<?php

// Resume existing session

session_start();
include('util.php');

$faculty[] = 'instructor'; 
$faculty[] = 'secretary';
$faculty[] = 'chair'; 
$faculty[] = 'dean';

// Check User types for faculty

checkUserTypeOfMultiple($faculty);

// Connect to DB and build MySQL query

include('db_conn2.php');

$search_key = $_SESSION['id_key'];

$sql = "SELECT * from s20_faculty_info where email='$search_key'";

$profile_info = $conn->query($sql);

if($profile_info->num_rows > 0){
        $profile_info = $profile_info->fetch_assoc();

        $sql_dept_info = "SELECT dept_code, name from s20_academic_dept_info";
        $depts = $conn->query($sql_dept_info);
        
        while($data = $depts->fetch_assoc()){
                $dept_info[$data['dept_code']] = $data['name'];
        }

        //var_dump($dept_info);

        if($profile_info['dept_1'] != null){
                $key1 = $profile_info['dept_1'];
                $dept1 = "<option value='$key1' id='dept_1'>$dept_info[$key1]</option>";   
        }
        else{
                $dept1 = "<option value=''>Select a Department</option>";
        }
        if($profile_info['dept_2'] != null){
                $key2 = $profile_info['dept_2'];
                $dept2 = "<option value='$key2' id='dept_2'>$dept_info[$key2]</option>";                
        }
        else{
                $dept2 = "<option value=''>Select a Department</option>";
        }
        if($profile_info['dept_3'] != null){
                $key3 = $profile_info['dept_3'];
                $dept3 = "<option value='$key3' id='dept_3'>$dept_info[$key3]</option>";               
        }
        else{
                $dept3 = "<option value=''>Select a Department</option>";
        }
        if($profile_info['dept_4'] != null){
                $key4 = $profile_info['dept_4'];
                $dept4 = "<option value='$key4' id='dept_4'>$dept_info[$key4]</option>";               
        }
        else{
                $dept4 = "<option value=''>Select a Department</option>";
        }

        echo "<form method='post' action='backend/submit-faculty.php'>";

                echo "<input type='hidden' name='query_type' value='update'>";

                echo "<label><p>First Name:</p>";
                echo "<input type='text' name='firstname' value='".$profile_info['f_name']."'></label>";

                echo "<label><p>Last Name:</p>";
                echo "<input type='text' name='lastname' value='".$profile_info['l_name']."'></label>";

                echo "<label><p>Middle Initial:</p>";
                echo "<input type='text' name='minitial' value='".$profile_info['m_initial']."'></label>";

                echo "<label><p>Phone Number:</p>";
                echo "<input type='text' name='telnum' value='".$profile_info['phone_number']."'></label>";

                echo "<label><p>Office Hours:</p>";
                echo "<input type='text' name='officeHours' value='".$profile_info['office_hours']."'></label>";

                echo "<label><p>Department:</p>";
                echo "<select id='dept1' name='PrimaryDept' onchange='showDept2()'  onclick='hide1()'>";
                //echo "<option value=''>Select a Department</option>";
                echo $dept1;
                        include('loadDepartments.php');
                echo "</select></label>";
                
                echo "<label id='Dept2'";
                
                if($profile_info['dept_2'] == null){
                        echo "style='display: none'";
                }
                
                echo "><p>Department:</p>";
                echo "<select id='dept2' name='SecondaryDept' onchange='showDept3()' onclick='hide2()'>";
                echo $dept2;
                        include('loadDepartments.php');
                echo "</select></label>";
        
                echo "<label id='Dept3' ";
                
                if($profile_info['dept_3'] == null){
                        echo "style = 'display:none'";
                }

                echo "><p>Department:</p>";
                echo "<select id='dept3' name='TertiaryDept' onchange='showDept4()' onclick='hide3()'>";
                echo $dept3;
                        include('loadDepartments.php');
                echo "</select></label>";
        
                echo "<label id='Dept4'";
                
                if($profile_info['dept_4'] == null){
                        echo "style='display: none'";
                }
                
                echo "><p>Department:</p>";
                echo "<select id='dept4' name='QuaternaryDept'  onclick='hide4()'>";
                echo $dept4;
                        include('loadDepartments.php');
                echo "</select></label>";
        
                echo "<input type='submit' value='update'>";
        echo "</form>";

}
else{
        echo "<form method='post' action='backend/submit-faculty.php'>";

                echo "<input type='hidden' name='query_type' value='insert'>";

                echo "<label><p>First Name:</p>";
                echo "<input type='text' name='firstname'></label>";

                echo "<label><p>Last Name:</p>";
                echo "<input type='text' name='lastname'></label>";

                echo "<label><p>Middle Initial:</p>";
                echo "<input type='text' name='minitial'></label>";

                echo "<label><p>Phone Number:</p>";
                echo "<input type='text' name='telnum'></label>";

                echo "<label><p>Office Hours:</p>";
                echo "<input type='text' name='officeHours'></label>";

                echo "<label><p>Department:</p>";
                echo "<select id='dept1' name='PrimaryDept' onchange='showDept2()'>";
                echo "<option value=''>Select a Department</option>";
                        include('loadDepartments.php');
                echo "</select></label>";
                
                echo "<label id='Dept2' style='display: none'><p>Department:</p>";
                echo "<select name='SecondaryDept' onchange='showDept3()'>";
                echo "<option value=''>Select a Department</option>";
                        include('loadDepartments.php');
                echo "</select></label>";

                echo "<label id='Dept3' style='display: none'><p>Department:</p>";
                echo "<select name='TertiaryDept' onchange='showDept4()'>";
                echo "<option value=''>Select a Department</option>";
                        include('loadDepartments.php');
                echo "</select></label>";

                echo "<label id='Dept4' style='display: none'><p>Department:</p>";
                echo "<select name='QuaternaryDept'>";
                echo "<option value=''>Select a Department</option>";
                        include('loadDepartments.php');
                echo "</select></label>";    

                echo "<input type='submit' value='insert'>";
        echo "</form>";
}

$conn->close();

?>

