<?php include 'helpers/not_authenticated.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bakery Shop</title>
  <link href="statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="statics/js/bootstrap.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .login-card {
      background: #ffffff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .login-title {
      color: #343a40;
      font-weight: bold;
    }
    .btn-custom {
      background-color: #ff6f61;
      border: none;
      color: white;
    }
    .btn-custom:hover {
      background-color: #e85b50;
    }
  </style>
  <script>
    function clearForm() {
      document.getElementById('login-form').reset();
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">CRUD SYSTEM</a>
      <ul class="nav">
      </ul>
    </div>
  </nav>
  
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5 login-card">
      <div class="text-center">
        <p class="display-5 login-title">Log-in to Your Account</p>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'no_account'): ?>
          <div class="alert alert-danger" role="alert">
            No account found. Please register first.
          </div>
        <?php endif; ?>
      </div>

      <form id="login-form" class="form" action="handlers/login_handler.php" method="POST" onsubmit="clearForm()">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" name="username" required />
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required />
        </div>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
          <div class="alert alert-warning" role="alert">
            Invalid username or password. Please try again.
          </div>
        <?php endif; ?>
        <div class="mb-3 text-end">
          <a href="register.php">Register here</a>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-custom">Login</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
