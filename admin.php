<?php

session_start();
include_once('backend/util.php');
//checkUserType("admin");
include('skeleton.head.php');
?>

<h1>Admin Tools</h1>
<hr/>
<!-- Code used to test user search capability -->


<!-- If Value Returned Display User Data here -->

<?php
/* 
if (isset($_SESSION['search_results'])) {
    $user_id = $_SESSION['search_results']['profile_id'];
    $email = $_SESSION['search_results']['email'];
    $type = $_SESSION['search_results']['profile_type'];
    $password = $_SESSION['search_results']['passcode'];


    ?>
<h2> User Login Credentials </h2>

<form method="post" action="backend/profile.php">
    <label>
        <p>Student ID</p>
        <input type="text" name="studentId" value="<?php echo $user_id; ?>">
    </label>
    <label>
        <p>Email</p>
        <input type="text" name="email" value="<?php echo $email; ?>">
    </label>
    <label>
        <p>Password</p>
        <input type="text" name="password" value="<?php echo $password; ?>">
    </label>
    <label>
        <p>Profile Type</p>
        <input type="text" name="user_type" value="<?php echo $type; ?>">
    </label>
    <input type="submit" name="submit_type" value="View Profile">
    <input type="submit" name="submit_type" value="Remove User">
    <input type="submit" name="submit_type" value="Update User">
</form>
<?php

    //will display user profile information here if previous submit button selected
}

if (isset($_SESSION['search_profile']) && ($email == $_SESSION['search_profile']['email'])) {

    // sort by profile type as different options appear for students, faculty and employers

    if ($type == 'student') {
        $first = $_SESSION['search_profile']['f_name'];
        $last = $_SESSION['search_profile']['l_name'];
        $middle = $_SESSION['search_profile']['m_initial'];
        $telephone = $_SESSION['search_profile']['phone_number'];
        $address = $_SESSION['search_profile']['street_address'];
        $aptNum = $_SESSION['search_profile']['apt_num'];
        $city = $_SESSION['search_profile']['city'];
        $state = $_SESSION['search_profile']['state'];
        $zip = $_SESSION['search_profile']['zipcode'];

        // unset($_SESSION['search_results']);
        //  unset($_SESSION['search_profile']);

        // Student profile HTML code goes here
        ?>
</div>
<div class="container">
    <!-- start a new container -->
    <h2> Profile Information </h2>
    <form>
        <label>
            <p>First Name:</p>
            <input type="text" id="fname" name="firstname" value=<?php echo $first ?>>
        </label>

        <label>
            <p>Last Name:</p>
            <input type="text" id="lname" name="lastname" value=<?php echo $last ?>>
        </label>

        <label>
            <p>Middle Initial:</p>
            <input type="text" id="midinitial" name="middleinitial" value=<?php echo $middle ?>>
        </label>

        <label>
            <p>Phone Number:</p>
            <input type="tel" id="telnum" name="telnum" value=<?php echo $telephone ?>>
        </label>

        <label>
            <p>Address:</p>
            <input type="text" id="address" name="address" value=<?php echo $address ?>>
        </label>

        <label>
            <p>Apartment Number:</p>
            <input type="text" id="aptnum" name="apartmentnumber" value=<?php echo $aptNum ?>>
        </label>

        <label>
            <p>City:</p>
            <input type="text" id="city" name="city" value=<?php echo $city ?>>
        </label>

        <label>
            <p>State:</p>
            <input type="text" id="state" name="state" value=<?php echo $state ?>>
        </label>

        <label>
            <p>Zipcode:</p>
            <input type="text" id="zipcode" name="zipcode" value=<?php echo $zip ?>>
        </label>

        <input type="submit" value="Update" disabled>
    </form>
    <?php
    } elseif ($type == 'secretary' || $type == 'instructor' || $type == 'chair' || $type == 'dean') {
        // Set variables from session array here
        // HTML code to display profile info below
        ?>
    <?php
    } elseif ($type == 'employer') { }
} else {
    //if search_result != search_profile unset search_profile
    unset($_SESSION['search_profile']);
}
*/
?>
    <h2>User Tools</h2>
    <p>
        <button type="button" class="half-width" data-toggle="modal" data-target="#searchUser">
            Look Up 🔎
        </button>
        <button type="button" class="half-width" data-toggle="modal" data-target="#createUser">
            Create 📝
        </button>
    </p>

    <hr />
    <h2>Department Tools</h2>

    <p>
        <button type="button" class="half-width" data-toggle="modal" data-target="#lookupDept">
            Look Up 🔎
        </button>
        <button type="button" class="half-width" data-toggle="modal" data-target="#createDept">
            Create 📝
        </button>
    </p>
    <hr/>
    <h2>Courses/Sequences</h2>

    <p>
        <button type="button" class="half-width" onclick="window.location.href=<?php echo('\'' . API_URL . 'create_user_sequence.php\''); ?>">
            Create Course ➕
        </button>
        <button type="button" class="half-width" onclick="window.location.href=<?php echo('\'' . API_URL . 'edit_user_sequence.php\''); ?>">
            Edit Course 📝
        </button>
    </p>
    <hr/>
    <h2>Workflows/Applications</h2>

    <p>
        <button type="button" class="half-width" data-toggle="modal" data-target="#viewAllWF">
            View All ▤
        </button>
        <button type="button" class="half-width" data-toggle="modal" data-target="#lookupWF">
            Look Up 🔎
        </button>
        <!--<button type="button" class="half-width" data-toggle="modal" data-target="#createWF">
            Add/Create 📝
        </button>-->
    </p>

    <?php

    include_once('components/admin/component_template.head.php');
    include('components/admin/create_user.php');
    include('components/admin/search_user.php');
    include('components/admin/create_department.php');
    include('components/admin/dept_lookup.php');
    include('components/admin/display_workflow.php');
    include('components/admin/lookup_workflow.php');

    ?>

    <script>
        function check_pass() {
            if (document.getElementById('passcode').value == document.getElementById('passcode_chk').value) {
                document.getElementById('message').innerHTML = '';
                document.getElementById("submit").disabled = false;
            } else {
                document.getElementById('submit').disabled = true;
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Passwords do not match';
            }
        }
    </script>
    <?php include('skeleton.foot.php'); ?>




