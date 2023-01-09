<?php

// start of session
session_start();

// checks if user is logged in
require('checkLogin.php');
// requires UserController
require('UserController.php');
// creates an instance of UserController
$userController = new UserController;
// call UserController's method
$userController->changeUserData($_POST, $_SESSION['userId']);
