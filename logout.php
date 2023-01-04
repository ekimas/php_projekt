<?php

session_start();
unset($_SESSION["auth"]);
unset($_SESSION["userId"]);
unset($_SESSION["nick"]);

session_destroy();

header('Location: index.html');