<?php

use RepositoryManager as RM;

class UserController extends Controller{
    public function displayAll( $page){

        $start_index = 0;
            if($page){
            $start_index = $page * UserRepository::USERS_BY_PAGE;
            }
        $userRepository = $this->RM->getUserRepository();
        
        $users = $userRepository->getUsers( $start_index); 
    
        var_dump( $users );
    }

    public function displayCreateForm(){
        if($this->Auth->hasGrant(1)){
            Flight::redirect("/products");
            return;
        }

        $errors = $this->getRegisteredErrors();
        
        $user = $this->getRegisteredDatas() ?? new User;
        
        $user = new User();
            if (!empty($_SESSION["user"])){
                $user = $_SESSION["user"];
            }
        unset($_SESSION["user"]);

        Flight::render("users/create_edit", [
            "user"=>$user,
            "errors" => $errors
        ]);
    }

    public function displayLoginForm(){
        $errors = $this->getRegisteredErrors();
        
        $user = $this->getRegisteredDatas() ?? new User;
        
        $user = new User();
            if (!empty($_SESSION["user"])){
                $user = $_SESSION["user"];
            }
        unset($_SESSION["user"]);

        Flight::render("users/login", [
            "user"=>$user,
            "errors" => $errors
        ]);
    }

    public function displayEditForm($id){
        $errors = $this->getRegisteredErrors();
    
        $user = $this->getRegisteredDatas();
       
            if(!$user){
                $userRepository = $this->RM->getUserRepository();

                $user = $userRepository->getUserbyId($id);
            }

            if($user){
                Flight::render("users/create_edit", [
                    "user"=>$user,
                    "errors" => $errors
                ]);
            }
    }

    public function displayDeleteUser ($id){
        $userRepository = $this->RM->getUserRepository();

        if( $userRepository->deleteUser( $id ) ){
            echo "L'utilisateur " . $id . " a bien été supprimé";
        }
        else {
            echo "L'utilisateur " . $id . " n'a pas pu être supprimé";
        }
    }

    public function displaySaveUser(){
        $datas = Flight::request()->data->getData();
        $user = new User( $datas );
        $formValidator = new UserFormValidator($datas);
        if(!$formValidator->check()){           
            $this->getRegisteredErrors($formValidator->getErrors());
            $this->getRegisteredDatas($user);
                if($id = $user->getId()){
                    Flight::redirect("/users/edit/".$id);
                }
                else{
                    Flight::redirect("/users/create");
                }
            Flight::redirect("/users/create");
            return;
        }
    
        $formValidator->getErrors();
        $repository = $this->RM->getUserRepository();

            if( $repository->saveUser( $user ) ){
            
            $message = "Utilisateur ". $user->getId() . " mis à jour";
            $_SESSION["message"] = $message;
            Flight::redirect("/users");
            }
            else {
                echo "Echec de l'inscription";
            }
    }

    public function login( $username, $password){
        $datas = Flight::request()->data->getData();
        
        $user = new User( $datas );
     
        $userRepository = RM::getInstance()->getUserRepository($user);
        var_dump($userRepository);
        $user = $userRepository->existsLogin($username, $password);
        var_dump($user);

        if($user){
            $grants = $userRepository->getGrants($user);
            $this->Auth->logUser($user);
            var_dump($user);
            var_dump($grants);
            echo "Utilisateur ".$user->getId()." connecté";
        }
        else{
            echo "Nom d'utilisateur ou Mot de passe incorrect";

        }
    }
    public function displayLogUser($username, $password){
        $datas = Flight::request()->data->getData();
        $user = new User( $datas );
        $this->Auth->logUser($user);
        
        $formValidator = new UserFormValidator($datas);
        if(!$formValidator->check()){ 
            $userRepository = RM::getInstance()->getUserRepository($user);
            $grants = $userRepository->getGrants($user);          
            $this->getRegisteredErrors($formValidator->getErrors());
            $this->getRegisteredDatas($user);
            // $user = $userRepository->existsLogin($username, $password);
            if($user){
                $grants = $userRepository->getGrants($user);
                $this->Auth->logUser($user);
                var_dump($user);
                var_dump($grants);
                echo "Utilisateur ".$user->getId()." connecté";
            }
            else{
                echo "Nom d'utilisateur ou Mot de passe incorrect";
    
            }
        }
    }

}
