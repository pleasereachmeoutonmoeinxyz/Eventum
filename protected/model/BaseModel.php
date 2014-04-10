<?php

namespace Model;

class BaseModel{
    
    protected $connection   =   null;
    protected $collection   =   null;
    protected $cursor       =   null;
    
    public function __construct($db) {
        $this->connection   =   $db['default'];
        $this->collection   = $this->collection->{$app['db']['collection']};
    }
}
