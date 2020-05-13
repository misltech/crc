<?php 

/**
 * This page sets department workflow from the ajax call from admin.js. It has to be serialized and because its being sent from the front end we
 * added Cross Site Request Forgery token to prevent unauthorized users from sending request to this api.
 * 
 */



include_once '../backend/db_con3.php';
if (!isset($_SESSION)) {
    session_start();
  }

if (!isset($_SESSION['token'])) {  
    exit();
}

header('Content-Type: application/json');

$headers = apache_request_headers();
if (isset($headers['token'])) {
    if ($headers['token'] !== $_SESSION['token']) {
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
    if(!(isset($_SESSION['user_email']))){
        exit(json_encode(['error' => 'No login found']));
    }
    if(isset($headers['setWorkflow']) and isset($headers['department'])){
        $dept = mysqli_escape_string($db_conn, $headers['department']);
        $workflow = filter_var($headers['setWorkflow'], FILTER_SANITIZE_STRING);
        $workflow = serialize(explode(",", $workflow));
        $sql = "UPDATE s20_workflow_order SET workflow='$workflow' WHERE dept_code = '$dept'";
        $query = mysqli_query($db_conn, $sql);
        if($query){
            exit(json_encode(['status' => 'success']));
        }
    }

}





        ?>