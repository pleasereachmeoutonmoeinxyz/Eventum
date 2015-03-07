<?php
set_time_limit(0);

include_once (dirname(__DIR__))."/protected/helper/cron.helper.php";
include_once (dirname(__DIR__))."/../vendor/autoload.php";
include_once (dirname(__DIR__))."/protected/helper/send.helper.php";
include_once (dirname(__DIR__))."/protected/helper/mail.helper.php";
$config = include_once (dirname(__DIR__))."/protected/config.php";
$locals = include_once (dirname(__DIR__))."/protected/locals.php";

Rollbar::init($config['ROLLBAR_CONFIG']);

$counter    =   0;

if(($pid = cronHelper::lock()) !== FALSE) {
    register_shutdown_function(function (){
        cronHelper::unlock();
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
    $criteria   =   array('$and'=>array(array('confirmation'=>'ACCEPTED'),
                                        array('$or'=>array(
                                            array('notify'=>array('$exists'=>FALSE)),
                                            array('notify'=>FALSE)
                                        ))));
    while(($eventObj   =   $event->findOne($criteria)) != NULL){
        $subject    =   $locals[$config['LANG']]['NOTIFY_SUBJECT'];
        $twig_vars  =   array(
            'locals'        =>  $locals[$config['LANG']]['NOTIFY'],
            'name'          =>  $eventObj['name'],
            'subject'       =>  $eventObj['subject'],
            'banners_link'  =>  $config['BANNERS_LINK'],
            'donate_link'   =>  $config['DONATE_LINK']
        );
        $body       =   mailHelper::generateContent($twig_vars,'notify.html');
        sendHelper::sendBySMTP($eventObj['email'], $subject, $body);
        $event->update( array('_id' =>  $eventObj['_id']),array('$set'=>  array('notify'=>TRUE)));     
        $counter++;
    }
}

Rollbar::report_message("{$counter} event owners notified", 'info');
Rollbar::flush();