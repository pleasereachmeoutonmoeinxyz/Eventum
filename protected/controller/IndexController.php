<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    class IndexController implements ControllerProviderInterface{
        public function connect(Application $app) {
            $controller =   $app['controllers_factory'];
            $controller->get("/",array($this,"index"))->bind('homepage');
            return $controller;
        }        
        
        function index(Application $app){
            $form   =   $app['form.factory']->createBuilder('form')
                        ->add('email','email', array('label'=>false))
                        ->getForm();
            
            return $app['twig']->render('index.html',array(
                'form'  =>  $form->createView()
            ));
        }
    }
}