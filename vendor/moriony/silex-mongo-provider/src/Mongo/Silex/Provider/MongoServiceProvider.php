<?php
namespace Mongo\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class MongoServiceProvider implements ServiceProviderInterface
{
    const MONGO = 'mongo';
    const MONGO_CONNECTIONS = 'mongo.connections';
    const MONGO_FACTORY = 'mongo.factory';

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app[self::MONGO_CONNECTIONS] = array(
            'default' => array(
                'server' => "mongodb://localhost:27017",
                'options' => array("connect" => true)
            )
        );

        $app[self::MONGO_FACTORY] = $app->protect(function ($server = "mongodb://localhost:27017", array $options = array("connect" => true)) use ($app) {
            return $app[MongoServiceProvider::MONGO]->createConnection($server, $options);
        });

        $app[self::MONGO] = $app->share(function () use($app) {
            return new MongoConnectionProvider($app[MongoServiceProvider::MONGO_CONNECTIONS]);
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registers
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {}
}
