<?php
session_start();

require('checkLogin.php');
require('UserController.php');

$userController = new UserController;

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
                    <span>Hello <?php echo $_SESSION["nick"] ?></span>
                </div>
                <div class="nav-button">
                    <a href="#">Konto</a>
                </div>
                <div class="nav-button">
                    <a href="./main.php">Oferty</a>
                </div>
                <div class="nav-button">
                    <a href="./offerForm.php">Dodaj ofertę</a>
                </div>
                <div class="nav-button">
                    <a href="login.php?redirect=logout.php">Wyloguj</a>
                </div>
            </nav>
            <div class="user-form">
                <form method="POST" action="updateUser.php">
                    <input type="text" name="name" placeholder="<?php echo $data['name'] ?>">
                    <input type="text" name="surname" placeholder="<?php echo $data['surname'] ?>">
                    <input type="text" name="nickname" placeholder="<?php echo $data['nickname'] ?>">

                    <input type="email" name="mail" placeholder="<?php echo $data['mail'] ?>">
                    <input type="password" name="password" placeholder="password">

                    <input type="submit" name="submit" value="Wyślij">
                </form>
            </div>
        </div>
    </body>
</html>