<?php include('skeleton.head.php') ?>
<h2>Forgot your password?</h2>
<p>Don't worry, it happens to everyone. Type in your banner ID below and we'll reset it for you.</p>
<form method="post" action="backend/reset-password.php">
    <label>
        <p>Enter your banner ID.</p>
        <input type="text" name="user_bid" placeholder="N..." />
    </label>
    <p><input type="submit"></p>
</form>
<p>Or, do you think you remember? <a href="login.php">Click here to try logging in again.</a></p>
<?php include('skeleton.foot.php') ?>
