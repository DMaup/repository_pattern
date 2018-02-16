<?php 
class Bdd {

    const DSN = "mysql:dbname=shop;host=localhost";
    const USER = "root";
    const PASS = "root";
    const CONFIG = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_WARNING
    ];

    private $pdo;

    // Empêcher toute instanciation extérieure
    private function __construct(){

        try {
            $this->pdo = new PDO( self::DSN, self::USER, self::PASS, self::CONFIG );
        }
        catch( PDOException $e ){
            echo "Erreur lors de la connexion : " . $e->getMessage();
        }

    }

    // L'instance unique se trouve ici
    private static $bdd = null;

    // Méthode d'appel de l'instance unique
    public static function getInstance(): PDO {
        
        // Si l'instance n'existe pas, je la crée
        if( !self::$bdd ){
            self::$bdd = new Bdd();
        }

        // On décide de renvoyer directement pdo
        return self::$bdd->pdo;

    }

}