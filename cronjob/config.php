<?php
return array(
    'SERVER'            =>  'localhost',
    'PORT'              =>  5672,
    'USERNAME'          =>  'test',
    'PASSWORD'          =>  'test',
    'CHANNEL'           =>  'MAIL_CHANNEL',
    'DB_STRING'         =>  'mongodb://moein:12345@localhost:27017',
    'DB_COLLECTION'     =>  'eventmail',
    'PAGINATION_LIMIT'  =>  20,
    'ROLLBAR_CONFIG'    =>  array(
                'access_token'  =>  'ba63f0d14fe84842a0efff7a5aa41a99',
                'max_errno'     =>  E_USER_NOTICE
    ),
    'REMINDER_CTS'      =>  3600 * 24 * 2,
    'REMINDER_LRTS'     =>  3600 * 24 * 25,
    'LANG'              =>  'FA',
    'URL_SETTING_BASE'  =>  'http://eventum.ir/mail/setting',
    'URL_DEACTIVE_BASE' =>  'http://eventum.ir/mail/deactive',
    'EXCUSE_START_TIME' =>  0,
    'EXCUSE_END_TIME'   =>  0,
    'HEADER_FROM'       =>  'From: Eventum.ir <events@eventum.ir>',
    'HEADER_RETURN_PATH'=>  'Return-Path: events@eventum.ir',
    'HOST_HEADER_FROM'  =>  'From: Eventum.ir <events@quantum.eventum.ir>',
    'HOST_HEADER_RP'    =>  'Return-Path: events@quantum.eventum.ir'
);