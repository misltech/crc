<?php

// Resume exisiting session

session_start();

include('skeleton.head.php');

// 

// Assign GET variable to session

$searchKey = $_SESSION['fw_id'];

$_SESSION['page_key'] = "instructor1";

$sql = "SELECT * FROM s20_application_info WHERE fw_id = '$searchKey'";

include('backend/db_conn2.php');


$result = $conn->query($sql);

if ($result->num_rows > 0 ) {
    $result = $result->fetch_assoc();

    $_SESSION['student_email'] = $student_email = $result['student_email'];
    // consoleLog($student_email);
    $_SESSION['emp_email'] = $result['employer_email'];
    $_SESSION['dept'] = $result['dept_code'];
    $_SESSION['edit_return'] = "instructor-review1.php?id=".$searchKey."";

    $sql_student = "SELECT student_first_name, student_last_name from s20_student_info where student_email='$student_email'";

    $result_student = $conn->query($sql_student);
    

    if ($result_student->num_rows > 0){

        $result_student = $result_student->fetch_assoc();

        include('backend/check-permissions.php');
?>

    <h1>Review Application Info:</h2>
    <br>
    <h2><?php echo $result['name']; ?></h2>
    <hr>
    <form method="post" action="backend/instructor-appinfo1.php">

        <h3>Course Information:</h3>

        <table>
            <tr>
                <th>Attribute:</th>
                <th>Student Entry:<th>
            </tr>
            <tr>
                <td>Student First Name</td>
                <td><?php echo $result_student['student_first_name']; ?></td>
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

<?php
// Show edit button if permission is allowed

        if ($courseInfo == '1') {
?>
        <button id="edit_courseInfo" type="button" onclick="window.location.href='/p/f18-02/f19-v3/student-application1.php?id=<?php echo $searchKey ?>'" class="btn btn-primary">Edit</button>
<?php   
        }
?>
        <br>
        <h3>Project Information:</h3>
        <br>
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

<?php
// Show edit button if permission is allowed

        if ($projectInfo == '1') {
?>
            <button id="edit_projectInfo" type="button" onclick="window.location.href='/p/f18-02/f19-v3/student-application3'" class="btn btn-primary">Edit</button>
<?php
        }
?>
            <input type="hidden" name="student_email" value="<?php echo $student_email ?>">
            <input type="hidden" name="title" value="<?php echo $result['name']; ?>">

            <?php include('components/accept_reject.php'); includeARComponent(); ?>

            <input type="submit" value="Submit">
    </form>


<?php
        }
$conn->close();

include('skeleton.foot.php');

?>
