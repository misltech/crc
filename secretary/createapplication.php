<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('../backend/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');




if(isset($_GET['id'])){
    //checks database for user then output user profile. Option to add 



}


?>

<?php  if(true){ ?>

<div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">Create Application <span class="d-inline">
                <div class="d-inline float-right dropdown">
                    <button class="btn btn-secondary dropdown-toggle ml-auto" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Course Settings
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./addcourse.php">Add a Course</a>

                    </div>
                </div>
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
                    <button name="submit" type="submit" class="btn btn-primary float-right">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php } else { ?>

    <div class="container " style="overflow: auto;">
    <div class="jumbotron">
        <h1 class="display-4">Create Application <span class="d-inline">
                <div class="d-inline float-right dropdown">
                    <button class="btn btn-secondary dropdown-toggle ml-auto" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Course Settings
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./addcourse.php">Add a Course</a>

                    </div>
                </div>
            </span></h1>
        <p class="lead">You can view and modify current courses here.</p>
        <hr class="my-4">
        <div class="d-flex justify-content-center mt-5">
           
        </div>
    </div>
</div>








    <?php } ?>
<?php

if (isset($_POST['submit-student'])) { //handles student submit button





}









include_once('components/footer.php');






?>