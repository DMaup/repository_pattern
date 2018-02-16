<?php
class ProductFormValidator extends FormValidator {
    function __construct($inputs){
        parent::__construct($inputs);
        $this->addField("label", FormValidator::TYPE_STRING);
        $this->addField("price", FormValidator::TYPE_FLOAT);
        $this->addField("image_url", FormValidator::TYPE_STRING);
    }
}