<div class="topnav" id="topnav">
        <a href="javascript:void(0)" class="hamburger" onclick="toggleMenu()">Menu</a>
<?php 
    include_once("backend/util.php");

    if (isset($_SESSION["user_type"])) {
        ?><a href="<?php echo(API_URL); ?>backend/logout.php">Log out</a><?php
    } else {
        ?><a href="<?php echo(API_URL); ?>login.php">Log in</a><?php
    }

    if (!DEBUG) {
        /* if (isset($_SESSION["user_type"])) {
            ?>
            <a href="<?php echo(API_URL) ?>index.php">Home</a>
            <a href="<?php 
            echo(API_URL);
            if ($_SESSION["user_type"] === "student") {
                ?>../student.php<?php 
            } elseif ($_SESSION["user_type"] === "employer") {
                // link page goes here
                    ?>
                    
                    <?php
            } else {
                ?>faculty.php<?php
            } ?>">Edit Profile</a>
            <?php */

            if (isset($_SESSION["user_type"])) { ?>
            
                <!-- <a href="<?php echo(API_URL) ?>index.php">Home</a> -->
                
               <?php  if($_SESSION["user_type"] == "student"){ ?>
                    <a href="<?php echo(API_URL) ?>index.php">Home</a>
               <?php }
                else if ($_SESSION["user_type"] == "employer"){ ?>
                    <a href="<?php echo(API_URL) ?>index.php">Home</a>
                <?php }
                else if($_SESSION["user_type"] == "faculty"){ ?>
                    <a href="<?php echo(API_URL) ?>index.php">Home</a>
                <?php } 
                else { ?>
                    <a href="<?php echo(API_URL) ?>index.php">Home</a>
                <?php } ?>
                
                
                <?php  if($_SESSION["user_type"] == "student"){ ?>
                    <a href="<?php echo(API_URL) ?>student.php">Edit Profile</a>
               <?php }
                else if ($_SESSION["user_type"] == "employer"){ ?>
                    <a href="<?php echo(API_URL) ?>index.php">Edit Profile</a>
                <?php }
                else if($_SESSION["user_type"] == "faculty" || $_SESSION["user_type"] == "secretary" || $_SESSION["user_type"] == "dean" || $_SESSION["user_type"] == "chair" ||  $_SESSION["user_type"] == "instructor"){ ?>
                    <a href="<?php echo(API_URL) ?>faculty.php">Edit Profile</a>
                <?php } ?>
        <?php } ?>
   <?php } else {
?>
        <!--a href="<?php echo(API_URL) ?>register.php">Register</a-->
        <a href="<?php echo(API_URL) ?>secretary.php">Secretary</a>
        <a href="<?php echo(API_URL) ?>student.php">Student</a>
        <a href="<?php echo(API_URL) ?>home.php">Home</a>
        <a href="<?php echo(API_URL) ?>faculty.php">Faculty</a>
        <a href="<?php echo(API_URL) ?>instructor-review1.php">Instructor</a>
        <a href="<?php echo(API_URL) ?>employer-review1.php">Company Supervisor</a>
        <a href="<?php echo(API_URL) ?>chair-review1.php">Chair</a>
        <a href="<?php echo(API_URL) ?>dean-review1.php">Dean</a>
        <a href="<?php echo(API_URL) ?>crc.php">CRCenter</a>
        <a href="<?php echo(API_URL) ?>recreg.php">Records & Registration</a>
        <a href="<?php echo(API_URL) ?>admin.php">Admin Tools</a>
<?php
    }
?>
</div>
<div style="height: 92px;">&nbsp;</div>