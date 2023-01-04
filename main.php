<?php
session_start();

require('checkLogin.php');
require('OfferController.php');

$offerController = new OfferController;

$offers = $offerController->getAllOffers();

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
                    <a href="#">Oferty</a>
                </div>
                <div class="nav-button">
                    <a href="./offerForm.php">Dodaj ofertę</a>
                </div>
                <div class="nav-button">
                    <a href="login.php?redirect=logout.php">Wyloguj</a>
                </div>
            </nav>
            <div>
                <table class="offers-table">
                    <?php
                        foreach($offers as $offer) {
                            echo '<tr>';
                            if ($_SESSION["auth"] == 1) {
                                echo '<td><a href="deleteOffer.php?offer=' . $offer['id'] . '">DELETE</a></td>';
                            }
                            echo '<td>'. $offer['creator'] .'</td><td class="offer-name">'. $offer["name"] .'</td><td>'. $offer["description"] .'</td><td class="offer-price">'. $offer["price"] .'</td></tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>