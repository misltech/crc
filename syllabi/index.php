<?php 
    // if this file doesn't exist: apache will allow everyone to get the entirety
    // of the contents in this folder. So, we just re-direct them to the right index.php
    // as a bit of a gesture.
    header("Location: ../index.php");
?>