<?php
namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Constraints as Assert;

    class EventController implements ControllerProviderInterface{
        public function connect(Application $app) {
            
            $controller =   $app['controllers_factory'];
            
            $controller->match('/basic/{id}/{code}',array($this,'basicAction'))
                    ->value('id', null)->value('code',null)
                    ->bind('event_basic')->method('GET|POST');
            
            return $controller;
        }
        
        
        
        public function basicAction(Request $request,$id,$code){
            $app        =   \EventMail::app();
            $data       =   array();
            $event      =   NULL;
            if ($id != NULL && $code != null){
                try{
                    $event  = \Model\Event::findById($id);
                    if ($event->code !== $code){
                        throw new \Exception;
                    }
                } catch (\MongoException $ex) {
                    $app->abort(404);
                } catch (\Exception $ex){
                    $app->abort(404);
                }
                $data   =   (array) $event;
            }
            
            $form       =   $this->buildBasicForm($app,$data);      
            
            if ($request->isMethod('POST')){
                $form->bind($request);
                if ($form->isValid()){
                    $data   =   $form->getData();
                    if ($event  === NULL){
                        $event  =   new \Model\Event;
                        $event->code    =   '';
                    }
                    
                    foreach ($data as $key=>$value){
                        $event->{$key}  =   $value;
                    }                    
                    $event->insert();
                }
            }
            
            return $app['twig']->render('event/basic.html',array('form'=>$form->createView()));
        }
    
        private function buildBasicForm(Application $app,$data = array()){
            $builder    =   $app['form.factory']->createBuilder('form',$data)
                                ->add('name','text',array(
                                    'constraints'   => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
                                    ))
                                ->add('email','email',array(
                                    'constraints'   =>  array(new Assert\NotBlank(),new Assert\Email())
                                ))
                                ->add('site','text',array(
                                    'constraints'   =>  array(new Assert\Url(),new Assert\NotBlank,new Assert\Length(array('min'=>5)))
                                ))
                                ->add('tel','text',array(
                                    'constraints'   =>  array(new Assert\NotBlank(),new Assert\Regex(array('pattern'=>'/^0[0-9]{8,10}$/')))
                                ))
                                ->add('types', 'choice', array(
                                    'choices' => $app['event.types'],
                                    'multiple' => true,
                                    'expanded' => true,
                                ))
                                ->add('locations', 'choice', array(
                                    'choices' => $app['event.locations'],
                                    'multiple' => true,
                                    'expanded' => true,
                                ))
                                ->add('categories', 'choice', array(
                                    'choices' => $app['event.categories'],
                                    'multiple' => true,
                                    'expanded' => true,
                                ));            
            return $builder->getForm();
        }
    }
}

