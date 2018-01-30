<?php
include('../include/dbConfig.php');
session_start();

	if($_SESSION["Proposal_Id"]!="")
		{
			//TAKING LEADER NAME 
			$_REQUEST["Team_Leader"];
			$result=$conn->query("SELECT Team_Leader_Id, CS_Executive_Id from team_master WHERE Team_Name = '".$_REQUEST["Team_Name"]."'");
			$row=$result->fetch_assoc();

			$Project_Name = $_REQUEST["Project_Name"];
			$CS_Executive_Id = $row["CS_Executive_Id"];
			$Team_Name = $_REQUEST["Team_Name"];
			$Team_Leader_Id = $row["Team_Leader_Id"];
			$Zone = $_REQUEST["Zone"];
			$Client_Name = $_REQUEST["Client_Name"];
			$Client_Group = $_REQUEST["Client_Group"];
			$Industry_Group = $_REQUEST["Industry_Group"];
			$EOA="";
				if($_REQUEST["Probability"]<90)
				{
					$Probability = $_REQUEST["Probability"];
					$Proposal_Status = $_REQUEST["Proposal_Status"];
					$EOA = "NULL";
					$Approved="NULL";
				}
				else
				{
					$newfilename = "";
					$temp = explode(".", $_FILES["fileToUpload"]["name"]);

					if(end($temp)!="")
					{
						$newfilename = $_SESSION["Proposal_Id"] . '.' . end($temp);
						move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../uploads/" . $newfilename);
					}

					if($newfilename!="")
					{
						$Probability = 100;
						$Proposal_Status = "Complete";
						$EOA = $newfilename;
						$Approved=date("d/m/Y h:i:sa");
					}

					else
					{
						$Probability = $_REQUEST["Probability"];
						$Proposal_Status = $_REQUEST["Proposal_Status"];
						$EOA = "1";
						$Approved="NULL";
					}
				}

				$result=$conn->query("UPDATE proposal_master SET Project_Name='".$Project_Name."' , CS_Executive_Id='".$CS_Executive_Id."' , 
					Team_Name='".$Team_Name."' , Team_Leader_Id='".$Team_Leader_Id."' , Zone='".$Zone."' , Client_Name='".$Client_Name."' , 
					Client_Group='".$Client_Group."' , Industry_Group='".$Industry_Group."' , Probability='".$Probability."' , 
					Proposal_Status='".$Proposal_Status."' , EOA='".$EOA."', Approved = '".$Approved."' WHERE Proposal_Id='".$_SESSION["Proposal_Id"]."'");

			if($result)
			{
					$stmt=$conn->query("SELECT * FROM activity_master");
					$Id=$stmt->num_rows;

					$stmt = $conn->prepare("INSERT INTO activity_master (Id, Day, Time, Date, Employee_Id, Proposal_Id, Mode) VALUES (?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("iisssss", $Id, $Day, $Time, $Date, $Employee_Id, $Proposal_Id, $Mode);
					$Id = $Id;
					$Date = date("d/m/Y");					
					$Day = date('w', strtotime($Date));
					$Time = date("h:i:sa");
					$Employee_Id = $_SESSION["Employee_Id"];
					$Proposal_Id = $_SESSION["Proposal_Id"];
					$Mode = "Edit";

					if($stmt->execute())
					{
						$conn->close();
						$_SESSION["Proposal_Id"]="";
						$_SESSION["copy_proposal"]="";
						header('Location: ../proposal-list');
						exit();
					}
					else
					{
						echo 'error';
					}
			}
			else
			{
				$_SESSION["Proposal_Id"]="";
				$_SESSION["copy_proposal"]="";
                $_SESSION["Error_Code"]="958";
				header('Location: ../error');
				exit();
			}

		}

	else
		{
			//TAKING LEADER NAME 
			$_REQUEST["Team_Leader"];
			$result=$conn->query("SELECT Team_Leader_Id, CS_Executive_Id from team_master WHERE Team_Name = '".$_REQUEST["Team_Name"]."'");
			$row=$result->fetch_assoc();


			//Taking country name 
			$sql = "SELECT c.Country_Name FROM country_master c JOIN employee_master e ON c.Country_Id = e.Country_Id WHERE 
					e.Employee_Id ='".$row["CS_Executive_Id"]."'";
			$result = $conn->query($sql);
			$result1 = $result->fetch_assoc();
			$result2= $result1['Country_Name'];
			$Id="".mb_substr($result2,0,3);


			//Counting rows currently present on the database	
			$result = $conn->query("SELECT * FROM proposal_master;");
			$Id1=$result->num_rows+1;


			//Adding pre-fix
			$Id1 = str_pad($Id1, 5, '0', STR_PAD_LEFT);

			//Concating country and number of records.
			$Id=$Id."".$Id1;

			$Id = strtoupper($Id);

			//MAIN DB CODE

			$stmt = $conn->prepare("INSERT INTO proposal_master (Proposal_Id, Project_Name, CS_Executive_Id, Team_Name, Team_Leader_Id, Zone, Client_Name, Client_Group, Industry_Group, Probability, Proposal_Status, EOA, IsActive, Created, Approved) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssssssssississ", $Proposal_Id, $Project_Name, $CS_Executive_Id, $Team_Name, $Team_Leader_Id, $Zone, $Client_Name, $Client_Group, 
				$Industry_Group, $Probability, $Proposal_Status, $EOA, $IsActive, $Created, $Approved);

			$Proposal_Id = $Id;
			$Project_Name = $_REQUEST["Project_Name"];
			$CS_Executive_Id = $row["CS_Executive_Id"];
			$Team_Name = $_REQUEST["Team_Name"];
			$Team_Leader_Id = $row["Team_Leader_Id"];
			$Zone = $_REQUEST["Zone"];
			$Client_Name = $_REQUEST["Client_Name"];
			$Client_Group = $_REQUEST["Client_Group"];
			$Industry_Group = $_REQUEST["Industry_Group"];
			$IsActive = 1;
			$Created = date("d/m/Y h:i:sa");

				if($_REQUEST["Probability"]<90)
				{
					$Probability = $_REQUEST["Probability"];
					$Proposal_Status = $_REQUEST["Proposal_Status"];
					$EOA = "NULL";
					$Approved = "NULL";
				}
				else
				{
					$newfilename = "";
					$temp = explode(".", $_FILES["fileToUpload"]["name"]);

					if(end($temp)!="")
					{
						$newfilename = $Id . '.' . end($temp);
						move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "../uploads/" . $newfilename);
					}

					if($newfilename!="")
					{
						$Probability = 100;
						$Proposal_Status = "Complete";
						$EOA = $newfilename;
						$Approved = date("d/m/Y h:i:sa");
					}

					else
					{
						$Probability = $_REQUEST["Probability"];
						$Proposal_Status = $_REQUEST["Proposal_Status"];
						$EOA = "NULL";
						$Approved = "NULL";
					}
				}

			if($stmt->execute())
			{
				$result=$conn->query("UPDATE adhoc_subscription SET Proposal_Id='".$Id."' WHERE Proposal_Id='1'");
				$result1=$conn->query("UPDATE onetime_track SET Proposal_Id='".$Id."' WHERE Proposal_Id='1'");
				if($result && $result1)
				{
					$stmt=$conn->query("SELECT * FROM activity_master");
					$Id=$stmt->num_rows;

					$stmt = $conn->prepare("INSERT INTO activity_master (Id, Day, Time, Date, Employee_Id, Proposal_Id, Mode) VALUES (?, ?, ?, ?, ?, ?, ?)");
					$stmt->bind_param("iisssss", $Id, $Day, $Time, $Date, $Employee_Id, $Proposal_Id, $Mode);
					$Id = $Id;
					$Date = date("d/m/Y");					
					$Day = date('w', strtotime($Date));
					$Time = date("h:i:sa");
					$Employee_Id = $_SESSION["Employee_Id"];
					$Proposal_Id = $Proposal_Id;
					$Mode = "New";

					if($stmt->execute())
					{
						$conn->close();
						$_SESSION["Proposal_Id"]="";
						$_SESSION["copy_proposal"]="";
						header('Location: ../proposal-list');
						exit();						
					}
				}
				else{
					$_SESSION["Proposal_Id"]="";
					$_SESSION["copy_proposal"]="";
		            $_SESSION["Error_Code"]="959";
					header('Location: ../error');
					exit();
				}
			}
			else{
					$_SESSION["Proposal_Id"]="";
					$_SESSION["copy_proposal"]="";
	                $_SESSION["Error_Code"]="960";
					header('Location: ../error');
					exit();
			}
		}

?>