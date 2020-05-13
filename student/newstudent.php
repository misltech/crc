<?php
/* 
This page will be emailed to a student with a link that they will 
click on and it will auto sign in and prompt them to change password immediately.
 */

include_once '../backend/db_con3.php';

if(isset($_GET['token']) && $_GET['token'] != null){

    $token = mysqli_real_escape_string($db_conn, $_GET['token']);

    $findsql = "SELECT * FROM s20_user_validation WHERE token='$token'";
    $findquery = mysqli_query($db_conn, $findsql);

    if($findquery && mysqli_num_rows($findquery) == 1){
        $findresult = mysqli_fetch_assoc($findquery);
        $email = $findresult['email'];
        $getuser = "SELECT * FROM s20_UserPass WHERE email = '$email'";
        $getuserquery = mysqli_query($db_conn, $getuser);
        $getuserresult = mysqli_fetch_assoc($getuserquery);
        
        if($getuserresult){

        session_unset();
        session_destroy();
        session_start();     
        $_SESSION['user_type'] = $getuserresult["profile_type"];
        $_SESSION['user_email'] = $getuserresult['email'];
        $_SESSION['timestamp'] = time();
        $_SESSION['token'] = bin2hex(random_bytes(32));

        $deletetoken = "DELETE FROM s20_user_validation WHERE token='$token'";
        $deletequery = mysqli_query($db_conn,$deletetoken);
        if($deletequery){
            header('Location: ./myaccount.php');
        }
    }     
    }
    else {
        $htmlele = "<html><head></head><body>";
        $htmlele = "<h5>Error 406</h5>";
        $htmlele .= "<p>Token already used. Contact the secretary.</p>";
        echo $htmlele;
    }

}
else{
    $htmlele = "<html><head></head><body>";
    $htmlele = "<h5>Error 406</h5>";
    $htmlele .= "<p>Something went wrong. Contact the secretary.</p>";
    echo $htmlele;
}
?>