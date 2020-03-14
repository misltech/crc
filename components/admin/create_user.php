<?php
include_once('component_template.head.php');
modalHead("createUser");
?>
<div class="modal-header">
    <h1>Create User</h1>
</div>
<form action="backend/admin/create-user.php" method="post">
    <label>
        <p>E-mail Address:</p>
        <input type="text" name="email" placeholder="Email Address">
    </label>
    <label>
        <p>Banner ID:</p>
        <input type="text" name="user_id" placeholder="Banner ID">
    </label>
    <label>
        <p>Password:</p>
        <input type="password" name="passcode" id="passcode" placeholder="Password">
    </label>
    <label>
        <p>Confirm Password:</p>
        <input type="password" name="passcode_chk" id="passcode_chk" placeholder="Verify Password" onkeyup='check_pass();'>
    </label>
    <label>
        <p>User Type:</p>
        <select name="profile_type">
            <option value="student">Student</option>
            <option value="secretary">Secretary</option>
            <option value="instructor">Instructor</option>
            <option value="employer">Employer</option>
            <option value="chair">Dept Chair</option>
            <option value="dean">Dean</option>
            <option value="admin">Admin</option>
            <option value="recreg">Records & Registration</option>
        </select>
    </label>
    <p id="message"></p>
    <!-- <input type="submit" id="submit" value="Submit" disabled> -->
    <input type="submit" id="submit" value="Submit">
</form>
<?php
include('component_template.foot.php');
?>