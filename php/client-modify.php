<?php

session_start();
    if(isset($_POST["Client_Name"]) && $_POST["Client_Name"]!="")    	
    {
    	$_SESSION["mod_client"]=$_POST["Client_Name"];
		header('Location: ../admin-create-client');
		exit();
	}
?>