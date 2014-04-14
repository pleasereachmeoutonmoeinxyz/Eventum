<?php

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

$loader->add('Models',PATH_PROTECTED . '/model');

$connection = new Connection();

$config = new Configuration();
$config->setProxyDir(PATH_PROTECTED . '/model/Proxies');
$config->setProxyNamespace('Proxies');
$config->setHydratorDir(PATH_PROTECTED . '/model/Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setDefaultDB($app['db']['collection']);
$config->setMetadataDriverImpl(AnnotationDriver::create(PATH_PROTECTED . '/model'));

AnnotationDriver::registerAnnotationClasses();

$dm = DocumentManager::create($connection, $config);