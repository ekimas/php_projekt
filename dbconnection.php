<?php

$dbhost = 'localhost';
$dbname = 'wsb';
$dbuser = 'root';
$dbpass = '';

$db_conn = mysqli_connect($dbhost,$dbuser,$dbpass)
    or die ("Odpowiedź: Błąd połączenia z serwerem $host");

mysqli_select_db($db_conn, $dbname) or die("Trwa konserwacja bazy danych… Odśwież stronę za kilka sekund.");