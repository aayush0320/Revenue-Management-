<?php
    session_start();
    include '../include/dbConfig.php';

    if(isset($_POST["Proposal_Id"]) && $_POST["Proposal_Id"]!="")    	
    {
    	$stmt = $conn->query("SELECT * from proposal_master WHERE Proposal_Id = '".$_POST["Proposal_Id"]."'");
    	if($stmt->num_rows==1)
    	{
    		$_SESSION["copy_proposal"]=$_POST["Proposal_Id"];
    		header('Location: ../proposal-create');
			exit();    		
    	}
    	else
    	{
    		header('Location: ../proposal-list');
			exit();    		
    	}

	}
?>