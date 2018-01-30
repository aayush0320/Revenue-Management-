<?php
	session_start();
	include '../include/dbConfig.php';
	$cs=$_REQUEST["CS_Executive_Id"];
	$cs1=substr($cs,0,10);
	echo $cs1;
	$stmt = $conn->query("UPDATE team_master set CS_Executive_Id = '".$cs1."' WHERE Team_Name = '".$_SESSION["modify_team_1"]."'");

	if($stmt)
	{
		$stmt= $conn->query("UPDATE proposal_master set CS_Executive_Id = '".$cs1."' WHERE Team_Name = '".$_SESSION["modify_team_1"]."'");
		if($stmt)
		{
			header ('location:admin-team-modify1');
			exit();
		}
		else
		{
			$_SESSION["Error_Code"]="990";
			header('Location: ../error');
			exit();

		}
	}
	else
	{
		$_SESSION["Error_Code"]="991";
		header('Location: ../error');
		exit();

	}

?>