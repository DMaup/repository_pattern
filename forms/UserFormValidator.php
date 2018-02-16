<?php
class UserFormValidator extends FormValidator {
    function __construct($inputs){
        parent::__construct($inputs);
        $this->addField("username", FormValidator::TYPE_STRING);
        $this->addField("password", FormValidator::TYPE_STRING);
        $this->addField("check_password", FormValidator::TYPE_STRING);
    }

    function check(){
        parent::check();
        $password_field = $this->getField("password");
        $check_password_field = $this->getField("check_password");
        
        

            if(!$password_field
            || !$check_password_field
            || $password_field->value != $check_password_field->value){
            
                $this->errors[] = "Les mots de passe ne correspondent pas!";
            }

            $username_field = $this->getField("username");
            // var_dump($username_field);




            return parent::check();
    }
}