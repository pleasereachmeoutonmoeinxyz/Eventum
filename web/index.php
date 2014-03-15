<?php

require_once './../vendor/autoload.php';
$app    =   new Silex\Application();

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use RedBean_Facade as R;

$app->register(new Ivoba\Silex\RedBeanServiceProvider(), array(
    'db.options' => array( 
        'dsn'       =>  'mysql:host=localhost;dbname=eventmail' ,
        'username'  =>  'root',
        'password'  =>  'hitler2013'
    )));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app['db']; // init RedBean


$app->get('/', function() use ($app){
    return $app['twig']->render('index.html');
});

$app->post('/subscribe',function(Request $request) use ($app){
    $email      =   $request->get('email');
    $errors     =   $app['validator']->validateValue($email, new Assert\Email());
    if (count($errors)){
        return json_encode(array('success'=>FALSE,'error'=>'wrong-mail'));
    } else {
        if (R::count('email', ' email=:email', array(':email'=>$email))){
            
        } else {
            $bean           =   R::dispense('email');
            $bean->email    =   $email;
            R::store($bean);
            return json_encode(array('success'=>TRUE));
        }
    }
});
$app->run();