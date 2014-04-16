<?php
namespace Model{
    
    use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
    use Symfony\Component\Validator\Constraints as Assert;
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
     * 
     * @properity 
     * @ODM\Document*/
    class Mail extends Base{
        
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
        
        /** @ODM\String @ODM\Index*/
        private $status;

        /** @ODM\String */
        private $link;
        
        /** @ODM\timestamp */
        private $cTimetamp;
        
        /** @ODM\timestamp */
        private $sTimestamp;
        
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
        static public function loadValidatorMetaData(ClassMetadata $metadata){
            $metadata->addPropertyConstraint('email', new Assert\Email());
            $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        }        
        
        public static function subscribe($email){
            
        }
    }
}
