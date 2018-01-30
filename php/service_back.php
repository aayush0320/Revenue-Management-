<?php
include('../include/dbConfig.php');
session_start();

$sql = "SELECT * FROM service_master";
$result = $conn->query($sql);

$Service_Name=$_REQUEST["Service_Name"];
	
	if($_REQUEST["IsActive"]=='selected')
		$IsActive=1;
	else
		$IsActive=0;
$id=$result->num_rows+1;

$stmt = $conn->prepare("INSERT INTO service_master (Service_Id, Service_Name, Product_Id, IsActive) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $Service_Id, $Service_Name, $Product_Id, $IsActive);

$Service_Id=$id;
$Service_Name=$Service_Name;
$Product_Id=$_REQUEST["Product_Name"];
$IsActive=$IsActive;

	if($stmt->execute())
	{
		$conn->close();
		 header('Location: ../admin-create-service');
		 exit();
	}
	else
	{
        $_SESSION["Error_Code"]="982";
        header('Location: ../error');
        exit();		
	}
?>