<?php 

$json_input = file_get_contents('php://input');

$php_input_obj = json_decode($json_input);

include ('../db_conn2.php');

$a = mysqli_real_escape_string($conn, $php_input_obj->appl);

$sql = "SELECT * FROM s20_application_info WHERE fw_id = '$a'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $result = $result->fetch_assoc();
    echo "{\"appl\": ";
    echo json_encode($result);
    
    $student_email = $result["student_email"];
    $sql_student = "SELECT student_first_name, student_last_name, banner_id FROM s20_student_info WHERE student_email='$student_email'";
    $result = $conn->query($sql_student);

    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        echo ", \"student_info\":";
        echo json_encode($result);
    }

    echo "}";
} else {
    echo "{}";
}
?>