<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (!isset($_SESSION)) {
  session_start();
}
//redirect on back button when already logged in.
include_once('./backend/util.php');
include_once('./backend/db_con3.php');
//console_log($_SESSION['user_type']);
if (isset($_SESSION['user_type'])) {
  redirect($_SESSION['user_type']);
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="https://newpaltz.edu/favicon.ico">

  <title>Internship Fieldwork Sign In</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/main.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">

  <style>
    body {
      background-image: url(https://login.newpaltz.edu/cas/themes/newpaltz/images/background.jpg);
      background-size: cover;
      background-attachment: fixed;
      background-position: center top;
    }
  </style>
</head>

<body class="text-center">
  <form class="form-signin" action="index" method="POST">
    <img class="mb-4" src="images/newpaltzlogo.png" alt="" width="250" height="auto">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?php if (checkInvalidCredentials()) { ?>
      <div class="alert alert-warning fade show">
        Invalid Credentials!
      </div>
    <?php } ?>
    <?php if (checkInternalError()) { ?>
      <div class="alert alert-danger fade show">
        Internal Error. Please try again later.
      </div>
    <?php } ?>
    <?php if (checkInactivity()) { ?>
      <div class="alert alert-warning fade show">
        Signed out due to inactivity. Please sign in again.
      </div>
    <?php } ?>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
      <a href="forgot.php">forgot username/password</a>
    </div>
    <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; Career Resource Center 2020</p>
  </form>
</body>

</html>


<?php
if (isset($_POST['submit'])) {

  if (!isset($_POST['email'], $_POST['password'])) {
    header("Location: index.php");  //this shouldnt happen. But if someone tries to bypass the front end form
    exit("Please fill out form.");
  }

  $email = mysqli_real_escape_string($db_conn, $_POST['email']);
  $password = mysqli_real_escape_string($db_conn, $_POST['password']);

  $sql = "SELECT * FROM " . $GLOBALS['accounts'] . " WHERE email = '$email' AND passcode = '$password'"; //substitute table to global
  $result = mysqli_query($db_conn, $sql);
  $row = mysqli_fetch_assoc($result);
  
  // mysqli_fetch_array($result, MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  if ($count == 1) {
    $_SESSION['user_type'] = $row["profile_type"];
    $_SESSION['user_email'] = $row['email'];
    $_SESSION['banner'] = $row['banner_id'];
    $_SESSION['timestamp'] = time();
    $_SESSION['token'] = bin2hex(random_bytes(32));

    redirect($_SESSION['user_type']);
  } else {
    header("Location: ./index.php?e=" . $GLOBALS['IncorrectCredentials']);
    exit();
  }
}
function checkInvalidCredentials()
{
  if (isset($_GET['e'])) {
    $error_id = $_GET['e'];
    if ($error_id == $GLOBALS['IncorrectCredentials']) {
      return true;
    }
  }
}
function checkInternalError()
{
  if (isset($_GET['e'])) {
    $error_id = $_GET['e'];
    if ($error_id == $GLOBALS['InternalError']) {
      return true;
    }
  }
}
function checkInactivity(){
  if (isset($_GET['inactive'])) {
    $id = $_GET['inactive'];
    if ($id == $GLOBALS['Inactivity']) {
      return true;
    }
  }
}

?>