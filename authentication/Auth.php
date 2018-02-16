<?php
class Auth{
    const SESSION_USER = "users";

    private $user;
    private $grants;

    public function __construct(){
        if($this->loadLoggedUser()){
            $this->loadGrants();
        }
    }

    private function loadLoggedUser(){
        $this->user = null;
            if(!empty($_SESSION[self::SESSION_USER])){
                $user = $_SESSION[self::SESSION_USER];
            }
        return $this->user;
    }

    private function loadGrants(){
        $userRepository = RepositoryManager::getInstance()->getUserRepository();
        $this->grants =$userRepository->getGrants($this->user);
    }

    public function logUser(User $user){
        $_SESSION[self::SESSION_USER]=$user;
        $this->user = $user;
        
    }

    public function getUser(){
        return $this->user = $user;
    }

    public function hasGrant($id_grant){
        if(!$this->user){
            return false;
        }
        foreach ($this->grants as $grant) {
            if($grant->getId() == $id_grant){
                return true;
            }
        }
        return false;
    }

    public function hasRoleLevel($id_role){
        return $this->user && $this->user->getId_role() <= $id_role;
    }

  
}