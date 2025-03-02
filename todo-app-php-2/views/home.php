<?php include '../helpers/authenticated.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Todo App</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="../statics/js/bootstrap.js"></script>
</head>

<body>
    <div class="container d-flex justify-content-center mt-5">
      <div class="col-6">
        <div class="text-center mb-4">
          <h1 class="fw-bold"><i class="fas fa-list-check"></i> Todo App</h1>
          <a href="add_todo.php" class="btn btn-outline-dark btn-sm"> <i class="fas fa-plus"></i> Add Todo</a>
        </div>

        <?php
          include '../database/database.php';
          $conn = getDatabaseConnection();
          $res = $conn->query("SELECT * FROM todo");
        ?>

        <?php if ($res->num_rows > 0): ?>
          <?php while ($row = $res->fetch_assoc()): ?>
            <div class="row border rounded p-3 my-3 shadow-sm">
                <div>
                    <h5 class="fw-bold"><i class="fas fa-tasks"></i> <?= htmlspecialchars($row['title']); ?></h5>
                    <p class="text-secondary"><i class="fas fa-align-left"></i> <?= htmlspecialchars($row['description']); ?></p>
                    <p class="fw-bold"><small><i class="fas fa-hourglass-half"></i> <?= $row['status'] == 0 ? "Ongoing" : "Done"; ?></small></p>
                    <div class="d-flex gap-2">
                        <a href="update_todo.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <a href="../handlers/delete_todo_handler.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="row border rounded p-3 my-3 text-center shadow-sm">
              <div class="col mt-3">
                  <p class="text-muted"><i class="fas fa-check-circle"></i> 🎉 No current tasks! Time to relax or add new tasks.</p>
              </div>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <a href="../handlers/logout_handler.php" class="btn btn-danger btn-sm position-fixed bottom-0 start-0 mb-3 ms-3"> <i class="fas fa-sign-out-alt"></i> Logout</a>

</body>

</html>
<?php
$conn->close();
?>