<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    class MailController implements ControllerProviderInterface{
        public function connect(Application $app) {
            
            $controller =   $app['controllers_factory'];
            
            $controller->post('/subscribe',  function (Request $request) use ($app){
                if (!$data   =   $request->get('form'))
                    $app->abort(400);
                
                $mail    = \Model\Mail::getLinkParams($data['email']);
                return $this->subscribeResonse($app,$mail);

            })->bind('subscribe');
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
                if ((time() - $mail->cTimestamp) < $app['activation.time_limit']){
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
            if (\Helper\Mailer::settingMailUrl($mail->email, $mail->id, $mail->link)){
                return \Helper\Ajax::message(NULL, $app['translator']->trans('ctrl.mail.subscribe.sent_successfully'), NULL);
            } else {
                return \Helper\Ajax::error(NULL, $app['translator']->trans('ctrl.mail.subscribe.sent_error'), NULL);
            }            
        }
    }
}