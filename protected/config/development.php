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

$app['debug']                   = true;

$app['db']                      =   array(
                                        'server'        =>  "mongodb://localhost:27017",
                                        'collection'    =>  "eventmail"
);   

$app['activation.time_limit']   =   300; // 5 mins

$app['mailer.sender_mail']      =   'moein7tl@gmail.com';

// events setting
$app['event.types']             =   array(
    'festival'
);

$app['event.locations']         =   array(
    'Alborz','Isfehan','Tehran','Azarbayejan','online'
);

$app['event.categories']        =   array(
    'computer','startup'
);