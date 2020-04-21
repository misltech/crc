<?php
    /**
     * Echoes a progress bar onto the current page (with correct progress filled in.)
     * 
     * @param string $id        The fieldwork ID to report about.
     */
    function include_progress_bar($id)
    {
        include('../backend/db_conn2.php');

        // so uh, we're kinda missing db logic to test for a complete application...
        // when we implement that, we can add another field to our query
        // and check it -- if true, don't execute the second query; just break
        
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

        // set $value to be something between 0 and 100
        $value = 0; 

        switch ($user_type) {
            case "instructor": {
                // step 1
                $value = 16.66666666666667;
                break;
            }
            case "employer": {
                // step 2
                $value = 33.33333333333333;
                break;
            }
            case "chair": {
                // step 3
                $value = 50;
                break;
            }
            case "dean": {
                // step 4
                $value = 66.66666666666667;
                break;
            }
            // we're also missing a user type for crc
            case "crc": {
                // step 5
                $value = 83.33333333333333;
                break;
            }
            case "recreg":{
                $value = 100;
                break;
            }
            case "student":
            default: {
                $value = 0;
                break;
            }
        }
        ?>
<div class="progress">
    <div id="myBar" class="progress-bar" role="progressbar" style="width: <?php echo($value) ?>%"
        aria-value="<?php echo($value) ?>" aria-valuemin="0" aria-valuemax="100">
    </div>
</div>
    <?php
    } ?>