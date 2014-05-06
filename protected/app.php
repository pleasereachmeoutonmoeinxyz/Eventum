<?php
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Mongo\Silex\Provider\MongoServiceProvider;

$app->register(new HttpCacheServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
//$app->register(new UrlGene)

// Translation definition.
$app->register(new TranslationServiceProvider());
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
	$translator->addLoader( 'yaml', new YamlFileLoader() );
        
        foreach ($app['translator.messages'] as $key=>$value){
            $translator->addResource( 'yaml', $value, $key );
        }
        
	return $translator;
}));

// Log definition.
$app->register(new MonologServiceProvider(), array(
	'monolog.logfile'   => PATH_LOG . '/app.log',
	'monolog.name'      => 'app',
	'monolog.level'     => Monolog\Logger::WARNING 
));

// Template system definition.
$app->register(new TwigServiceProvider(), array(
	'twig.options'		=> array(
		'cache'			=> isset($app['twig.options.cache']) ? $app['twig.options.cache'] : false,
		'strict_variables'      => true
	),
	'twig.path'		=> array( PATH_VIEWS )
));

$app->register(new MongoServiceProvider, array(
    'mongo.connections' => array(
        'default' => array(
            'server'    =>  $app['db']['server'],
            'options'   =>  $app['db']['options']
        )
    ),
));

// Error Handler
$app->error(function (Exception $e,$code){
    
});

require PATH_PROTECTED . '/routes.php';

return $app;