<?php
class Grant extends Model {
    private $grant_name;
    
    public function getGrant_name()
    {
        return $this->grant_name;
    }

    public function setGrant_name($grant_name)
    {
        $this->grant_name = $grant_name;

        return $this;
    }
}