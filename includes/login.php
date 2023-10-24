<?php include "db.php"; ?>

<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT * FROM users username = '{$username}' ";
  $select_user_query = mysqli_query($connection, $query);
  if (!$select_user_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }

  while ($row = mysqli_fetch_array($select_user_query)) {
    $db_user_id = $row['user_id'];
    $db_username = $row['username'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];
  }

  if ($username !== $db_username && $password !== $db_user_password) {
    header("Location: ../index.php");
  } else if ($username == $db_username && $password == $db_user_password) {
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;

    header("Location ../admin");
  }else{
    header("Location: ../index.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kode is a Premium Bootstrap Admin Template, It's responsive, clean coded and mobile friendly">
  <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
  <title>Kidzori LMS</title>

  <!-- ========== Css Files ========== -->
  <link href="css/root.css" rel="stylesheet">
</head>

<body style="background-color: #f5f5f5;">

  <div class="login-form">
    <form method="POST" action="login.php">
      <div class="top">
        <img src="images/logo.png" alt="icon" class="icon">
        <h1>Kidzori</h1>
        <h4>Welcome</h4>
      </div>
      <div class="form-area">
        <div class="group">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <i class="fa fa-user"></i>
        </div>
        <div class="group">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <i class="fa fa-key"></i>
        </div>
        <div class="checkbox checkbox-primary">
          <input id="checkbox101" type="checkbox" checked>
          <label for="checkbox101"> Remember Me</label>
        </div>
        <button type="submit" class="btn btn-default btn-block">LOGIN</button>
      </div>
    </form>
    <div class="footer-links row">
      <div class="col-xs-6"><a href="/register.html"><i class="fa fa-external-link"></i> Register Now</a></div>
      <div class="col-xs-6 text-right"><a href="/forgot-password.html"><i class="fa fa-lock"></i> Forgot password</a></div>
    </div>
  </div>

</body>

</html>