<?php 
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include('skeleton.head.php'); 
include_once('backend/util.php');

checkUserType('secretary');

if(!isset($_SESSION['search_results'])){
?>

    <h2>Fieldwork Application</h2>

    <form action="backend/search-user.php" id="searchForm" method="post">
        <label>
            <p>Look up a Student ID:</p>
            <input type="text" name="search_id" placeholder="Enter Student ID">
        </label>
        <p><input type="submit" value="Submit"></p>
    </form>

<?php 
} else {

    // check if user data exists

//     if($_SESSION['search_results'] != "False"){
//         $student_email = $_SESSION['search_results']['email'];
//         unset($_SESSION['search_results']);

// //        var_dump($_SESSION);

//         // create new fieldwork application

//         echo "<h2>Start a New Application</h2>";
        
//         echo "<form method='post' action='backend/create-application.php'>";
//             echo "<input type='hidden' name='email' value='$student_email'>";
//             echo "<div>";
//             echo "<p>Select Department: </p>";
//             echo "<select name='dept' onchange='findInstructors(this.value)'>";
//                 echo "<option value=''>Select a Department</option>"; 
//                     include("backend/loadDepartments.php");
//                 echo "</select>";
//             echo "</div>";
//             echo "<div id='instructors'></div>";
//             echo "<input type='submit' value='Submit'>";
//         echo "</form>";

//     }
//     else{

    if($_SESSION['search_results'] != "False"){
        $student_email = $_SESSION['search_results']['email'];
        unset($_SESSION['search_results']);
    }
    else {
        $student_ID = $_SESSION['user_bannerID'];
        unset($_SESSION['search_results']);
        unset($_SESSION['user_bannerID']);
        echo "<h2>Create New User</h2>";

        echo "<form method='post' action='backend/create-user.php'>";
            echo "<br><input type='hidden' name='user_id' value='$student_ID'>";
            echo "<input type='hidden' name='user_type' value='student'>";
            echo "<input type='text' name='user_email' placeholder='Enter an Email Address'>";
            echo "<input type='submit' name='secretary form' value='Submit'>";
        echo "</form>";
    }
    
    //load application
    echo "<div id='app_info'></div>";
        
}

    
// }
include('skeleton.foot.php'); 

?>

<script>
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            document.getElementById("app_info").innerHTML = this.responseText;    
		}
	};
	xhttp.open("GET", "backend/load-new-application.php", true);
    xhttp.send();

    function hide(elementID){
        document.getElementById(elementID).style.display = 'none';
    }
</script>