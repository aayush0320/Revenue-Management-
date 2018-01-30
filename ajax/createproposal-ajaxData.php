<?php
//Include database configuration file
include('../include/dbConfig.php');
 
if(isset($_POST["Business_Name"]) && !empty($_POST["Business_Name"])){
    //Get all state data
    $query = $conn->query("SELECT * FROM product_master WHERE IsActive = 1 and Business_Id = ".$_POST['Business_Name']);
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select Product</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['Product_Id'].'">'.$row['Product_Name'].'</option>';
        }
    }else{
        echo '<option value="">Product not available</option>';
    }
}
 
if(isset($_POST["Product_Name"]) && !empty($_POST["Product_Name"])){
    //Get all city data
    $query = $conn->query("SELECT * FROM service_master WHERE IsActive = 1 and Product_Id = ".$_POST['Product_Name']);
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Select Service</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['Service_Name'].'">'.$row['Service_Name'].'</option>';
        }
    }else{
        echo '<option value="">Service not available</option>';
    }
}
?>