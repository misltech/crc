<?php

//Learning objective questions. 
//objectives are determined by data from the database.
//Save their responses in database and move to next.
//This should also check if they have a data already and fill data.

if (!isset($_SESSION)) {
    session_start();
}


include_once('../newback/util.php');
validate($GLOBALS['student_type']);
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');


?>



<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Project Information</h1>
        <p class="lead">You can view the status of your application below</p>
        <hr class="my-4">

        <div class="row">
            <div class="col-md-8 order-md-1 mx-auto">
                <form>
                    <div class="form-group">
                        <label for="textarea">What are your responsibilities on the site?</label>
                        <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea1">What special project will you be working on?</label>
                        <textarea id="textarea1" name="textarea1" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea2">What do you expect to learn?</label>
                        <textarea id="textarea2" name="textarea2" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea3">How is the proposal related to your major areas of interest?</label>
                        <textarea id="textarea3" name="textarea3" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea4">Describe the course work you have completed which provides appropriate background to the project.</label>
                        <textarea id="textarea4" name="textarea4" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="textarea5">What is the proposed method of study? Where appropriate, cite readings and practical experience.</label>
                        <textarea id="textarea5" name="textarea5" cols="40" rows="5" class="form-control" required="required"></textarea>
                    </div>
                    <div class="form-group mt-5">
                        <button name="submit" type="submit" class="btn btn-primary float-right">Submit</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>






<?php

include_once('components/footer.php');
//semester form to input into database
?>