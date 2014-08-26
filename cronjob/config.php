<?php
return array(
    'SERVER'            =>  'localhost',
    'PORT'              =>  5672,
    'USERNAME'          =>  'test',
    'PASSWORD'          =>  'test',
    'CHANNEL'           =>  'MAIL_CHANNEL',
    'DB_STRING'         =>  'mongodb://localhost:27017',
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
    'URL_DEACTIVE_BASE' =>  'http://eventum.ir/mail/unsbscribe',
    'EXCUSE_START_TIME' =>  0,
    'EXCUSE_END_TIME'   =>  0,
    'HEADER_FROM'       =>  'From: Eventum.ir <events@eventum.ir>',
    'HEADER_RETURN_PATH'=>  'Return-Path: events@eventum.ir',
    'HOST_HEADER_FROM'  =>  'From: Eventum.ir <events@quantum.eventum.ir>',
    'HOST_HEADER_RP'    =>  'Return-Path: events@quantum.eventum.ir',
    'WORKER_NAME'       =>  'MAIN',
    
    'SMTP_HOST'         =>  '',
    'SMTP_PORT'         =>  25,
    'SMTP_USERNAME'     =>  '',
    'SMTP_PASSWORD'     =>  '',
    'SENDER_NAME'       =>  'Eventum.ir - رویدادگرا',
    'SENDER_MAIL'       =>  'info@eventum.ir',
    'REPLY_MAIL'        =>  'info@eventum.ir',
    
    'USING_SMTP'        =>  TRUE,    
    
    'EMAIL_TO_TWITTER'  =>  'info@eventum.ir',
    
    'BANNERS_LINK'      =>  'http://blog.eventum.ir/banners/',
    'DONATE_LINK'       =>  'http://eventum.ir'
);