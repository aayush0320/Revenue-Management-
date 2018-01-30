<?php
	include '../include/dbConfig.php';

	$stmt = $conn->query("UPDATE proposal_master SET IsActive = 1 WHERE Proposal_Id = '".$_POST["Proposal_Id"]."'");

	if($stmt)
	{
		$conn->close();		
		header('Location: ../admin-dashboard');
		exit();				
	}
	else
	{
		$conn->close();		
        $_SESSION["Error_Code"]="949";
		header('Location: ../error');
		exit();	
	}
?>