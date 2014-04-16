<?php

class EventMail {
    
    private static $instance    =   null;
    
    public static function app(){
        if (!self::$instance instanceof \Silex\Application)
            self::$instance    =   new \Silex\Application;
        return self::$instance;
    }
}