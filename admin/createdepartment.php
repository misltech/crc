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
    <h1 class="display-4">Create a Department</h1>
    <p class="lead">You can generate a new department here.</p>
    <hr class="my-4">

    <div class="d-flex justify-content-center mt-5 mb-3">

      <form>
        <div class="form-group">
          <label for="text">Department Name</label>
          <input id="text" name="text" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="text1">Department Code</label>
          <input id="text1" name="text1" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="text2">Department Email</label>
          <input id="text2" name="text2" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="text3">Chair Email</label>
          <input id="text3" name="text3" type="text" class="form-control">
        </div>
        <hr>
        <div class="mt-3 mb-3">
          <legend>Permissions</legend>
        </div>
        <div class="form-group">
          <label>Instructors can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm1" id="perm1_0" type="checkbox" class="custom-control-input" value="">
              <label for="perm1_0" class="custom-control-label">modify course info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm1" id="perm1_1" type="checkbox" class="custom-control-input" value="">
              <label for="perm1_1" class="custom-control-label">modify project info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm1" id="perm1_2" type="checkbox" class="custom-control-input" value="">
              <label for="perm1_2" class="custom-control-label">modify employer info</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Employers can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm2" id="perm2_0" type="checkbox" class="custom-control-input" value="">
              <label for="perm2_0" class="custom-control-label">modify project info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm2" id="perm2_1" type="checkbox" class="custom-control-input" value="">
              <label for="perm2_1" class="custom-control-label">modify learning objectives</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Department Chairs can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_0" type="checkbox" class="custom-control-input" value="">
              <label for="perm3_0" class="custom-control-label">modify course info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_1" type="checkbox" class="custom-control-input" value="">
              <label for="perm3_1" class="custom-control-label">modify project info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_2" type="checkbox" class="custom-control-input" value="">
              <label for="perm3_2" class="custom-control-label">modify employer info</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="perm3" id="perm3_3" type="checkbox" class="custom-control-input" value="">
              <label for="perm3_3" class="custom-control-label">modify learning objectives</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="mt-3 mb-3">
          <legend>Email Settings</legend>
        </div>
        <div class="form-group">
          <label>Students can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em1" id="em1_0" type="checkbox" class="custom-control-input" value="">
              <label for="em1_0" class="custom-control-label">receive email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em1" id="em1_1" type="checkbox" class="custom-control-input" value="">
              <label for="em1_1" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Instructors can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em2" id="em2_0" type="checkbox" class="custom-control-input" value="">
              <label for="em2_0" class="custom-control-label">receive email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em2" id="em2_1" type="checkbox" class="custom-control-input" value="">
              <label for="em2_1" class="custom-control-label">receive rejection emails</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em2" id="em2_2" type="checkbox" class="custom-control-input" value="">
              <label for="em2_2" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Department Chairs can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em3" id="em3_0" type="checkbox" class="custom-control-input" value="">
              <label for="em3_0" class="custom-control-label">receive email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em3" id="em3_1" type="checkbox" class="custom-control-input" value="">
              <label for="em3_1" class="custom-control-label">receive rejection emails</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em3" id="em3_2" type="checkbox" class="custom-control-input" value="">
              <label for="em3_2" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label>Deans can</label>
          <div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em4" id="em4_0" type="checkbox" class="custom-control-input" value="rabbit">
              <label for="em4_0" class="custom-control-label">recieve email updates</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em4" id="em4_1" type="checkbox" class="custom-control-input" value="duck">
              <label for="em4_1" class="custom-control-label">receive rejection emails</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
              <input name="em4" id="em4_2" type="checkbox" class="custom-control-input" value="fish">
              <label for="em4_2" class="custom-control-label">receive reminder emails</label>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <button name="submit" type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>
  <?php
  include_once('components/footer.php');
  ?>