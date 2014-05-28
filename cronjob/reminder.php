<?php

include_once (dirname(__FILE__))."/cron.helper.php";
include_once (dirname( __DIR__ )."/vendor/autoload.php");
$config = include_once (dirname(__FILE__))."/config.php";
$locals = include_once (dirname(__FILE__))."/locals.php";

$loader = new Twig_Loader_Filesystem(dirname(__FILE__)."/views");
$twig = new Twig_Environment($loader, array(
    'cache' => dirname(__FILE__)."/runtime/cache",
));

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
Rollbar::init($config['ROLLBAR_CONFIG']);

Rollbar::report_message("Reminder is running", 'info');
Rollbar::flush();

if(($pid = cronHelper::lock()) !== FALSE) {
    set_time_limit(0);
    try{
        $connection =   new AMQPConnection($config['SERVER'], $config['PORT'], $config['USERNAME'], $config['PASSWORD']);
        $channel    =   $connection->channel();
        $channel->queue_declare($config['CHANNEL'], false, true, false, false);
    } catch (Exception $ex) {    
        Rollbar::report_exception($ex);
        cronHelper::unlock();
        exit();
    }

    try{
        $mongo      =   new Mongo($config['DB_STRING']);        
    } catch (Exception $ex) {
        Rollbar::report_exception($ex);
        $channel->close();
        $connection->close();    
        cronHelper::unlock();
        exit();
    }
    
    $db         =   $mongo->selectDB($config['DB_COLLECTION']);
    $maildb     =   $db->Mail;
    $query      =   array('$and'=>array(
                                    array('status'=>'DEACTIVE'),
                                    array('critical_timestamp'=>array('$lt'=>(new MongoTimestamp(time() - $config['REMINDER_CTS'])))),
                                    array('$or'=>array(
                                        array('last_remind'=>array('$exists'=>FALSE)),
                                        array('last_remind'=>array('$lt'=>(new MongoTimestamp(time() - $config['REMINDER_LRTS']))))
                                    ))
                    ));

    while(($mail = $maildb->findOne($query)) != NULL){
        $maildb->update(array('_id' =>  $mail['_id']),
                        array('$set'=>  array('last_remind' =>  new MongoTimestamp())));
        
        $content    =   $twig->render('reminder.html',array('link'=>$config['URL_SETTING_BASE']."/{$mail['_id']}/{$mail['code']}",'locals'=>$locals[$config['LANG']]['REMINDER']));
        $data       = genrateEmailJSON($mail['email'], $locals[$config['LANG']]['REMINDER_SUBJECT'], $content);
        $msg        = new AMQPMessage($data,array('delivery_mode' => 2));
        $channel->basic_publish($msg, '', $config['CHANNEL']);               
    }
    
    
    $channel->close();
    $connection->close();    
    $mongo->close();
    cronHelper::unlock();
}

Rollbar::report_message("Reminder has been ended.", 'info');
Rollbar::flush();

function genrateEmailJSON($to,$subject,$body){
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Eventum.ir<noreply@eventum.ir>" . "\r\n";
    $headers .= "To: {$to}" . "\r\n";

    $data   =   array(
        'to'        =>  $to,
        'subject'   =>  $subject,
        'body'      =>  $body,
        'headers'   =>  $headers
    );
    
    return json_encode($data);
}