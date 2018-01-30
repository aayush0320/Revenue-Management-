<?php

include('../include/dbConfig.php');
 
if($_POST["BPS"]=="Business"){
    //Get all state data
    $query = $conn->query("SELECT * FROM business_master");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display business list
    if($rowCount > 0){
        echo '<option>Select Business Unit</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['Business_Id'].'">'.$row['Business_Name'].'</option>';
        }
    }else{
        echo '<option value="">Business Unit not available</option>';
	}
}
if($_POST["BPS"]=="Product"){
	echo '<option value="">Select Business Unit First</option>';
}

if($_POST["BPS"]=="Service"){
	echo '<option value="">Select Product First</option>';
}

?>