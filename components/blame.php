<?php
    /**
     * Simply echoes the blame status.
     *
     * @param string $id        The id of the fieldwork application to report about.
     */
    function include_blame_logic($id)
    {
        include('../backend/db_conn2.php');
        
        $sql = "SELECT assigned_to FROM s20_application_info WHERE fw_id = '$id'";

        $result = $conn->query($sql);

        $assigned_to_email = "";

        while ($row = $result->fetch_assoc()) {
            $assigned_to_email = $row['assigned_to'];
        }

        if ($assigned_to_email == 'recreg'){
            $user_type = 'recreg';
        } else {

        $sql = "SELECT profile_type FROM s20_UserPass WHERE email = '$assigned_to_email'";

        $result = $conn->query($sql);

        $user_type = "";


        while ($row = $result->fetch_assoc()) {
            $user_type = $row['profile_type'];
        } 
        }
        $message = "<p>";

        if ($_SESSION['user_type'] === 'student') {
            if ($user_type === 'student') {
                $message .= "This one's waiting on you.";
            } elseif($user_type == 'recreg'){
                $message .= "The application has been approved. It is now being processed by Records & Registration.";
            } else {
                $message .= "The application is assigned to your $user_type.";
            }
        } else {
            $message .= "The application is assigned to the $user_type.";
        }

        $message .= "</p>";

        echo $message; ?>
<?php
    }
?>