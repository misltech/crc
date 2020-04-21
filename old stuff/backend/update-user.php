<?php
   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include (db_conn2.php);

$conn->close();

?>