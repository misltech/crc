<?php

$currentTypeOrder = $userOrder[$userKey];

// Used to display User Sequence

for ($j=0; $j<=$length; $j++) {
    echo "<option";
        if ($j == $currentTypeOrder) {
            echo " selected value='".$j."'>";
        }
        else {
            echo " value='".$j."'>";
        }
    if ($j != 0){
        echo $j."</option>";
    }
    else {
        echo "Do Not Use</option>";
    }
}

?>