<?php

// requires dbconnection.php
require('dbconnection.php');

/**
 * Escapes special characters in a string for use in an SQL statement, taking into account the current charset of the connection
 */
$user_name = mysqli_real_escape_string($db_conn, $_POST["name"]);
$user_surname = mysqli_real_escape_string($db_conn, $_POST["surname"]);
$user_nickname = mysqli_real_escape_string($db_conn, $_POST["nickname"]);
$user_mail = mysqli_real_escape_string($db_conn, $_POST["mail"]);
$user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);

// creates hash of password
$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

if (mysqli_query(
    $db_conn,
    "INSERT INTO users (nickname, password, mail, name, surname) VALUES ('$user_nickname', '$user_password_hash', '$user_mail', '$user_name', '$user_surname')"
)) {
    // redirect
    header('Location: index.html');
} else {
    echo "User already exists";
}
