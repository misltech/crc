<?php
session_start();

include 'backend/util.php';

include('skeleton.head.php');

// unset($_SESSION['fw_id']);

if (!isset($_SESSION["user_type"])) {
    header("Location: login.php");
} else if ($_SESSION["user_type"] === "admin") {
    header("Location: admin.php");
}

echo "<h1>Your Applications</h1>";
echo "<div id='applications'></div>";

// so this is going to be an eventual auto-fill with the correct page sort of system
// really, this just checks user type and sees which type the user is, then imports
// the correct page

// if this isn't set, it boots back to login.php
/*
if (isset($_SESSION["user_type"])) {
*/
    switch ($_SESSION["user_type"]) {
        case 'student': {
            $_SESSION['page_key'] = 'home1';
            break;
        }
        case 'instructor': {
            $_SESSION['page_key'] = 'home2';
            break;
        }case 'employer': {
            $_SESSION['page_key'] = 'home3';
            break;
        }
        case 'chair': {
            $_SESSION['page_key'] = 'home4';
            break;
        }
        case 'dean': {
            $_SESSION['page_key'] = 'home5';
            break;
        }
        case 'recreg': {
            $_SESSION['page_key'] = 'home6';
            break;
        }
        // case 'secretary': {
        //     $_SESSION['page_key'] = 'home7';
        //     break;
        // }
        default: {
            header("Location: login.php");
            break;
        }
    }
/*} else {
    include('login.php');
}
*/
?>
<script>
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("applications").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "backend/listApplications.php", true);
			xhttp.send();
</script>
<?php

include('skeleton.foot.php');

?>
