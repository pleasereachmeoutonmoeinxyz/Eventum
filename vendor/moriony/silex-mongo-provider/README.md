# silex-mongo-provider
[![Build Status](https://travis-ci.org/moriony/silex-mongo-provider.png?branch=master)](https://travis-ci.org/moriony/silex-mongo-provider) [![Coverage Status](https://coveralls.io/repos/moriony/silex-mongo-provider/badge.png?branch=master)](https://coveralls.io/r/moriony/silex-mongo-provider?branch=master) [![Dependency Status](https://www.versioneye.com/user/projects/51980354e6cb9b000200b188/badge.png)](https://www.versioneye.com/user/projects/51980354e6cb9b000200b188)

[Mongo](http://mongodb.org/) service provider for the [Silex](http://silex.sensiolabs.org/) framwork.

## Install via composer

Add in your ```composer.json``` the require entry for this library.
```json
{
    "require": {
        "moriony/silex-mongo-provider": "*"
    }
}
```
and run ```composer install``` (or ```update```) to download all files.

## Usage

### Service registration
```php
$app->register(new MongoServiceProvider, array(
    'mongo.connections' => array(
        'default' => array(
            'server' => "mongodb://localhost:27017",
            'options' => array("connect" => true)
        )
    ),
));
```

###  Connections retrieving
```php
$connections = $app['mongo'];
$defaultConnection = $connections['default']; 
```

###  Creating mongo connection via factory
```php
$mongoFactory = $app['mongo.factory'];
$customConnection = $mongoFactory("mongodb://localhost:27017", array("connect" => true));
```
