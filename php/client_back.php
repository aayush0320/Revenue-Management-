<?php
include('../include/dbConfig.php');
session_start();


if(isset($_SESSION["mod_client"]) && $_SESSION["mod_client"]!="")
{

	$Client_Name=$_REQUEST["Client_Name"];
	$Client_Group=$_REQUEST["Client_Group"];
	$Industry_Group=$_REQUEST["Industry_Group"];
	$Client_Address=$_REQUEST["Client_Address"];
	$Client_Office_No=$_REQUEST["Client_Office_No"];
	$Client_Personal_No=$_REQUEST["Client_Personal_No"];
	$Client_Email=$_REQUEST["Client_Email"];
	$Country_Id=$_REQUEST["Country_Name"];


	$result=$conn->query("UPDATE client_master SET Client_Name='".$Client_Name."' , Client_Group='".$Client_Group."' , Industry_Group='".$Industry_Group."' , Client_Address='".$Client_Address."' , Client_Office_No='".$Client_Office_No."' , Client_Personal_No='".$Client_Personal_No."' , 
		Client_Email='".$Client_Email."' , Country_Id='".$Country_Id."' WHERE Client_Name='".$_SESSION["mod_client"]."'");

	if($result)
	{
		$_SESSION['mod_client']="";
		$conn->close();		
		$_SESSION["success"] = 1;
		header('Location: ../admin-create-client');
		exit();
	}
	else
	{
		$conn->close();		
		$_SESSION["success"] = 0;
		header('Location: ../admin-create-client');
		exit();
		// $_SESSION["Error_Code"]="1000";
		// header('Location: ../error.php');
		// exit();
	}
}
else
{
	$sql = "SELECT * FROM client_master";
	$result = $conn->query($sql);



	$stmt = $conn->prepare("INSERT INTO client_master (Client_Id, Client_Name, Client_Group, Industry_Group, Client_Address, Client_Office_No, Client_Personal_No, Client_Email, Country_Id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("issssssss", $Client_Id, $Client_Name, $Client_Group, $Industry_Group, $Client_Address, $Client_Office_No, $Client_Personal_No, $Client_Email, $Country_Id);

	$Client_Id=$result->num_rows+1;
	$Client_Name=$_REQUEST["Client_Name"];
	$Client_Group=$_REQUEST["Client_Group"];
	$Industry_Group=$_REQUEST["Industry_Group"];
	$Client_Address=$_REQUEST["Client_Address"];
	$Client_Office_No=$_REQUEST["Client_Office_No"];
	$Client_Personal_No=$_REQUEST["Client_Personal_No"];
	$Client_Email=$_REQUEST["Client_Email"];
	$Country_Id=$_REQUEST["Country_Name"];

	if($stmt->execute())
	{
		$conn->close();
		$_SESSION["success"] = 1;
		header('Location: ../admin-create-client');
		exit();
	}
	else
	{
		$conn->close();		
		$_SESSION["success"] = 0;
		header('Location: ../admin-create-client');
		exit();		
  //       $_SESSION["Error_Code"]="964";
		// header('Location: ../error.php');
		// exit();
	}
}
?>