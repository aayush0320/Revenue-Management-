<?php
	session_start();
	include '../include/dbConfig.php';
	
	$stmt = $conn->query("SELECT Team_Leader_Id from team_master WHERE Team_Name = '".$_SESSION["modify_team_1"]."'");
	$stmt1=$stmt->fetch_assoc();
	$Team_Leader_Id = $stmt1["Team_Leader_Id"];

	$stmt = $conn->query("SELECT IsMember from employee_master WHERE Employee_Id = '".$Team_Leader_Id."'");
	$stmt1=$stmt->fetch_assoc();
	$no = $stmt1["IsMember"]-1;	

	$stmt=$conn->query("UPDATE employee_master SET IsMember = ".$no." WHERE Employee_Id = '".$Team_Leader_Id."'");
	if(!$stmt)
	{
		$_SESSION["Error_Code"]="992";
		header('Location: ../error');
		exit();
	}

	$member=$_REQUEST["Team_Leader_Id"];
	$Team_Leader_Id=substr($member,0,10);
	$Role = $_REQUEST["Role"];

	$stmt = $conn->query("UPDATE team_master SET Team_Leader_Id = '".$Team_Leader_Id."', Role = '".$Role."' WHERE Team_Name = '".$_SESSION["modify_team_1"]."'");
	if(!$stmt)
	{
		$_SESSION["Error_Code"]="993";
		header('Location: ../error');
		exit();
	}

	$stmt = $conn->query("SELECT IsMember from employee_master WHERE Employee_Id = '".$Team_Leader_Id."'");
	$stmt1=$stmt->fetch_assoc();
	$no = $stmt1["IsMember"]+1;	

	$stmt=$conn->query("UPDATE employee_master SET IsMember = ".$no." WHERE Employee_Id = '".$Team_Leader_Id."'");
	if(!$stmt)
	{
		$_SESSION["Error_Code"]="994";
		header('Location: ../error');
		exit();
	}

	$stmt=$conn->query("UPDATE proposal_master SET Team_Leader_Id = '".$Team_Leader_Id."' WHERE Team_Name = '".$_SESSION["modify_team_1"]."'");
	if(!$stmt)
	{
		$_SESSION["Error_Code"]="995";
		header('Location: ../error');
		exit();
	}

	header ('location:admin-team-modify1');
	exit();			

?>