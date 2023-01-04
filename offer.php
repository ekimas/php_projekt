<?php
session_start();

require('checkLogin.php');
require('OfferController.php');

$offerController = new OfferController;

$offerController->createOffer();