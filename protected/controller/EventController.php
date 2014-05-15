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
            
            $controller->match('/content/{id}/{code}',array($this,'contentAction'))
                    ->bind('event_content')->method('GET|POST');
            return $controller;
        }
        

        public function contentAction(Request $request,$id,$code){
            $app    = \EventMail::app();
            $form   = $this->buildContentForm($app);
            return $app['twig']->render('event/content.html',array(
                        'form'  =>  $form->createView()
                    ));
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
                
                if ($event->status !== \Model\Event::STATUS_NEW){
                    $app->abort(404);
                }
                $data   = get_object_vars($event);
            }
            
            $form       =   $this->buildBasicForm($app,$data);      
            
            if ($request->isMethod('POST')){
                $form->bind($request);
                if ($form->isValid()){
                    $data   =   $form->getData();
                    if ($event  === NULL){
                        $event  =   new \Model\Event;
                    }
                    
                    foreach ($data as $key=>$value){
                        $event->{$key}  =   $value;
                    }
                    $event->save();
                    
//                       \Helper\Mailer::eventUrl($event->email, $event->id, $event->code);                    
                    return $app->redirect($app['url_generator']->generate('event_content',array('id'=>$event->id,'code'=>$event->code)));
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
        
        private function buildContentForm(Application $app,$data=array()){
            $builder    =   $app['form.factory']->createBuilder('form',$data);
            $builder->add('content', 'textarea', array('label'=>false));
            return $builder->getForm();
        }
    }
}

