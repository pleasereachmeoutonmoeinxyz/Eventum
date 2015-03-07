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

$twig_vars     =   array(
    'events'            =>  array(),
    'setting_link'      =>  mailHelper::generateSubscribeLink("Test Id","Test Code"),
    'unsubscribe_link'  =>  mailHelper::generateUnsubscribeLink("Test Id","Test Code"),
    'locals'            =>  $locals[$config['LANG']]['NEWSLETTER']                    
);
$subject    = $locals[$config['LANG']]['NEWSLETTER_SUBJECT'];
$content    = mailHelper::generateContent($twig_vars,'newsletter.html');
$data       = mailHelper::generateEmailJSON("moein7tl@gmail.com", $subject, $content);
$msg        = new AMQPMessage($data,array('delivery_mode' => 2));
$channel->basic_publish($msg, '', $config['CHANNEL']);    
$channel->close();
$connection->close();