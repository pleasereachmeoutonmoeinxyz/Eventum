<?php
$app['locale']                  = 'fa';
$app['translator.messages'] = array(
	'fa' => PATH_LOCALES . '/fa.yml',
        'en' => PATH_LOCALES . '/en.yml',
);
$app['session.default_locale']  = $app['locale'];

// Cache
$app['cache.path']              = PATH_CACHE;
$app['http_cache.cache_dir']    = $app['cache.path'] . '/http';
$app['twig.options.cache']      = $app['cache.path'] . '/twig';

$app['debug'] = true;

$app['db']                      =   array(
                                        'server'        =>  "mongodb://localhost:27017",
                                        'collection'    =>  "eventmail"
);   