<?php

class Ajax extends stdClass{
    private $error;
    
        public function __set($name, $value) {
            if ($name   === 'error'){
                if ($value === TRUE || $value === FALSE)
                    $this->error    =   $value;
            } else {
                $this->{$name}  =   $value;                    
            }
        }

        public function __get($name) {
            return $this->{$name};
        }
}