<?php
function getDatabaseConnection() {
    $servername = "localhost"; // Change if needed
    $username = "root"; // Update if you use a different username
    $password = ""; // Update if MySQL has a password
    $dbname = "todo_app"; // Make sure this matches your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
