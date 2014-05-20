<?php
set_time_limit(0);
include_once (dirname( __DIR__ )."/vendor/autoload.php");
$config = include_once (dirname(__FILE__))."/config.php";

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
Rollbar::init($config['ROLLBAR_CONFIG']);

try{
    $connection = new AMQPConnection($config['SERVER'], $config['PORT'], $config['USERNAME'], $config['PASSWORD']);    
} catch (Exception $ex) {
    Rollbar::report_exception($ex);
    exit();
}

$channel    = $connection->channel();
$channel->queue_declare($config['CHANNEL'], false, true, false, false);

$callback = function($msg){
  $data = json_encode($msg->body);
  mail($data['to'], $data['subject'], $data['body'],$data['headers']);
  sleep(rand(1, 5));
  $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume($config['CHANNEL'], '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

