<?php
namespace Model;

class Errors {
    private $errors;
    public function __construct() {
        $this->errors   =   array();
    }
    
    public function addError($error){
        $this->errors[] =   $error;
    }
    
    public function earase(){
        $this->errors   =   array();
    }
    
    public function getErrors(){
        return $this->errors;
    }
    
    public function count(){
        return count($this->errors);
    }
}