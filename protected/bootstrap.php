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

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

if ( ! file_exists($file = PATH_ROOT . '/vendor/autoload.php')) {
    throw new RuntimeException('Install dependencies to run this script.');
}

$loader = require_once $file;


