<?php
namespace Model{
    use Symfony\Component\Validator\Mapping\ClassMetadata;
    use Symfony\Component\Validator\Constraints as Assert;
    class MailProvider extends BaseModel{
        
        const collectionName    =   "mail";
        private $email;
        public function __construct($db) {
            parent::__construct($db);
            $this->cursor   = $this->collection->{self::collectionName};
        }
        
        static public function loadValidatorMetaData(ClassMetadata $metadata){
            $metadata->addPropertyConstraint('email', new Assert\Email());
            $metadata->addPropertyConstraint('email', new Assert\NotBlank());
            $metadata->addPropertyConstraint('email', new Assert\Length(5,255));
            
        }
    }
}