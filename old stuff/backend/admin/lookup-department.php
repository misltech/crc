<?php 

$json_input = file_get_contents('php://input');

$php_input_obj = json_decode($json_input);

include ('../db_conn2.php');

$e = mysqli_real_escape_string($conn, $php_input_obj->dept);

$sql = "SELECT * FROM s20_academic_dept_info WHERE name = '$e'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $result = $result->fetch_assoc();
    echo "{\"dept\": ";
    echo json_encode($result);

    $dept_code = $result['dept_code'];
    $sql = "SELECT * FROM s20_edit_permissions WHERE dept_code = '$dept_code'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        echo ", \"edit_permssions\":";
        echo json_encode($result);
    }

    $sql = "SELECT * FROM s20_email_permissions WHERE dept_code = '$dept_code'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $result = $result->fetch_assoc();
        echo ", \"email_permssions\":";
        echo json_encode($result);
    }

    echo "}";
} else {
    echo "{}";
}
?>