<?php
if (!isset($_SESSION)) {
  session_start();
}
$csrf = $_SESSION['token'];

validCSRF($csrf);

function validCSRF($csrf){
  if($csrf == null or strlen($csrf) < 2){
    redirect(null);
  }
}
?>
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
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/dark-mode.css">
  <link href="../css/main.css" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
  <link rel="manifest" href="../favicon/site.webmanifest">
  <!-- Custom styles for this template -->
  <link href="../css/simple-sidebar.css" rel="stylesheet">
</head>

<?php
include '../backend/timeout.php';
validate('student');
?>
<body>