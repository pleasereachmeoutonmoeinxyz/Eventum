<?php
namespace Model{
    
    use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
    use Symfony\Component\Validator\Constraints as Assert;
    /** 
     * @property Integer $id
     * @property String $email
     * @property String $locations
     * @property String $types
     * @property String $categories
     * @ODM\Document*/
    class Mail extends \Base{
        
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
            $metadata->addPropertyConstraint('email', new Assert\Length(5,255));
        }        
        
        
    }
}
