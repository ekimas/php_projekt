<?php

if ( !isset($_SESSION["auth"]) && !isset($_SESSION["userId"])) {
    header('Location: index.html');
}
