<?php


/**
 * This is where the applications would show up for a chair to accept or reject. Never Implemented
 */


if (!isset($_SESSION)) {
    session_start();
}

include_once '../backend/util.php';
include_once 'components/header.php';
include_once 'components/sidebar.php';
include_once 'components/topnav.php';
?>

<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Create a User</h1>
        <p class="lead">You can generate a single new user here. (Not implemented)</p>
        <hr class="my-4">
    </div>
</div>


<?php
include_once 'components/footer.php';
?>