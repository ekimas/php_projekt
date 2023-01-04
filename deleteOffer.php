<?php
session_start();

require('checkLogin.php');
require('OfferController.php');

if (isset($_GET['offer'])) {
    $offerController = new OfferController;

    $offerController->deleteOffer($_GET['offer']);        
} else {
    header('Location: main.php');
}

