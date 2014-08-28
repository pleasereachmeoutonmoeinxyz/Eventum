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
     *  @property string $code
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
        const CONFIRMATION_WAITING          =   'WAITING';
        /** @ODM\Id */        
        public $id;
        
        /** @ODM\String*/        
        public $name;
        
        /** @ODM\String*/        
        public $email;
        
        /** @ODM\String*/        
        public $site;
        
        /** @ODM\String*/        
        public $tel;
        
        /** @ODM\Collection @ODM\Index */
        public $locations  =   array();
        
        /** @ODM\Collection @ODM\Index */
        public $types      =   array();

        /** @ODM\Collection @ODM\Index */
        public $categories =   array();
        
        /** @ODM\String*/
        public $secretariat;
        
        /** @ODM\String */
        public $date;
        
        /** @ODM\String*/        
        public $subject;
        
        /** @ODM\String*/
        public $tweet;
        
        /** @ODM\String*/        
        public $content;

        /** @ODM\String*/    
        public $status;
        
        /** @ODM\String*/
        public $confirmation;
        
        /** @ODM\String*/
        public $code;

        /** @ODM\timestamp */        
        public $timestamp;
        
        
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

        /**
         * insert or update record in MongoDB
         * If record is new,set code,status and timestamp
         * always set confrimation as waiting
         */
        public function save() {
            if ($this->isNewRecord()){
                $this->code         =   \EventMail::genRandomCode();
                $this->timestamp    =   new \MongoTimestamp();
                $this->status       =   self::STATUS_NEW;
            }
            $this->confirmation     =   self::CONFIRMATION_WAITING;
            parent::save();
        }
        
    }
}