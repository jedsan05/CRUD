<?php

session_start();

unset($_SESSION['access_token']);

setcookie("access_token", "", time() - 3600, "/"); 
session_destroy();

header("Location: ../index.php");
exit;
