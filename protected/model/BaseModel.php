<?php

namespace Model;

class BaseModel{
    protected $res;
    public function __construct($res) {
        $this->res  =   $res;
    }
}
