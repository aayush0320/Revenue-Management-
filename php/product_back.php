<?php
include('../include/dbConfig.php');
session_start();

$sql = "SELECT * FROM product_master";
$result = $conn->query($sql);
	
	if($_REQUEST["IsActive"]=='selected')
		$IsActive=1;
	else
		$IsActive=0;

$Product_Id=$result->num_rows+1;

$stmt = $conn->prepare("INSERT INTO product_master (Product_Id, Product_Name, Business_Id, IsActive) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $Product_Id, $Product_Name, $Business_Id, $IsActive);

$Product_Id=$Product_Id;
$Product_Name=$_REQUEST["Product_Name"];
$Business_Id=$_REQUEST["Business_Name"];
$IsActive=$IsActive;

	if($stmt->execute())
	{
		$conn->close();
		header('Location: ../admin-create-product');
		exit();
	}
	else
	{
        $_SESSION["Error_Code"]="983";
        header('Location: ../error');
        exit();		
	}
?>