<?php
       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    include_once('backend/util.php');

    $id = generatePassword(8);

    if (isset($_SESSION["msg_success"])) {
        if ($_SESSION["msg_success"] === "1" || $_SESSION["msg_success"] === 1 || $_SESSION["msg_success"] === true) {
            ?>
            <div class="container success" id="fw-message-<?php echo $id ?>"><p><span style="float: left;">✔️</span>
            <?php
        } else {
            ?>
            <div class="container failure" id="fw-message-<?php echo $id ?>"><p><span style="float: left;">❌</span>
            <?php
        }
        
        // shared html?>
        
        <?php echo $_SESSION["msg"]; ?></p>
        <button type="button" class="close" aria-label="Close" onclick="removeMessage('<?php echo $id ?>')">
            <span aria-hidden="true">&times;</span>
        </button>
            </div>

        <?php

        clearMessage();
    }
?>