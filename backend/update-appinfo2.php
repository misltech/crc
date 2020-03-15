<?php
    include_once('util.php');
    include_once('db_conn2.php');

       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
    $emp_email = mysqli_escape_string($conn, $_POST["email"]);
    $b_name    = mysqli_escape_string($conn, $_POST["b_name"]);
    $phone     = mysqli_escape_string($conn, $_POST["p_num"]);
    $f_name    = mysqli_escape_string($conn, $_POST["first_name"]);
    $l_name    = mysqli_escape_string($conn, $_POST["last_name"]);
    $addr      = mysqli_escape_string($conn, $_POST["address"]);
    $city      = mysqli_escape_string($conn, $_POST["city"]);
    $state     = mysqli_escape_string($conn, $_POST["state"]);
    $zip       = mysqli_escape_string($conn, $_POST["zip"]);
    $id = $_SESSION["fw_id"];

    // let's see if they exist!
    $sql = "SELECT email FROM s20_UserPass WHERE email = '$emp_email'";

    $result = $conn->query($sql);

    $success = 1;

    if ($result->num_rows > 0) {
        // they exist; pop the application over to them

        $sql = "UPDATE s20_application_info SET employer_email = '$emp_email' WHERE fw_id = '$id'";

        $result = $conn->query($sql);

        if ($conn->affected_rows > 0) {
            // update happened

            // are they in employer_info?
            $sql = "SELECT * FROM s20_employer_info WHERE employer_email = '$emp_email'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // we don't /really/ care.
                // we can just update employer info like this:

                $sql = "UPDATE s20_employer_info SET business_name = '$b_name',
                phone_number = '$phone', first_name = '$f_name', last_name = '$l_name', street_address = '$addr',
                city = '$city', state = '$state', zipcode = '$zip' WHERE employer_email = '$email'";
                
                $conn->query($sql);

                if ($conn->affected_rows > 0) {
                    setMessage(true, "Employer info updated.");
                } else {
                    setMessage(false, "Employer info did not update.");
                }
            } else {
               
                // employer isn't in employer_info
                $sql = "INSERT INTO s20_employer_info (business_name, phone_number, first_name,
                last_name, street_address, city, state, zipcode, employer_email) VALUES ('$b_name',
                '$phone', '$f_name', '$l_name', '$addr', '$city', '$state', '$zip',
                '$emp_email')";

                if ($conn->query($sql) === false) {
                    setMessage(false, "Employer info could not be added.");
                    header("Location: ../student-application2.php");
                    echo $emp_email;
                    $success = 0;
                } else {
                    setMessage(true, "Employer info added.");
                }
            }
        } else {
            // they probably exist already and this is an update

            $sql = "UPDATE s20_employer_info SET business_name = '$b_name',
                phone_number = '$phone', first_name = '$f_name', last_name = '$l_name', street_address = '$addr',
                city = '$city', state = '$state', zipcode = '$zip' WHERE employer_email = '$emp_email'";
                
            $conn->query($sql);

            if ($conn->affected_rows > 0) {
                setMessage(true, "Employer info updated.");
            } else {
                setMessage(false, "Employer info was on application already, and did not update.");
            }
        }
    } else {
        // yes, I'm really doing 2 queries to add information here.

        $sql = "INSERT INTO s20_employer_info (business_name, phone_number, first_name,
            last_name, street_address, city, state, zipcode, employer_email) VALUES ('$b_name',
            '$phone', '$f_name', '$l_name', '$addr', '$city', '$state', '$zip',
            '$emp_email');
        
        UPDATE s20_application_info SET employer_email = '$emp_email' WHERE fw_id = '$id';";

        $result = $conn->multi_query($sql);

        if ($result !== false) {
            setMessage(true, "Employer added in the system.");
        } else {
            setMessage(false, "Failed to add employer in the system.");
            header("Location: ../student-application2.php");
            $success = 0;
        }
    }

    if ($success == 1) {
        if (isset($_SESSION['edit_return'])) {
            $redirect = $_SESSION['edit_return'];
            header("Location: ../".$redirect."");
        }
        else{
            header("Location: sequence-controller.php");
        }
    }
