<?php
namespace Model {
        
    class Base{
        
        public static function findOne($params = array()) {
            $app    = \EventMail::app();
            return $app['dm']->getRepository(get_called_class())->findOneBy($params);
        }
    
        public static function findAll($params){
            $app    = \EventMail::app();
            return $app['dm']->getRepository(get_called_class())->findBy($params);
        }
        
        public static function findById($id){
            if (!$id instanceof \MongoId){
                $id =   new \MongoId($id);
            }
            $app    = \EventMail::app();
            return $app['dm']->getRepository(get_called_class())->find($id);
        }

        public function getErrors(){
            $app    =   \EventMail::app();
            $errors = $app['validator']->validate($this);
            if (count($errors) == 0)    return NULL;
            
            $errObj =   new Errors();
            
            foreach ($errors as $error){
                $errObj->addError($error->getMessage());
            }
            return $errObj;
        }           
    }
    
}