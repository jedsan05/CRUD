<?php
session_start();

// Redirect to login if user is not authenticated
if (!isset($_SESSION['access_token'])) {
    header("Location: ../index.php"); 
    exit;
}
?>
