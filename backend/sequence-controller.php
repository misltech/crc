<?php

// resume existing session

	session_start();
	
// Assign variables from session

if (isset($_GET['id'])) {
	$_SESSION['fw_id'] = $_GET['id'];
}
if (isset($_GET['dept'])) {
	$_SESSION['dept'] = $_GET['dept'];
}

	$page_key = $_SESSION['page_key'];
	$deptKey = $_SESSION['dept'];
				
// connect to database

	include_once('db_conn2.php');

// Get Array of links from linkArray, needs to be after the db connection

	include_once('../components/linkArray.php');
	
// Build MySQL query and determine next redirect page

		$sql = "SELECT * from s20_progress_tracker where dept_code='$deptKey'";

//		echo $sql;
		
		$currentProgress = $conn->query($sql);
		
		if ($currentProgress->num_rows > 0) {
			
			$currentProgress = $currentProgress->fetch_assoc();

// Acquire current sequence count, convert string to int and increment by one
			//var_dump($currentProgress);

			$pageCount = intval($currentProgress[$page_key]);
			$pageCount++;
			$pageCount = strval($pageCount);

//			echo $pageCount;

			$home1 = $currentProgress['home1'];
			$student1 = $currentProgress['student1'];
			$student2 = $currentProgress['student2'];
			$student3 = $currentProgress['student3'];
			$student4 = $currentProgress['student4'];
			$home2 = $currentProgress['home2'];
			$instructor1 = $currentProgress['instructor1'];
			$instructor2 = $currentProgress['instructor2'];
			$instructor3 = $currentProgress['instructor3'];
			$instructor4 = $currentProgress['instructor4'];
			$instructor5 = $currentProgress['instructor5'];
			$home3 = $currentProgress['home3'];
			$employer1 = $currentProgress['employer1'];
			$home4 = $currentProgress['home4'];
			$chair1 = $currentProgress['chair1'];
			$home5 = $currentProgress['home5'];
			$dean1 = $currentProgress['dean1'];
			$home6 = $currentProgress['home6'];

/* Optional for extra pages, commented out when not in use

			$extra1 = $currentProgress['extra1'];
			$extra2 = $currentProgress['extra2'];
			$extra3 = $currentProgress['extra3'];
			$extra4 = $currentProgress['extra4'];
			$extra5 = $currentProgress['extra5'];
			$extra6 = $currentProgress['extra6'];
			$extra7 = $currentProgress['extra7'];
			$extra8 = $currentProgress['extra8'];
			$extra9 = $currentProgress['extra9'];
*/
// build array to determine next link
			$order[$home1] = "home1";
			$order[$student1] = "student1";
			$order[$student2] = "student2";
			$order[$student3] = "student3";
			$order[$student4] = "student4";
			$order[$home2] = "home2";
			$order[$instructor1] = "instructor1";
			$order[$instructor2] = "instructor2";
			$order[$instructor3] = "instructor3";
			$order[$instructor4] = "instructor4";
			$order[$instructor5] = "instructor5";
			$order[$home3] = "home3";
			$order[$employer1] = "employer1";
			$order[$home4] = "home4";
			$order[$chair1] = "chair1";
			$order[$home5] = "home5";
			$order[$dean1] = "dean1";
			$order[$home6] = "home6";			

/*
			$order[$extra1] = "extra1";
			$order[$extra2] = "extra2";
			$order[$extra3] = "extra3";
			$order[$extra4] = "extra4";
			$order[$extra5] = "extra5";
			$order[$extra6] = "extra6";
			$order[$extra7] = "extra7";
			$order[$extra8] = "extra8";
			$order[$extra9] = "extra9";
*/

			// $sequenceKey = "app_".$pageCount;
		
// Build another query to determine page_key for next page in sequence
/*
			$sql_getNext = "SELECT $sequenceKey from application_sequence where dept_code='$deptKey'";
			
			echo $sql_getNext;

			$nextPage = $conn->query($sql_getNext);
			
			if ($nextPage->num_rows > 0) {
				
				$nextPage = $nextPage->fetch_assoc();
*/				
// Determine page key for next page in sequence
				
			//	$getNextPage = $nextPage[$sequenceKey];	
			//	$nextLink = $linkNames[$getNextPage];

			$getNextPage = $order[$pageCount];
			$nextLink = $linkNames[$getNextPage];
				echo $nextLink;
// Close DB connection
	
				$conn->close();

			}
		
				
// If nextLink is to a home page redirect to assign-next.php to switch application assignment, else redirect to next page 							
			if ($nextLink == 'home.php') {
				$_SESSION['page_key'] = $getNextPage;
				header("Location: assign-next.php");
			}
			else {
				$_SESSION['page_key'] = $getNextPage;
				header("Location: ../".$nextLink);
			}
				
//		}


?>