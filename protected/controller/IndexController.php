<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    
    class IndexController implements ControllerProviderInterface{
        public function connect(Application $app) {
            $controller =   $app['controllers_factory'];
            $controller->get("/",array($this,"index"))->bind('index');
            return $controller;
        }        
        
        function index(Application $app){
            return $app['twig']->render('index.html');
        }
    }
}
