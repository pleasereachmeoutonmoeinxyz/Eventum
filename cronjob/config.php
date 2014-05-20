<?php
return array(
    'SERVER'            =>  'localhost',
    'PORT'              =>  5672,
    'USERNAME'          =>  'guest',
    'PASSWORD'          =>  'guest',
    'CHANNEL'           =>  'MAIL_CHANNEL',
    'DB_STRING'         =>  'mongodb://moein:12345@localhost:27017',
    'DB_COLLECTION'     =>  'eventmail',
    'PAGINATION_LIMIT'  =>  20,
    'ROLLBAR_CONFIG'    =>  array(
                'access_token'  =>  'POST_SERVER_ITEM_ACCESS_TOKEN',
                'max_errno'     =>  E_USER_NOTICE
    )
);