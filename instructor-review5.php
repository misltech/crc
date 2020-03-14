<?php

// Resume Existing Session

session_start();

include('skeleton.head.php');

$searchKey = $_SESSION['fw_id'];
$_SESSION['page_key'] = "instructor5";

$sql = "SELECT * FROM s20_application_info WHERE fw_id = '$searchKey'";

include('backend/db_conn2.php');

$result = $conn->query($sql);

if ($result->num_rows > 0 ) {

    $result = $result->fetch_assoc();
    $student_email = $_SESSION['student_email'] = $result['student_email'];
    $sql_student = "SELECT student_first_name, student_last_name from s20_student_info where student_email='$student_email'";
    $result_student = $conn->query($sql_student);

    if ($result_student->num_rows > 0){

        $result_student = $result_student->fetch_assoc();

?>

<h1>Review Application Info:</h2>
    <br>
    <h2><?php echo $result['name']; ?></h2>
    <hr>
    <form method="post" action="backend/instructor-appinfo5.php">

        <h3>Course Information:</h3>

        <input type="hidden" name="first_name" value="<?php echo $result_student['student_first_name']; ?>">
        <input type="hidden" name="last_name" value="<?php echo $result_student['student_last_name']; ?>">
        <input type="hidden" name="title" value="<?php echo $result['name']; ?>">


        <table>
            <tr>
                <th>Attribute:</th>
                <th>Student Entry:<th>
            </tr>
            <tr>
                <td>Student First Name</td>
                <td><?php echo $result_student['student_fist_name']; ?></td>
            </tr>
            <tr>
                <td>Student Last Name</td>
                <td><?php echo $result_student['student_last_name']; ?></td>
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
        
        <h3>Project Information:</h3>

<?php
    }

}

        $sql_projectInfo = "SELECT * from s20_project_info where fw_id='$searchKey'";

        $result2 = $conn->query($sql_projectInfo);

        if($result2->num_rows > 0){
            $result2 = $result2->fetch_assoc();
?>
            <table>
                <tr>
                    <th>Attribute:</th>
                    <th>Student Entry:</th>
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

<?php
        }

        $empEmail = $result['employer_email'];

        $sql_empInfo = "SELECT * from s20_employer_info where email='$empEmail'";

        $result3 = $conn->query($sql_empInfo);
        
        if ($result3->num_rows > 0) {
        
            $result3 = $result3->fetch_assoc();

?>

        <h3>Employer Information:</h3>
        
        <table>
            <tr>
                <th>Attribute:</th>
                <th>Your Response:</th>
            </tr>
            <tr>
                <td>Business Name</td>
                <td><?php echo $result3['business_name'];?></td>
            </tr>
            <tr>
                <td>Supervisor's Name</td>
                <td><?php echo $result3['first_name']." ".$result3['last_name'];?></td>
            </tr>
            <tr>
                <td>Supervisor's Email</td>
                <td><?php echo $result3['employer_email'];?></td>
            </tr>
            <tr>
                <td>Telephone Number</td>
                <td><?php echo $result3['phone_number'];?></td>
            </tr>
            <tr>
                <td>Street Address</td>
                <td><?php echo $result3['street_address'];?></td>
            </tr>
            <tr>
                <td>City, State, Zipcode</td>
                <td><?php echo $result3['city'].", ".$result3['state'].", ".$result3['zipcode'];?></td>
            </tr>
        </table>

        <h3>Learning Objectives:</h3>

<?php

        }

        $sql_loInfo = "SELECT * from s20_Learning_Objectives where fw_id=$searchKey ORDER BY lo_id";

        $result4 = $conn->query($sql_loInfo);

        if ($result4->num_rows > 0) {

            $LO_base = 1;

            echo "<table><tr><th>Attribute:</th><th>Your Response:</th></tr>";

            while ($row = $result4->fetch_assoc()) {

                echo "<tr><td>LO".$LO_base.":</td>";

                echo "<td>".$row['description']."</td></tr>";

                $LO_base++;
            }

            echo "</table>";
        } ?>
		<?php include('components/accept_reject.php'); includeARComponent(); ?>
        <input type="submit" value="Submit">
	</form>

<?php 
	$conn->close();
	include('skeleton.foot.php'); ?>

?>
