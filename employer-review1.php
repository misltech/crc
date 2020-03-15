<?php

// Resume existing session

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once('skeleton.head.php');
include_once('backend/db_conn2.php');

// assign variables from GET Request

$searchKey = $_SESSION['fw_id'];
echo "<div id='$searchKey'></div>";


// Do not modify page key value, you will break this system
$_SESSION['page_key'] = "employer1";

$sql = "SELECT * FROM s20_application_info WHERE fw_id = '$searchKey'";

$result = $conn->query($sql);

if($result->num_rows > 0) {

    $result = $result->fetch_assoc();

    $_SESSION['dept'] = $result['dept_code'];
    $student_email = $result['student_email'];
    $sql_student = "SELECT student_first_name, student_last_name from s20_student_info where student_email='$student_email'";
    $result_student = $conn->query($sql_student);

// Check edit permissions here

    include('backend/check-permissions.php');

    if($result_student->num_rows > 0) {

        $result_student = $result_student->fetch_assoc();

        $sql_projectInfo = "SELECT * from s20_project_info where fw_id='$searchKey'";

        $result2 = $conn->query($sql_projectInfo);

        if($result2->num_rows > 0){
            $result2 = $result2->fetch_assoc();
?>
            <h1>Review Application Info:</h2>
            <br>
            <h2><?php echo $result['name']; ?></h2>
            <hr>
            <form method="post" action="backend/employer-appinfo1.php">

                <input type="hidden" name="f_name" value="<?php echo $result_student['f_name']; ?>">
                <input type="hidden" name="l_name" value="<?php echo $result_student['l_name']; ?>">
                <input type="hidden" name="dept" value="<?php echo $result['dept_code']; ?>">
                <input type="hidden" name="title" value="<?php echo $result['name']; ?>">
                <input type="hidden" name="instructor_email" value="<?php echo $result['instructor_email']; ?>">
                <input type="hidden" name="student_email" value="<?php echo $result['student_email']; ?>">            

            <h3>Project Information:</h3>

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

            if ($empInfo == '1') {
                $_SESSION['edit_return'] = "employer-review1.php?id=".$searchKey;
?>
                <button id="edit_projectInfo" type="button" onclick="window.location.href='/p/f18-02/f19-v3/student-application3'" class="btn btn-primary">Edit</button>
<?php
        }
?>
            <!-- <h3>Learning Objectives:</h3> -->

<?php
            // $sql_getLO = "SELECT learning_obj FROM s20_application_info WHERE fw_id='$searchKey'";
            // $res_getLO = $conn->query($sql_getLO);

            // $res_getLO = $res_getLO->fetch_assoc();
            // $arr_LO = explode(",", $res_getLO['learning_obj']);
            // $c = count($arr_LO);

            // echo "<table><tr><th>Learning Objective:</th><th>Description:</th></tr>";
            // echo "<div id='$c'></div>";
            // for ($i = 0; $i < count($arr_LO); $i++){
            //     $key = $arr_LO[$i];
            //     $sql_loInfo = "SELECT * FROM s20_Learning_Obj WHERE LO_id='$key'";

            //     $res_loInfo = $conn->query($sql_loInfo);
            //     $row = $res_loInfo->fetch_assoc();

            //     echo "<tr><td>".$row['LO_title']."</td>";
            //     echo "<td>".$row['LO_description']."</td></tr>";
            // }

            // echo "</table>";
            

            /*$result4 = $conn->query($sql_loInfo);

            if ($result4->num_rows > 0) {

                $LO_base = 1;

                echo "<table><tr><th>Learning Objective:</th><th>Description:</th></tr>";

                while ($row = $result4->fetch_assoc()) 
                    echo "<td>".$row['LO_Title']."</td>";
                    echo "<td>".$row['LO_Description']."</td></tr>";

                    $LO_base++;
                }

                echo "</table>";
            }  */         
        }
    }
}
        // if ($learningObj == '1') {
        //     echo "<button id='edit_learningObj' type='button' onclick=\"window.location.href='/p/f18-02/f19-v3/instructor-review3.php'\" class='btn btn-primary'>Edit</button>";
        // }

        include('components/accept_reject.php'); includeARComponent();
        echo "<input type='submit' value='Review Learning Objectives'>";
        echo "</form>";

include('skeleton.foot.php');

?>
