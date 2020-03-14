<?php
session_start();
include('../backend/db_conn2.php');
/* 
Before Accessing this file make sure the user_sequence table is updated to allow assigned_to values to be correctly set. If value in that table is set to 0 usr is not designated for application flow

Build MySQL query to determine which linkNames to use:
*/
	//var_dump($_SESSION);
	$seqKey = $_SESSION['dept'];
 
	$sql_userSeq = "SELECT * from s20_user_sequence where dept_code='$seqKey'";
//	echo $sql_userSeq;
	$usrFlow = $conn->query($sql_userSeq);

// These are required links
			
	$linkNames['student1'] = 'student-application1.php'; 	// Course Information
	$linkNames['student2'] = 'student-application2.php'; 	// Employer Entry Information
	$linkNames['student3'] = 'student-application3.php'; 	// Project Information
	$linkNames['instructor2'] = 'instructor-review2.php';	// Verifies and Creates Employer
	$linkNames['instructor3'] = 'instructor-review3.php';	// Learning Objectives
	$linkNames['instructor4'] = 'instructor-review4.php';	// Grading Criteria
	$linkNames['home6'] = 'home.php';						// Send to Records and Registration
		
	
	if ($usrFlow->num_rows > 0) {

		$usrFlow = $usrFlow->fetch_assoc();
/*		var_dump($usrFlow);
		$conn->close();
	}
*/
// Check if user type is deisgnated for this workflow, this will simplify the list we generate, as these pages are user type specific

		if ($usrFlow['student'] != "0") {
		
		// Student Links

			$linkNames['home1'] = 'home.php'; 						// Label in dropdown Assign to Student
			$linkNames['student4'] = 'student-application4.php';
		}
		
		if ($usrFlow['instructor'] != "0") {
		
		// Instructor Links	
			
			$linkNames['home2'] = 'home.php'; 						// Label in dropdown Assign to Instructor
			$linkNames['instructor1'] = 'instructor-review1.php'; 	// Instructor Review of Project and Course Information 
			$linkNames['instructor5'] = 'instructor-review5.php';
		
		}
		
		if ($usrFlow['employer'] != "0") {
		
		// Employer Links	
			
			$linkNames['home3'] = 'home.php'; 						// Label in dropdown Assign to Employer
			$linkNames['employer1'] = 'employer-review1.php';

		}
		if ($usrFlow['chair'] != "0") {
		
		// Department Chair Links

			$linkNames['home4'] = 'home.php';						// Label in dropdown Assign to Department Chair
			$linkNames['chair1'] = 'chair-review1.php';
		}
		if ($usrFlow['dean'] != "0") {
			
		// Dean Links

			$linkNames['home5'] = 'home.php';						// Label in dropdown Assign to Dean
			$linkNames['dean1'] = 'dean-review1.php';
		}	
		

	}

//	var_dump($linkNames);

/* If extra application pages are added add links below, commented out if not in use, do not modify the array keys as these are used to communicate with the database
			
	$linkNames['extra1'] = '';
	$linkNames['extra2'] = '';
	$linkNames['extra3'] = '';
	$linkNames['extra4'] = '';
	$linkNames['extra5'] = '';
	$linkNames['extra6'] = '';
	$linkNames['extra7'] = '';
	$linkNames['extra8'] = '';
	$linkNames['extra9'] = '';


*/
// Create array to describe links in for table generated in update-sequence.php

	$linkDesc['home1'] = 'Assign to Student';
	$linkDesc['home2'] = 'Assign to Instructor';
	$linkDesc['home3'] = 'Assign to Employer';
	$linkDesc['home4'] = 'Assign to Chair';
	$linkDesc['home5'] = 'Assign to Dean';
	$linkDesc['home6'] = 'Assign to Records & Registration';
	$linkDesc['student1'] = 'Enter Course Information';
	$linkDesc['student2'] = 'Enter Employer Information';
	$linkDesc['student3'] = 'Enter Project Information';
	$linkDesc['student4'] = 'Student Entry Summary';
	$linkDesc['instructor1'] = 'Review Course & Project Entries';
	$linkDesc['instructor2'] = 'Validate & Create Employer';
	$linkDesc['instructor3'] = 'Enter Learning Objectives';
	$linkDesc['instructor4'] = 'Enter Grading Criteria';
	$linkDesc['instructor5'] = 'Instructor Entry Review';
	$linkDesc['employer1'] = 'Review Course & Learning Objective Entries';
	$linkDesc['chair1'] = 'Chair Review of All Application Entries';
	$linkDesc['dean1'] = 'Dean Review of All Application Entries';
	
/* This is where the extra(1-9) entries go, commented out when not in use

	$linkDesc['extra1'] = '[Insert Page Description Here]';
	$linkDesc['extra2'] = '[Insert Page Description Here]';
	$linkDesc['extra3'] = '[Insert Page Description Here]';
	$linkDesc['extra4'] = '[Insert Page Description Here]';
	$linkDesc['extra5'] = '[Insert Page Description Here]';
	$linkDesc['extra6'] = '[Insert Page Description Here]';
	$linkDesc['extra7'] = '[Insert Page Description Here]';
	$linkDesc['extra8'] = '[Insert Page Description Here]';
	$linkDesc['extra9'] = '[Insert Page Description Here]';

*/
		
/*
	Create a dropdown list for the above array items using the index name as the form element name, set the value equal to its sequenced position, do not allow repeated values
*/	
?>	