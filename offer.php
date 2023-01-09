<?php

// start of session
session_start();

// checks if user is logged in
require('checkLogin.php');
// requires OfferController
require('OfferController.php');

// creates an instance of OfferController
$offerController = new OfferController;

// call OfferController's method
$offerController->createOffer();
