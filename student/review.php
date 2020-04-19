<?php

//Get all data from database show to user in a cute way. 
//When user submits this page ->  check the workflow order and move one place to the right.
//This page should be jumped to if user completes application but still wants to see their application. However they cant submit again. *Remove Submit button*
//Get request from url will determine if they can still modify. Will check database for rejection and show functions.

if (!isset($_SESSION)) {
    session_start();
}

include_once('../newback/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
include_once('../newback/db_con3.php');

$fwid = null;
$rejected = null;
$comments = null;

if (isset($_GET['fwid'])) {  //check for rejected application
    $sql = "SELECT * FROM s20_application_util WHERE fw_id = " . $_GET['fwid'];
    $qsql  = mysqli_query($db_conn, $sql);
    $r = mysqli_num_rows($qsql);
    $fwid = $_GET['fwid'];
    if ($r == 1) {
        $result = mysqli_fetch_assoc($qsql);
        $rejected = $result['rejected'];
        $comments = $result['comments'];
    } else {
        header('Location: ./application.php');
    }
}
else{
    header('Location: ./application.php');
}



?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Review Application</h1>
        <p class="lead">You can review your application here. <span style="color:red; font-weight:600;">Colors Subject to change </span></p>
        <hr class="my-4">
        <div class="row dropdown">
            <button class="btn btn-secondary dropdown-toggle ml-auto" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                App Settings
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Delete Application</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 order-md-1 mx-auto">
                <h5>Course Information <?php if ($rejected) { ?><span><a href="./sem.php?fwid=<?php echo $_GET['fwid']; ?>&exist=1" class="btn btn-xs btn-secondary"><span class="fa fa-edit"></span> Edit</a></span></h5><?php } else { ?> </h5> <?php } ?>
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Attribute:</th>
                        <th scope="col">Your Response:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Course Number</td>
                        <td>485</td>
                    </tr>
                    <tr>
                        <td scope="row">Academic Semester</td>
                        <td>Spring 2020</td>
                    </tr>
                    <tr>
                        <td scope="row">Grading Type</td>
                        <td>Pass/Fail</td>
                    </tr>
                    <tr>
                        <td scope="row">Credit Hours</td>
                        <td>4</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 order-md-1 mx-auto">
                <h5>Employer Information <?php if ($rejected) { ?><span><a href="./emp.php" class="btn btn-xs btn-secondary"><span class="fa fa-edit"></span> Edit</a></span></h5><?php } else { ?> </h5> <?php } ?>
            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Attribute:</th>
                        <th scope="col">Your Response:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Name</td>
                        <td>Andrew Blake</td>
                    </tr>

                    <tr>
                        <td scope="row">Company</td>
                        <td>IBM Poughkeepsie</td>
                    </tr>
                    <tr>
                        <td scope="row">Email</td>
                        <td>bl@ibm.it</td>
                    </tr>
                    <tr>
                        <td scope="row">Phone number</td>
                        <td>845-565-2121</td>
                    </tr>
                    <tr>
                        <td scope="row">Site Address</td>
                        <td>2455 South Rd Building 705, Poughkeepsie, NY 12601</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-10 order-md-1 mx-auto">
                <h5>Learning Objectives <?php if ($rejected) { ?><span><a href="./lo.php" class="btn btn-xs btn-secondary"><span class="fa fa-edit"></span> Edit</a></span></h5><?php } else { ?> </h5> <?php } ?>

            <table class="table table-striped table-dark">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Learning Objectives</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td scope="row">What are your responsibilities on the site? </td>

                    </tr>
                    <tr>
                        <th>Your Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guess</th>

                    </tr>
                    <tr>

                        <td scope="row">What special project will you be working on?</td>

                    </tr>
                    <tr>
                        <th>Your Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guess</th>

                    </tr>
                    <tr>
                        <td scope="row">What do you expect to learn?</td>

                    </tr>
                    <tr>
                        <th>Your Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guess</th>

                    </tr>
                    <tr>
                        <td scope="row">What is the proposed method of study? Where appropriate, cite readings and practical experience.</td>

                    </tr>
                    <tr>
                        <th>Your Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guess</th>

                    </tr>
                    <tr>
                        <td scope="row">How is the proposal related to your major areas of interest?</td>

                    </tr>
                    <tr>
                        <th>Your Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guess</th>

                    </tr>
                    <tr>
                        <td scope="row">Describe the course work you have completed which provides appropriate background to the project.</td>

                    </tr>
                    <tr>
                        <th>Your Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guessYour Response I guess</th>

                    </tr>

                </tbody>
            </table>

            </div>
        </div>

        <?php if ($rejected) { ?>
            <div class="mt-5">
                <form action="" method="post">
                    <button class="btn btn-block btn-secondary" value="<?php echo $_GET['fwid']; ?>" name="modify" type="submit">Submit Application</button>
                </form>
            </div>
        <?php } ?>

    </div>

</div>


<?php
if (isset($_POST['modify'])) {
    console_log($_POST['modify']);

    //remove reject and comments
}
include_once('components/footer.php');
//semester form to input into database
?>