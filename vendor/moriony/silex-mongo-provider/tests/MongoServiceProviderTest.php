<?php

namespace Mongo\Silex\Tests;

use Silex\Application;
use Mongo\Silex\Provider\MongoServiceProvider;

class MongoServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Application
     */
    protected $app;

    protected $mongoClass;

    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new MongoServiceProvider, array(
            'mongo.connections' => array(
                'default' => array(
                    'server' => "mongodb://localhost:27017",
                    'options' => array("connect" => false)
                )
            ),
        ));
        $this->mongoClass = (version_compare(phpversion('mongo'), '1.3.0', '<')) ? '\Mongo' : '\MongoClient';
    }

    public function testServiceDeclaration()
    {
        $this->assertInstanceOf('Mongo\Silex\Provider\MongoConnectionProvider', $this->app['mongo']);
    }

    public function testConnectionProvider()
    {
        $this->assertInstanceOf($this->mongoClass, $this->app['mongo']['default']);
    }

    public function testFactory()
    {
        $factory = $this->app['mongo.factory'];
        $connection = $factory("mongodb://localhost:27017", array("connect" => false));
        $this->assertInstanceOf($this->mongoClass, $connection);
    }
}
