<?php

// start of a session
session_start();

// checks if user is logged in
require('checkLogin.php');
// requires OfferController
require('OfferController.php');

// creates instance of OfferController
$offerController = new OfferController;

// call OfferController's method
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
                    <a href="./user.php">Account</a>
                </div>
                <div class="nav-button">
                    <a href="#">Offers</a>
                </div>
                <div class="nav-button">
                    <a href="./offerForm.php">Add an offer</a>
                </div>
                <div class="nav-button">
                    <a href="login.php?redirect=logout.php">Logout</a>
                </div>
            </nav>
            <div>
                <table class="offers-table">
                    <?php
                    // foreach loop for displaying offers
                    foreach ($offers as $offer) {
                        echo '<tr>';
                        // only admin can delete an offer
                        if ($_SESSION["auth"] == 1) {
                            echo '<td><a href="deleteOffer.php?offer=' . $offer['id'] . '">DELETE</a></td>';
                        }
                        echo '<td>' . $offer['creator'] . '</td><td class="offer-name">' . $offer["name"] . '</td><td>' . $offer["description"] . '</td><td class="offer-price">' . $offer["price"] . '</td></tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
