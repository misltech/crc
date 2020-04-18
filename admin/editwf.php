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

    <div id="example3-right" class="list-group col">
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
    </div>

    <div class="container">
    <div class="sideBySide">
  <div class="left">
    <ul class="source">
      <li>Alfa Romeo</li>
      <li>Audi</li>
      <li>BMW</li>
      <li>Ford</li>
      <li>Jaguar</li>
      <li>Mercedes</li>
      <li>Porsche</li>
      <li>Tesla</li>
      <li>Volkswagen</li>
      <li>Volvo</li>
    </ul>
  </div>
  <div class="right">
    <ol class="target">
      <li class="placeholder">Drop your favourites here</li>
    </ol>
  </div>
</div>
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