<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    class MailController implements ControllerProviderInterface{
        public function connect(Application $app) {
            $controller =   $app['controllers_factory'];
            
            $controller->post('/subscribe',array($this,'subscribe'))->bind('subscribe');
            
            return $controller;
        }
        
        function subscribe(Application $app){
            
        }
    }
}