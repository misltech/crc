<?php
if (!isset($_SESSION)) {
  session_start();
}
$csrf = $_SESSION['token'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="hello there">
  <meta name="csrf-token" content="<?php echo $csrf; ?>">

  <title>Student Internship Report</title>

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Thambi+2&display=swap" rel="stylesheet">
  <link rel="icon" href="https://newpaltz.edu/favicon.ico">
  <link href="../css/main.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/simple-sidebar.css" rel="stylesheet">
</head>

<body>