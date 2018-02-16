<?php

use RepositoryManager as RM;

$productController = new ProductController();

Flight::route('/products(/@page:[0-9]+)',        [ $productController, "displayAll"]);

Flight::route('/products/create',                [ $productController, "displayCreateForm"]);

Flight::route('/products/edit/@id:[0-9]+',       [ $productController, "displayEditForm"]);
   
Flight::route('POST /products/save',             [ $productController, "diplaySaveProduct"]);

Flight::route('/products/delete/@id:[0-9]+',     [ $productController, "displayDeleteProduct"]);

Flight::route('/read/@id:[0-9]+',                [ $productController, "displayReadProduct"]);

   