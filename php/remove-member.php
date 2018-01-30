<?php
	session_start();
	include '../include/dbConfig.php';

	$Team_Member_Id="";
	if(isset($_GET["team"]) && $_GET["team"]!="")
	{
		$Team_Member_Id = $_GET["team"];
	}

	$stmt = $conn->query("SELECT IsMember from employee_master WHERE Employee_Id = '".$Team_Member_Id."'");
	$stmt1=$stmt->fetch_assoc();
	$no = $stmt1["IsMember"]-1;	

	$stmt=$conn->query("UPDATE employee_master SET IsMember = ".$no." WHERE Employee_Id = '".$Team_Member_Id."'");
	if(!$stmt)
	{
		$_SESSION["Error_Code"]="998";
		header('Location: ../error');
		exit();
	}

	$stmt=$conn->query("UPDATE team_member_master SET IsActive = 0 WHERE Team_Member_Id = '".$Team_Member_Id."'");
	if(!$stmt)
	{
		$_SESSION["Error_Code"]="999";
		header('Location: ../error');
		exit();
	}

	header ('location:admin-team-modify1');
	exit();
?>