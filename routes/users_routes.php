<?php

use RepositoryManager as RM;

$userController = new UserController();

Flight::route('/users(/@page:[0-9]+)',                       [ $userController, "displayAll"]);

Flight::route('/users/create',                               [ $userController, "displayCreateForm"]);

Flight::route('/users/edit/@id:[0-9]+',                      [ $userController, "displayEditForm"]);

Flight::route('POST /users/save',                            [ $userController, "displaySaveUser"]);

Flight::route('/users/deleteUser/@id:[0-9]+',                [ $userController, "displayDeleteUser"]);

Flight::route('/users/log',                                  [ $userController, "displayLoginForm"]);

Flight::route('POST /users/login(/@username/@password)',     [ $userController, "displayLogUser"]);







   