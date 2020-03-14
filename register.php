<?php include('skeleton.head.php') ?>
<h2>Register</h2>

<form method="post" action="backend/server.php">
    <label>
        <p>Student ID</p>
        <input type="text" name="studentId" value="<?php echo $studentId; ?>">
    </label>
    <label>
        <p>Email</p>
        <input type="email" name="email" value="<?php echo $email; ?>">
    </label>
    <label>
        <p>Password</p>
        <input type="password" name="password_1" id="pass_1" onchange="check_pass()" onkeyup="check_pass()">
    </label>
    <label>
        <p>Confirm password</p>
        <input type="password" name="password_2" id="pass_2" onchange="check_pass()" onkeyup="check_pass()">
    </label>
    <input type="submit" name="reg_user" value="Register" id="submit" />
    <label id="message" style="display: none; visiblility: hidden;"></label>
</form>
<script src="javascript/password_checker.js"></script>
<script>
    // autofill is not a smart tool
    check_pass();
</script>
<?php include('skeleton.foot.php'); ?>
