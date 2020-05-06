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