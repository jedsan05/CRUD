<?php

include '../database/database.php';

try {
  $conn = getDatabaseConnection();

  if (!$conn) {
    throw new Exception("Failed to connect to the database.");
  }

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $id = $_POST['id'];

    $stmt = $conn->prepare("UPDATE todo SET title = ?, description = ?, status = ? WHERE id = ?");
    if (!$stmt) {
      throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("ssii", $title, $description, $status, $id);

    if ($stmt->execute()) {
      header("Location: ../index.php");
      exit;
    } else {
      echo "Operation failed: " . $stmt->error;
    }

    $stmt->close();
  }

  $conn->close();
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}
?>