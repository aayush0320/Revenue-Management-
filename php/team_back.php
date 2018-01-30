<?php

session_start();
include('../include/dbConfig.php');

    $i = $_SESSION["total_records"];
    $temp = 0;
$stmt = $conn->prepare("INSERT INTO team_master (Team_Name, IsActive, CS_Executive_Id, Team_Leader_Id, Role, Country_Id, Office_Id)VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sissiii", $Team_Name, $IsActive, $CS_Executive_Id, $Team_Leader_Id, $Role, $Country_Id ,$Office_Id);


$Team_Name = $_REQUEST["Team_Name"];
if($_REQUEST["IsActive"]=='selected')
	$IsActive=1;
else
	$IsActive=0;
$Country_Id = $_REQUEST["Country_Name"];
$Office_Id = $_REQUEST["Office_Name"];
$CS_Executive_Id = $_REQUEST["CS_Executive_Id"];
$cs=$_REQUEST["Team_Leader_Id"];
$Team_Leader_Id = substr($cs,0,10);
$Role = $_REQUEST["Role"];

	if($stmt->execute())
	{
		$stmt=$conn->query("SELECT IsMember from employee_master WHERE Employee_Id = '".$Team_Leader_Id."'");
		$temp1=$stmt->fetch_assoc();
		$number = $temp1["IsMember"] + 1;

		$result=$conn->query("UPDATE employee_master SET IsMember = ".$number." WHERE Employee_Id ='".$Team_Leader_Id."'");

		if($result)
		{
			if($i>1)
			{
				$stmt = $conn->prepare("INSERT INTO team_member_master (Id, Team_Name, IsActive, Team_Member_Id, Role) VALUES (?, ?, ?, ?, ?)");
				$stmt->bind_param("isisi", $Id, $Team_Name, $IsActive, $Team_Member_Id, $Role);

				while($temp <= $i-2)
				{				
					$result=$conn->query("SELECT * FROM team_member_master");
					$Id = $result->num_rows;
					$Team_Name = $_REQUEST["Team_Name"];
					if($_REQUEST["IsActive"]=='selected')
						$IsActive=1;
					else
						$IsActive=0;
					$cs=$_REQUEST['Team_Member_Id'][$temp];
					$Team_Member_Id = substr($cs,0,10);
					$Role = $_REQUEST['role'][$temp];
					if($stmt->execute())
					{

						$stmt1=$conn->query("SELECT IsMember from employee_master WHERE Employee_Id = '".$Team_Member_Id."'");
						$temp1=$stmt1->fetch_assoc();
						$number = $temp1["IsMember"] + 1;

						$result1=$conn->query("UPDATE employee_master SET IsMember = ".$number." WHERE Employee_Id ='".$Team_Member_Id ."'");
						if($result1)
						{
							$temp=$temp+1;
						}
					}
					else
					{
						$_SESSION["Error_Code"]="985";
						header('Location: ../error');
						exit();
					}
				}
			}
		}

		else
		{
			$_SESSION["Error_Code"]="986";
			header('Location: ../error');
			exit();		
		}
	}
	else
	{
		$_SESSION["Error_Code"]="987";
		header('Location: ../error');
		exit();
	}
	$_SESSION["success"] = 1;
	header('Location: ../admin-team-creation');
	exit();
?>