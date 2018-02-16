<?php 
// L'autoloader va permettre de charger automatiquement les fichier
// des classes dont on à besoin !
// $className = "Product"
spl_autoload_register( function( $className ){

    // On liste nos dossiers contenant nos classes
    $dirs = [
        "models/",
        "repositories/",
        "forms/",
        "controllers/",
        "authentication/"
    ];

    // Je boucle et je regarde si un fichier correspond
    foreach( $dirs as $dir ){

        $file = $dir . $className . ".php"; // models/Product.php
        
        if( file_exists( $file ) ){
            require_once $file;
            break;
        }

    }

} );