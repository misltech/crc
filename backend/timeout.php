<?php

if(time() - $_SESSION['timestamp'] > 900) { //subtract new timestamp from the old one
    redirect("inactive");
  } else {
    $_SESSION['timestamp'] = time(); //set new timestamp
  }

?>