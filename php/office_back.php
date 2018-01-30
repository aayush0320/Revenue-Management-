<?php
include('../include/dbConfig.php');
session_start();

$sql = "SELECT * FROM office_master";
$result = $conn->query($sql);

	if($_REQUEST["IsActive"]=='selected')
		$IsActive=1;
	else
		$IsActive=0;

$stmt = $conn->prepare("INSERT INTO office_master (Office_Id, Office_Name, Office_Address, Country_Id, IsActive, Zone) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issiis", $Office_Id, $Office_Name, $Office_Address, $Country_Id, $IsActive, $Zone);

$Office_Name=$_REQUEST["Office_Name"];
$Office_Id=$result->num_rows+1;
$Office_Address=$_REQUEST["Office_Address"];
$IsActive=$IsActive;
$Country_Id=$_REQUEST["Country_Name"];
$Zone=$_REQUEST["Zone"];

if($stmt->execute())
	{
		$conn->close();
		$_SESSION["success"] = 1;
		header('Location: ../admin-create-office');
		exit();
	}
else
{
		$conn->close();
		$_SESSION["success"] = 0;
		header('Location: ../admin-create-office');
		exit();
        // $_SESSION["Error_Code"]="980";
        // header('Location: ../error.php');
        // exit();	
}
?>