<?php
class Controller{
    const ERRORS    = "errors";
    const FORM_DATA = "form_data";
    protected $RM;
    protected $Auth;

    function __construct(){
        $this->RM   = RepositoryManager::getInstance();
        $this->Auth = new Auth();
    }

    function registerErrors($errors){
        $_SESSION[self::ERRORS] = $errors;
    }

    function getRegisteredErrors(){
            $errors = [];
        if (!empty($_SESSION[self::ERRORS])){
            $errors = $_SESSION[self::ERRORS];
            unset($_SESSION[self::ERRORS]);
        }
        return $errors;
    }

    function getRegisteredFormDatas(Model $data){
        $_SESSION[self::FORM_DATA] = $data;
    }

    function getRegisteredDatas(){
        $data = null;
        if (!empty($_SESSION[self::FORM_DATA])){
            $data = $_SESSION[self::FORM_DATA];
            unset($_SESSION[self::FORM_DATA]);
        }
        return $data;
    }

}