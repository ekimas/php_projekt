<?php
session_start();

require('checkLogin.php');
require('UserController.php');

print_r($_POST);

$userController = new UserController;

$userController->changeUserData($_POST, $_SESSION['userId']);
