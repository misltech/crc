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

    <!-- <div class="row">
      <div class="col-md-6" id="oldUserSequence">
        <h2 class="text-center">Old Workflow</h2>
        <div class="col-md-12 dragTarget buttonHolder" id="oldStep1" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div class="col-md-12 sequenceButton" id="Student" draggable="true" ondragstart="drag(event)">
            <b>STUDENT</b>
          </div>
        </div>
        <div class="col-md-12 dragTarget buttonHolder" id="oldStep2" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div class="col-md-12 sequenceButton" id="Instructor" draggable="true" ondragstart="drag(event)">
            <b>INSTRUCTOR</b></div>
        </div>
        <div class="col-md-12 dragTarget buttonHolder" id="oldStep3" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div class="col-md-12 sequenceButton" id="Employer" draggable="true" ondragstart="drag(event)"><b>EMPLOYER</b></div>
        </div>
        <div class="col-md-12 dragTarget buttonHolder" id="oldStep4" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div class="col-md-12 sequenceButton" id="Department" chair="" draggable="true" ondragstart="drag(event)"><b>DEPARTMENT CHAIR</b></div>
        </div>
        <div class="col-md-12 dragTarget buttonHolder" id="oldStep5" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div class="col-md-12 sequenceButton" id="Dean" draggable="true" ondragstart="drag(event)"><b>DEAN</b></div>
        </div>
        <div class="col-md-12 dragTarget buttonHolder" id="oldStep6" ondrop="drop(event)" ondragover="allowDrop(event)">
          <div class="col-md-12 sequenceButton" id="Records" &="" registration="" draggable="true" ondragstart="drag(event)"><b>RECORDS &amp; REGISTRATION</b></div>
        </div>
      </div>
      <div class="col-md-6" id="newUserSequence">
        <h2 class="text-center">Workflow Order</h2>
        <div class="col-md-12 dragTarget buttonHolder" id="newStep1" ondrop="drop(event)" ondragover="allowDrop(event)">Step 1</div>
        <div class="col-md-12 dragTarget buttonHolder" id="newStep2" ondrop="drop(event)" ondragover="allowDrop(event)">Step 2</div>
        <div class="col-md-12 dragTarget buttonHolder" id="newStep3" ondrop="drop(event)" ondragover="allowDrop(event)">Step 3</div>
        <div class="col-md-12 dragTarget buttonHolder" id="newStep4" ondrop="drop(event)" ondragover="allowDrop(event)">Step 4</div>
        <div class="col-md-12 dragTarget buttonHolder" id="newStep5" ondrop="drop(event)" ondragover="allowDrop(event)">Step 5</div>
        <div class="col-md-12 dragTarget buttonHolder" id="newStep6" ondrop="drop(event)" ondragover="allowDrop(event)">Step 6</div>
      </div>
    </div> -->

    <!-- <div id="example3-right" class="list-group col">
      <div class="list-group-item ">Student
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="list-group-item ">Instructor
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="list-group-item ">Employer
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="list-group-item ">Department Chair
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="list-group-item ">Dean
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="list-group-item ">Records and Registration
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div> -->


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