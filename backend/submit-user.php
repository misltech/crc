<?php
include('../skeleton.head.php');

/*
$user_id = $_POST['user_id'];
$workflow = $_POST['workflow'];
$email = $_POST['email'];
$password = $_POST['password'];
$banner_id = $_POST['banner_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$access_lvl =  = $_POST['access_level'];
*/
$user_id = 'N00000000';
$workflow = 1;
$email = 'test@test.com';
$password = 'test';
$banner_id = '000000000';
$first_name = 'Test';
$last_name = 'McTest';
$access_lvl = 9;

require('db_conn.php');

// insert user information into user table
$stmt = $mysqli->prepare("INSERT INTO user (user_id, workflow, email, password, banner_id, first_name, last_name, access_level)
						 VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sisssssi", $user_id, $workflow, $email, $password, $banner_id, $first_name, $last_name, $access_lvl);


if (!$stmt->execute()) {
	echo "There was an issue creating this user.";
}
else {
	echo "User successfully created.";
}

$stmt->close();

$mysqli->close();

include('../skeleton.foot.php');
?>