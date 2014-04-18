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
                
                $params    = \Model\Mail::getLinkParams($data['email']);
                
                return "X";
            })->bind('subscribe');
            return $controller;
        }
    }
}