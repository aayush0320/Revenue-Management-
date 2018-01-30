<?php
	session_start();
	include '../include/dbConfig.php';

	$member=$_REQUEST["Team_Member_Id"];
	$Team_Member_Id=substr($member,0,10);
	$Role = $_REQUEST["Role"];

	echo $Team_Member_Id;

	$stmt = $conn->query("SELECT IsMember from employee_master WHERE Employee_Id = '".$Team_Member_Id."'");
	$stmt1=$stmt->fetch_assoc();
	$no = $stmt1["IsMember"]+1;

	$stmt = $conn->prepare("INSERT INTO team_member_master (Id, Team_Name, Team_Member_Id, Role, IsActive) VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param("issii", $Id, $Team_Name, $Team_Member_Id, $Role, $IsActive);

	$result = $conn->query("SELECT * FROM team_member_master");
	$Id = $result->num_rows;
	$Team_Name = $_SESSION["modify_team_1"];
	$Team_Member_Id = $Team_Member_Id;
	$Role = $_REQUEST["Role"];
	$IsActive = 1 ;

	if($stmt->execute())
	{
		$stmt=$conn->query("UPDATE employee_master SET IsMember = ".$no." WHERE Employee_Id = '".$Team_Member_Id."'");
		if($stmt)
		{
			header ('location:admin-team-modify1');
			exit();			
		}
		else
		{
			$_SESSION["Error_Code"]="988";
			header('Location: ../error');
			exit();
		}
	}
	else
	{
		$_SESSION["Error_Code"]="989";
		header('Location: ../error');
		exit();
	}
?>