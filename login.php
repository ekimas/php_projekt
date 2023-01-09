<?php

// start of the session
session_start();

// requires dbconnection.php
require('dbconnection.php');

// checks for any redirect
if (isset($_GET['redirect'])) {
    // redirects
    header('Location: ' . $_GET['redirect']);
} else {
    /**
     * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
     */
    $user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);
    $user_email = mysqli_real_escape_string($db_conn, $_POST["mail"]);
    $query_login = mysqli_query($db_conn, "SELECT * FROM users WHERE mail ='$user_email'");

    if (mysqli_num_rows($query_login) > 0) {
        $record = mysqli_fetch_assoc($query_login);
        $hash = $record["password"];

        // verifies that a password matches a hash
        if (password_verify($user_password, $hash)) {
            // sets session's variables
            $_SESSION["userId"] = $record['id'];
            $_SESSION["auth"] = $record['auth'];
            $_SESSION["nick"] = $record['nickname'];
            // redirects to main.php
            header('Location: login.php?redirect=main.php');
        } else {
            header('Location: index.html');
        }
    } else {
        echo "wrong credentials";
    }
}
