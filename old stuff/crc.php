<?php include('skeleton.head.php'); ?>
<h1>Review Form</h1>

<p>Student and company information, professor acceptance, employer acceptance, chair/dean signature here to be
    reviewed...</p>

<form method="post" action="backend/submit-crc.php">


    <?php include('components/accept_reject.php'); includeARComponent(); ?>

    <input id="button" type="submit" name="button" value="Submit" />
</form>
<?php include('skeleton.foot.php'); ?>
