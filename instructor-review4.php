<?php
session_start();
include('skeleton.head.php');
//include('backend/util.php');
//consoleLog("util working");
$_SESSION['page_key'] = "instructor4";
//consoleLog($_SESSION["user_id"]);
?>

<h1>Upload a New Syllabus</h1>
<form method="post" enctype="multipart/form-data" action="backend/instructor-appinfo4.php">
    <label>
        <p>Choose a syllabus file.</p>
        <input type="file" name="file" />
    </label>
    <input type="submit" value="Upload" />
</form>

<?php
include('skeleton.foot.php');
?> 
