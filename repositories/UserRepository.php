<?php 
class UserRepository extends Repository {

    const USERS_BY_PAGE = 5;

    private function createUser( User $user ){
        
        $sql = "INSERT INTO users 
                SET username=:username, 
                    password=:password,
                    id_role=:id_role";
        
        $params = [
            "username"     => $user->getUsername(),
            "password"     => $user->getPassword(),
            "id_role"      => $user->getId_role()
        ];
        // var_dump($params);
        
        return $this->create( $sql, $params, $user );

    }

    protected function save( Model $user ){
        // Cas 1 : Pas d'id renseigné, je souhaite insérer mon produit
        if( empty( $user->getId() ) ){
            return $this->createUser( $user );
        }
        //Cas 2 : id renseigné, je cherche a mettre à jour mon produit
        else {
            return $this->updateUser( $user );
        }
    }
    
    public function saveUser( User $user ){
        return $this->save( $user );
    }

    public function getUserById( $id ) {

        $sql = "SELECT * FROM users WHERE id=:id";
        $params = [
            "id" => $id
        ];
        $data = $this->read( $sql, $id );
        
        $user = false;

        if( $data ){
            $user = new User( $data );
        }
        
        return $user;

    }

    public function deleteUser( $id ){

        $sql = "DELETE FROM users WHERE id=:id";
        return $this->delete( $sql, $id );

    }

    public function getUsers( $start_index = 0 ){

        $sql = "SELECT * FROM users LIMIT :start_index, :per_page";
        $params = [
            ':start_index' => $start_index,
            ':per_page' => self::USERS_BY_PAGE
        ];

        $datas = $this->readAll( $sql, $params );

        $users = [];
        
        foreach ( $datas as $data ) {
            
            $users[] = new User( $data );

        }

        return $users;

    }

    private function updateUser( User $user ){

        $sql = "UPDATE users 
                SET username=:username, 
                    password=:password, 
                    id_role=:id_role
                WHERE id=:id";

        $params = [
            "username"      => $user->getUsername(),
            "password"      => $user->getPassword(),
            "id_role"       => $user->getId_role()
        ];

        return $this->update( $sql, $params, $user );

    }

    public function getGrants(User $user){
        $sql = "SELECT *
        FROM grants
        JOIN link_role_grant
        as link
        ON id = link.id_grant
        WHERE link.id_role = :id_role";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "id_role" => $user->getId_role()
        ]);

        $results = $statement->fetchAll();

        $grants =[];
            foreach ($results as $result) {
                $grants[] = new Grant($result);
            }
            // var_dump($grants);
        return $grants;
    }

    public function existsLogin($username, $password){
        $sql = "SELECT *
        FROM users
        WHERE username = :username
        AND password = :password";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            "username" => $username,
            "password" => $password
        ]);

        $result = $statement->fetch();

        $user = null;
         if($result){
             $user = new User($result);
         }
        return $user;



    }

   
}