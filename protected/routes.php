<?php
require PATH_PROTECTED . '/controller/IndexController.php';
$app->mount("/",new Controller\IndexController());