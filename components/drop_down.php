<?php
include_once('backend/util.php');

/**
 * Given a column of a table and a table to choose from,
 * output a combo box of options from that table.
 *
 * @param  string $from_column      Column of values to choose from.
 * @param  string $from_table       Table that the column is in.
 * @return string A unique ID suffix for that drop-down.
 */
function drop_down($from_column, $from_table)
{
    $sql = "SELECT $from_column FROM $from_table";
    $uuid = generatePassword(8); ?>
    <select id="<?php echo $uuid; ?>" name="<?php echo $uuid; ?>">
        <?php


        include('backend/db_conn2.php');

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $data = $row[$from_column];
            echo "<option value=\"$data\">$data</option>";
        } ?>
    </select>
    <?php
    return $uuid;
}

/**
 * Given a column of a table and a table to choose from,
 * output a combo box of options from that table SO LONG AS
 * they follow the SQL conditon specified.
 *
 * @param  string $from_column      Column of values to choose from.
 * @param  string $from_table       Table that the column is in.
 * @param  string $condition        Will only select values that follow this condition. This is an SQL string.
 * @return string A unique ID suffix for that drop-down.
 */
function drop_down_conditional($from_column, $from_table, $condition)
{
    $sql = "SELECT $from_column FROM $from_table WHERE $condition";
    $uuid = generatePassword(8); ?>
    <select id="<?php echo $uuid; ?>" name="<?php echo $uuid; ?>">
        <?php


        include("backend/db_conn2.php");

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $data = $row[$from_column];
            echo "<option value=\"$data\">$data</option>";
        } ?>
    </select>
    <?php
    return $uuid;
}

function two_col_drop_down($from_column, $from_column_two, $from_table)
{
    $sql = "SELECT * FROM $from_table";
    $uuid = generatePassword(8); ?>
    <select id="<?php echo $uuid; ?>" name="<?php echo $uuid; ?>">
        <?php
    
        include('backend/db_conn2.php');
        
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            $data = $row[$from_column];
            $student_sql = "SELECT student_first_name, student_last_name FROM s20_student_info WHERE student_email = '$data'";
            $student_result = $conn->query($student_sql);
            $s_row = $student_result->fetch_assoc();
            $data_first = $s_row['student_first_name'];
            $data_last = $s_row['student_last_name'];
            $data_two = $row[$from_column_two];
            $id = $row['fw_id'];
            echo "<option class=$id value=\"$id\">$data_first $data_last --- $data_two</option>";
        } ?>
    </select>
    <?php
    return $uuid;
}

?>