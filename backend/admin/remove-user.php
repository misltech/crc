<?php
session_start();

include '../util.php';

if ($_SESSION['user_type'] !== 'admin') {
    unset($_SESSION['remove_user']); // just in case
    setMessage(false, "You must be logged in as an administrator to perform this action.");
    header('Location: ../../home.php');
} else if (isset($_SESSION['remove_user'])){
    $user_data = $_SESSION['remove_user'];
    unset($_SESSION['remove_user']);

    include('../db_conn2.php');

    // Check profile_type to remove profile information before deleting user

    if ($user_data['user_type'] == 'student'){
        $table = "s20_student_info";
    }

    else if ($user_data['user_type'] == 'employer'){
        $table = "s20_employer_info";
    }

    else{
        $table = "s20_faculty_info";
    }

    // Build MySQL query to remove user profile information

    $email = $user_data['email'];
    $sql_profileRemoval = "DELETE from $table where email = '$email'";

    if($conn->query($sql_profileRemoval) == False){
        $message = 'and no profile exists.';
    }
    else{
        $message = 'and their profile has been removed.';
    }

    // Remove user from system
    
    $sql_removeUser = "DELETE from s20_UserPass where email = '$email'";
    
    if($conn->query($sql_removeUser) == True){
        setMessage(true, "'$email' has been removed from the system, $message");
        $conn->close();
        header("Location: ../../admin.php");
    }
    else{
        setMessage(false, "Error removing user '$email'");
        $conn->close();
        header("Location: ../../admin.php");
    }
    

    //var_dump($user_data);
}

?>