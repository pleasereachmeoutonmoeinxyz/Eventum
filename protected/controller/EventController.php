<?php
namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Validator\Constraints\NotBlank;
    
    class EventController implements ControllerProviderInterface{
        public function connect(Application $app) {
            
            $controller =   $app['controllers_factory'];
            
            $controller->match('/new',array($this,'newEventAction'))->bind('new_event')->method('GET|POST');
            
            return $controller;
        }
        
        public function newEventAction(Request $request){
            $app    = \EventMail::app();
            
            
            return $app['twig']->render('event/new_event.html');
        }
    }
}

