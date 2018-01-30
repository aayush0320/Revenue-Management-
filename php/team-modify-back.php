<?php
	session_start();
	if($_REQUEST["Team_Name"]!="" && $_REQUEST["CS_Executive_Id"]!="" && $_REQUEST["Country_Name"]!="" && $_REQUEST["Office_Name"]!="")
	{
		$_SESSION["modify_team_1"]=$_REQUEST["Team_Name"];
		$_SESSION["modify_team_2"]=$_REQUEST["CS_Executive_Id"];	
		$_SESSION["modify_team_3"]=$_REQUEST["Country_Name"];		
		$_SESSION["modify_team_4"]=$_REQUEST["Office_Name"];
		header('Location: admin-team-modify1');
		exit();			
	}
?>