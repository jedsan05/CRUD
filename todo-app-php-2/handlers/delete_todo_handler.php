<?php

include '../database/database.php';

try {
  $conn = getDatabaseConnection();

  if (!$conn) {
    throw new Exception("Failed to connect to the database.");
  }

  $id = $_GET['id'];

  $stmt = $conn->prepare("DELETE FROM todo WHERE id = ?");
  if (!$stmt) {
    throw new Exception("Failed to prepare statement: " . $conn->error);
  }

  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    header("Location: ../index.php");
    exit;
  } else {
    echo "Operation failed: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}
?>