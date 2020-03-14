<?php

// Resume Existing Session

session_start();

include('skeleton.head.php');

$searchKey = $_SESSION['fw_id'];

$sql = "SELECT * FROM s20_application_info WHERE fw_id = '$searchKey'";

// set return path if user decides to edit information

$_SESSION['edit_return'] = "chair-review1.php?id=".$searchKey;

// Do not change page_key value, it will break the system

$_SESSION['page_key'] = "chair1";

include('backend/db_conn2.php');

$result = $conn->query($sql);
//echo "<div id=".$result->num_rows."></div>";

if ($result->num_rows > 0 ) {

    $result = $result->fetch_assoc();
    $student_email = $result['student_email'];
    $_SESSION['dept'] = $result['dept_code'];
    $sql_student = "SELECT student_first_name, student_last_name from s20_student_info where student_email='$student_email'";
    $result_student = $conn->query($sql_student);
    //echo "<div id=".$result_student->num_rows."></div>";

    if ($result_student->num_rows > 0){

// Check edit permissions

        include('backend/check-permissions.php');

        $result_student = $result_student->fetch_assoc();

?>

<h1>Review Application Info:</h2>
    <br>
    <h2><?php echo $result['name']; ?></h2>
    <hr>
    <form method="post" action="backend/chair-appinfo1.php">

        <h3>Course Information:</h3>

        <input type="hidden" name="f_name" value="<?php echo $result_student['f_name']; ?>">
        <input type="hidden" name="l_name" value="<?php echo $result_student['l_name']; ?>">

        <input type="hidden" name="dept" value="<?php echo $result['dept_code']; ?>">
        <input type="hidden" name="title" value="<?php echo $result['name']; ?>">
        <input type="hidden" name="instructor_email" value="<?php echo $result['instructor_email']; ?>">
        <input type="hidden" name="student_email" value="<?php echo $result['student_email']; ?>">


        <table>
            <tr>
                <th>Attribute:</th>
                <th>Student Entry:<th>
            </tr>
            <tr>
                <td>Student First Name</td>
                <td><?php echo $result_student['f_name']; ?></td>
            </tr>
            <tr>
                <td>Student Last Name</td>
                <td><?php echo $result_student['l_name']; ?></td>
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
        
            <button id="edit_courseInfo" type="button" onclick="window.location.href='/p/f18-02/f19-v3/student-application1.php?id=<?php echo $searchKey ?>'" class="btn btn-primary">Edit Course Information</button>
<?php
        }
?>
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
// Show edit button if permission is allowed

            if ($projectInfo == '1') {
?>
                <button id="edit_projectInfo" type="button" onclick="window.location.href='/p/f18-02/f19-v3/student-application3'" class="btn btn-primary">Edit Project Information</button>
<?php
            }
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
                <td><?php echo $result3['f_name']." ".$result3['l_name'];?></td>
            </tr>
            <tr>
                <td>Supervisor's Email</td>
                <td><?php echo $result3['email'];?></td>
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
<?php
// Show edit button if permission is allowed

        if ($empInfo == '1') {
?>
            <button id="edit_employerInfo" type="button" onclick="window.location.href='/p/f18-02/f19-v3/student-application2.php'" class="btn btn-primary">Edit Employer Information</button>
<?php
        }
?>
        <h3>Learning Objectives:</h3>

<?php

        }

        $sql_getLO = "SELECT learning_obj FROM s20_application_info WHERE fw_id='$searchKey'";
        $res_getLO = $conn->query($sql_getLO);

        $res_getLO = $res_getLO->fetch_assoc();
        $arr_LO = explode(",", $res_getLO['learning_obj']);
        $c = count($arr_LO);

        echo "<table><tr><th>Learning Objective:</th><th>Description:</th></tr>";
        echo "<div id='$c'></div>";
        for ($i = 0; $i < count($arr_LO); $i++){
            $key = $arr_LO[$i];
            $sql_loInfo = "SELECT * FROM s20_Learning_Obj WHERE LO_id='$key'";

            $res_loInfo = $conn->query($sql_loInfo);
            $row = $res_loInfo->fetch_assoc();

            echo "<tr><td>".$row['LO_title']."</td>";
            echo "<td>".$row['LO_description']."</td></tr>";
        }

        echo "</table>";

        if ($learningObj == '1') {
            echo "<button id='edit_learningObj' type='button' onclick=\"window.location.href='/p/f18-02/f19-v3/instructor-review3.php'\" class='btn btn-primary'>Edit Learning Objectives</button>";
        }

        include('components/accept_reject.php'); includeARComponent();
        echo "<input type='submit' value='Submit'></form>";

include('skeleton.foot.php');

?>
