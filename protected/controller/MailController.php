<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    class MailController implements ControllerProviderInterface{
        public function connect(Application $app) {
            
            $controller =   $app['controllers_factory'];
            
            // subscribe action
            $controller->post('/subscribe',  function (Request $request) use ($app){
                if (!$data   =   $request->get('form'))
                    $app->abort(404);
                
                $mail    = \Model\Mail::getLinkParams($data['email']);
                return $this->subscribeResonse($app,$mail);
            });
            
            // unsubscribe action
            $controller->get('/unsubscribe/{id}/{code}',  function ($id,$code) use ($app){
                try{
                    $mail   = \Model\Mail::findById($id);    
                } catch (\MongoException $ex) {
                    $app->abort(404);
                }
                
                if ($mail   !=  NULL && $mail->code === $code){
                    $mail->setAsDeactive();
                    return $app['twig']->render('mail/unsubscribe.html');
                } else {
                    $app->abort(404);
                }
            })->bind('unsubscribe');
            
            // setting get action
            $controller->get('/setting/{id}/{code}',    function($id,$code) use ($app){
                try{
                    $mail   = \Model\Mail::findById($id);    
                } catch (\MongoException $ex) {
                    $app->abort(404);
                }
                
                if ($mail   !=  NULL && $mail->code === $code){
                    
                    $default_types      =   $app['event.types'];
                    $default_categories =   $app['event.categories'];
                    $default_locations  =   $app['event.locations'];
                    
                    // load user setting
                    $user_types         =   $mail->types;
                    $user_categories    =   $mail->categories;
                    $user_locations     =   $mail->locations;
                    $subscribtion_status=   $mail->status;
                    
                    // active it if not
                    $mail->setAsActive();
                    
                    // render view
                    return $app['twig']->render('mail/setting',array(
                        'default_types'             =>  $default_types,
                        'default_categories'        =>  $default_categories,
                        'default_locations'         =>  $default_locations,
                        'user_types'                =>  $user_types,
                        'user_categories'           =>  $user_categories,
                        'user_locations'            =>  $user_locations,
                        'subscribtion_status'       =>  $subscribtion_status
                    ));
                    
                } else {
                    $app->abort(404);
                }                
            })->bind('setting');
            
            
            
            return $controller;
        }
        
        /**
         * generate subscribtion json response
         * @param Application $app
         * @param \Model\Mail $mail
         * @return string
         */
        private function subscribeResonse(Application $app,$mail){
            if ($mail instanceof \Model\Mail){
                if ((time() - $mail->critical_imestamp->sec) < $app['activation.time_limit'] && $mail->critical_imestamp->sec != $mail->subscribtion_timestamp->sec){
                    return \Helper\Ajax::error(NULL, $app['translator']->trans('ctrl.mail.subscribe.time_limit'), NULL);
                } else {
                    return $this->sendSettingMail($app,$mail);
                }
            } elseif ($mail instanceof \Model\Errors) {
                return \Helper\Ajax::error(NULL, $app['translator']->trans('ctrl.mail.subscribe.errors'), $mail->getErrors());
            }            
        }
        /**
         * send setting url to user mail address and return json for ajax response
         * @param Application $app
         * @param \Model\Mail $mail
         * @return string
         */
        private function sendSettingMail(Application $app,$mail){
            if (\Helper\Mailer::settingMailUrl($mail->email, $mail->id, $mail->mail)){
                $mail->updateTimestamp();
                return \Helper\Ajax::message(NULL, $app['translator']->trans('ctrl.mail.subscribe.sent_successfully'), NULL);
            } else {
                return \Helper\Ajax::error(NULL, $app['translator']->trans('ctrl.mail.subscribe.sent_error'), NULL);
            }            
        }
    }
}