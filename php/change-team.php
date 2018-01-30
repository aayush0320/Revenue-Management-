<?php

$type=$_GET["type"];
$id=$_GET["id"];
$team=$_GET["team"];
$role=$_GET["role"];

include('../include/dbConfig.php');
session_start();

	if($type=="l")
		{
			if($role==1)
				$role=0;
			else
				$role=1;
			$result=$conn->query("UPDATE team_master SET Role = ".$role." WHERE Team_Name = '".$team."' AND Team_Leader_Id = '".$id."'");
			if($result)
			{
				header('Location: admin-team-modify1');
				exit();				
			}
			else
			{		
				$_SESSION["Error_Code"]="996";
				header('Location: ../error');
				exit();
			}
		}
	else
		{
			if($role==1)
				$role=0;
			else
				$role=1;			
			$result=$conn->query("UPDATE team_member_master SET Role = ".$role." WHERE Team_Name = '".$team."' AND Team_Member_Id = '".$id."'");
			if($result)
			{
				header('Location: admin-team-modify1');
				exit();				
			}
			else
			{
				$_SESSION["Error_Code"]="997";
				header('Location: ../error');
				exit();
			}
		}
?>