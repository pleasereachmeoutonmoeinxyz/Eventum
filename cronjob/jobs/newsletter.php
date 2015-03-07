<?php
set_time_limit(0);

include_once (dirname(__DIR__))."/protected/helper/cron.helper.php";
include_once (dirname(__DIR__))."/../vendor/autoload.php";
include_once (dirname(__DIR__))."/protected/helper/send.helper.php";
include_once (dirname(__DIR__))."/protected/helper/mail.helper.php";
$config = include_once (dirname(__DIR__))."/protected/config.php";
$locals = include_once (dirname(__DIR__))."/protected/locals.php";

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

Rollbar::init($config['ROLLBAR_CONFIG']);

$counter    =   0;

if(($pid = cronHelper::lock()) !== FALSE) {
    register_shutdown_function(function (){
        cronHelper::unlock();
    });
    
    try{
        $connection =   new AMQPConnection($config['SERVER'], $config['PORT'], $config['USERNAME'], $config['PASSWORD']);
        $channel    =   $connection->channel();
        $channel->queue_declare($config['CHANNEL'], false, true, false, false);
    } catch (Exception $ex) {    
        Rollbar::report_exception($ex);
        exit();
    }
    
    register_shutdown_function(function () use($connection,$channel){
        $channel->close();
        $connection->close();    
    });

    try{
        $mongo      =   new Mongo($config['DB_STRING']);        
    } catch (Exception $ex) {
        Rollbar::report_exception($ex);
        exit();
    }
    
    register_shutdown_function(function () use($mongo){
        $mongo->close();
    });
    $db         =   $mongo->selectDB($config['DB_COLLECTION']);
    $event      =   $db->Event;
    $mail       =   $db->Mail;
    $emails     =   $mail->find(array('status'=>'ACTIVE'));
    
    foreach ($emails as $email){
        $criteria  =    array('$and'=>array(
                            array('types'       =>  array('$in'=>$email['types'])),
                            array('locations'   =>  array('$in'=>$email['locations'])),
                            array('categories'  =>  array('$in'=>$email['categories'])),
                            array('confirmation'=>  'ACCEPTED'),                                
                            array('status'      =>  'NEW')
            ));
        $events         =   $event->find($criteria);
        $userEvent      =   array();
        
        foreach ($events as $eventObj){
            $userEvent[]    =   array(
                'subject'   =>  $eventObj['subject'],
                'site'      =>  $eventObj['site'],
                'tweet'     =>  $eventObj['tweet'],
                'date'      =>  $eventObj['date'],
                'url'       =>  mailHelper::generateEventUrl($eventObj['_id']),
            );
        }
        if (count($userEvent)){
                $twig_vars     =   array(
                    'events'            =>  $userEvent,
                    'setting_link'      =>  mailHelper::generateSubscribeLink($email['_id'], $email['code']),
                    'unsubscribe_link'  =>  mailHelper::generateUnsubscribeLink($email['_id'], $email['code']),
                    'locals'    =>  $locals[$config['LANG']]['NEWSLETTER']                    
                );
                $subject    = $locals[$config['LANG']]['NEWSLETTER_SUBJECT'];
                $content    = mailHelper::generateContent($twig_vars,'newsletter.html');
                $data       = mailHelper::generateEmailJSON($email['email'], $subject, $content);
                $msg        = new AMQPMessage($data,array('delivery_mode' => 2));
                $channel->basic_publish($msg, '', $config['CHANNEL']);    
                $counter++;            
        }
    }
    
    $event->update(array('$and'=>array(
                                array('confirmation'=>  'ACCEPTED'),
                                array('status'      =>  'NEW'))),
                    array(
                        '$set' => array('status'    =>  'SENT')
                    ),
                    array('multiple'=> true)
        );
}

Rollbar::report_message("{$counter} mail generated", 'info');
Rollbar::flush();