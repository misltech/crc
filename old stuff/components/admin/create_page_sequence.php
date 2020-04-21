<?php
include_once('component_template.head.php');
include_once('components/drop_down.php');
include_once('backend/util.php');
modalHead("createSequence");
?>

<div class="modal-header">
    <h1>Set Page Sequence</h1>
</div>
<form action="backend/admin/create_page_sequence.php" method="post">
    <label>
        <p>Give the course a name:</p>
        <input type="text" name="sequenceName" />
    </label>
    <label>
        <p>What is the department code?</p>
        <input type="text" name="deptCode" />
    </label>
</form>



<?php
include('component_template.foot.php');
?>