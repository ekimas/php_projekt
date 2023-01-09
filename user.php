<?php

// start of the session
session_start();

// checks if user is logged in
require('checkLogin.php');
// requires UserController
require('UserController.php');
// creates an instance of UserController
$userController = new UserController;
// calls UserController's method
$data = $userController->getUser($_SESSION['userId']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lorem ipsum</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
    <meta name=viewport content="width=device-width, initial-scale=1,user-scalable=no"/>
</head>
<body>
<div class="page-container">
    <nav>
        <div class="nav-button">
            <span>Hello <?php
                echo $_SESSION["nick"] ?></span>
        </div>
        <div class="nav-button">
            <a href="#">Account</a>
        </div>
        <div class="nav-button">
            <a href="./main.php">Offers</a>
        </div>
        <div class="nav-button">
            <a href="./offerForm.php">Add an offer</a>
        </div>
        <div class="nav-button">
            <a href="login.php?redirect=logout.php">Logout</a>
        </div>
    </nav>
    <div class="user-form">
        <form method="POST" action="updateUser.php">
            <input type="text" name="name" placeholder="<?php
            echo $data['name'] ?>">
            <input type="text" name="surname" placeholder="<?php
            echo $data['surname'] ?>">
            <input type="text" name="nickname" placeholder="<?php
            echo $data['nickname'] ?>">

            <input type="email" name="mail" placeholder="<?php
            echo $data['mail'] ?>">
            <input type="password" name="password" placeholder="password">

            <input type="submit" name="submit" value="Send">
        </form>
    </div>
</div>
</body>
</html>
