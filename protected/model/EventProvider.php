<?php

namespace Model{
        class EventProvider extends BaseModel{
        const collectionName    =   "event";
        public function __construct($db) {
            parent::__construct($db);
            $this->cursor   = $this->collection->{self::collectionName};
        }
    }
}

