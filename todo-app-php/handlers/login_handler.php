<?php

include '../database/database.php';
session_start();

try {
  $conn = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
      $_SESSION['errors'] = "Username and password are required!";
      header("Location: ../index.php");
      exit;
    }
    //==================================================================
    
    $user = verify_user($conn, $username, $password);

    if ($user) {
      session_regenerate_id(true);

      $token = bin2hex(random_bytes(32));

      $_SESSION['access_token'] = $token;

      header("Location: ../views/home.php");
      exit;
    } else {
      $_SESSION['errors'] = "Invalid username or password!";
      header("Location: ../index.php");
      exit;
    }
  }

  $conn->close();
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}function verify_user($conn, $username, $password)
{
  if (!$conn) {
    throw new Exception("Database connection failed");
  }

  $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
  if (!$stmt) {
    throw new Exception("Failed to prepare statement: " . $conn->error);
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
      return $row; 
    }
  }
  return false;
}
?>