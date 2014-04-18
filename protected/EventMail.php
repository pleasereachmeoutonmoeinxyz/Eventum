<?php

class EventMail {
    
    private static $instance    =   null;
    const VALIDATOR_ERROR       =   500;
    const LIMITATION_ERROR      =   501;
    public static function app(){
        if (!self::$instance instanceof \Silex\Application)
            self::$instance    =   new \Silex\Application;
        return self::$instance;
    }
}