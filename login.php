<?php

session_start();

require('dbconnection.php');

if (isset($_GET['redirect'])) {
    header('Location: ' . $_GET['redirect']);
} else {
    $user_password = mysqli_real_escape_string($db_conn, $_POST["password"]);
    $user_email = mysqli_real_escape_string($db_conn, $_POST["mail"]);
    $query_login = mysqli_query($db_conn, "SELECT * FROM users WHERE mail ='$user_email'");

    if(mysqli_num_rows($query_login) > 0) {
        $record = mysqli_fetch_assoc($query_login);
        $hash = $record["password"];
        if (password_verify($user_password, $hash)) {
            $_SESSION["userId"] = $record['id'];
            $_SESSION["auth"] = $record['auth'];
            $_SESSION["nick"] = $record['nickname'];
            header('Location: login.php?redirect=main.php');  
        } else {
            header('Location: index.html');
        }
    } else {
        echo "wrong credentials";
    }
}
