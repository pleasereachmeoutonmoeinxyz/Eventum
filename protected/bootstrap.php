<?php

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

$loader->add('Model',PATH_PROTECTED);

$connection = new Connection($app['db']['server']);
$config = new Configuration();
$config->setProxyDir(PATH_RUNTIME . '/Proxies');
$config->setProxyNamespace('Proxies');
$config->setHydratorDir(PATH_RUNTIME . '/Hydrators');
$config->setHydratorNamespace('Hydrators');
$config->setDefaultDB($app['db']['collection']);
$config->setMetadataDriverImpl(AnnotationDriver::create(PATH_PROTECTED . '/Model'));

AnnotationDriver::registerAnnotationClasses();

$app['dm']  =   DocumentManager::create($connection, $config);
//$app['dm']->getSchemaManager()->ensureIndexes();