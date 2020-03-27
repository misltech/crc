<?php 

if (!isset($_SESSION)) {
    session_start();
  }

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

header('Content-Type: application/json');

$headers = apache_request_headers();
if (isset($headers['CsrfToken'])) {
    if ($headers['CsrfToken'] !== $_SESSION['csrf_token']) {
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
    else if(isset($headers['workflow'])){
        
    }
} 
else {
    exit(json_encode(['error' => 'No CSRF token.']));
}



//get 








?>

