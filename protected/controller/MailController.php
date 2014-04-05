<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    class MailController implements ControllerProviderInterface{
        public function connect(Application $app) {
            $mailController = $app['controllers_factory'];
            $mailController->post('/subscribe', array($this,'login'))->bind('subscribe');
            $mailController->get('/unsubscribe',array($this,'unsubscribe'))->bind('unsubscribe');
            $mailController->get('/setting',array($this,'setting'))->bind('setting');
        }
        
        function setting(Application $app){
            
        }
    }
}