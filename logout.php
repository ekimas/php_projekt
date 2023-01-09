<?php

// start of session
session_start();

// unsets all session's variables
unset($_SESSION["auth"]);
unset($_SESSION["userId"]);
unset($_SESSION["nick"]);

// destroys the session
session_destroy();

// redirects to index.html
header('Location: index.html');
