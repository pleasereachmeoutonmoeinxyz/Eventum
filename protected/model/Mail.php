<?php
namespace Model{
    
    use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
    
    /** @ODM\Document */
    class Mail{
        
        /** @ODM\Ud */
        private $id;

        /** @ODM\String */
        private $email;
        
        static public function loadValidatorMetaData(ClassMetadata $metadata){
            $metadata->addPropertyConstraint('email', new Assert\Email());
            $metadata->addPropertyConstraint('email', new Assert\NotBlank());
            $metadata->addPropertyConstraint('email', new Assert\Length(5,255));
        }        
        
    }
}
