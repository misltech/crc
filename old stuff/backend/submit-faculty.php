<?php

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

unset($_SESSION['dept_1']);
unset($_SESSION['dept_2']);
unset($_SESSION['dept_3']);
unset($_SESSION['dept_4']);

if (!isset($_SESSION['id_key'])) {
    header("Location: ../login.php");
}
else {
    include('db_conn2.php');

// Declare variables to submit to faculty_info table

    $faculty_fname = $faculty_lname = $faculty_middle = $phone_num = $officeHours = '';
    $dept1 = $dept2 = $dept3 = $dept4 = '';

    $faculty_fname = mysql_real_escape_string($_POST['firstname']);
    $faculty_lname = mysql_real_escape_string($_POST['lastname']);
    $faculty_middle = mysql_real_escape_string($_POST['minitial']);
    $phone_num = mysql_real_escape_string($_POST['telnum']);
    $officeHours = mysql_real_escape_string($_POST['officeHours']);
    $dept1 = mysql_real_escape_string($_POST['PrimaryDept']);
    $dept2 = mysql_real_escape_string($_POST['SecondaryDept']);
    $dept3 = mysql_real_escape_string($_POST['TertiaryDept']);
    $dept4 = mysql_real_escape_string($_POST['QuaternaryDept']);

    if ($_POST['query_type'] == 'update'){
        
        $user_email = $_SESSION['id_key'];

        $sql = "UPDATE s20_faculty_info SET f_name = '$faculty_fname', l_name = '$faculty_lname', m_initial = '$faculty_middle', 
                phone_number = '$phone_num', office_hours = '$officeHours', dept_1 = '$dept1' WHERE email = '$user_email'";
        
        if($conn->query($sql) == true){
            $conn->close();
            header("Location: ../home.php");
        }
        else{
            setMessage(false, "Error Updating Profile");
            header("Location: ../faculty.php");
        }

    }
    else if($_POST['query_type'] == 'insert'){

        $user_id = $_SESSION['user_id'];
        $user_email = $_SESSION['id_key'];
        $type = $_SESSION['user_type'];

        // Build MySQL query to generate faculty profile

        $sql = "INSERT into s20_faculty_info (banner_id, f_name, l_name, m_initial, phone_number, office_hours,
                dept_1, dept_2, dept_3, dept_4, email, profile_type) 
                values ('$user_id', '$faculty_fname', '$faculty_lname', '$faculty_middle', '$phone_num',
                '$officeHours', '$dept1', '$dept2', '$dept3', '$dept4', '$user_email', '$type')";

        // Build update query for UserPass table to redirect differently from submit-login.php

        $sql_userUpdate = "UPDATE s20_UserPass SET verified = 1 WHERE email = '$user_email'";

        //echo $sql_userUpdate;

        if ($conn->query($sql) == true){
            if ($conn->query($sql_userUpdate) == true){
                $conn->close();
                header("Location: ../home.php");
            }
            else{
                echo "User Update Failed";
            }
         }
        // else{
        //     // echo "Profile creation Failed";
        //     $conn->close();
        //         header("Location: ../secretary.php");
        // }
    }
    else{
        echo "No such query can be made. at backend/submit-faculty.php";
    }
}
?>
