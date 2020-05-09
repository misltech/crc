<html>

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
            background-image: url(https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/Crater_Lake_winter_pano2.jpg/1920px-Crater_Lake_winter_pano2.jpg);
            background-size: cover;
            background-attachment: fixed;
            background-position: center top;
        }
    </style>
</head>

<body>

    <form class="form-signin text-center" method="POST">
        <img class="mb-4" src="favicon/android-chrome-512x512.png" alt="" width="auto" height="90">
        <?php if (isset($_GET['request']) and $_GET['request'] == 'true') { ?>
            <div class="alert alert-success fade show">
                Success! Password reset sent!
            </div>
            <?php exit(header("refresh:5;url=index.php")); ?>
        <?php } ?>
        <h1 class="h3 mb-3 font-weight-normal text-center">Please enter your email address</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control mb-3" placeholder="Email address" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" name="reset" type="submit">Request</button>
        <p class="mt-5 mb-3 text-muted">&copy; Career Resource Center 2020</p>
        <!-- Wrap this around php get statement that hides if submitted and sys  -->
    </form>
</body>

<?php

if (isset($_POST['reset'])) {
    include_once 'backend/db_con3.php';
    include_once 'backend/util.php';
    $email = mysqli_escape_string($db_conn, $_POST['email']);
    $checksql = "SELECT * FROM s20_UserPass WHERE email = '$email'";
    $run = mysqli_query($db_conn, $checksql);
    if ($run and mysqli_num_rows($run) == 1) {
        sendEmail($email, "Internship Fieldwork Password Reset", "Password requested! Ignore if you did not make this request.");
        header('Location: ./forgot.php?request=true');
    }
}


?>

</html>