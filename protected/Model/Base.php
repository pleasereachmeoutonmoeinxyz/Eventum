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

        public function insert(){
            $app    = \EventMail::app();
            $app['dm']->persist($this);
            $app['dm']->flush();
        }

        public function update(){-
            $app    = \EventMail::app();
            $app['dm']->flush();
        }

        public function save(){
            if ($this->isNewRecord() === FALSE){
                $this->update ();
            } else {
                $this->insert();  
            }
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
        
        public function isNewRecord(){
            if (property_exists(get_called_class(), 'id')){
                if ($this->id === NULL)
                    return true;
                return false;
            }
            return NULL;
        }
    }
    
}