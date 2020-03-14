<?php
session_start();

if (!isset($_SESSION['id_key'])) {
    header("Location: ../login.php");
} else {
    include('db_conn2.php');

    $passcode = mysql_real_escape_string($_POST['password']);
    $email = $_SESSION['id_key'];
    $type = $_SESSION['user_type'];
    
    $sql = "UPDATE s20_UserPass SET passcode = '$passcode', first_time = 1 where email = '$email'";
    
    if ($conn->query($sql) == true) {
        $sql = "SELECT * FROM s20_UserPass WHERE email = '$email'";
        $result = $conn->query($sql);
        $verified = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $verified = $row['verified'];
            }
        }
        if ($type == 'student') {
            if ($verified == "0") {
                header("Location: ../student.php");
            } else {
                header("Location: ../home.php");
            }
        } elseif ($type == 'admin') {
            header("Location: ../admin.php");
        } elseif ($type == 'employer') {
            header("Location: ../supervisor.php");
        } else {
            if ($verified == "0") {
                header("Location: ../faculty.php");
            } else if ($type == "secretary") {
                header("Location: ../secretary.php");
            } else {
                header("Location: ../home.php");
            }
        }
    } else {
        echo('Error');
    }
}
