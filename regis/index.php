<?php
    session_start();
    require_once '../config/db.php';
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
    max-width: 800px;
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

  .form-row {
    display: flex;
    flex-wrap: wrap;
    margin: -10px;
  }

  .form-row > div {
    flex: 1 0 50%;
    padding: 10px;
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
  <br>
  <h3>Register</h3>
  <hr>
  <form action="signup_db.php" method="post">
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
    <?php if(isset($_SESSION['warning'])) { ?>
      <div class="alert alert-warning" role="alert">
        <?php
          echo $_SESSION['warning'];
          unset($_SESSION['warning']);
        ?>
      </div>
    <?php } ?>

    <div class="form-row">
      <div>
        <label for="username" class="form-label">User name</label>
        <input type="text" class="form-control" name="username">
      </div>
      <div>
        <label for="fname" class="form-label">First name</label>
        <input type="text" class="form-control" name="fname">
      </div>
    </div>

    <div class="form-row">
      <div>
        <label for="lname" class="form-label">Last name</label>
        <input type="text" class="form-control" name="lname">
      </div>
      <div>
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email">
      </div>
    </div>

    <div class="form-row">
      <div>
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password">
      </div>
      <div>
        <label for="c_password" class="form-label">Confirm password</label>
        <input type="password" class="form-control" name="c_password">
      </div>
    </div>

    <div class="text-center">
      <br>
      <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
    </div>
  </form>
  <hr>
  
  <p>Already a member? <a href="signin.php">Sign in</a></p>
  <p>Back to <a href="../page/home.php">Home Page</a></p>
  <br>
</div>
    
    
</body>
</html>