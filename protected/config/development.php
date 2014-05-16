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
                                        'server'        =>  "mongodb://moein:12345@localhost:27017",
                                        'collection'    =>  "eventmail"
);   

$app['activation.time_limit']   =   300; // 5 mins

$app['mailer.sender_mail']      =   'moein7tl@gmail.com';

// events setting
$app['event.types']             =   array(
    'Festival'                      =>  'Festival',
    'Exhibition'                    =>  'Exhibition',
    'Conference'                    =>  'Conference',
    'Seminar'                       =>  'Seminar',
    'Workshop'                      =>  'Workshop',
    'Meeting'                       =>  'Meeting',
    'Product Lanuch'                =>  'Product Lanuch',
    'Networking Event'              =>  'Networking Event',
    'Award Ceremony'                =>  'Award Ceremony',
    'User Group Event'              =>  'User Group Event',
    'Happy Hours'                   =>  'Happy Hours',
    'Show'                          =>  'Show',
    'Press Conference'              =>  'Press Conference'
);

$app['event.locations']         =   array(
    'Online'                        =>  'Online',
    'Alborz'                        =>  'Alborz',
    'Ardabil'                       =>  'Ardabil',
    'Azerbaijan, East'              =>  'Azerbaijan, East',
    'Azerbaijan, West'              =>  'Azerbaijan, West',
    'Bushehr'                       =>  'Bushehr',
    'Chahar Mahaal and Bakhtiari'   =>  'Chahar Mahaal and Bakhtiari',
    'Fars'                          =>  'Fars',
    'Gilan'                         =>  'Gilan',
    'Golestan'                      =>  'Golestan',
    'Hamadan'                       =>  'Hamadan',
    'Hormozgan'                     =>  'Hormozgan',
    'Isfahan'                       =>  'Isfahan',
    'Kerman'                        =>  'Kerman',
    'Kermanshah'                    =>  'Kermanshah',
    'Khorasan, North'               =>  'Khorasan, North',
    'Khorasan, Razavi'              =>  'Khorasan, Razavi',
    'Khorasan, South'               =>  'Khorasan, South',
    'Khuzestan'                     =>  'Khuzestan',
    'Kohgiluyeh and Boyer-Ahmad'    =>  'Kohgiluyeh and Boyer-Ahmad',
    'Kurdistan'                     =>  'Kurdistan',
    'Lorestan'                      =>  'Lorestan',
    'Markazi'                       =>  'Markazi',
    'Mazandaran'                    =>  'Mazandaran',
    'Qazvin'                        =>  'Qazvin',
    'Qom'                           =>  'Qom',
    'Semnan'                        =>  'Semnan',
    'Sistan and Baluchestan'        =>  'Sistan and Baluchestan',
    'Tehran'                        =>  'Tehran',
    'Yazd'                          =>  'Yazd',
    'Zanjan'                        =>  'Zanjan'
);

$app['event.categories']        =   array(
    
    'Charity'                       =>  'Charity'
);