<?php
//
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Mongo\Silex\Provider\MongoServiceProvider;
//
$app->register(new HttpCacheServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

// Translation definition.
$app->register(new TranslationServiceProvider());
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
	$translator->addLoader( 'yaml', new YamlFileLoader() );
	$translator->addResource( 'yaml', PATH_LOCALES . '/en.yml', 'en' );
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

require PATH_PROTECTED . '/routes.php';

return $app;