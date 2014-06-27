<?php
set_time_limit(0);
include_once (dirname( __DIR__ )."/vendor/autoload.php");
$config = include_once (dirname(__FILE__))."/config.php";

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
Rollbar::init($config['ROLLBAR_CONFIG']);

Rollbar::report_message("Worker is running", 'info');
Rollbar::flush();

try{
    $connection = new AMQPConnection($config['SERVER'], $config['PORT'], $config['USERNAME'], $config['PASSWORD']);    
} catch (Exception $ex) {
    Rollbar::report_exception($ex);
    exit();
}

$channel    = $connection->channel();
$channel->queue_declare($config['CHANNEL'], false, true, false, false);
$callback = function($msg){
  $data = json_decode($msg->body);
  $header   =   $data->headers;
  str_replace($config['HEADER_FROM'], $config['HOST_HEADER_FROM'], $header);
  str_replace($config['HEADER_RETURN_PATH'], $config['HOST_HEADER_RP'], $header);
  mail($data->to, $data->subject, $data->body,$header);
  $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);  
  sleep(rand(10, 15));
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume($config['CHANNEL'], '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

