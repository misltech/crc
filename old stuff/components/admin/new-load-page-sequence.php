<?php
       if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

// Assign local variable from GET request

    $deptKey = $_GET['key'];
    //$_SESSION['dept'] = $deptKey;

// Connect to Database

    include('../../backend/db_conn2.php');

    
    include('../../backend/util.php');

        $deptCode_query = "SELECT dept_code FROM s20_academic_dept_info WHERE name = '$deptKey'";
        $deptCode_result = $conn->query($deptCode_query);
        $deptCode_result = $deptCode_result->fetch_assoc();
        $dept_code = $deptCode_result['dept_code'];
        $_SESSION['dept'] = $dept_code;

        include('../linkArray.php');

        $sql_pageSeq = "SELECT * FROM s20_progress_tracker WHERE dept_code='$dept_code'";

        $currentProgress = $conn->query($sql_pageSeq);

        if ($currentProgress->num_rows > 0) {

            $currentProgress = $currentProgress->fetch_assoc();

            $home1 = $currentProgress['home1'];
			$student1 = $currentProgress['student1'];
			$student2 = $currentProgress['student2'];
			$student3 = $currentProgress['student3'];
			$student4 = $currentProgress['student4'];
			$home2 = $currentProgress['home2'];
			$instructor1 = $currentProgress['instructor1'];
			$instructor2 = $currentProgress['instructor2'];
			$instructor3 = $currentProgress['instructor3'];
			$instructor4 = $currentProgress['instructor4'];
			$instructor5 = $currentProgress['instructor5'];
			$home3 = $currentProgress['home3'];
			$employer1 = $currentProgress['employer1'];
			$home4 = $currentProgress['home4'];
			$chair1 = $currentProgress['chair1'];
			$home5 = $currentProgress['home5'];
			$dean1 = $currentProgress['dean1'];
			$home6 = $currentProgress['home6'];

/* Optional for extra pages, commented out when not in use

			$extra1 = $currentProgress['extra1'];
			$extra2 = $currentProgress['extra2'];
			$extra3 = $currentProgress['extra3'];
			$extra4 = $currentProgress['extra4'];
			$extra5 = $currentProgress['extra5'];
			$extra6 = $currentProgress['extra6'];
			$extra7 = $currentProgress['extra7'];
			$extra8 = $currentProgress['extra8'];
			$extra9 = $currentProgress['extra9'];
*/
// build array to determine next link
			$order[$home1] = "home1";
			$order[$student1] = "student1";
			$order[$student2] = "student2";
			$order[$student3] = "student3";
			$order[$student4] = "student4";
			$order[$home2] = "home2";
			$order[$instructor1] = "instructor1";
			$order[$instructor2] = "instructor2";
			$order[$instructor3] = "instructor3";
			$order[$instructor4] = "instructor4";
			$order[$instructor5] = "instructor5";
			$order[$home3] = "home3";
			$order[$employer1] = "employer1";
			$order[$home4] = "home4";
			$order[$chair1] = "chair1";
			$order[$home5] = "home5";
			$order[$dean1] = "dean1";
			$order[$home6] = "home6";			

/*
			$order[$extra1] = "extra1";
			$order[$extra2] = "extra2";
			$order[$extra3] = "extra3";
			$order[$extra4] = "extra4";
			$order[$extra5] = "extra5";
			$order[$extra6] = "extra6";
			$order[$extra7] = "extra7";
			$order[$extra8] = "extra8";
			$order[$extra9] = "extra9";
*/

            $pageArray = array('home1', 'student1', 'student2', 'student3', 'student4', 'home2', 'instructor1', 'instructor2',
                        'instructor3', 'instructor4', 'instructor5', 'home3', 'employer1', 'home4', 'chair1', 'home5', 'dean1', 'home6',
                        'extra1', 'extra2', 'extra3', 'extra4', 'extra5', 'extra6', 'extra7', 'extra8', 'extra9');

            $length = count($pageArray);
            $orderLength = count($order);
            //echo("<div class=orderLength id=".$orderLength."></div>");
            //echo("<div class=linkNamesLength id=".count($linkNames)."></div>");

            $orderCorrection = array();

            for ($k = 0; $k < $length; $k++) {
                $temp = $pageArray[$k];

// Check in linkArray if user specific pages need to be included

                if (!isset($linkNames[$temp])) {
                    $orderKey = array_search($temp, $order);
                    unset($order[$orderKey]);
                    unset($pageArray[$k]);
                }
            }
            
            $orderLengthChk = count($order);

// check if order needs to be adjusted

            if ($orderLength > $orderLengthChk) {
                $seqCount = 1;
                $temp = array();
                for ($i = 1; $i <= $orderLength; $i++) {
                    $i2String = strval($i);
                    if (isset($order[$i2String])) {
                        $orderVal = $order[$i2String];
                        $temp[$seqCount] = $orderVal;
                        $seqCount++;
                    }
                }
                for ($i = 1; $i <= $orderLength; $i++) {
                    $i2String = strval($i);
                    if (isset($temp[$i])) {
                        $order[$i2String] = $temp[$i];
//                        echo $order[$i2String]."<br>";
                    }
                    else {
                        unset($order[$i2String]);
                    }
                }
            }
            
?>
    <form action="backend/admin/set-page-sequence.php" method="post">
        <table>
            <tr>
                <th>Page Order:</th>
                <th>Page Description:</th>
                <th>Header 3</th>   
            </tr>
<?php
            $length = count($order);
            //echo("<div class=postSortLength id=".$length."></div>");
            $seqlength = count($pageArray);
            $idKey = 1;
            for ($i = 1; $i <= $length; $i++) {
                $i2String = strval($i);
                $pageKey = $order[$i2String];
                $pageDesc = $linkDesc[$pageKey];

                echo "<tr ondrop='onDrop(event)' ondragover='onDragover(event)'>";
                echo "<td>";
                if ($pageKey == 'home1' || $pageKey == 'home2' || $pageKey == 'home3' || $pageKey == 'home4' || $pageKey == 'home5' || $pageKey == 'home6') {
                    echo "<select id=seq_".$idKey." name='".$pageKey."' onchange='update(this.value, ".$idKey.")'>";
                }
                else {
                    echo "<select id=seq_".$idKey." name='".$pageKey."' onchange='update(this.value, ".$idKey.")'>";
                }
                $idKey++;
// Load Select Options
                for ($j=0; $j<=$seqlength; $j++) {
                    echo "<option";
                    if ($j == $i) {
                        echo " selected value='".$j."'>";
                    }
                    else {
                        echo " value='".$j."'>";
                    }
                    if ($j != 0) {
                        echo $j."</option>";
                    }
                    else {
                        echo "Do Not Use</option>";
                    }    
                }
                echo "</select></td><td id='$pageKey' draggable='true' ondragstart='onDragStart(event)' ondrop='onDrop(event)' ondragover='onDragover(event)'>".$pageDesc."</td></tr>";
// Remove $pageKey from pageArray
                $arrayKey = array_search($pageKey, $pageArray);
                unset($pageArray[$arrayKey]);
            }

// Display Extra Pages, set all as Do Not Use
            foreach ($pageArray as $tableRow) {
                echo "<tr><td>".$tableRow."</td>";
                echo "<td><select name='".$tableRow."'>";
                    echo "<option value='0' selected>Do Not Use</option>";
                    for ($i=1; $i <=$seqlength; $i++) {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                echo "</select></td>";    
                }

?>
        </table>
        <input type="hidden" name="dept" value="<?php echo($dept_code); ?>">
        <input type="submit" value='Update Page Sequence'></form>
<?php
        }
 //    var_dump($order);

    $conn->close();
    unset($_SESSION['dept']);

?>

<script>
function onDragStart(event){
    event.dataTransfer.setData('text/plain', event.target.id);

    event.currentTarget.style.backgroundColor='blue';
}

function onDragover(event){
    event.preventDefault();
}

function onDrop(event){
    const id = event.dataTransfer.getData('text');
    const draggableElement = document.getElementById(id);
    const dropzone = event.target;

    dropzone.appendChild(draggableElement);

    event.dataTransfer.clearData();
}

</script>