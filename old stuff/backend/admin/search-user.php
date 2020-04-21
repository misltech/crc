<?php
/*
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
include '../util.php';
unset($_SESSION['search_results']);

if ($_SESSION['user_type'] !== 'admin') {
    setMessage(false, "You must be logged in as an administrator to perform this action.");
    header("Location: ../../home.php");
}
else { 

    include ('../db_conn2.php');

    if($_POST['submit_type'] == 'Submit'){

        $search_id = mysql_real_escape_string($_POST['search_id']);
    }
    else{

        $search_id = '';

    }
    $sql = "SELECT * from UserPass where profile_id = '$search_id'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['search_results'] = $result->fetch_assoc();
        setMessage(true, "Found user!");
        header("Location: ../../admin.php");
    }
    else{
        if($_POST['submit_type'] != 'Clear'){
            setMessage(false, "Unable to locate this user.");
        }
        header("Location: ../../admin.php");
    }

}

Yes, it really is this little code. Don't blame me, blame JSON
*/

$json_input = file_get_contents('php://input');
$php_input_obj = json_decode($json_input);

include ('../db_conn2.php');

$email = $php_input_obj->email;
$email = mysqli_real_escape_string($conn, $email);

$sql = "SELECT * FROM s20_UserPass WHERE email = '$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo null;
}

?>