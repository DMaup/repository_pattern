<?php
class User extends Model {

    private $username;
    private $password;
    private $check_password;
    private $id_role = 3;
    protected $id;
    // protected $name_doublon = 1;
    const SALT = "QWONQULqF0";

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getCheck_password()
    { 
        return $this->check_password;
       
    }

    public function setCheck_password($check_password)
    {
        $this->check_password = $check_password;

        return $this;
    }

    public function getId_role()
    {
        return $this->id_role;
    }

    public function setId_role($id_role)
    {
        $this->id_role = $id_role;

        return $this;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}



   

    
