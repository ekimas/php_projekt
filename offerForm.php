<?php
    session_start();
    $userId = $_SESSION['userId']
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
                    <a href="./user.php">Konto</a>
                </div>
                <div class="nav-button">
                    <a href="./main.php">Oferty</a>
                </div>
                <div class="nav-button">
                    <a href="#">Dodaj ofertę</a>
                </div>
                <div class="nav-button">
                    <a href="login.php?redirect=logout.php">Wyloguj</a>
                </div>
            </nav>
            <div class="offer-form">
                <form method="POST" action="offer.php">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="number" name="price" min="0" placeholder="Price" required>
                    <textarea name="description" rows="4" cols="50"></textarea>
                    <input type="hidden" name="userId" value="<?php echo $userId ?>">

                    <input type="submit" name="submit" value="Add">
                </form>
            </div>
        </div>
    </body>
</html>
