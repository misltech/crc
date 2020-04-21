<?php
    include 'util.php';

    include('db_conn2.php');

    $bid = mysqli_real_escape_string($conn, $_POST['user_bid']);

    // Generate a random password

    $password = generatePassword(8);
    $message = "Hey! We saw you forgot your password. Don't worry about it!\nYour new password is: $password " . 
                "\nWhen you log in, you'll be prompted to make a new one." .
                "\nIf you feel this is a mistake, log in again with that password, and you'll be prompted to reset it.";

    $sql = "UPDATE s20_UserPass SET passcode = '$password', first_time = 0 WHERE banner_id = '$bid'";

    if ($conn->query($sql) == true && $conn->affected_rows > 0) {
        setMessage(true, "Your password has been successfully reset. Check your e-mail!");
        $sql = "SELECT * FROM s20_UserPass WHERE banner_id = '$bid'";
        $result = $conn->query($sql);
        $email = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $email = $row['email'];
            }
        }
        sendEmail($email, "Password Reset", $message);
        header("Location: ../login.php");
    } else {
        setMessage(false, "Your password couldn't be reset. Did you get your banner ID right?");
        header("Location: ../forgot.php");
    }
?>
