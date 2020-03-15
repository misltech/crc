<?php

// Resume Existing Session

   if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include('skeleton.head.php');
include_once('backend/util.php');

// Assign fw_id variable from session

$searchKey = $_SESSION['fw_id'];
$empEmail = $_SESSION['emp_email'];
unset($_SESSION['edit_return']);

// Connect to DB and build MySQL query to pull employer info;

include('backend/db_conn2.php');
include('backend/check-permissions.php');

$_SESSION['page_key'] = "instructor2";

$sql = "SELECT * from s20_employer_info where employer_email='$empEmail'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $result = $result->fetch_assoc();

?>

<h1>Review Application Info:</h2>
    <br>
    <hr>
    <form method="post" action="backend/instructor-appinfo2.php">

        <h3>Employer Information:</h3>
        
            <table>
                <tr>
                    <th>Attribute:</th>
                    <th>Your Response:</th>
                </tr>
                <tr>
                    <td>Business Name</td>
                    <td><?php echo $result['business_name'];?></td>
                </tr>
                <tr>
                    <td>Supervisor's Name</td>
                    <td><?php echo $result['first_name']." ".$result['last_name'];?></td>
                </tr>
                <tr>
                    <td>Supervisor's Email</td>
                    <td><?php echo $result['employer_email'];?></td>
                </tr>
                <tr>
                    <td>Telephone Number</td>
                    <td><?php echo $result['phone_number'];?></td>
                </tr>
                <tr>
                    <td>Street Address</td>
                    <td><?php echo $result['street_address'];?></td>
                </tr>
                <tr>
                    <td>City, State, Zipcode</td>
                    <td><?php echo $result['city'].", ".$result['state'].", ".$result['zipcode'];?></td>
                </tr>
            </table>
<?php
// Show edit button if permission is allowed

        if ($empInfo == '1') {
            $_SESSION['edit_return'] = 'instructor-review2.php';
?>
            <button id="edit_employerInfo" type="button" onclick="window.location.href=<?php echo('\'' . API_URL . 'student-application2.php\''); ?>" class="btn btn-primary">Edit</button>
<?php
        }
?>
            <input type="hidden" name="emp_id" value="<?php echo $result['employer_id'] ?>">

            <?php include('components/accept_reject.php'); includeARComponent(); ?>

            <input type="submit" value="Submit">
    </form>
<?php
}

$conn->close();

include('skeleton.foot.php');

?>
