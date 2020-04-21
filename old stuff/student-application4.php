<?php 

// Resume Existing session

       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    include('skeleton.head.php');

    $_SESSION['page_key'] = "student4";

//    checkUserType("student");
/*
    if (!isset($_SESSION['fw_id'])) {
        setMessage(false, "You do not have access to this form.");
        header("Location: home.php");
    }
*/
    $searchKey = $_SESSION['fw_id'];

    $sql = "SELECT * FROM s20_application_info WHERE fw_id = '$searchKey'";

    include('backend/db_conn2.php');

    $result = $conn->query($sql);

    if($result->num_rows > 0 ){
    
        $result = $result->fetch_assoc();
        $emp_email = $result["employer_email"];
        $_SESSION['instructor_email'] = $result['instructor_email'];
?>

        <h1>Review Application Info:</h2>
        <br>
        <h2><?php echo $result['name']; ?></h2>
        <hr>
        <form action="backend/update-appinfo4.php">
        <h3>Course Information:</h3>
        <table>
            <tr>
                <th>Attribute:</th>
                <th>Your Response:</th>
            </tr>
            <tr>
                <td>Course Number</td>
                <td><?php echo($result['dept_code'])." ".$result['class_number'] ?></td>
            </tr>
            <tr>
                <td>Academic Semester</td>
                <td><?php echo($result['semester'] . " " . $result['year']); ?></td>
            </tr>
            <tr>
                <td>Grading Type</td>
                <td><?php echo($result['grade_mode']); ?></td>
            </tr>
            <tr>
                <td>Credit Hours</td>
                <td><?php echo($result["credits"]); ?></td>
            </tr>
        </table>

        <h3>Employer Information:</h3>
        <br>

<?php
    }
        $sql_empInfo = "SELECT * FROM s20_employer_info WHERE email = '$emp_email'";
        $result1 = $conn->query($sql_empInfo);

        if ($result1->num_rows > 0){
            $result1 = $result1->fetch_assoc();
?>

            <table>
                <tr>
                    <th>Attribute:</th>
                    <th>Your Response:</th>
                </tr>
                <tr>
                    <td>Business Name</td>
                    <td><?php echo $result1['business_name'];?></td>
                </tr>
                <tr>
                    <td>Supervisor Name</td>
                    <td><?php echo $result1['f_name']." ".$result1['l_name'];?></td>
                </tr>
                <tr>
                    <td>Supervisor's Email</td>
                    <td><?php echo $result1['email'];?></td>
                </tr>
                <tr>
                    <td>Telephone Number</td>
                    <td><?php echo $result1['phone_number'];?></td>
                </tr>
                <tr>
                    <td>Street Address</td>
                    <td><?php echo $result1['street_address'];?></td>
                </tr>
                <tr>
                    <td>City, State, Zipcode</td>
                    <td><?php echo $result1['city'].", ".$result1['state'].", ".$result1['zipcode'];?></td>
                </tr>
        </table>

        <h3>Project Information:</h3>
        <br>
<?php
        }

        $sql_projectInfo = "SELECT * from s20_project_info where fw_id='$searchKey'";

        $result2 = $conn->query($sql_projectInfo);

        if($result2->num_rows > 0){
            $result2 = $result2->fetch_assoc();
?>
            <table>
                <tr>
                    <th>Attribute:</th>
                    <th>Your Response:</th>
                </tr>
                <tr>
                    <td>What are your responsibilities on the site?</td>
                    <td><?php echo $result2['responsibilities'];?></td>
                </tr> 
                <tr>
                    <td>What special project will you be working on?</td>
                    <td><?php echo $result2['description'];?></td>
                </tr> 
                <tr>
                    <td>What do you expect to learn?</td>
                    <td><?php echo $result2['learning_expectations'];?></td>
                </tr> 
                <tr>
                    <td>How is the proposal related to your major areas of interest?</td>
                    <td><?php echo $result2['major_relationship'];?></td>
                </tr>
                <tr>
                    <td>Describe the course work you have completed which provides appropriate background to the project.</td>
                    <td><?php echo $result2['background'];?></td>
                </tr>                <tr>
                    <td>What is the proposed method of study? Where appropriate, cite readings and practical experience.</td>
                    <td><?php echo $result2['proposal'];?></td>
                </tr>                       
            </table>
           
                <input type="submit" value="Submit">
            </form>

<?php
        }

    $conn->close();

    include('skeleton.foot.php');
?>
