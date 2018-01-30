<?php
include('../include/dbConfig.php');
session_start();

$sql = "SELECT * FROM business_master";
$result = $conn->query($sql);

$Business_Name=$_POST["Business_Name"];
$id=$result->num_rows+1;

	if($_POST["IsActive"]=='selected')
		$IsActive=1;
	else
		$IsActive=0;

$stmt = $conn->prepare("INSERT INTO business_master (Business_Id, Business_Name, IsActive) VALUES (?, ?, ?)");
$stmt->bind_param("isi", $Business_Id, $Business_Name,$IsActive);

$Business_Id=$id;
$Business_Name=$Business_Name;
$IsActive=$IsActive;
	if($stmt->execute())
	{
		$conn->close();
		header('Location: ../admin-create-businessunit');
		exit();
	}
	else
	{
        $_SESSION["Error_Code"]="984";
        header('Location: ../error');
        exit();
	}
?>