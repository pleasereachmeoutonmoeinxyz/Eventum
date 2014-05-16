<?php

namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Validator\Constraints\NotBlank;
    class MailController implements ControllerProviderInterface{
        public function connect(Application $app) {
            
            $controller =   $app['controllers_factory'];
            
            $controller->post('/subscribe',array($this,'subscribeAction'));
            $controller->get('/unsbscribe/{id}/{code}',array($this,'unsbscribeAction'))->bind('unsubscribe');
            $controller->match('/setting/{id}/{code}',array($this,'settingAction'))->bind('setting')->method('GET|POST');
            
            return $controller;
        }
        
        /**
         * Handle subscribe request "base_url/mail/subscribe"
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @return type
         */
        public function subscribeAction(Request $request){
            $app    = \EventMail::app();

            if (!$data   =   $request->get('form'))
                $app->abort(404);

            $mail    = \Model\Mail::getLinkParams($data['email']);
            
            if ($mail instanceof \Model\Mail){
                if ((time() - $mail->critical_timestamp->sec) < $app['activation.time_limit'] && $mail->critical_timestamp->sec != $mail->subscribtion_timestamp->sec){
                    return \Helper\Ajax::error(NULL, $app['translator']->trans('ctrl.mail.subscribe.time_limit'), NULL);
                } else {
                    return $this->sendSettingMail($app,$mail);
                }
            } else if ($mail instanceof \Model\Errors) {
                return \Helper\Ajax::error(NULL, $app['translator']->trans('ctrl.mail.subscribe.errors'), $mail->getErrors());
            }            
        }
        
        /**
         * Handle unsubscribe request "base_url/mail/unsubscribe"
         * @param type $id
         * @param type $code
         * @return type
         */
        public function unsbscribeAction($id,$code){
            $app    = \EventMail::app();

            try{
                $mail   = \Model\Mail::findById($id); 
                if ($mail->code != $code){
                    throw new \Exception;
                }
            } catch (\MongoException $ex) {
                $app->abort(404);
            } catch(\Exception $ex){
                $app->abort(404);
            }

            $mail->setAsDeactive();
            return $app['twig']->render('mail/unsubscribe.html');         
        }
        
        /**
         * Handle setting request "base_url/mail/setting"
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @param type $id
         * @param type $code
         * @return type
         */
        public function settingAction(Request $request,$id,$code){
            $app    = \EventMail::app();
            
            try{
                $mail   = \Model\Mail::findById($id);    
            } catch (\MongoException $ex) {
                $app->abort(404);
            }

            if ($mail   !=  NULL && $mail->code === $code){
                return $this->settingHandler($app, $request, $mail);
            } else {
                $app->abort(404);
            }                   
        }
        
        /**
         * send setting url to user mail address and return json for ajax response
         * @param Application $app
         * @param \Model\Mail $mail
         * @return string
         */
        private function sendSettingMail(Application $app,$mail){
            if (\Helper\Mailer::settingMailUrl($mail->email, $mail->id, $mail->code)){
                $mail->updateTimestamp();
                return \Helper\Ajax::message(NULL, $app['translator']->trans('ctrl.mail.subscribe.sent_successfully'), NULL);
            } else {
                return \Helper\Ajax::error(NULL, $app['translator']->trans('ctrl.mail.subscribe.sent_error'), NULL);
            }            
        }
        
        /**
         * 
         * @param \Silex\Application $app
         * @param \Symfony\Component\HttpFoundation\Request $request
         * @param \Model\Mail $mail
         */
        private function settingHandler(Application $app,Request $request,  \Model\Mail $mail){
            $types      =   $app['event.types'];
            $categories =   $app['event.categories'];
            $locations  =   $app['event.locations'];
            $data               =   array(
                'locations' =>  $mail->locations,
                'types'     =>  $mail->types,
                'categories'=>  $mail->categories
            );                        

            $form                   =   $this->buildSettingForm($app,$types,$locations,$categories,$data);                   
            $save                   =   NULL;
            if ($request->isMethod('POST')){
                $form->bind($request);
                if ($form->isValid()){
                    $data               =   $form->getData();
                    $mail->categories   =   $data['categories'];
                    $mail->locations    =   $data['locations'];
                    $mail->types        =   $data['types'];
                    $mail->update();
                    $save               =   TRUE;
                }
            } else {
                $subscribtion_status    =   $mail->status;
                // active it if not
                $mail->setAsActive();                
            }

            // render view
            return $app['twig']->render('mail/setting.html',array(
                'subscribtion_status'       =>  $subscribtion_status,
                'form'                      =>  $form->createView(),
                'save'                      =>  $save
            ));            
        }


        /**
         * 
         * @param \Silex\Application $app
         * @param mixed $types
         * @param mixed $locations
         * @param mixed $categories
         * @param mixed $data
         * @return \Symfony\Component\Form\Form
         */
        private function buildSettingForm(Application $app,$types,$locations,$categories,$data){
            
            $builder = $app['form.factory']->createBuilder('form', $data);
            
            $builder
            ->add('types', 'choice', array(
                'choices' => $types,
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('locations', 'choice', array(
                'choices' => $locations,
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('categories', 'choice', array(
                'choices' => $categories,
                'multiple' => true,
                'expanded' => true,
            ));
            return $builder->getForm();            
        }
    }
}