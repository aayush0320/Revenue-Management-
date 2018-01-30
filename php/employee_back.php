<?php
include('../include/dbConfig.php');
session_start();

if(isset($_SESSION["mod_emp"]) && $_SESSION["mod_emp"]!="")
{
	$Employee_Name=$_REQUEST["Employee_Name"];
	if($_REQUEST["IsActive"]=='selected')
		$IsActive=1;
	else
		$IsActive=0;	
	$Country_Id=$_REQUEST["Country_Name"];
	$Office_Id=$_REQUEST["Office_Name"];
	$Department_Id=$_REQUEST["Department"];
	$Last_Modified=date("d/m/Y h:i:s a");
	$Email=$_REQUEST["Email"];
	$Employee_Dob=$_REQUEST["Employee_Dob"];
	$Employee_Contact_No=$_REQUEST["Employee_Contact_No"];
	$Employee_Designation=$_REQUEST["Employee_Designation"];
	$Residance_Address=$_REQUEST["Residance_Address"];

	$result=$conn->query("UPDATE employee_master SET Employee_Name='".$Employee_Name."' , Country_Id='".$Country_Id."' , 
		Office_Id='".$Office_Id."' , Department_Id='".$Department_Id."' , Email='".$Email."' , Employee_Dob='".$Employee_Dob."' , 
		Employee_Contact_No='".$Employee_Contact_No."' , Employee_Designation='".$Employee_Designation."' , Residance_Address='".$Residance_Address."' , 
		Last_Modified='".$Last_Modified."' , IsActive='".$IsActive."' WHERE Employee_Id='".$_SESSION["mod_emp"]."'");

	if($result)
	{
		$_SESSION['mod_emp']="";
		$conn->close();		
		$_SESSION["success"] = 1;
		header('Location: ../admin-create-employee');
		exit();		
	}
	else
	{
		$conn->close();		
		$_SESSION["success"] = 0;
		header('Location: ../admin-create-employee');
		exit();
		// $_SESSION["Error_Code"]="1001";
		// header('Location: ../error.php');
		// exit();	
	}

}
else
{

//Taking country name 
$cname=$conn->query("SELECT Country_Name from country_master WHERE Country_Id=".$_REQUEST["Country_Name"]);
$cname1 = $cname->fetch_assoc();
$cname2= $cname1['Country_Name'];
$Id="".mb_substr($cname2,0,3);


//Taking office name
$oname=$conn->query("SELECT Office_Name from office_master WHERE Office_Id=".$_REQUEST["Office_Name"]);
$oname1 =$oname->fetch_assoc();
$oname2 = $oname1['Office_Name'];
$Id=$Id."".mb_substr("".$oname2,0,2);


//Converting data to Uppercase.	
$Id = strtoupper($Id);


//Counting rows currently present on the database
$sql = "SELECT * FROM employee_master WHERE Country_Id=".$_REQUEST['Country_Name']." AND Office_Id=".$_REQUEST['Office_Name'];
$result = $conn->query($sql);
$Id1=$result->num_rows+1;


//Adding pre-fix
$Id1 = str_pad($Id1, 5, '0', STR_PAD_LEFT);


//Final Employee Id
$Id=$Id."".$Id1;

//Random Password Generation
$characters = 'abcdefghijklmnopqrstuvwxyz0123456789_*#$@!(){}';
$string = '';
$max = strlen($characters) - 1;
for ($i = 0; $i < 6; $i++) {
  $string .= $characters[mt_rand(0, $max)];
}


//MAIN DB OPERATION

$sql = "SELECT * FROM employee_master";
$result = $conn->query($sql);
$stmt = $conn->prepare("INSERT INTO employee_master (Employee_Id, Employee_Name, IsActive, Country_Id, Office_Id, Department_Id, Creation, Last_Modified, Email, Employee_Dob, Employee_Contact_No, Employee_Designation, Residance_Address, IsMember) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiiissssssssi", $Employee_Id, $Employee_Name, $IsActive, $Country_Id, $Office_Id, $Department_Id, $Creation, $Last_Modified, $Email, $Employee_Dob, $Employee_Contact_No, $Employee_Designation, $Residance_Address, $IsMember);

$Employee_Id=$Id;
$Employee_Name=$_REQUEST["Employee_Name"];
if($_REQUEST["IsActive"]=='selected')
	$IsActive=1;
else
	$IsActive=0;
$Country_Id=$_REQUEST["Country_Name"];
$Office_Id=$_REQUEST["Office_Name"];
$Department_Id=$_REQUEST["Department"];
$Creation=date("d/m/Y h:i:s a");
$Last_Modified=date("d/m/Y h:i:s a");
$Email=$_REQUEST["Email"];
$Employee_Dob=$_REQUEST["Employee_Dob"];
$Employee_Contact_No=$_REQUEST["Employee_Contact_No"];
$Employee_Designation=$_REQUEST["Employee_Designation"];
$Residance_Address=$_REQUEST["Residance_Address"];
$IsMember=0;

	if($stmt->execute())
	{
		$stmt1=$conn->prepare("INSERT INTO login (Employee_Id, Login_Id, Password) VALUES (?, ?, ?)");
		$stmt1->bind_param("sss", $Employee_Id, $Login_Id, $Password);

		$Employee_Id=$Id;
		$Login_Id=$Id;
		$Password=md5($string);

		if($stmt1->execute())
		{			
			$account="no-reply.nielsen@hotmail.com";
		   	$password="Nielsen_rockz";
		  	$to = $Email;
		   	$from="no-reply.nielsen@hotmail.com";
		   	$from_name="Nielsen Inc.";
		   	$subject = "Nielsen Employee Credentials";

		   	$msg = "<b>Dear ".$Employee_Name." ,<br/></b>";
		   	$msg .= "<p>Your LogIn Credentials are </p>";
		   	$msg .= "<p>Username : ".$Login_Id." </p>";
		   	$msg .= "<p>Password : ".$string." </p>";      


		   	include("phpmailer/class.phpmailer.php");
		   	$mail = new PHPMailer();
		   	$mail->IsSMTP();
		   	$mail->CharSet = 'UTF-8';
		   	$mail->Host = "smtp.live.com"; //smtp.gmail.com
		   	$mail->SMTPAuth= true;
		   	$mail->Port = 587; //465
		   	$mail->Username= $account;
		   	$mail->Password= $password;
		   	$mail->SMTPSecure = 'tls'; //ssl
		   	$mail->From = $from;
		   	$mail->FromName= $from_name;
		   	$mail->isHTML(true);
		   	$mail->Subject = $subject;
		   	$mail->Body = $msg;
		   	$mail->addAddress($to);
		   	if(!$mail->send()){
		    	//echo "Mailer Error: " . $mail->ErrorInfo;
		    	$_SESSION["Error_Code"]="961";
				header('Location: ../error');
				exit();	
		   	}else{
				$conn->close();		
				$_SESSION["success"] = 1;
				header('Location: ../admin-create-employee');
				exit();
		   	}			
		}

		else
		{
			// $conn->close();		
			// $_SESSION["success"] = 0;
			// header('Location: ../admin-create-employee.php');
			// exit();
                $_SESSION["Error_Code"]="962";
				header('Location: ../error');
				exit();
		}
	}
	else
	{		
		$conn->close();		
		$_SESSION["success"] = 0;
		header('Location: ../admin-create-employee');
		exit();
    //             $_SESSION["Error_Code"]="963";
				// header('Location: ../error.php');
				// exit();
	}
}
?>