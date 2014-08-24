<?php
set_time_limit(0);
include_once (dirname(__FILE__))."/cron.helper.php";
include_once (dirname( __DIR__ )."/vendor/autoload.php");
include_once (dirname(__FILE__))."/mailhelper.php";
$config = include_once (dirname(__FILE__))."/config.php";

Rollbar::init($config['ROLLBAR_CONFIG']);

Rollbar::report_message("Share is running", 'info');
Rollbar::flush();
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

    while($event->find(array('$and'=>array(array('status'=>'NEW'),array('confirmation'=>'ACCEPTED'))))->count()){
        
        $eventObj   =   $event->findOne(array('$and'=>array(
                                                        array('confirmation'=>'ACCEPTED'),
                                                        array('shared'=>array('$exists'=>FALSE)),
                                                        array('shared'=>FALSE)
        )));
        sendHelper::sendBySMTP($config['EMAIL_TO_TWITTER'], $eventObj['subject'], $eventObj['site']);
        $event->update( array('_id' =>  $eventObj['_id']),array('$set'=>  array('shared'=>TRUE)));
    }
}

Rollbar::report_message("Share has been ended. {{$counter}} events shared", 'info');
Rollbar::flush();