<?php include '../helpers/authenticated.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Todo</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="../statics/js/bootstrap.js"></script>
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="text-center mb-4">
        <h1 class="fw-bold"><i class="fas fa-plus-circle"></i> Create Todo</h1>
      </div>
      <div class="row">
        <form class="form" action="../handlers/add_todo_handler.php" method="POST">
          <div class="my-3">
            <label><i class="fas fa-heading"></i> Title</label>
            <input class="form-control" type="text" name="title" required />
          </div>
          <div class="my-3">
            <label><i class="fas fa-align-left"></i> Description</label>
            <textarea class="form-control" name="description" required></textarea>
          </div>
          <div class="my-3 text-center">
            <button type="submit" class="btn btn-outline-dark"> <i class="fas fa-check"></i> Create Todo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
