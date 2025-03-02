<?php
include '../database/database.php';
session_start();

$conn = getDatabaseConnection(); // Ensure connection is established

try {
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
      $_SESSION['errors'] = "Username and password are required!";
      header("Location: ../index.php");
      exit;
    }

    $user = verify_user($conn, $username, $password); // Pass $conn to function

    if ($user) {
      // Generate a unique token
      $token = bin2hex(random_bytes(32));

      // Store token in session
      $_SESSION['access_token'] = $token;
      $_SESSION['user_id'] = $user['id']; // Store user ID for authentication
      $_SESSION['username'] = $username;

      // Redirect to the Todo App dashboard
      header("Location: ../views/todo_dashboard.php"); // Ensure this file exists
      exit;
    } else {
      $_SESSION['errors'] = "Invalid username or password!";
      header("Location: ../index.php");
      exit;
    }
  }
} catch (\Exception $e) {
  echo "Error: " . $e->getMessage();
}

// Function to verify user credentials
function verify_user($conn, $username, $password) // Pass connection as parameter
{
  $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
  
  if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
  }

  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
      return $row; // Return user info
    }
  }
  return false;
}
?>
