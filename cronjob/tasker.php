<?php
include_once (dirname(__FILE__))."/cron.helper.php";
include_once (dirname( __DIR__ )."/vendor/autoload.php");
$config = include_once (dirname(__FILE__))."/config.php";

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
Rollbar::init($config['ROLLBAR_CONFIG']);
if(($pid = cronHelper::lock()) !== FALSE) {
    set_time_limit(0);
    try{
        $connection =   new AMQPConnection($config['SERVER'], $config['PORT'], $config['USERNAME'], $config['PASSWORD']);
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
    
    $channel    =   $connection->channel();
    $channel->queue_declare($config['CHANNEL'], false, true, false, false);
    $db         =   $mongo->selectDB($config['DB_COLLECTION']);
    $event      =   $db->Event;
    $mail       =   $db->Mail;
    
    while($event->find(array('$and'=>array(array('status'=>'NEW'),array('confirmation'=>'ACCEPTED'))))->count()){
        $event_obj  =   $event->findOne(array('$and'=>array(array('status'=>'NEW'),array('confirmation'=>'ACCEPTED'))));       
        $event->update(
                array('_id' =>  $event_obj['_id']),
                array('$set'=>  array('status'=>'RUNNING'))
                );
        $query  =   array('$and'=>array(
                                        array('types'       =>  array('$in'=>$event_obj['types'])),
                                        array('locations'   =>  array('$in'=>$event_obj['locations'])),
                                        array('categories'  =>  array('$in'=>$event_obj['categories']))));
        
        $email_counter  =   $mail->find($query)->count();
        
        for($i = 0;$i < $email_counter;$i+= $config['PAGINATION_LIMIT']){
            $results    =   $mail->find($query,array('email'))->skip($i)->limit($config['PAGINATION_LIMIT']);
            foreach ($results as $result){
                $data    = genrateEmailJSON($result['email'], $event_obj['subject'], $event_obj['content']);
                $msg = new AMQPMessage($data,array('delivery_mode' => 2));
                $channel->basic_publish($msg, '', $config['CHANNEL']);                
            }
        }
        $event->update(
                array('_id' =>  $event_obj['_id']),
                array('$set'=>  array('status'=>'SENT'))
                );
        break;
    }
    
    $channel->close();
    $connection->close();    
    $mongo->close();
    cronHelper::unlock();
}

function genrateEmailJSON($to,$subject,$body){
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Eventum.ir<events@eventum.ir>" . "\r\n";
    $headers .= "TO: {$to}" . "\r\n";

    $data   =   array(
        'to'        =>  $to,
        'subject'   =>  $subject,
        'body'      =>  $body,
        'headers'   =>  $headers
    );
    
    return json_encode($data);
}