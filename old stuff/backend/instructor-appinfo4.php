<?php
    include('util.php');
    consoleLog('util working');
       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
    checkUserType("instructor");
    
    if (!isset($_SESSION["user_id"])) {
        setMessage(false, "Could not get department.");
        consoleLog("No dept");
        // header("Location: ../home.php");
    } else {
        // $targetFile = SYLLABI_DIR.$_SESSION["user_id"].basename($_FILES["file"]["tmp_name"]);
        $file_name = $_FILES["file"]["name"];
        $targetLoc = SYLLABI_DIR.$_SESSION["user_id"]."/";
        $shouldUpload = 1;
        consoleLog($targetFile);
        
        // Check if it exists
        if (file_exists($targetFile)) {
            setMessage(false, "This file already exists.");
            consoleLog("File already exists");
            header("Location: ../instructor-review4.php");
            $shouldUpload = 0;
        }

        // Check the size
        if ($_FILES["file"]["size"] > SYLLABI_MAX_SIZE) {
            setMessage(false, "File too big. Must not exceed ".SYLLABI_MAX_SIZE." bytes.");
            consoleLog("File too big");
            header("Location: ../instructor-review4.php");
            $shouldUpload = 0;
        }
        // if ($shouldUpload === 1) {
        //     if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        //         setMessage(true, "File uploaded.");
        //         header("Location: sequence-controller.php");
        //     } else {
        //         setMessage(false, "Sorry, your file couldn't be uploaded. Try again.");
        //         header("Location: ../instructor-review4.php");
        //     }
        // }

        if ($shouldUpload === 1) {
            $temp_name = $_FILES["file"]["tmp_name"];
            if (move_uploaded_file($temp_name, $targetLoc.$file_name)) {
                setMessage(true, "File uploaded.");
                consoleLog("File uploaded");
                header("Location: sequence-controller.php");
            } else {
                setMessage(false, "Sorry, your file couldn't be uploaded. Try again.");
                consoleLog("Upload failed");
                header("Location: ../instructor-review4.php");
            }
        }
    }
?>
