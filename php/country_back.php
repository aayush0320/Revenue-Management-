<?php
include('../include/dbConfig.php');
session_start();

$sql = "SELECT * FROM country_master";
$result = $conn->query($sql);

	if($_REQUEST["IsActive"]=='selected')
		$IsActive=1;
	else
		$IsActive=0;

$stmt = $conn->prepare("INSERT INTO country_master (Country_Id, Country_Name, Region_Id, IsActive) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $Country_Id, $Country_Name, $Region_Id, $IsActive);

$Country_Name=$_REQUEST["Country_Name"];
$Country_Id=$result->num_rows+1;
$Region_Id=$_REQUEST["Region_Name"];
$IsActive=$IsActive;

if($stmt->execute())
	{
		$conn->close();
		$_SESSION["success"] = 1;
		header('Location: ../admin-create-country');
		exit();
	}
else
{
		$conn->close();
		$_SESSION["success"] = 0;
		header('Location: ../admin-create-country');
		exit();
        // $_SESSION["Error_Code"]="981";
        // header('Location: ../error.php');
        // exit();	
}
?>