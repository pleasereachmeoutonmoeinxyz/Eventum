<?php
namespace Model{
    
    use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\Validator\Mapping\ClassMetadata;    
    
    /** 
     * @property \MongoId $id
     * @property string $email
     * @property mixed $locations
     * @property mixed $types
     * @property mixed $categories
     * @property string $status;
     * @property string $code;
     * @property \MongoTimestamp $critical_timestamp critical timestamp;
     * @property \MongoTimestamp $subscribtion_timestamp subscribe timestamp; 
     * @ODM\Document*/
    class Mail extends Base{
        
        const STATUS_ACTIVE     =   'ACTIVE';
        const STATUS_DEACTIVE   =   'DEACTIVE';
        
        /** @ODM\Id */
        public $id;

        /** @ODM\String @ODM\Index(unique=true, order="asc") */
        public $email;
        
        /** @ODM\Collection @ODM\Index */
        public $locations  =   array();
        
        /** @ODM\Collection @ODM\Index */
        public $types      =   array();

        /** @ODM\Collection @ODM\Index */
        public $categories =   array();
        
        /** @ODM\String*/
        public $status;

        /** @ODM\String */
        public $code;
        
        /** @ODM\timestamp */
        public $critical_timestamp;
        
        /** @ODM\timestamp */
        public $subscribtion_timestamp;

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
         * Validate attribute by Silex validator
         * @param \Model\ClassMetadata $metadata
         */
        static public function loadValidatorMetadata(ClassMetadata $metadata){
            $metadata->addPropertyConstraint('email', new Assert\Email());
            $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        }        
        
        
        /**
         * 
         * @param string $email
         * @return Model\Mail
         */
        public static function getLinkParams($email){            
            $mail   =   self::findOne(array('email' =>  $email));
            if ($mail   === null){
                return self::subscribe($email);
            } else {
                return $mail;
            }
        }
        
        /**
         * 
         * @param string $email
         * @return \self
         * @return Errors
         */
        private static function subscribe($email){
            $timestamp                      =   time();
            $mail                           =   new self();
            $mail->email                    =   $email;
            $mail->status                   =   self::STATUS_DEACTIVE;
            $mail->code                     =   \EventMail::genRandomCode();
            $mail->subscribtion_timestamp   =   new \MongoTimestamp($timestamp);
            $mail->critical_timestamp       =   new \MongoTimestamp($timestamp);
            
            if (($errors = $mail->getErrors()) === NULL){
                $mail->save();
                return $mail;
            } else {
                return $errors;
            }
        }

        public function updateTimestamp(){
            $this->critical_timestamp    =   new \MongoTimestamp();
            $this->save();
        }
        
        /**
         * active mail
         */
        public function setAsActive(){
            $this->status               =   self::STATUS_ACTIVE;
            $this->save();
        }
        
        /**
         * deactive mail
         */
        public function setAsDeactive(){
            $this->status               =   self::STATUS_DEACTIVE;
            $this->save();
        }
    }
}