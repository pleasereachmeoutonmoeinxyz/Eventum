<?php
require PATH_PROTECTED . '/controller/IndexController.php';
require PATH_PROTECTED . '/controller/MailController.php';
require PATH_PROTECTED . '/controller/EventController.php';

$app->mount("/",new Controller\IndexController());
$app->mount("/mail", new Controller\MailController());
$app->mount("/event",new Controller\EventController());