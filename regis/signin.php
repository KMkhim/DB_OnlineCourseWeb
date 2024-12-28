<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   
<style>
  body {
    font-family: 'Montserrat', sans-serif;
    background-image: url('../page/image/8753.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    backdrop-filter: blur(5px);
  }

  .container {
    max-width: 400px;
    margin: 80px auto;
    background-color: rgba(255, 255, 255, 0.8);
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  h3 {
    text-align: center;
    font-weight: 600;
    margin-bottom: 30px;
  }

  .form-control {
    border-radius: 4px;
    border: 1px solid #ced4da;
    padding: 12px 16px;
    font-size: 16px;
  }

  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 16px;
    padding: 12px 24px;
    border-radius: 4px;
    transition: background-color 0.3s, border-color 0.3s;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #004a9e;
  }

  a {
    color: #007bff;
    text-decoration: none;
  }

  a:hover {
    color: #0056b3;
  }
</style>

<div class="container">
  <h3>Sign In</h3>
  <hr>
  <form action="signin_db.php" method="post">
    <?php if(isset($_SESSION['error'])) { ?>
      <div class="alert alert-danger" role="alert">
        <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        ?>
      </div>
    <?php } ?>
    <?php if(isset($_SESSION['success'])) { ?>
      <div class="alert alert-success" role="alert">
        <?php
          echo $_SESSION['success'];
          unset($_SESSION['success']);
        ?>
      </div>
    <?php } ?>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" name="email" aria-describedby="email">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" aria-describedby="password">
    </div>
    <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
  </form>
  <hr>
  <p>Not a member yet? <a href="index.php">Register here</a></p>
  <p>Back to <a href="../page/home.php">Home Page</a></p>
</div>
</body>
</html>