<?php

include_once (dirname(__FILE__))."/cron.helper.php";
include_once (dirname( __DIR__ )."/vendor/autoload.php");
include_once (dirname(__FILE__))."/mailhelper.php";
$config = include_once (dirname(__FILE__))."/config.php";
$locals = include_once (dirname(__FILE__))."/locals.php";

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
Rollbar::init($config['ROLLBAR_CONFIG']);

Rollbar::report_message("Reminder is running", 'info');
Rollbar::flush();

$counter    =   0;

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
                                    array('status'=>'WAITING'),
                                    array('critical_timestamp'=>array('$lt'=>(new MongoTimestamp(time() - $config['REMINDER_CTS'])))),
                                    array('$or'=>array(
                                        array('last_remind'=>array('$exists'=>FALSE)),
                                        array('last_remind'=>array('$lt'=>(new MongoTimestamp(time() - $config['REMINDER_LRTS']))))
                                    ))
                    ));

    while(($mail = $maildb->findOne($query,array('email','code'))) != NULL){
        $maildb->update(array('_id' =>  $mail['_id']),
                        array('$set'=>  array('last_remind' =>  new MongoTimestamp())));
        
        $twig_vars     =   array(
            'unsubscribe_link'  =>  mailHelper::generateUnsubscribeLink($mail['_id'], $mail['code']),
            'link'              =>  mailHelper::generateSUbscribeLink($mail['_id'], $mail['code']),
            'locals'            =>  $locals[$config['LANG']]['REMINDER']
        );
        $content    = mailHelper::generateContent($twig_vars,'reminder.html');
        $data       = mailHelper::generateEmailJSON($mail['email'], $locals[$config['LANG']]['REMINDER_SUBJECT'], $content);        
        $msg        = new AMQPMessage($data,array('delivery_mode' => 2));
        $channel->basic_publish($msg, '', $config['CHANNEL']);      
        $counter++;
    }
    
    
    $channel->close();
    $connection->close();    
    $mongo->close();
    cronHelper::unlock();
}

Rollbar::report_message("Reminder has been ended. {{$counter}} mails sent.", 'info');
Rollbar::flush();