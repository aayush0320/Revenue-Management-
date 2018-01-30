<!DOCTYPE html>
<html>

<?php 
	session_start();
	if(!isset($_SESSION['Employee_Name'])){
		header("location:../login.php");
	}
	if($_SESSION['Employee_Designation']!=2)
    {
        header("location:../login.php");
    }
?>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Proposal Management | nielsen</title>

	<link rel="shortcut icon" href="img/favicon.ico" type="img/x-icon"/>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
    <link rel="stylesheet" href="../css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/separate/vendor/typeahead.min.css">
</head>
<body class="with-side-menu">
	<header class="site-header">
	    <div class="container-fluid">	
	    	<button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>

			<a href="proposal-list.php" class="site-logo">
	            <img class="hidden-md-down" src="../img/logo.png" alt="">
	            <img class="hidden-lg-up" src="../img/logo-mob.png" alt="">
	        </a>

	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                           
	                        <?php echo $_SESSION["Employee_Name"]; ?> <img src="../img/avatar-2-64.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>
		
	<?php
		include '../include/dbConfig.php';

		$result10= $conn->query("SELECT Employee_Id, Employee_Name from employee_master where Employee_Designation = 1 and 
									Country_Id='".$_SESSION["modify_team_3"]."' and Office_Id = '".$_SESSION["modify_team_4"]."'");
		$cs_list=$result10->num_rows;

		$result =$conn->query("SELECT Country_Name from country_master WHERE Country_Id = '".$_SESSION["modify_team_3"]."'");
		$country = $result->fetch_assoc();

		$result =$conn->query("SELECT Office_Name from office_master WHERE Office_Id = '".$_SESSION["modify_team_4"]."'");
		$office = $result->fetch_assoc();

		$result=$conn->query("SELECT * FROM team_master WHERE IsActive = 1 AND Team_Name = '".$_SESSION["modify_team_1"]."'");
		$row=$result->fetch_assoc();
		$cs = $row["CS_Executive_Id"];
		$result = $conn->query("SELECT Employee_Name from employee_master WHERE Employee_Id = '".$row["CS_Executive_Id"]."'");
		$Emp=$result->fetch_assoc();		

		$result1=$conn->query("SELECT * FROM team_member_master WHERE IsActive = 1 AND Team_Name = '".$_SESSION["modify_team_1"]."'");
		$rowCount=$result1->num_rows;
	?>
	
	<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	    <ul class="side-menu-list">
	    	<li class="blue with-sub">
	            <a href="../admin-dashboard.php">
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Dashboard</span>
	            </a>
	        </li>
	        <li class="red with-sub">
	            <span>
	                <span class="font-icon font-icon-contacts"></span>
	                <span class="lbl">Employee</span>
	            </span>
	            <ul>
	                <li><a href="../admin-create-employee"><span class="lbl">Create</span></a></li>
	                <li><a href="#E-mod" data-toggle="modal"><span class="lbl">Modify</span></a></li>
	            </ul>
	        </li>
	         <li class="green with-sub">
	            <span>
	                <span class="fa fa-black-tie"></span>
	                <span class="lbl">Team</span>
	            </span>
	            <ul>
	            	<li><a href="../admin-team-creation"><span class="lbl">Create</span></a></li>
	            	<li><a href="../admin-team-modify"><span class="lbl">Modify</span></a></li>
	            </ul>
	        </li> 
	        <li class="blue with-sub">
	            <span>
	                <span class="fa fa-credit-card"></span>
	                <span class="lbl">Clients</span>
	            </span>
	            <ul>
	                <li><a href="../admin-create-client"><span class="lbl">Add</span></a></li>
	                <li><a href="#C-mod" data-toggle="modal"><span class="lbl">Modify</span></a></li>
	            </ul>
	        </li>  
	        <li class="pink with-sub">
	            <a href="../admin-create-businessunit">
	                <i class="fa fa-industry"></i>
	                <span class="lbl">Business Units</span>
	            </a>
	        </li>            
	        <li class="green with-sub">
	            <a href="../admin-create-product">
	                <i class="fa fa-puzzle-piece"></i>
	                <span class="lbl">Products</span>
	            </a>
	        </li>        
	    	<li class="red with-sub">
	            <a href="../admin-create-service">
	                <i class="fa fa-server"></i>
	                <span class="lbl">Services</span>
	            </a>
	        </li>                	          
	        <li class="blue-dirty with-sub">
	            <a href="../admin-create-country">
	                <i class="fa fa-map"></i>
	                <span class="lbl">Country</span>
	            </a>
	        </li>        
	    	<li class="aquamarine with-sub">
	            <a href="../admin-create-office">
	                <i class="fa fa-building"></i>
	                <span class="lbl">Offices</span>
	            </a>
	        </li>            
	        <li class="gold">
	            <a href="../admin-log">
	                <i class="font-icon font-icon-speed"></i>
	                <span class="lbl">Activity Log</span>
	            </a>
	        </li>

	        <li class="green with-sub">
	            <a href="#Proposal_Active" data-toggle="modal">
	                <i class="fa fa-play-circle"></i>
	                <span class="lbl">Activate Proposal</span>
	            </a>
	        </li>
	    
	    </ul>	    
	</nav><!--.side-menu-->

    <div class="modal fade" id="E-mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Employee Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="employee-modify.php">
                        <div class="row">
                            <div class="col-lg-9 col-xs-7">                                 
                                <fieldset class="form-group typeahead-container">
                                    <input  type="text" class="form-control" id="Employee_Id_s" name="Employee_Id" placeholder="Enter Employee ID" />
                                </fieldset>
                            </div>
                            <div class="col-lg-3 col-xs-3">                             
                                    <button type="submit" class="btn btn-inline btn-primary">Modify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="C-mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Client Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="client-modify.php">
                        <div class="row">
                            <div class="col-lg-9 col-xs-7">                                 
                                <fieldset class="form-group typeahead-container">
                                    <input  type="text" class="form-control" id="Client_Name_s" name="Client_Name" placeholder="Enter Client Name"/>
                                </fieldset>
                            </div>
                            <div class="col-lg-3 col-xs-3">                             
                                    <button type="submit" class="btn btn-inline btn-primary">Modify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Proposal_Active" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Proposal Activation</h4>
                </div>
                <div class="modal-body">
                    <form name="myForm" method="post" action="proposal-activate.php">
                        <div class="row">
                            <div class="col-lg-9 col-xs-7">                                 
                                <fieldset class="form-group typeahead-container">
                                    <input  type="text" class="form-control" id="Proposal_Id_s" name="Proposal_Id" placeholder="Enter Proposal ID" required/>
                                </fieldset>
                            </div>
                            <div class="col-lg-3 col-xs-3">                             
                                    <button type="submit" id = "Submit" class="btn btn-inline btn-primary">Activate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<section class="card">
						<div class="card-block">
			    			<?php	
								{
								echo'
								<div class="row">
									<fieldset class="form-group">
										<div class="col-md-6"></div>
										<div class="col-md-3 col-xs-6" style="margin-top:10 px">
											<a href="#Change_CS" data-toggle="modal"><button class="btn btn-primary" type="button" style="width:100%">Change CS </button>
											</a>
										</div>
										<div class="col-md-3 col-xs-6" style="margin-top:10 px">
											<a href="#Add_member" data-toggle="modal"><button class="btn btn-primary" type="button" style="width:100%">Add Member </button>
											</a>
										</div>
									</fieldset>
								</div>
								<div class="row">
									<div class="form-group col-md-5 col-xs-12">
										<div class="row">
											<div class="col-md-6 col-xs-5">Country Name </div><div class="col-md-6 col-xs-6">'.$country["Country_Name"].'</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-5">Office Name </div><div class="col-md-6 col-xs-6">'.$office["Office_Name"].'</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-5">CS Executive</div><div class="col-md-6 col-xs-6">'.$Emp["Employee_Name"].'</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-xs-5">Country Name </div><div class="col-md-6 col-xs-6">'.$_SESSION["modify_team_1"].'</div>
										</div>
									</div>
								</div>
								';
								}
							?>
							<div class="row">								
								<table class="table table-bordered table-hover" id="tab_logic">
									<thead>
										<tr >
											<th class="text-center">
												#
											</th>
											<th>
												Employee ID
											</th>
											<th>
												Role
											</th>
											<th width="1"></th>
											<th width="1"></th>
										</tr>
									</thead>
									<?php
										echo'<tr>
											<td class="text-center">1</td>
											<td>';

											$stmt = $conn->query("SELECT Employee_Name from employee_master WHERE Employee_Id = '".$row["Team_Leader_Id"]."'");
											$stmt1=$stmt->fetch_assoc();
											echo $stmt1["Employee_Name"].' - '.$row["Team_Leader_Id"].'

											</td>
											<td>';

											if($row["Role"])
											{
												echo 'Edit';
											}
											else
											{
												echo 'View';
											}

											echo '</td>
											<td><a href="change-team.php?type=l&id='.$row["Team_Leader_Id"].'&team='.$_SESSION["modify_team_1"].'&role='.$row['Role'].'"><button class="btn btn-sm btn-info">Change</button></a></td>
											<td>
											<a href="#Change_Leader" data-toggle="modal"><button class="btn btn-sm btn-danger" type="button">Remove</button>
											</td>
											</tr>';
										if($rowCount>0)
										{
											$i=2;
											while($row=$result1->fetch_assoc())
											{
												echo'<tr>
													<td class="text-center" >'.$i.'</td>
													<td>';

														$stmt = $conn->query("SELECT Employee_Name from employee_master WHERE 
																					Employee_Id = '".$row["Team_Member_Id"]."'");
														$stmt1=$stmt->fetch_assoc();
														echo $stmt1["Employee_Name"].' - '.$row["Team_Member_Id"].'

													</td>
													<td>';

													if($row["Role"])
													{
														echo 'Edit';
													}
													else
													{
														echo 'View';
													}

												echo'</td>
													<td><a href="change-team.php?type=m&id='.$row["Team_Member_Id"].'&team='.$_SESSION["modify_team_1"].'&role='.$row['Role'].'"><button class="btn btn-sm btn-info">Change</button></a></td>
													<td>
													<a href="remove-member.php?team='.$row["Team_Member_Id"].'"><button class="btn btn-sm btn-danger" type="button">Remove</button>
													</td>
													</tr>';
													$i=$i+1;													
											}
										}									
									?>
								</table>
							</div>	
							<div class="row" style="margin-top: 10px">
								<div class="col-md-10 col-xs-6"></div>
							    <div class="col-md-2 col-xs-6">
									<a href="../admin-team-modify"><button class="btn btn-primary" style="width: 100%">Done</button></a>
								</div> 
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>



	<div class="modal fade" id="Change_CS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"	aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
						<i class="font-icon-close-2"></i>
					</button>
					<h4 class="modal-title" id="myModalLabel">Change CS Executive</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="change-cs-back.php">
						<div class="row" style="margin-top: 30px; margin-bottom: 30px">
							<div class="col-lg-6 col-xs-7">									
				                <select class="form-control" name="CS_Executive_Id" id="CS_Executive_Id">
				                  	<option value="">Select CS Executive</option>
				                    <?php
				                   	    if($cs_list > 0){
				                            while($cs_list = $result10->fetch_assoc()){ 
				                            	if($cs_list["Employee_Id"]!=$cs)
				                            	{
					                                echo '<option value="'.$cs_list["Employee_Id"].'">'.$cs_list["Employee_Id"].' - '.$cs_list["Employee_Name"].'
					                                		</option>';
				                            	}
				                            }
				                        }else{
				                            echo '<option value="">CS not available</option>';
				                        }
				                    ?>
				                </select>
							</div>
							<div class="col-lg-6 col-xs-3">								
									<button type="submit" class="btn btn-inline btn-primary">Change</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--.modal-->




	<div class="modal fade" id="Add_member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"	aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
						<i class="font-icon-close-2"></i>
					</button>
					<h4 class="modal-title" id="myModalLabel">Add New Member</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="add-member-back.php">
						<div class="row" style="margin-top: 30px; margin-bottom: 30px">
							<div class="col-lg-8 col-xs-7">									

									<div class="typeahead-container">
										<input type="text" name="Team_Member_Id"  id ="Team_Member_Id_s" placeholder="Team Member ID" class="form-control"/>
									</div>
							</div>
							<div class="col-lg-4 col-xs-7">							
								<select class="form-control" name="Role" id="Role">
									<option>Select Role</option>														
									<option value="0">View</option>
									<option value="1">Edit</option>
								</select>								
							</div>
						</div>
						<div class="row">
							<div class="col-lg-9 col-xs-3"></div>
							<div class="col-lg-3 col-xs-3">								
									<button type="submit" class="btn btn-inline btn-primary">Add member</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--.modal-->



	<div class="modal fade" id="Change_Leader" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"	aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
						<i class="font-icon-close-2"></i>
					</button>
					<h4 class="modal-title" id="myModalLabel">Change Team Member</h4>
				</div>
				<div class="modal-body">
					<form method="post" action="change-leader-back.php">
						<div class="row" style="margin-top: 30px; margin-bottom: 30px">
							<div class="col-lg-8 col-xs-7">									

									<div class="typeahead-container">
										<input type="text" name="Team_Leader_Id"  id ="Team_Leader_Id_s" placeholder="Team Leader ID" class="form-control"/>
									</div>
							</div>
							<div class="col-lg-4 col-xs-7">							
								<select class="form-control" name="Role" id="Role">
									<option>Select Role</option>														
									<option value="0">View</option>
									<option value="1">Edit</option>
								</select>								
							</div>
						</div>
						<div class="row">
							<div class="col-lg-9 col-xs-3"></div>
							<div class="col-lg-3 col-xs-3">								
									<button type="submit" class="btn btn-inline btn-primary">Add member</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--.modal-->	


	<script src="../js/lib/jquery/jquery.min.js"></script>
	<script src="../js/lib/tether/tether.min.js"></script>
	<script src="../js/lib/bootstrap/bootstrap.min.js"></script>
	<script src="../js/plugins.js"></script>
	<script src="../js/app.js"></script>
	<script src="../js/lib/typeahead/jquery.typeahead.min.js"></script>
	<script>
		$(document).ready(function(){
			var employee = [<?php 
                $result=$conn->query("SELECT * FROM employee_master WHERE Employee_Designation = 0");
            	$rowCount = $result->num_rows;
                if($rowCount > 0){
                    while($row = $result->fetch_assoc()){ 
	                echo  '"'.$row['Employee_Id']. ' - ' . $row['Employee_Name'].'",';
                    }
                }
	        ?>];
			 $.typeahead({
		        input: "#Team_Leader_Id_s",
		        order: "asc",
		        minLength: 1,
		        source: {
		            data: employee
		        }
			});
		});
	</script>

	<script>
		$(document).ready(function(){
			var employee1 = [<?php 
                $result=$conn->query("SELECT * FROM employee_master WHERE Employee_Designation = 0");
            	$rowCount = $result->num_rows;
                if($rowCount > 0){
                    while($row = $result->fetch_assoc()){ 
	                echo  '"'.$row['Employee_Id']. ' - ' . $row['Employee_Name'].'",';
                    }
                }
	        ?>];
			 $.typeahead({
		        input: "#Team_Member_Id_s",
		        order: "asc",
		        minLength: 1,
		        source: {
		            data: employee1
		        }
			});
		});
	</script>
</body>
</html>