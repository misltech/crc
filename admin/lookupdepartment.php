<?php
if (!isset($_SESSION)) {
  session_start();
}

include_once('../newback/util.php');
include_once('../newback/db_con3.php');
include_once('components/header.php');
include_once('components/sidebar.php');
include_once('components/topnav.php');

?>

<div class="container">

  <div class="container ">
    <div class="jumbotron">
      <h1 class="display-4">Modify Departments</h1>
      <p class="lead">You can modify a department email/user permissions here.</p>
      <hr class="my-4">

      <div class="d-flex justify-content-center mt-5">
        <form>
          <div class="form-group row">
            <label for="select" class="col-3 col-form-label"> Select a Department</label>
            <div class="col-9">
              <select id="select" name="select" class="custom-select">
                <?php

                if (validateState($GLOBALS['admin_type'])) { //redirects if not an admin or session not found
                  $sql = "SELECT dept_code, dept_name FROM s20_academic_dept_info";
                  $query = mysqli_query($db_conn, $sql);
                  $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                  $count = mysqli_num_rows($query);
                  if ($count == 0) {

                ?>
                    //display no departments


                    <?php } else {
                    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                      $deptcode = $row['dept_code'];
                      $deptname = $row['dept_name'];
                    ?>

                      <option value="<?php echo $deptcode; ?>"><?php echo $deptname; ?></option>

                <?php }
                  }
                } else {
                  redirect(null);
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-3 col-9">
              <button name="submit" type="submit" class="btn btn-primary">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php

  include_once('components/footer.php');

  

  ?>
