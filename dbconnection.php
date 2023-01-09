<?php

$dbhost = 'localhost';
$dbname = 'wsb';
$dbuser = 'root';
$dbpass = '';

$db_conn = mysqli_connect($dbhost, $dbuser, $dbpass)
or die ('Connection error');

mysqli_select_db($db_conn, $dbname) or die('DB is not accessible');
