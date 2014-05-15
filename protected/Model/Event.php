<?php
namespace Model{
    
    use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\Validator\Mapping\ClassMetadata;    
    
    /**
     *  @property \MongoId $id
     *  @property string $name
     *  @property string $email
     *  @property string $site
     *  @property string $tel
     *  @property mixed $locations
     *  @property mixed $categories
     *  @property mixed $types
     *  @property string $subject
     *  @property string $content
     *  @property string $status
     *  @property \MongoTimestamp $timestamp
     *  @ODM\Document*/
    class Event extends Base{
        
        const STATUS_SENT                   =   'SENT';
        const STATUS_RUNNING                =   'RUNNING';
        const STATUS_NEW                    =   'NEW';
        
        const CONFIRMATION_ACCEPTED         =   'CONFIRMED';
        const CONFIRMATION_REJECTED         =   'REJECTED';
        
        /** @ODM\Id */        
        private $id;
        
        /** @ODM\String*/        
        private $name;
        
        /** @ODM\String*/        
        private $email;
        
        /** @ODM\String*/        
        private $site;
        
        /** @ODM\String*/        
        private $tel;
        
        /** @ODM\Collection @ODM\Index */
        private $locations  =   array();
        
        /** @ODM\Collection @ODM\Index */
        private $types      =   array();

        /** @ODM\Collection @ODM\Index */
        private $categories =   array();        

        /** @ODM\String*/        
        private $subject;
        
        /** @ODM\String*/        
        private $content;

        /** @ODM\String*/    
        private $status;
        
        /** @ODM\String*/
        private $confirmation;
        
        /** @ODM\String*/
        private $code;

        /** @ODM\timestamp */        
        private $timestamp;
        
        public function __set($name, $value) {
            if (property_exists(__CLASS__, $name)){
                $this->{$name}  =   $value;
            }
        }

        public function __get($name) {
            if (property_exists(__CLASS__, $name)){
                return $this->{$name};
            }
        }
        
    }
}