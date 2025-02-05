<?php

function getDatabaseConnection() {
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "todo_app";

  try {
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
      throw new Exception("Database connection unsuccessful: " . $conn->connect_error);
    }

    return $conn;
  } catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
    return null;
  }
}
?>