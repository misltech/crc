<?php include_once('backend/util.php'); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#003e7e" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Fieldwork Addition Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo (API_URL) ?>stylesheets/styles.css" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Cormorant+Garamond" />
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans" />
</head>

<body onload="addEventListeners();">
    <script src="<?php echo (API_URL) ?>javascript/shared.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php
       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (isset($_SESSION["user_type"]) || DEBUG === true) {
        include('components/nav.php');
    }
    echo ("<h1 style=\"color: rgba(255,255,255,0.8);\">Internship Fieldwork Registration Form</h1>");


    include('components/message.php');

    // if (DEBUG === true) {
    //     echo ("<div class=\"container\" style=\"background-color: rgba(255, 0, 0, 0.8); color: white;\">");
    //     include('components/session_debug.php');
    //     echo ("</div>");
    // }
    ?>
    <div class="background" id="background"></div>
    <div class="container-fluid">