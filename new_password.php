<?php    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  ?>
<?php

include('skeleton.head.php');

if (!isset($_SESSION['id_key'])) {
  header("Location: login.php");
}
else {

?>

<h2>Update Password</h2>
    <form action="backend/submit-new-password.php" method="post">
      <label>
        <p>Password:</p>
        <p><input id="password" name="password" placeholder="Enter New Password" type="password"></p>
      </label>
      
      <label>
        <p>Re-Enter Password:</p>
        <p><input id="password_chk" name="password_chk" placeholder="Re-Enter New Password" type="password"></p>
      </label>
      
      <p><input name="submit" type="submit" value="Login" name="login"></p>
    </form>

<?php
}

include('skeleton.foot.php');

?>



