<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

// initializing variables
$banner_id = "";
$email    = "";
$errors = array(); 

// connect to the database
require('db_conn.php');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $banner_id= mysql_real_escape_string($_POST['banner_id']);
  $email = mysql_real_escape_string($_POST['email']);
  $password_1 = mysql_real_escape_string($_POST['password_1']);
  $password_2 = mysql_real_escape_string($_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($banner_id)) { array_push($errors, "Student Id is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  if ($stmt = $mysqli->prepare("SELECT * FROM s20_UserPass WHERE ID='$banner_id' OR email='$email' LIMIT 1")) {
    $stmt->execute();
    
    $stmt->bind_result($banner_id,$userPass,$userEmail);
    if($stmt->fetch()){
      if (($banner_id == $banner_id)){
	 array_push($errors, "Student Id already exists");
	}
      if (($email == $userEmail)){
 	array_push($errors, "email already exists");
     }
	$stmt->close();
    }

  }

  // Finally, register user if there are no errors in the form
$to      = $email;
$subject = 'Registration';
$message = 'Your registration is complete. Thank you for registering.';
$headers = 'From: CRC WorkFlow Project' . "\r\n" .
    'Reply-To: https://cs.newpaltz.edu/p/f18-02/f19-v1/' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  if (count($errors) == 0) {
	mysqli_query($mysqli,"INSERT INTO s20_UserPass (ID, passcode, email) VALUES('$banner_id', '$password_1', '$email')");
	mysqli_close($mysqli);
	mail($to, $subject, $message, $headers);
	$_SESSION['banner_id'] = $banner_id;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index-p8-secretary.htm');
  }
}
?>