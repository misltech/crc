<?php
session_start();
//redirect on back button when already logged in.
if(isset($_SESSION['user_type'])){
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
  <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

  <title>Internship Fieldwork Sign In</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/sign-in/">

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin" action="index.php" method="POST">
    <img class="mb-4" src="images/newpaltzlogo.png" alt="" width="250" height="auto">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?php if (checkInvalidCredentials()) { ?>
      <div class="alert alert-warning alert-dismissible fade show">
        Invalid Credentials!
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    <?php } ?>
    <?php if (checkInternalError()) { ?>
      <div class="alert alert-danger alert-dismissible fade show">
        Internal Error. Please try again later.
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
    <?php } ?>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; Career Resource Center 2020</p>
  </form>
</body>

</html>


<?php
include_once 'backend_new/config.php';
if (isset($_POST['submit'])) {

  if (!isset($_POST['email'])) {
    header("Location: index.php");  //this shouldnt happen. But if someone tries to bypass the front end form
    exit;
  }

  if (!isset($_POST['password'])) {
    header("Location: index.php"); //this shouldnt happen. But if someone tries to bypass the front end form
    exit;
  }

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "SELECT * FROM " . $accounts . "WHERE email = '$email'"; //substitute table to global
  $result = $db_conn->query($sql);

  if ($result == 1) {
    $result = $result->fetch_assoc();
    $_SESSION['id_key'] = $email;
    $_SESSION['user_type'] = $result["profile_type"];
    $first_time = $result["first_time"];
    $verified = $result["verified"];
    redirect($_SESSION['user_type']);
 
}

function checkInvalidCredentials()
{
  include_once 'backend_new/config.php'; //needs to be done. Apparenly functions are limited to its variables
  if (isset($_GET['error'])) {
    $error_id = $_GET['error'];
    if ($error_id == $IncorrectCredentials) {
      return true;
    }
  }
}
function checkInternalError()
{
  include_once 'backend_new/config.php'; //needs to be done. Apparenly functions are limited to its variables
  if (isset($_GET['error'])) {
    $error_id = $_GET['error'];
    if ($error_id == $InternalError) {
      return true;
    }
  }
}




?>