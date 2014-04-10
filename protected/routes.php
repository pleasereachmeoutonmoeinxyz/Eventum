<?php
require PATH_PROTECTED . '/controller/IndexController.php';
require PATH_PROTECTED . '/controller/MailController.php';

$app->mount("/",new Controller\IndexController());
$app->mount("/mail", new Controller\MailController());