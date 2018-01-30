<?php

session_start();
    if(isset($_POST["Id"]) && $_POST["Id"]!="")    	
    {
    	$_SESSION["eid"]=$_POST["Id"];
	}
?>