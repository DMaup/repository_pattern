<?php 
abstract class Repository {

    protected $pdo;

    function __construct($pdo){

        //On appelle le singleton de la base de donnée
        $this->pdo = $pdo;
    }

    // Force l'implémentation de cette méthode dans les classes enfants
    abstract protected function save( Model $model );

    protected function create( $sql, $params, Model $model ){

        $statement = $this->pdo->prepare( $sql );
        $result = $statement->execute( $params );

        $id = 0;

        if( $result ){
            $id = $this->pdo->lastInsertId();

            //Quelque soit le $model passé, on sait que la fonction setId existe !!!
            $model->setId( $id );
        }

        return $id;
    }

    protected function update( $sql, $params, Model $model ){

        $statement = $this->pdo->prepare( $sql );

        $params["id"] = $model->getId();
        $result = $statement->execute( $params );

        $updated = 0;

        if( $result ){
            $updated = $statement->rowCount();
        }

        return $updated;

    }

    protected function read( $sql, $id ){

        $statement = $this->pdo->prepare( $sql );
        $statement->execute([
            "id" => $id
        ]);

        return $statement->fetch();

    }

    protected function delete( $sql, $id ){

        $statement = $this->pdo->prepare( $sql );
        $result = $statement->execute([
            "id" => $id
        ]);

        $deleted = 0;

        if( $result ){
            $deleted = $statement->rowCount();
        }

        return $deleted;

    }

    protected function readAll( $sql, $params ){

        $statement = $this->pdo->prepare( $sql );

        foreach( $params as $key => $value ){

            $statement->bindValue( $key, $value, PDO::PARAM_INT);
        }

        $statement->execute();

        return $statement->fetchAll();

    }
    
}