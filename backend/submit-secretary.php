<?php
include('../skeleton.head.php');

session_start();

// initializing variables
$studentId = "";
$studentEmail    = "";
$professorEmail = "";
$supervisorName   = "";
$supervisorEmail    = "";
$chairEmail    = "";
$deanEmail    = "";
$errors = array();

// connect to the database
require('db_conn.php');

if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $studentId= mysql_real_escape_string($_POST['studentID']);
    $studentEmail = mysql_real_escape_string($_POST['studentEmail']);
    $studentPassword = mysql_real_escape_string($_POST['studentPassword']);
    $professorEmail = mysql_real_escape_string($_POST['professorEmail']);
    $supervisorName = mysql_real_escape_string($_POST['supervisorName']);
    $supervisorEmail = mysql_real_escape_string($_POST['supervisorEmail']);
    $chairEmail = mysql_real_escape_string($_POST['chairEmail']);
    $deanEmail = mysql_real_escape_string($_POST['deanEmail']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($studentId)) {
        array_push($errors, "Student Id is required");
    }
    if (empty($studentEmail)) {
        array_push($errors, "Student email is required");
    }
    if (empty($studentPassword)) {
        array_push($errors, "Student Password is required");
    }
    if (empty($professorEmail)) {
        array_push($errors, "Professor email is required");
    }
    if (empty($supervisorName)) {
        array_push($errors, "Supervisor name is required");
    }
    if (empty($supervisorEmail)) {
        array_push($errors, "Supervisor email is required");
    }
    if (empty($chairEmail)) {
        array_push($errors, "Chair email is required");
    }
    if (empty($deanEmail)) {
        array_push($errors, "Dean email is required");
    }

  
    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    if ($stmt = $mysqli->prepare("SELECT * FROM UserPass WHERE ID='$studentId' OR email='$studentEmail' LIMIT 1")) {
        $stmt->execute();
    
        $stmt->bind_result($studentId, $studentPassword, $studentEmail);
        if ($stmt->fetch()) {
            if (($studentId == $studentId)) {
                array_push($errors, "Student Id already exists");
            }
            if (($email == $userEmail)) {
                array_push($errors, "Student email already exists");
            }
            $stmt->close();
        }
    }

    // Finally, register user if there are no errors in the form
    $to      = $studentEmail;
    $subject = 'Registration';
    $message = 'Your registration is complete. Thank you for registering. Your password is ' .$studentPassword;
    $headers = 'From: CRC WorkFlow Project' . "\r\n" .
    'Reply-To: https://cs.newpaltz.edu/p/f18-02/v1/' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if (count($errors) == 0) {
        mysqli_query($mysqli, "INSERT INTO FieldworkWHO19 (StudentEmail, ProfEmail, ChairEmail, DeanEmail, 
	SupervisorEmail, SupervisorName)
	VALUES('$studentEmail', '$professorEmail', '$chairEmail', '$deanEmail', '$supervisorEmail', '$supervisorName')");
        mysqli_query($mysqli, "INSERT INTO UserPass (ID, passcode, email) 
	VALUES('$studentId', '$studentPassword', '$studentEmail')");
        mysqli_close($mysqli);
        mail($to, $subject, $message, $headers);
        $_SESSION['studentId'] = $studentId;
        $_SESSION['success'] = "Account Created successfully";
        header('location: index-p8-secretary.htm');
    }
}

include('../skeleton.foot.php');
