<?php

session_start();

include('skeleton.head.php');
include_once('backend/util.php');
/*
if (isset($_SESSION['user_id'])) {
?>
    <h2>Welcome, <?php echo $_SESSION['user_id']; ?></h2>
    <form action="submit-logout.php" method="post">
      <input name="submit" type="submit" value="Logout">
    </form>
<?php
}
else {
 */ 
?>

    <h2>Log In</h2>
    <form action="backend/submit-login.php" method="post">
      <label>
        <p>Email:</p>
        <p><input id="email" name="email" placeholder="Enter Email" type="text"></p>
      </label>
      
      <label>
        <p>Password:</p>
        <p><input id="password" name="password" placeholder="Enter Password" type="password"></p>
      </label>
      
      <p><input name="submit" type="submit" value="Log In" name="login"></p>
    </form>
    <p><a href="forgot.php">Forgot password?</a></p>
    <p>If you do not have a password yet, please talk to your department secretary. They can create an account for you.</p>
<?php

include('skeleton.foot.php');

?>
