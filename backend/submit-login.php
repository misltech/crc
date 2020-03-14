<?php
session_start();

//echo $_SESSION['test'];

include_once 'db_conn2.php';
include_once 'util.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

//$email = $_POST['email'];
//$password = $_POST['password'];

//echo "<div id='$email' class='$password'></div>";


$sql = "SELECT * FROM s20_UserPass WHERE email = '$email'";
$result = $conn->query($sql);

$userPass = "";

if ($result->num_rows > 0) {
    $result = $result->fetch_assoc();
    $userPass = $result["passcode"];
    
    if (!($userPass == $password)) {
        unload();
        setMessage(false, "Incorrect username or password");
        header("Location: ../login.php");
    } else {
        $_SESSION['id_key'] = $email;
        // Add login timestamp to UserPass table

        $_SESSION['user_type'] = $result["profile_type"];
        $_SESSION['user_id'] = $result["banner_id"];
        $first_time = $result["first_time"];
        $verified = $result["verified"];
        $type = $result['profile_type'];
        //setMessage(true, "Logged in successfully. Welcome back, " . $email . "!");

        //$sql_update = "UPDATE UserPass SET last_access = NOW() WHERE email = '$email'";

        if (/*$conn->query($sql_update)*/ true === true) {

            if (true) {

                // Filter USER to appropriate page based on profile type and if personal info has been entered.

                if ($type == 'admin') {
                    header("Location: ../admin.php");
                    exit();
                }
                else if ($type == 'student') {
                    //header("Location: ../student.php");
                    //exit();
                    if ($verified == 0) {
                        header("Location: ../student.php");
                        exit();
                    } else {
                        header("Location: ../home.php");
                        exit();
                    }
                    
                }
                else if ($type == "secretary" || $type == "chair" || $type == "dean" || $type == "instructor") {
                    if ($verified == 0) {
                        header("Location: ../faculty.php");
                        exit();
                    } else if ($type == "secretary") {
                        header("Location: ../secretary.php");
                        exit();
                    } else {
                        header("Location: ../home.php");
                        exit();
                    }
                }
                else if ($type == "employer") {
                    header("Location: ../home.php");
                    exit();
                }
            } else {
                // yeet them to the password reset screen
                header("Location: ../new_password.php");
                exit();
            }
        } else {
            unload();
            setMessage(false, "Failed logging you in.");
            header("Location: ../login.php");
            exit();
        }
    }
} else {
    unload();
    setMessage(false, "Incorrect username or password.");
    header("Location: ../login.php");
    exit();
}

// function to unset session variables if incorrect password
function unload() {
    unset($_SESSION["id_key"]);
    unset($_SESSION["user_type"]);
    unset($_SESSION["user_id"]);
}