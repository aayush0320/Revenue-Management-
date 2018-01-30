<?php

session_start();
    if(isset($_POST["Employee_Id"]) && $_POST["Employee_Id"]!="")    	
    {
    	$cs=$_POST["Employee_Id"];;
    	$_SESSION["mod_emp"] = substr($cs,0,10);
		header('Location: ../admin-create-employee');
		exit();
	}
?>