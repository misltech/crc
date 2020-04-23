<?php 

include_once '../backend/db_con3.php';
if (!isset($_SESSION)) {
    session_start();
  }

if (isset($_SESSION['csrf_token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

header('Content-Type: application/json');

$headers = apache_request_headers();
if (true  or isset($headers['token'])) {
    if (false and $headers['token'] !== $_SESSION['csrf_token']) {
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
    if(!(isset($_SESSION['user_email']))){
        exit(json_encode(['error' => 'No login found']));
    }
    if(isset($headers['request'])){
        $req = $headers['request'];
        $email = $_SESSION['user_email'];
        //$email = 'student@email.com';
        if($req == "all"){
            
            $sql = "SELECT s20_application_info.dept_code,`semester`,`year`,`class_number`,`progress`,`comments`,`rejected`,s20_application_info.fw_id, workflow
            FROM s20_application_info LEFT JOIN s20_application_util ON s20_application_info.fw_id = s20_application_util.fw_id LEFT JOIN s20_workflow_order ON s20_application_info.dept_code = s20_workflow_order.dept_code
            WHERE student_email = '$email'";
            
            $query = mysqli_query($db_conn, $sql);
            $count = mysqli_num_rows($query);

            if($count == 0){
                $res = (object)[404 => 'No applications found'];
                exit(json_encode(''));
            }
            else{
                $main_arr = [];

                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $sub_arr = [];
                    $order = unserialize($row['workflow']);
                    array_push($sub_arr, $order);
                    array_push($sub_arr, ['fwid' => $row['fw_id'], 'dept' => $row['dept_code'], 'classnumber' => $row['class_number'], 'progress' => $row['progress'] ,'semester' => $row['semester'], 'year' => $row['year'], 'rejected' => $row['rejected'], 'comments' => $row['comments']]);
                    //validate inputs here
                    array_push($main_arr, $sub_arr);
                }
            }
            exit(json_encode($main_arr));
        }
    }
} 
else {
    exit(json_encode(['error' => 'No CSRF token.']));
}


function getworkflow_order($email, $dbconn){
    //from s20_workflow_order

}

function getProgress(){
    //from s20_application_util
}

function getApplications($email, $dbconn){
    //from s20_application_info
}

function getRejects($email, $dbconn){
    //from s20_application_util
}

function checkRejects(){
     //from s20_application_util
}


//get student functions
//checks request againt session[email address]

// stages of student: employer deets, learning objective deets, semester deets, reviewapp deets.
/**
 * functions
 */

 //get user application details(employer)(objective)(semester)
//get learning objectives
//get user sequence


// on first submit of application. go through entire application process
//When rejection from next user stage
//show rejection on progress bar aswell

//student will be able to review their entire application. With rejection notice. 




?>