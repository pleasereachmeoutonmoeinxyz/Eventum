<?php

define( 'PATH_ROOT',            dirname( __DIR__ ) );
define( 'PATH_PROTECTED',       PATH_ROOT       . '/protected' );
define( 'PATH_RUNTIME',         PATH_ROOT       . '/runtime' );
define( 'PATH_CACHE',           PATH_RUNTIME    . '/cache' );
define( 'PATH_LOG',             PATH_RUNTIME    . '/log' );
define( 'PATH_PUBLIC',          PATH_ROOT       . '/public_html' );
define( 'PATH_VENDOR',          PATH_ROOT       . '/vendor' );
define( 'PATH_LOCALES',         PATH_PROTECTED    . '/locals' );
define( 'PATH_VIEWS',           PATH_PROTECTED    . '/views' );

$loader =   require_once PATH_VENDOR . '/autoload.php';

$app    =   new Silex\Application();

require PATH_PROTECTED . '/config/development.php';
require PATH_PROTECTED . '/bootstrap.php';
require PATH_PROTECTED . '/app.php';

$app['http_cache']->run();