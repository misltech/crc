<?php include('skeleton.head.php') ?>
<h1>Review Form</h1>
<p>Student and company information here to be reviewed...</p>

<form method="post" action="backend/submit-supervisor.php">


    <label>
        <p>Student ID for Candidate:</p><input type="text" name="studentID" value="">
    </label>

    <label>
        <p>Internship Description:</p>
        <textarea id="intDescript" name="intDescript" rows="10" cols="100"></textarea>
    </label>

    <legend>Learning Objectives:</legend>
    <p>(display chosen learning objectives here)</p>


    <?php include('components/accept_reject.php'); includeARComponent(); ?>

    <input id="button" type="submit" name="button" value="Submit" />
</form>
<?php include('skeleton.foot.php') ?>
