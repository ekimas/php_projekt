<?php

require('dbconnection.php');

$user_name = mysqli_real_escape_string($db_conn, $_POST["name"]);
$user_surname = mysqli_real_escape_string($db_conn, $_POST["surname"]);
$user_nickname = mysqli_real_escape_string($db_conn, $_POST["nickname"]);
$user_mail = mysqli_real_escape_string($db_conn, $_POST["mail"]);
$user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);

$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

if (mysqli_query($db_conn, "INSERT INTO users (nickname, password, mail, name, surname) VALUES ('$user_nickname', '$user_password_hash', '$user_mail', '$user_name', '$user_surname')")){
   header('Location: index.html');
 } else {
    echo "Nieoczekiwany błąd - użytkownik już istnieje lub błąd serwera MySQL.";
 }