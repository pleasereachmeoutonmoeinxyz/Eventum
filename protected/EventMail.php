<?php

class EventMail {
    
    private static $instance    =   null;
    const VALIDATOR_ERROR       =   500;
    const LIMITATION_ERROR      =   501;
    
    /**
     * return running instance of Application
     * @return \Silex\Application
     */
    public static function app(){
        if (!self::$instance instanceof \Silex\Application)
            self::$instance    =   new \Silex\Application;
        return self::$instance;
    }
    
    /**
     * translate text using TranslationServiceProvider
     * @param string $text
     * @return string
     */
    public static function t($text){
        return self::app()->trans($text);
    }
    
    /**
     * return url using UrlGeneratorServiceProvider
     * @param string $router
     * @param mixed $params
     * @return string
     */
    public static function url($router,$params){
        $app    =   self::app();
        return $app['url_generator']->generate($router,$params);
    }
    
    /**
     * get html text of view
     * @param string $file
     * @param mixed $params
     * @return string
     */
    public static function render($file,$params){
        return self::app()->render($file,$params);
    }
    
    /**
     * return config setting
     * @param string $conf
     * @return string
     */
    public static function config($conf){
        $app    =   self::app();
        return $app[$conf];
    }
}