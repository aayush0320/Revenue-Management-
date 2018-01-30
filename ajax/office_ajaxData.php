<?php
include('../include/dbConfig.php');
 
if(isset($_POST["Country_Name"]) && !empty($_POST["Country_Name"])){
    //Get all state data
    $query = $conn->query("SELECT * FROM office_master WHERE IsActive = 1 and Country_Id = ".$_POST["Country_Name"]);
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select Office</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['Office_Id'].'">'.$row['Office_Name'].'</option>';
        }
    }else{
        echo '<option value="">Office not available</option>';
    }
}

if(isset($_POST["Office_Name"]) && !empty($_POST["Office_Name"]))
{
    //Get all state data
    $query = $conn->query("SELECT * FROM employee_master WHERE Employee_Designation = 1 AND IsActive = 1 and Office_Id = ".$_POST["Office_Name"]);
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0)
    {
        echo '<option value="">Select CS Executive </option>';
        while($row = $query->fetch_assoc())
        { 
            echo '<option value="'.$row['Employee_Id'].'">'.$row['Employee_Name'].'</option>';
        }
    }
    else
    {
        echo '<option value="">CS Executive not available</option>';
    }
}

if(isset($_POST["CS_Executive_Id"]) && !empty($_POST["CS_Executive_Id"]))
{
    //Get all state data
    $query = $conn->query("SELECT * FROM team_master WHERE IsActive = 1 and CS_Executive_Id = '".$_POST["CS_Executive_Id"]."'");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0)
    {
        echo '<option value=""> Select Team Name </option>';
        while($row = $query->fetch_assoc())
        { 
            echo '<option value="'.$row['Team_Name'].'">'.$row['Team_Name'].'</option>';
        }
    }
    else
    {
        echo '<option value="">Team not available</option>';
    }
}
?>