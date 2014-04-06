<?php
namespace Mongo\Silex\Provider;

class MongoConnectionProvider extends \Pimple
{
    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $provider = $this;
        foreach($options as $key => $connection) {
            $this[$key] = $this->share(function() use($connection, $provider) {
                return $provider->createConnection($connection['server'], $connection['options']);
            });
        }
    }

    /**
     * @param string $server
     * @param array $options
     * @return \Mongo|\MongoClient
     */
    public function createConnection($server = "mongodb://localhost:27017", array $options = array("connect" => true))
    {
        $mongoClass = (version_compare(phpversion('mongo'), '1.3.0', '<')) ? '\Mongo' : '\MongoClient';
        return new $mongoClass($server, $options);
    }
}
