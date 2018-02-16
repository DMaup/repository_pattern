<?php
Class FormValidator{
    const TYPE_STRING   = "string";
    const TYPE_FLOAT    = "float";
    const TYPE_INT      = "int";
    const TYPE_REGEXP   = "regexp";

    private $fields     = [];
    private $inputs     = [];
    protected $errors   = [];

    function __construct($inputs){
        $this->inputs = $inputs;
    }

    protected function addField($name, $type, $param = ""){
        $value = null;
        if(!empty($this->inputs[$name])){
            $value = $this->inputs[$name];
        }

        $this->fields[] = new Field($name, $value, $type, $param);

    }

    public function check(){
        foreach($this->fields as $field){
            $correct = false;
            switch($field->type){
                case self::TYPE_STRING:
                    $correct = $this->checkStr($field->value);
                    break;
                case self::TYPE_INT:
                    $correct = $this->checkInt($field->value);
                    break;
                case self::TYPE_FLOAT:
                    $correct = $this->checkFloat($field->value);
                    break;
                case self::TYPE_REGEXP:
                    $correct = $this->checkRegexp($field->value, $field->param);
                    break;
                default:
                    break;
            }

            if(!$correct){

                $error = "Le champ ".$field->name;
                $error .=" est incorrect et ne correspond pas au type fourni:";
                $error .=$field->type;
                $this->errors[] = $error;
                
            }

        }
        return (bool) !count($this->errors);
        
    }
    protected function checkStr($value){
        return is_string($value);
    }

    protected function checkInt($value){
        return filter_var($value, FILTER_VALIDATE_INT);
    }

    protected function checkFloat($value){
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }

    protected function checkRegexp($value, $regexp){
        return preg_match($regexp,$value);
    }

    protected function getField($name){
        foreach ($this->fields as $field) {
            if($field->name ==$name){
                // var_dump($field);
                return $field;
            }
        }
        return null;
    }

    protected function getName($name){
        foreach ($this->names as $name) {
            if($name->value ==$name){
                // var_dump($name);
                return $name;
            }
        }
        return null;
    }

    protected function getId($name){
        foreach ($this->names as $name) {
            if($name->id ==$name){
                // var_dump($name);
                return $name;
            }
        }
        return null;
    }

    public function getErrors(){
        return $this->errors;
    }
}