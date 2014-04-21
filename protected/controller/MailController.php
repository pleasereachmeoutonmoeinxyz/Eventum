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
                return $this->subscribeResonse($mail);

            })->bind('subscribe');
            return $controller;
        }
        
        /**
         * generate subscribtion json response
         * @param \Model\Mail $mail
         * @return string
         */
        private function subscribeResonse($mail){
            if ($mail instanceof \Model\Mail){
                if ((time() - $mail->cTimestamp) < $app['activation.time_limit']){
                    return \Helper\Ajax::error($code, $message, $data);
                } else {
                    return $this->sendSettingMail($mail);
                }
            } elseif ($mail instanceof \Model\Errors) {
                return \Helper\Ajax::error($code, $message, $data);
            }            
        }
        /**
         * send setting url to user mail address and return json for ajax response
         * @param \Model\Mail $mail
         * @return string
         */
        private function sendSettingMail($mail){
            if (Helper\Mailer::settingMailUrl($mail->email, $mail->id, $mail->link)){
                return \Helper\Ajax::message($code, $message, $data);
            } else {
                return \Helper\Ajax::error($code, $message, $data);
            }            
        }
    }
}