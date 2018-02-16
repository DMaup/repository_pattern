<?php
class RepositoryManager{
    private $product_Repository;
    private $user_Repository;

    private static $instance = null;
    public static function getInstance(){
            if(!self::$instance){
                self::$instance = new self();
                
            }
            return self::$instance;

    }

    function __construct(){

            $pdo = Bdd::getInstance();

            $this->product_Repository    = new ProductRepository($pdo);
            $this->user_Repository       = new UserRepository($pdo);
    }

  
    public function getUserRepository()
    {
        return $this->user_Repository;
    }

    public function getProductRepository()
    {
        return $this->product_Repository;
    }
}