<?php

// Resume Existing session

	session_start();
	
// Connect to Database

	include('db_conn2.php');
//	include('util.php')
	
// Assign local variables from session

		$pageKey = $_SESSION['page_key'];
		$dept = $_SESSION['dept'];
		$formKey = $_SESSION['fw_id'];
		
		if ($pageKey == 'home1') {
			$type = 'student';
		}
		else if ($pageKey == 'home2') {
			$type = 'instructor';
		}
		else if ($pageKey == 'home3') {
			$type = 'employer';
		}
		else if ($pageKey == 'home4') {
			$type = 'chair';
		}
		else if ($pageKey == 'home5') {
			$type = 'dean';
		}
		else {
			$type = 'recreg';
		}
		
// Based on type get assinged-to user's email from system

		if ($type == 'student' || $type == 'instructor' || $type == 'employer') {
			$sql_getNext = "SELECT student_email, instructor_email, employer_email from s20_application_info where fw_id='$formKey'";
		}
		if ($type == 'chair' || $type == 'dean') {
			$sql_getNext = "SELECT chair_email, dean_email from s20_academic_dept_info where dept_code='$dept'";
		}
		
// Query DB and get next

		echo $type;

		if ($type == 'recreg') {

			$sql_assignNext = "UPDATE s20_application_info SET assigned_to='$type' WHERE fw_id='$formKey'";
			if($conn->query($sql_assignNext) == True) {
				header("Location: ../home.php");
			}

		}

		$nextEmail = $conn->query($sql_getNext);
		$emailKey = $type."_email";
		
		if ($nextEmail->num_rows > 0){

			$nextEmail = $nextEmail->fetch_assoc();
			$assign_next = $nextEmail[$emailKey];

			echo $assign_next;

// Build update query to assign to next user
			
			$sql_assignNext = "UPDATE s20_application_info SET assigned_to='$assign_next', assigned_when=NOW() WHERE fw_id='$formKey'";

			if ($conn->query($sql_assignNext) == True){

// Clear reject message

				$sql_clearRejectStatus = "UPDATE s20_application_util SET comments='', rejected='0' where fw_id='$formKey'";
				
				if ($conn->query($sql_clearRejectStatus) == True){
					$conn->close();

					unset($_SESSION['emp_email']);
					unset($_SESSION['student_email']);
					unset($_SESSION['dept']);
					unset($_SESSION['instructor_email']);
					unset($_SESSION['fw_id']);

					header("Location: ../home.php");
				}
			}

		}
		
?>