<?php
    include("../backend/util.php");

    // include necessary js
    ?>
        <script src="javascript/autofill.js"></script>
    <?php

    /**
     * Generates an input box that will, on change, output suggestions.
     * The actual processing of populating items as the user types is done client-side.
     * The list of items is returned as server-side JSON.
     * 
     * @param string $table_name        Name of the SQL table to use.
     * @param string $table_column      Column of the SQL table to use.
     * @param string $name              Name of the input textbox.
     * @return string       A UUID for the textbox. Its HTML ID will be "autofill-box-<UUID>".
     */
    function autofill_box($table_name, $table_column, $name)
    {
        $uuid = generatePassword(8); ?>
            <input type="text" name="<?php echo($name); ?>" id="autofill-box-<?php echo($uuid); ?>" />
        <?php

        include('backend/db_conn2.php');

        $sql = "SELECT $table_column FROM $table_name";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $tempName = utf8_encode($row[$table_column]);
            $resultArray[] = $tempName;
        } ?>
            <script>
                autocomplete(document.getElementById("autofill-box-<?php echo($uuid); ?>"), <?php echo(json_encode($resultArray)); ?>);
            </script>
        <?php

        return $uuid;
    }

    /**
     * Generates an input box that will, on change, output suggestions.
     * The actual processing of populating items as the user types is done client-side.
     * The list of items is returned as server-side JSON.
     * 
     * The only items that the client sees are those that meet the specified condition.
     * 
     * @param string $table_name        Name of the SQL table to use.
     * @param string $table_column      Column of the SQL table to use.
     * @param string $name              Name of the input textbox.
     * @param string $condition         SQL condition that items have to meet.
     * @return string       A UUID for the textbox. Its HTML ID will be "autofill-box-<UUID>".
     */
    function autofill_box_conditional($table_name, $table_column, $name, $condition) {
        $uuid = generatePassword(8); ?>
            <input type="text" name="<?php echo($name); ?>" id="autofill-box-<?php echo($uuid); ?>" />
        <?php

        include('backend/db_conn2.php');

        $sql = "SELECT $table_column FROM $table_name WHERE $condition";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $tempName = utf8_encode($row[$table_column]);
            $resultArray[] = $tempName;
        } ?>
            <script>
                autocomplete(document.getElementById("autofill-box-<?php echo($uuid); ?>"), <?php echo(json_encode($resultArray)); ?>);
            </script>
        <?php

        return $uuid;
    }
?>