<?php
namespace Model{
    
    use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\Validator\Mapping\ClassMetadata;    
    
    /**
     *  @property \MongoId $id
     *  @property string $name
     *  @property string $thumb
     *  @property string $content 
     *  @ODM\Document*/
    class Template extends Base{
        
        /** @ODM\Id */
        private $id;
        
        /** @ODM\String */
        private $name;
        
        /** @ODM\String */
        private $thumb;
        
        /** @ODM\String */
        private $content;

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