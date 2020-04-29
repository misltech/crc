<?php
ob_start();
//Get all data from database show to user in a cute way. 
//When user submits this page ->  check the workflow order and move one place to the right.
//This page should be jumped to if user completes application but still wants to see their application. However they cant submit again. *Remove Submit button*
//Get request from url will determine if they can still modify. Will check database for rejection and show functions.

session_start();

include_once('../backend/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../backend/db_con3.php');

global $fwid;
global $rejected;
global $comments;
global $stage;
global $banner;
global $appbanner;
global $title;
global $semester;
global $classnumber;
global $grademode;
global $credits;
global $hours;
global $showedits;
if (isset($_GET['fwid'])) {  //check for rejected application
    $fwid = $_GET['fwid'];
    $banner = $_SESSION['banner'];
    $sql  = "SELECT * FROM s20_application_info WHERE fw_id = '$fwid' AND banner_id = '$banner'"; //checks if they are allowed to view page
    $qsql  = mysqli_query($db_conn, $sql);
    $r = mysqli_num_rows($qsql);
    if ($r == 1) {  //if application is found
        $result = mysqli_fetch_assoc($qsql);
        $appbanner = $result['banner_id'];
        $title = $result['project_name'];
        $semester = $result['semester'] . " " . $result['year'];
        $classnumber = $result['dept_code'] . " " . $result['class_number'];
        $grademode = $result['grade_mode'];
        $credits = $result['academic_credits'];
        $hours = $result['hours_per_wk'];
        //get course info from here since it was called already.
        $utilsql = "SELECT * FROM s20_application_util WHERE fw_id = '$fwid'";
        console_log($utilsql);
        $query = mysqli_query($db_conn, $utilsql);
        $result = mysqli_fetch_assoc($query);
        $rejected = $result['rejected'];
        $comments = $result['comments'];
        $stage = $result['assigned_to']; 
        $progress = $result['progress'];
        console_log($stage);
        console_log($progress);
        if($rejected == 1 or $stage == "student" or $progress == -1){
            $showedits = true;
        }

    } else {
        exit(header('Location: ./application.php'));
    }
} else {
    exit(header('Location: ./application.php'));
}

?>

<div class="container">
    <div class="jumbotron">
         <h1 class="display-4">Review Application</h1> 
        <p class="lead">You can review your application here.</p>

        <?php if ($rejected) { ?>
            <div class="card" style="width: auto">
                <div class="card-body">
                    <h6 class="card-title"><strong>Application flagged for revision.</strong></h6>
                    <h6 class="card-subtitle mb-2 text-muted">Reason:</h6>
                    <?php echo $comments; ?>
                </div>
            </div>
        <?php } ?>

        <hr class="my-4">

        <nav class="mb-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" id="student-tab" data-toggle="tab" href="#info-body" role="tab" aria-controls="info" aria-selected="true">Student Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="course-tab" data-toggle="tab" href="#course-body" role="tab" aria-controls="course" aria-selected="false">Course Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="employer-tab" data-toggle="tab" href="#employer-body" role="tab" aria-controls="employer" aria-selected="false">Employer Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" id="learning-tab" data-toggle="tab" href="#learning-body" role="tab" aria-controls="learning" aria-selected="false">Learning Expectations</a>
                </li>
            </ul>
        </nav>

        <div class="tab-content" id="myTab">

            <div class="tab-pane  show active" id="info-body" role="tabpanel" aria-labelledby="student-tab">
                <div class="row mt-3">
                    <div class="col-md-10 order-md-1 mx-auto review-sections">
                        <h5>Student Information <?php if ($showedits) { ?><span><a href="./stu.php?fwid=<?php echo $fwid; ?>&edit=true" class="btn btn-xs p-1"><span class="fa fa-edit"></span> Edit</a></span></h5><?php } else { ?> </h5> <?php } ?>
                    <table class="table table-striped">
                        
                    <?php 
                        $sql  = "SELECT * FROM s20_student_info WHERE fw_id = '$fwid'"; //checks if they are allowed to view page

                        $stusql  = mysqli_query($db_conn, $sql);
                        $result = mysqli_fetch_assoc($stusql);
                        
                        $name = $result['student_first_name'] . " " . $result['student_last_name'] ;
                        if($result['student_apt_num'] == null){
                            $address = $result['student_address']. " " . $result['student_city']. ", ". $result['student_state']. ", ".$result['student_zip'];
                        }
                        else{
                            $address = $result['student_address']. " " . $result['student_apt_num']. ", ". $result['student_city']. ", ". $result['student_state']. ", ".$result['student_zip']; 
                        }
                        $email = $result['student_email'];
                        $phone = $result['student_phone'];
                        $creditreg = $result['credits_registered'];
                    
                    ?>
                    <tbody>
                            <tr>
                                <td scope="row">N#</td>
                                <td><?php echo $appbanner; ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Name</td>
                                <td><?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Local Address: Street</td>
                                <td><?php echo $address; ?></td>
                            </tr>

                            <tr>
                                <td scope="row">E-mail</td>
                                <td><?php echo $email; ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Telephone number</td>
                                <td><?php echo $phone; ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Total credits registered</td>
                                <td><?php echo $creditreg; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane show" id="course-body" role="tabpanel" aria-labelledby="course-tab">
                <div class="row mt-3">
                    <div class="col-md-10 order-md-1 mx-auto review-sections">
                        <h5>Course Information <?php if ($showedits) { ?><span><a href="./sem.php?fwid=<?php echo $fwid; ?>&edit=true" class="btn btn-xs  p-1"><span class="fa fa-edit"></span> Edit</a></span></h5><?php } else { ?> </h5> <?php } ?>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td scope="row">Course Number</td>
                                <td><?php echo $classnumber;?></td>
                            </tr>
                            <tr>
                                <td scope="row">Academic Semester</td>
                                <td><?php echo $semester;?></td>
                            </tr>
                            <tr>
                                <td scope="row">Grading Type</td>
                                <td><?php echo $grademode;?></td>
                            </tr>
                            <tr>
                                <td scope="row">Credit Hours</td>
                                <td><?php echo $credits;?></td>
                            </tr>
                            <tr>
                                <td scope="row">Number of Hours/Week</td>
                                <td><?php echo $hours;?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane  show " id="employer-body" role="tabpanel" aria-labelledby="employer-tab">
                <div class="row mt-3">
                    <div class="col-md-10 order-md-1 mx-auto review-sections">
                        <h5>Employer Information <?php if ($showedits) { ?><span><a href="./emp.php?fwid=<?php echo $fwid; ?>&edit=true" class="btn btn-xs  p-1"><span class="fa fa-edit"></span> Edit</a></span></h5><?php } else { ?> </h5> <?php } ?>
                    <table class="table table-striped">
                        
                    <?php    
                        $sql = "SELECT * FROM s20_company_info WHERE fw_id = '$fwid'";
                        $empsql = mysqli_query($db_conn, $sql);
                        $r         = mysqli_num_rows($empsql);
                        $result    = mysqli_fetch_assoc($empsql);
                        $name = $result['supervisor_first_name'] . " " . $result['supervisor_last_name'];
                        $company   = $result['company_name'];
                        $email     = $result['supervisor_email'];
                        $phone     = $result['supervisor_phone'];
                        if($result['company_address2'] == null){
                            $address = $result['company_address'] . " " . $result['company_city']. " ". $result['company_state'] ." " . $result['company_zip'];
                        }
                        else{
                            $address = $result['company_address'] . ", " .$result['company_address2'].", ". $result['company_city']. ", ". $result['company_state'] .", " . $result['company_zip'];
                        }

                    ?>
                    
                    
                    <tbody>
                            <tr>
                                <td scope="row">Name</td>
                                <td><?php echo $name;?></td>
                            </tr>

                            <tr>
                                <td scope="row">Company</td>
                                <td><?php echo $company;?></td>
                            </tr>
                            <tr>
                                <td scope="row">Email</td>
                                <td><?php echo $email;?></td>
                            </tr>
                            <tr>
                                <td scope="row">Phone number</td>
                                <td><?php echo $phone;?></td>
                            </tr>
                            <tr>
                                <td scope="row">Site Address</td>
                                <td><?php echo $address;?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane  show " id="learning-body" role="tabpanel" aria-labelledby="learning-tab">
                <div class="row mt-3">
                    <div class="col-md-10 order-md-1 mx-auto review-sections">
                        <h5>Learning Expectations <?php if ($showedits) { ?><span><a href="./lo.php?fwid=<?php echo $fwid;?>&edit=true" class="btn btn-xs  p-1"><span class="fa fa-edit"></span> Edit</a></span></h5><?php } else { ?> </h5> <?php } ?>

                    <table class="table table-striped">
                        
                    <?php 
                    
                    $losql = "SELECT * FROM s20_project_info WHERE fw_id = '$fwid'";
                    $loquery  = mysqli_query($db_conn, $losql);
                    $r = mysqli_num_rows($loquery);
                    $result = mysqli_fetch_assoc($loquery);
                    $firstresponse = $result['project_response1'];
                    $secondresponse = $result['project_response2'];
                    $thirdresponse = $result['project_response3'];
                    
                    
                    ?>
                    <tbody>
                            <tr>
                                <th scope="row">What are your responsibilities on the site? What special project will you be working on? What do you expect to learn? </th>
                            </tr>
                            <tr>
                                <td><?php echo $firstresponse;?></td>
                            </tr>
                            <tr>
                                <th scope="row">How is the proposal related to your major areas of interest? Describe the course work you have completed which provides appropriate background to the project.</th>
                            </tr>
                            <tr>
                                <td><?php echo $secondresponse;?></td>
                            </tr>
                            <tr>
                                <th scope="row">What is the proposed method of study? Where appropriate, cite readings and practical experience.</th>
                            </tr>
                            <tr>
                                <td><?php echo $thirdresponse;?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($showedits) { ?>
            <div class="mt-5 mt-5 col-8 mx-auto">
                <form method="post">
                    <button class="btn btn-block btn-secondary" value="<?php echo $fwid; ?>" name="modify" type="submit">Submit Revised Application</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>


<?php
if (isset($_POST['modify'])) {
    $fwidsubmit = mysqli_real_escape_string($db_conn, $_POST['modify']);
    console_log($_POST['modify']);
    //check if all sections are completed. then move application to next stage.
    $sql = "SELECT * FROM s20_application_util WHERE fw_id = '$fwid'";
        $query = mysqli_query($db_conn, $sql);
        $result = mysqli_fetch_assoc($qsql);

        if($result['progress'] == 0 or $result['assigned_to'] == "student" ){
            $update = "UPDATE s20_application_util SET rejected='0' WHERE fw_id ='$fwid'";
            $up = mysqli_query($db_conn, $update);
            if($up){
                //confirm then redirect
                header('Location: ./application.php'); 
            }
            else{
                alert("appsubmit error :". mysqli_errno($db_conn));
            }
        }
        else if($result['rejected'] == 1){
            $update = "UPDATE s20_application_util SET rejected='0' WHERE fw_id ='$fwid'";
            $in = mysqli_query($db_conn,$update);
            if($in){
                // confirmation then redirect
                header('Location: ./application.php'); 
            }
            else{
                alert("appsubmit error :". mysqli_errno($db_conn));
            }
        }
    //remove reject and comments
}
include_once('components/footer.php');
//semester form to input into database
?>