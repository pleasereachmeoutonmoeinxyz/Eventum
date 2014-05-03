<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Validator\Constraints\NotBlank;
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
            $controller->match('/setting/{id}/{code}',    function(Request $request,$id,$code) use ($app){
                try{
                    $mail   = \Model\Mail::findById($id);    
                } catch (\MongoException $ex) {
                    $app->abort(404);
                }
                
                if ($mail   !=  NULL && $mail->code === $code){
                    
                    $types      =   $app['event.types'];
                    $categories =   $app['event.categories'];
                    $locations  =   $app['event.locations'];
                    
                    // load user setting
                    $data               =   array(
                        'locations' =>  $mail->locations,
                        'types'     =>  $mail->types,
                        'categories'=>  $mail->categories
                    );
                    
                    $form                   =   $this->generateSettingForm($app,$types,$locations,$categories,$data);                   
                    $subscribtion_status    =   $mail->status;
                    // active it if not
                    $mail->setAsActive();
                    
                    // render view
                    return $app['twig']->render('mail/setting.html',array(
                        'subscribtion_status'       =>  $subscribtion_status,
                        'form'                      =>  $form->createView()
                    ));
                } else {
                    $app->abort(404);
                }                
            })->bind('setting')->method('GET|POST');
            
            
            
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
        
        private function generateSettingForm(Application $app,$types,$locations,$categories,$data){
            
            $builder = $app['form.factory']->createBuilder('form', $data);
            
            $builder
            ->add('types', 'choice', array(
                'choices' => $types,
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('locations', 'choice', array(
                'choices' => $locations,
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('categories', 'choice', array(
                'choices' => $categories,
                'multiple' => true,
                'expanded' => true,
            ));
            return $builder->getForm();            
        }
    }
}