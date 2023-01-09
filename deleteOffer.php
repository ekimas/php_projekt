<?php

// start of session
session_start();

// checks for logged user
require('checkLogin.php');
// requires OfferController.php
require('OfferController.php');

// checks if request has got an offer param
if (isset($_GET['offer'])) {
    // creates an instance of OfferController
    $offerController = new OfferController;

    // call OfferController's method
    $offerController->deleteOffer($_GET['offer']);
} else {
    // redirect to main.php
    header('Location: main.php');
}
