<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once('../newback/util.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');
?>

<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Create a workflow</h1>
    <p class="lead">You can generate a new workflow by departments here. This is hard to debug, will implement outsource</p>
    <hr class="my-4">

    <style>
      .sideBySide .left,
      .sideBySide .right {
        display: inline-block;
        width: 230px;
        padding: 0;
        margin: 0;
      }

      .sideBySide .right {
        display: inline-block;
        width: 230px;
        padding: 0;
        margin: 0;
      }

      ul.source,
      ul.target {
        min-height: 50px;
        margin: 0px 25px 10px 0px;
        padding: 2px;
        border-width: 1px;
        border-style: solid;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        list-style-type: none;
        list-style-position: inside;
      }

      ul.source {
        border-color: #f8e0b1;
      }

      ul.target {
        border-color: #add38d;
      }

      .source li,
      .target li {
        margin: 5px;
        padding: 5px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
      }

      .source li {
        background-color: #fcf8e3;
        border: 1px solid #fbeed5;
        color: #c09853;
      }

      .target li {
        background-color: #ebf5e6;
        border: 1px solid #d6e9c6;
        color: #468847;
      }

      .sortable-dragging {
        border-color: #ccc !important;
        background-color: #fafafa !important;
        color: #bbb !important;
      }

      .sortable-placeholder {
        height: 40px;
      }

      .source .sortable-placeholder {
        border: 2px dashed #f8e0b1 !important;
        background-color: #fefcf5 !important;
      }

      .target .sortable-placeholder {
        border: 2px dashed #add38d !important;
        background-color: #f6fbf4 !important;
      }
    </style>
    <div class="sideBySide" style="  min-height: 260px;
    margin-top: 10px;
    margin-bottom: 10px; width: 50%;
    margin: 0 auto;">
      <div class="left ">
        <h6>Available </h6>
        <ul class="source">
          <li>Student</li>
          <li>Instructor</li>
          <li>Employer</li>
          <li>Department Chair</li>
          <li>Dean</li>
          <li>Records & Registration</li>
        </ul>
      </div>
      <div class="right">
        <h6>Modify</h6>
        <ul class="target connected">
        </ul>
      </div>
    </div>

    <div class="mt-5">
      <input class="btn btn-primary btn-block" type="submit" value='Save Workflow Order'>
    </div>
  </div>
</div>



<script src="../js/sequence.js"></script>
<?php
include_once('components/footer.php');
?>