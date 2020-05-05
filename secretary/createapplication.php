<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once '../backend/db_con3.php';


global $CreateAPP;
if (isset($_GET['found']) and $_GET['found'] == true) {
    //checks database for user then output user profile. Option to add 

    $CreateAPP = true;
} else {
    $CreateAPP = false;
}


?>


<!-- Show form or not -->
<?php if ($CreateAPP) { ?>

    <div class="container " style="overflow: auto;">
        <div class="jumbotron">
            <h1 class="display-4">Create Application</h1>
            <p class="lead">You can create an application here. Search by email address.</p>
            <hr class="my-4">
            <div class="d-flex justify-content-center mt-5">
                <div class="col-md-8 mx-auto">
                <h6 class="row mb-3">Creating application for: <?php echo "emailhere";?></h6> 
                    <form method="POST">
                
                        <div class="form-group row">
                            <label for="type" class="col-4 col-form-label">Department</label>
                            <div class="col-8">
                                <select id="type" name="utype" class="custom-select" size="1" value="" required="required">
                                    <?php
                                    $sql = "SELECT * FROM s20_course_numbers ORDER BY dept_code ASC";
                                    $qsql  = mysqli_query($db_conn, $sql);
                                    $r = mysqli_num_rows($qsql);

                                    if ($r > 0) {
                                        while ($result = mysqli_fetch_assoc($qsql)) {
                                            $id = $result['id'];
                                            $coursenum = $result['course_number'];
                                            $deptcode = $result['dept_code'];
                                    ?>
                                            <option value="<?php echo $id; ?>"><?php echo $deptcode . " " . $coursenum; ?></option>
                                    <?php
                                        }
                                    } else {
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-4 col-form-label">Semester</label>
                            <div class="col-8">
                                <select id="type" name="sem" class="custom-select" required="required">
                                    <option value="Spring 2020">Spring 2020</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gm" class="col-4 col-form-label">Grade Mode</label>
                            <div class="col-8">
                                <select id="gm" value="<?php echo $grademode; ?>" name="gm" required="required" class="custom-select">
                                    <option value="Letter Grades">Letter Grades</option>
                                    <option value="Pass/Fail">Pass/Fail</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit-student" type="submit float-right" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </span></h1>
        <p class="lead">You can view and modify current courses here.</p>
        <hr class="my-4">
        <div class="d-flex justify-content-center mt-5">

            <form method="POST">

                <div class="form-group">
                    <label for="uniquesearch">Input a students email address</label>
                    <input id="uniquesearch" name="uniquesearch" type="text" class="form-control" aria-describedby="uniquesearchHelpBlock" required="required">
                    <span id="uniquesearchHelpBlock" class="form-text text-muted">xx@newpaltz.edu</span>
                </div>

                <div class="form-group">
                <label for="Semester_Input">Select a Semester</label>
                    <input type="radio" id="Spring" name="semester" value="Spring"> <label for="Spring">Spring</label><br>
                    <input type="radio" id="Fall"   name="semester" value="Fall">   <label for="Fall">Fall</label><br>
                    <input type="radio" id="Winter" name="semester" value="Winter"> <label for="Winter">Winter</label><br>
                </div>

                <!--Need to retrieve classes-->




                    <button name="submit" type="submit" class="btn btn-primary float-right">Submit Application</button>
                </div>
            </form>

        </div>
    </div>
</div>

            </div>
        </div>

    <?php } else { ?>

        <div class="container " style="overflow: auto;">
            <div class="jumbotron">
                <h1 class="display-4">Create Application <span class="d-inline">

                    </span></h1>
                <p class="lead">You can view and modify current courses here.</p>
                <hr class="my-4">
                <div class="d-flex justify-content-center mt-5">
                    <form method="POST">
                        <div class="form-group">
                            <label for="uniquesearch">Search for a student</label>
                            <input id="uniquesearch" name="uniquesearch" type="text" class="form-control" aria-describedby="uniquesearchHelpBlock" required="required">
                            <span id="uniquesearchHelpBlock" class="form-text text-muted">N0365XXXX or xx@newpaltz.edu</span>
                        </div>
                        <div class="form-group">
                            <button name="search" type="submit" class="btn btn-primary float-right">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php } ?>
    <?php

    if (isset($_POST['search'])) { //handles student submit button
        $email = mysqli_real_escape_string($db_conn, $_POST['uniquesearch']);

        $sql = "SELECT * FROM s20_UserPass WHERE email = '$email'";
        $query = mysqli_query($db_conn, $sql);

        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                header('Location: ./createapplication.php?found=true');
            } else {
                //redirect to create account with get parameters and do it there.

            }
        }
    }
    //     if (isset($_POST['submit-student'])) { //handles student submit button
    //         $email = mysqli_real_escape_string($db_conn, $_POST['email']);
    //         $type = mysqli_real_escape_string($db_conn, $_POST['utype']);
    //         $sem = mysqli_real_escape_string($db_conn, $_POST['sem']);
    //         $banner = strtoupper($banner);
    //         $sem = explode(" ", $sem);
    //         $semester = $sem[0];
    //         $year = $sem[1];
    //         //check if exists
    //         $pass = generatePassword(8);
    //         $insert = "INSERT INTO s20_UserPass (email, profile_type, passcode) VALUES('$email', 'student', '$pass')";
    //         $insertsql  = mysqli_query($db_conn, $insert);


    //         if (mysqli_errno($db_conn) == 1062) { //mean sduplicate entry
    //           if (strpos(mysqli_error($db_conn), 'PRIMARY')) { //checks if its in the error line
    //             //alert that banner id exits
    //             alert("banner id exist");
    //           } else if (strpos(mysqli_error($db_conn), 'email')) { //means duplicated email address. But different banner number
    //             alert("email exits");
    //             //alert that email exist.
    //             //bring up modal. ask to send a forgot email
    //           }
    //         } else if (mysqli_errno($db_conn) == 0) { //if user created and query success
    //           $fwid = bin2hex(random_bytes(32));  //duplication is unlikely with this one. However should make an method to catch duplication
    //           $newappsql = "INSERT INTO s20_application_info(fw_id, banner_id, dept_code, student_email, semester, year) VALUES ('$fwid','$banner','$type', '$email', '$semester', '$year');"; ///get department code
    //           $newutilsql = "INSERT INTO s20_application_util(fw_id, progress, rejected, assigned_to, assigned_when) VALUES ('$fwid', '-1', '0', 'student', 'CURRENT_TIMESTAMP');";
    //           $insql = mysqli_multi_query($db_conn, $newappsql);
    //           if (mysqli_errno($db_conn) == 0) {
    //             $insql = mysqli_multi_query($db_conn, $newutilsql);
    //             if (mysqli_errno($db_conn) == 0) {
    //               alert("success");
    //               $t = bin2hex(random_bytes(24));
    //               $link = "https://" . $_SERVER['SERVER_NAME'] . "/~mitchelt6/crc/student/newstudent.php?token=$t";
    //               $newsql = "INSERT INTO s20_user_validation (email, token) VALUES ('$email', '$t')";
    //               $newtoken = mysqli_query($db_conn, $newsql);

    //               if ($newtoken) {
    //                 $message = "Please click on the link below and change your password immediately. This link only works once. You can reset your password on the website.\n$link";
    //                 sendEmail($email, "Welcome to your Fieldwork Application!", $message);
    //                 alert("Sent email");
    //               } else {
    //                 console_log(mysqli_error($db_conn));
    //               }
    //             }
    //           } else {
    //             //alert(mysqli_error($db_conn));
    //           }

    //           //echo "<meta http-equiv='refresh' content='0'>";
    //           //alert success
    //         }
    //       }



    // }









    include_once('components/footer.php');






    ?>