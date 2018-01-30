<?php

session_start();
    if(isset($_POST["data"]) && $_POST["data"]!="")    	
    {
    	$_SESSION["total_records"]=$_POST["data"];
	}
?>