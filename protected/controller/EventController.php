<?php
namespace Controller{
    use Silex\Application;
    use Silex\ControllerProviderInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Validator\Constraints\NotBlank;
    
    class EventController implements ControllerProviderInterface{
        public function connect(Application $app) {
        }
    }
}
