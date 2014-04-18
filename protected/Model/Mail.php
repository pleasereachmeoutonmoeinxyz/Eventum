<?php
namespace Model{
    
    use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\Validator\Mapping\ClassMetadata;    
    
    /** 
     * @property int $id
     * @property string $email
     * @property mixed $locations
     * @property mixed $types
     * @property mixed $categories
     * @property string $status;
     * @property string $link;
     * @property string $cTimestamp critical timestamp;
     * @property string $sTimestamp subscribe timestamp; 
     * @ODM\Document*/
    class Mail extends Base{
        
        const STATUS_ACTIVE     =   'ACTIVE';
        const STATUS_DEACTIVE   =   'DEACTIVE';
        
        /** @ODM\Id */
        private $id;

        /** @ODM\String @ODM\Index(unique=true, order="asc") */
        private $email;
        
        /** @ODM\Collection @ODM\Index */
        private $locations  =   array();
        
        /** @ODM\Collection @ODM\Index */
        private $types      =   array();

        /** @ODM\Collection @ODM\Index */
        private $categories =   array();
        
        /** @ODM\String*/
        private $status;

        /** @ODM\String */
        private $link;
        
        /** @ODM\timestamp */
        private $cTimestamp;
        
        /** @ODM\timestamp */
        private $rTimestamp;

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
         * @param type $email
         * @return type
         * @throws Exception
         */
        public static function getLinkParams($email){
            $app                =   \EventMail::app();
            
            $mail   =   self::findOne(array('email' =>  $email));
            if ($mail   === null){
                return self::subscribe($email);
            } else {
                if ((time() - $mail->cTimestamp) < $app['activation.time_limit'])
                    throw new Exception("Limitation Error",  \EventMail::LIMITATION_ERROR);
                return array($mail->id,$mail->link);
            }
        }
        
        /**
         * 
         * @param type $email
         * @return type
         * @throws Exception
         */
        private static function subscribe($email){
            $app                =   \EventMail::app();
            
            $mail               =   new self();
            $mail->email        =   $email;
            $mail->status       =   self::STATUS_DEACTIVE;
            $mail->link         =   $mail->generateRndUrl();
            $mail->rTimestamp   =   new \MongoTimestamp();
            $mail->cTimestamp   =   new \MongoTimestamp();
            
            if (($errors = $mail->getErrors()) === NULL){
                $app['dm']->persist($mail);
                $app['dm']->flush();
                return array($mail->id,$mail->link);
            } else {
                throw new Exception(json_encode($errors),  \EventMail::VALIDATOR_ERROR);
            }
        }

        private function generateRndUrl(){
            return md5(sha1($this->email . rand(-1 * PHP_INT_MAX, PHP_INT_MAX))).md5(microtime()).md5(rand(-1 * PHP_INT_MAX, PHP_INT_MAX));
        }
    }
}