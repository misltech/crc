<?php
    $userLabels = array('Student', 'Instructor', 'Employer', 'Department Chair', 'Dean', 'Records & Registration');
    $userTypes = array('student', 'instructor', 'employer', 'chair', 'dean', 'recreg');

    include('../db_conn2.php');

    $deptKey = $_GET['key'];

    $sql_usrSeq = "SELECT * FROM s20_user_sequence WHERE dept_code='$deptKey'";

//    echo $sql_usrSeq;

    $userOrder = $conn->query($sql_usrSeq);

    if ($userOrder->num_rows > 0) {
        $userOrder = $userOrder->fetch_assoc();
?>        
    <div class=row>
    <div class=col-md-6 id=oldUserSequence>
    <h2>Button Selection</h2>
        <?php
            $length = count($userTypes);
            for ($i=0; $i<6; $i++) {
                $idKey = $i+1;
                $userLabel = $userLabels[$i];
                $userKey = $userTypes[$i];
                echo "<div class=\"col-md-12 dragTarget buttonHolder\" id=oldStep".$idKey." ondrop=drop(event) ondragover=allowDrop(event)>Button Placeholder";
                echo "<div class=\"col-md-12 sequenceButton\" id=".$userLabel." draggable=true ondragstart=drag(event)>";
                    echo "<b>".strtoupper($userLabel)."</b>";
                echo "</div></div>";
            }
        ?>
       
    </div>
    <div class=col-md-6 id=newUserSequence>
        <h2>Workflow Order</h2>
        <div class="col-md-12 dragTarget buttonHolder" id=newStep1 ondrop=drop(event) ondragover=allowDrop(event)>Step 1</div>
        <div class="col-md-12 dragTarget buttonHolder" id=newStep2 ondrop=drop(event) ondragover=allowDrop(event)>Step 2</div>
        <div class="col-md-12 dragTarget buttonHolder" id=newStep3 ondrop=drop(event) ondragover=allowDrop(event)>Step 3</div>
        <div class="col-md-12 dragTarget buttonHolder" id=newStep4 ondrop=drop(event) ondragover=allowDrop(event)>Step 4</div>
        <div class="col-md-12 dragTarget buttonHolder" id=newStep5 ondrop=drop(event) ondragover=allowDrop(event)>Step 5</div>
        <div class="col-md-12 dragTarget buttonHolder" id=newStep6 ondrop=drop(event) ondragover=allowDrop(event)>Step 6</div>
    </div> 
    </div>
        <input type="submit" value='Save Workflow Order'>
<?php        
    }
    $conn->close();

?>
