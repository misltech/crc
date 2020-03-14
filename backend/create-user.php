<?php
// resume existing session
session_start();

include('util.php');

if (checkUserTypeOfMultiple(['secretary', 'admin', 'professor'])) {

    // Declare variable from POST request

    $email = mysql_real_escape_string($_POST['user_email']);
    $banner_ID = mysql_real_escape_string($_POST['banner_id']);
    $type = mysql_real_escape_string($_POST['user_type']);

    // Generate random password

    $pw = generatePassword(8);
    $welcomeMSG = "Welcome to the Fieldwork Application System!\nYour password is: $pw";
    $subject = "Welcome!";

    // Connect to DB and generate query

    include('db_conn2.php');

    $sql = "INSERT INTO s20_UserPass (email, banner_id, profile_type, passcode)
            values ('$email', '$banner_ID', '$type', '$pw')";

    if ($conn->query($sql) == true) {
        setMessage(true, "New $type created; have the $type check their e-mail at $email for their password.");
        $_SESSION['search_results']['email'] = $email;
        sendEmail($email, $subject, $welcomeMSG);
    } else {
        setMessage(false, "Failed to create user.");
    }

    $conn->close();

    /*if(isset($_POST['secretary form'])){
        header("Location: ../secretary.php");
    }
    */
    header("Location: ../secretary.php");
} else {
    header("Location: ../home.php");
}
?>