<?php
session_start();

/*
 Check if request is to update user info, if true assign $_POST variables into session
and redirect to update-user page to correctly handle task
*/

if($_POST["submit_type"] == "Update User"){
    $_SESSION['update_user'] = $_POST;
    header("Location: update-user.php");
}
else if($_POST["submit_type"] == "Remove User"){
    $_SESSION['remove_user'] = $_POST;
    header("Location: admin/remove-user.php");
}
else{

    include('db_conn2.php');

    $email = mysqli_real_escape_string($conn, $_POST['email']);

// Check user type to query correct table

    if($_POST['user_type'] == 'student'){

        $sql = "SELECT * from s20_student_info where student_email = '$email'";

    }
    else if ($_POST['user_type'] == 'employer'){

        $sql = "SELECT * from s20_employer_info where employer_email = '$email'";

    }
    else{

        $sql = "SELECT * from s20_faculty_info where email = '$email'";

    }
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        echo json_encode($result->fetch_assoc());
        $conn->close();
    }
    else{
        echo null;
        $conn->close();

    }

    //header("Location: ../admin.php");
}


//echo $_POST["submit_type"];

?>