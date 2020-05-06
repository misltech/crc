<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once '../backend/db_con3.php';


global $CreateAPP;


if (isset($_GET['found']) and $_GET['found'] and isset($_GET['uniquesearch']) == true) {
    $CreateAPP = true;
} else {
    $CreateAPP = false;
}


?>


<?php if ($CreateAPP) { ?>

    <div class="container " style="overflow: auto;">
        <div class="jumbotron">
            <h1 class="display-4">New application</h1>
            <p class="lead">Select the required information, then hit Submit Application</p>
            <hr class="my-4">
            <div class="d-flex justify-content-center mt-5">
                
                    <form method="POST">

                        <div class="form-group row">
                            <label for="type" class="col-4 col-form-label">Student email</label>
                            <div class="col-8">
                                <label for="type" class="col-4 col-form-label"> <?php echo $_GET['uniquesearch']?> </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-4 col-form-label">Department</label>
                            <div class="col-8">
                                <select id="type" name="utype" class="custom-select" size="1" value="" required="required">
                                    <?php
                                    $sql = "SELECT * FROM s20_course_numbers ORDER BY dept_code ASC"; //table of courses
                                    $qsql  = mysqli_query($db_conn, $sql);
                                    $r = mysqli_num_rows($qsql);

                                    if ($r > 0) { //if there are courses in the table
                                        while ($result = mysqli_fetch_assoc($qsql)) { //itterate through each row  
                                            $id = $result['id']; //returns ID of course
                                            $deptcode = $result['dept_code']; //gets dept code: CPS
                                            $coursenum = $result['course_number']; //gets course number: 100
                                            $course = $deptcode . " " . $coursenum; //concat: CPS 100

                                    ?>
                                            <option value="<?php echo $id; ?>"><?php echo $course ?></option>
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

                        <br>
                        <br>
                            <button name="submitApp" type="submit" class="btn btn-primary float-right">Submit Application</button>
                    </form>
             </div>
         </div>
    </div>
</span></h1>


    <?php } else { ?>

        <div class="container " style="overflow: auto;">
            <div class="jumbotron">
                <h1 class="display-4">New Application <span class="d-inline">

                    </span></h1>
                <p class="lead">Submit a students hawkmail address</p>
                <hr class="my-4">
                <div class="d-flex justify-content-center mt-5">
                    <form method="POST">
                        <div class="form-group">
                            <label for="uniquesearch">Search for a student</label>
                            <input id="uniquesearch" name="uniquesearch" type="text" class="form-control" aria-describedby="uniquesearchHelpBlock" required="required">
                            <span id="uniquesearchHelpBlock" class="form-text text-muted">xx@newpaltz.edu</span>
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

    if (isset($_POST['search'])) { //handles student search button
        $email = mysqli_real_escape_string($db_conn, $_POST['uniquesearch']);

        $sql = "SELECT * FROM s20_UserPass WHERE email = '$email'";
        $query = mysqli_query($db_conn, $sql);

        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                header('Location: ./createapplication.php?found=true&uniquesearch=' . $email ); //if true then redirect to application form with value of email 
            } else {
                //redirect to create account with get parameters and do it there.

            }
        }
    }
         if (isset($_POST['submitApp'])) { //handles Application submit button
         }
/*
            $getuser = "SELECT * FROM s20_UserPass WHERE email = '$email'";
            $getuserquery = mysqli_query($db_conn, $getuser);
            $getuserresult = mysqli_fetch_assoc($getuserquery);
            $banner = $result['banner_id'];
            $semester = document.getElementById('sem');

            $fwid = bin2hex(random_bytes(32));  //duplication is unlikely with this one. However should make an method to catch duplication
            $newappsql = "INSERT INTO s20_application_info(fw_id, banner_id, dept_code, student_email, semester, year) VALUES ('$fwid','$banner','$type', '$email', '$semester', '$year');"; ///get department code
            $newutilsql = "INSERT INTO s20_application_util(fw_id, progress, rejected, assigned_to, assigned_when) VALUES ('$fwid', '-1', '0', 'student', 'CURRENT_TIMESTAMP');";

            
  


                            } 
                            else {
                                console_log(mysqli_error($db_conn));
                            }
                        }
                }



    // } */
    include_once('components/footer.php');
?>