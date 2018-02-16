<?php 
require "flight/Flight.php";
require "autoload.php";

session_start();

define("BASE_URL","/Poo/repository_pattern");

require "routes/products_routes.php";
require "routes/users_routes.php";

Flight::set('Flight.handele_errors', false);

Flight::start();