<?php

/**
 * Checks the session for logged user's params
 *
 * If user is not logged in, redirects to index.html (login/register page)
 */
if ( !isset($_SESSION["auth"]) && !isset($_SESSION["userId"])) {
    header('Location: index.html');
}
