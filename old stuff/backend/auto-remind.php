<?php

include('util.php');

include('db_conn2.php');

$sql = "SELECT assigned_to, name, assigned_when FROM s20_application_info";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $fiveDaysAgo = strtotime("-5 days");
    $sevenDaysAgo = strtotime("-7 days");
    while ($row = $result->fetch_assoc()) {
        $assignTime = strtotime($row["assigned_when"]);
        if ($assignTime <= $fiveDaysAgo) { // in other words, "before 5 days ago"
            $email = $row["assigned_to"];
            $name = $row["name"];
            $userType = "";

            $sql = "SELECT profile_type FROM s20_UserPass WHERE email = '$email'";
            $resultB = $conn->query($sql);

            if ($resultB->num_rows > 0) {
                while ($rowY = $resultB->fetch_assoc()) {
                    $userType = $rowY["profile_type"];
                }
            }

            $message = "";

            if ($userType === "student" && $assignTime <= $sevenDaysAgo) {
                $message = "Hi! We noticed that you didn't update your information for your field work form," .
                            " and it's been a while now.\n" .
                            "You should log back in to the system and keep working on the application for " .
                            $name . ".\n" .
                            "Thank you!";
                sendEmail($email, "Reminder about $name", $message);
                echo "Sent $email (student) a reminder for $name.\n";
            } else if ($userType !== "student") {
                $message = "Hi! We wanted to remind you that it's your turn to process the field work form in " .
                            "relation to $name. You should log in to the system and update it! Thank you!";
                sendEmail($email, "Reminder about $name", $message);
                echo "Sent $email ($userType) a reminder for $name.\n";
            }
        }
    }
}
