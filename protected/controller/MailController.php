<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    class MailController implements ControllerProviderInterface{
        public function connect(Application $app) {
            $controller =   $app['controllers_factory'];
            
            $controller->post('/subscribe',  function (Request $request) use ($app){
                if (!$data   =   $request->get('form')){
                    $app->abort(400);
                }
                
                $mail   =   new \Model\MailProvider($app['']);
                $mail->setEmail($data['email']);
                
                if (count($app['validator']->validate($mail)) > 0){
                    
                }
                
                
            })->bind('subscribe');
            return $controller;
        }
    }
}