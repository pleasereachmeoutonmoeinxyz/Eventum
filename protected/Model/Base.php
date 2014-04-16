<?php
namespace Model {
    
    class Base{
        
        public static function findOne($params = array()) {
            $app    = \EventMail::app();
            return $app['dm']->getRepository(get_called_class())
                    ->findOneBy($params);
        }
    
        public static function find($params){
            $app    = \EventMail::app();
            return $app['dm']->getRepository(get_called_class())
                    ->findBy($params);
        }
        
    }
    
}