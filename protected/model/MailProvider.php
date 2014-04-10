<?php
namespace Model{
    class MailProvider extends BaseModel{
        
        const collectionName    =   "mail";
        
        public function __construct($db) {
            parent::__construct($db);
            $this->cursor   = $this->collection->{self::collectionName};
        }
    }
}