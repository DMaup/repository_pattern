<?php
class Field{
    
public $name;
public $value;
public $type;
public $param;

    function __construct($name, $value, $type, $param =""){
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->param = $param;
    }

}
