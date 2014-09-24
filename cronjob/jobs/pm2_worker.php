<?php
set_time_limit(0);

include_once (dirname(__DIR__))."/../vendor/autoload.php";
include_once (dirname(__DIR__))."/protected/helper/send.helper.php";
$config = include_once (dirname(__DIR__))."/protected/config.php";

use PhpAmqpLib\Connection\AMQPConnection;

Rollbar::init($config['ROLLBAR_CONFIG']);

Rollbar::report_message("{$config['WORKER_NAME']} worker is running", 'info');
Rollbar::flush();

try{
    $connection = new AMQPConnection($config['SERVER'], $config['PORT'], $config['USERNAME'], $config['PASSWORD']);    
} catch (Exception $ex) {
    Rollbar::report_exception($ex);
    exit();
}
$channel    = $connection->channel();

register_shutdown_function(function () use($connection,$channel){
    $channel->close();
    $connection->close();
});    

$callback = function($msg) use($config){
    $data     =   json_decode($msg->body);
    if ($config['USING_SMTP'] && filter_var($data->to, FILTER_VALIDATE_EMAIL)){
        sendHelper::sendBySMTP($data->to, $data->subject, $data->body);
    } else {
        $header   =   $data->headers;
        if ($config['WORKER_NAME'] !== 'MAIN'){
            str_replace($config['HEADER_FROM'], $config['HOST_HEADER_FROM'], $header);
            str_replace($config['HEADER_RETURN_PATH'], $config['HOST_HEADER_RP'], $header);                
        }
        sendHelper::sendByPHP($data->to, $data->subject, $data->body,$header);
    }
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);  
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume($config['CHANNEL'], '', false, false, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
    if ($config['USING_SMTP']){
    } else {
        sleep(rand(45, 75));
    }
}