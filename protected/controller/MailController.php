<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    class MailController implements ControllerProviderInterface{
        public function connect(Application $app) {
            $controller =   $app['controllers_factory'];
            
            $controller->post('/subscribe',  function (Request $request) use ($app){
                
            })->bind('subscribe');
            
            return $controller;
        }
    }
}