<?php include 'include/head.html';?>
	<link rel="stylesheet" href="css/lib/bootstrap-table/bootstrap-table.min.css">
</head>
<body class="with-side-menu">

	<?php 
		include 'include/header.php';
		include 'include/dbConfig.php';
		include 'include/sidebar.php';
		$_SESSION["Proposal_Id"]="";
		$_SESSION["copy_proposal"]="";
	?>
	
	<div class="page-content">
		<div class="container-fluid">
			<?php
				if($_SESSION["Employee_Designation"]==1)
				{
					echo '	<div class="row">			
								<div class="col-md-3 col-xs-6">
									<a href="proposal-create">
										<button class="btn btn-inline btn-secondary" style="width: 100%">Create New Proposal</button>
				    				</a>
				    			</div>
				    			<div class="col-md-3 col-xs-6">
				    					<button class="btn btn-inline btn-secondary" href="#Copy_Proposal" data-toggle="modal" style="width: 100%">Create Copy Proposal</button>
				    			</div>
							</div>';
		    	}
			?>
			<section class="box-typical scrollable">
	    		<!-- <div class="table-responsive"> -->
	    			<div id="toolbar">
						<STRONG>Proposal List</STRONG>
					</div>
			    	<table id="table"
						data-show-toggle="true" 
			    		data-filter-control="true"
			    		data-toolbar="#toolbar"
						data-search="true"
			    		data-show-columns="true"
						data-minimum-count-columns="3"
						data-show-pagination-switch="true"
						data-pagination="true"
						data-page-list="[5, 10, 15, 20, 25, 50, 100, ALL]"
			    		data-mobile-responsive="true"
						data-response-handler="responseHandler">
						<thead>
							<tr>
								<th data-field="Proposal Id" data-filter-control="input" data-sortable="true">Proposal Id</th>
								<th data-field="Proposal Name" data-filter-control="input" data-sortable="true">Proposal Name</th>
								<th data-field="ClientName" data-filter-control="select" data-sortable="true">Client Name</th>
								<th data-field="CSName" data-filter-control="select" data-sortable="true">Team Name</th>
								<th data-field="Team Lead" data-filter-control="input" data-sortable="true">Team Lead</th>
								<th data-field="Probability" data-filter-control="select" data-sortable="true">Probability</th>
								<th data-field="Status" data-filter-control="select" data-sortable="true">Status</th>
								<th width="1">Edit Record</th>
							</tr>
						</thead>
						<tbody>
							<?php

								//CS EXECUTIVE

								if($_SESSION["Employee_Designation"]==1)
								{
									$result=$conn->query("SELECT p.Proposal_Id, p.Project_Name, p.Team_Name, p.Client_Name, p.CS_Executive_Id, p.Team_Leader_Id, p.Probability, p.Proposal_Status FROM proposal_master p JOIN team_master t on p.Team_Name = t.Team_Name WHERE p.CS_Executive_Id = '".$_SESSION["Employee_Id"]."' AND t.CS_Executive_Id ='".$_SESSION["Employee_Id"]."' AND p.IsActive = 1");
									$rowCount=$result->num_rows;			
					
									if($rowCount > 0)
									{
										while($row = $result->fetch_assoc())
										{
											echo '<tr>
													<td>'.$row["Proposal_Id"].'</td>
													<td>'.$row["Project_Name"].'</td>
													<td>'.$row["Client_Name"].'</td>
													<td>';
													// $result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["CS_Executive_Id"]."'");
												 	// $row1=$result1->fetch_assoc();
											echo    $row["Team_Name"];
											echo   '</td>
												    <td>';
													$result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["Team_Leader_Id"]."'");
												    $row1=$result1->fetch_assoc();
											echo    $row1["Employee_Name"];
											echo   '</td>
												    <td>'.$row["Probability"].'%</td>
													<td>'.$row["Proposal_Status"].'</td>
													<td>';
														
														if($row["Probability"]!=100)
															echo '<a href="proposal-create?data='.$row["Proposal_Id"].'&but=save"><button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a>';
														else
															echo '<a href="proposal-view?data='.$row["Proposal_Id"].'"><button class="btn btn-sm btn-default">
																<span class="fa fa-eye">
																</span></button></a>';									
												
														echo'&nbsp;&nbsp;&nbsp;<a href="php/inactive?data='.$row["Proposal_Id"].'"><button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"></span></button></a>											
												        </td>
														</tr>';									
										}
									}
								}
							
								// ONLY VIEWERs

								elseif($_SESSION["IsMember"]==0)
								{
									$stmt=$conn->query("SELECT Office_Id FROM employee_master WHERE Employee_Id='".$_SESSION["Employee_Id"]."'");
									$Office_Id = $stmt->fetch_assoc();

									$result=$conn->query("SELECT p.Proposal_Id, p.Project_Name, p.Team_Name, p.Client_Name, p.CS_Executive_Id, p.Team_Leader_Id, p.Probability, 
										p.Proposal_Status FROM proposal_master p JOIN employee_master e on p.CS_Executive_Id = e.Employee_Id WHERE p.IsActive =1 and 
										e.Office_Id = ".$Office_Id["Office_Id"]);
									$rowCount=$result->num_rows;		

									if($rowCount > 0)
									{
										while($row = $result->fetch_assoc())
										{
											echo '<tr>
													<td>'.$row["Proposal_Id"].'</td>
													<td>'.$row["Project_Name"].'</td>
													<td>'.$row["Client_Name"].'</td>
													<td>';
													// $result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["CS_Executive_Id"]."'");
												 	// $row1=$result1->fetch_assoc();
											echo    $row["Team_Name"];
											echo   '</td>
												    <td>';
													$result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["Team_Leader_Id"]."'");
												    $row1=$result1->fetch_assoc();
											echo    $row1["Employee_Name"];
											echo   '</td>
												    <td>'.$row["Probability"].'%</td>
													<td>'.$row["Proposal_Status"].'</td>
													<td>';
													
											echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<a href="proposal-view?data='.$row["Proposal_Id"].'">
														<button class="btn btn-sm btn-default">
															<span class="fa fa-eye"></span>
														</button>
													</a>';									
										}
									}
								}
							
								//TEam MEMBERS

								else
								{					
									$stmt=$conn->query("SELECT * FROM team_master WHERE IsActive = 1 AND Team_Leader_Id='".$_SESSION["Employee_Id"]."'");
									$rc = $stmt->num_rows;

									if($rc>0)
									{
										while($CS = $stmt->fetch_assoc())
										{
											$test = $conn->query("SELECT *  FROM proposal_master WHERE Team_Name = '".$CS["Team_Name"]."'");
											$test1=$test->num_rows;

											if($test1>0)
											{
												$result=$conn->query("SELECT p.Proposal_Id, p.Project_Name, p.Team_Name, p.Client_Name, p.CS_Executive_Id, p.Team_Leader_Id, p.Probability, p.Proposal_Status FROM proposal_master p JOIN team_master t on p.Team_Name = t.Team_Name WHERE p.CS_Executive_Id = '".$CS["CS_Executive_Id"]."' AND t.CS_Executive_Id ='".$CS["CS_Executive_Id"]."' AND t.IsActive = 1 AND p.IsActive = 1 AND p.Team_Leader_Id = '".$_SESSION["Employee_Id"]."'");

												$rowCount=$result->num_rows;
												
												if($rowCount > 0)
												{
													while($row = $result->fetch_assoc())
													{
														echo '<tr>
																<td>'.$row["Proposal_Id"].'</td>
																<td>'.$row["Project_Name"].'</td>
																<td>'.$row["Client_Name"].'</td>
																<td>';
																// $result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["CS_Executive_Id"]."'");
															 	// $row1=$result1->fetch_assoc();
														echo    $row["Team_Name"];
														echo   '</td>
															    <td>';
																$result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["Team_Leader_Id"]."'");
															    $row1=$result1->fetch_assoc();
														echo    $row1["Employee_Name"];
														echo   '</td>
															    <td>'.$row["Probability"].'%</td>
																<td>'.$row["Proposal_Status"].'</td>
																<td>';
																
																if($CS["Role"]==1)
																	{	
																	if($row["Probability"]!=100)
																		echo '<a href="proposal-create?data='.$row["Proposal_Id"].'&but=save"><button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a>';
																	else
																		echo '<a href="proposal-view?data='.$row["Proposal_Id"].'"><button class="btn btn-sm btn-default">
																			<span class="fa fa-eye">
																			</span></button></a>';
																	}
																else
																	{
																		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="proposal-view?data='.$row["Proposal_Id"].'"><button class="btn btn-sm btn-default">
																			<span class="fa fa-eye">
																			</span></button></a>';
																	}										
													}
												}
											}
										}
									}

									$stmt=$conn->query("SELECT Team_Name FROM team_member_master WHERE IsActive = 1 AND 
																Team_Member_Id='".$_SESSION["Employee_Id"]."'");
									$number=$stmt->num_rows;
									if($number>0){	while($Team_Name = $stmt->fetch_assoc()){
									

									$stmt1=$conn->query("SELECT * FROM team_master WHERE IsActive = 1 AND Team_Name = '".$Team_Name["Team_Name"]."'");
									$rc = $stmt1->num_rows;

									if($rc>0)
									{
										while($CS = $stmt1->fetch_assoc())
										{
											$test = $conn->query("SELECT *  FROM proposal_master WHERE Team_Name = '".$CS["Team_Name"]."'");
											$test1=$test->num_rows;

											if($test1>0)
											{											
												$result=$conn->query("SELECT p.Proposal_Id, p.Project_Name, p.Team_Name, p.Client_Name, p.CS_Executive_Id, p.Team_Leader_Id, p.Probability, p.Proposal_Status FROM proposal_master p JOIN team_master t on p.Team_Name = t.Team_Name WHERE p.CS_Executive_Id = '".$CS["CS_Executive_Id"]."' AND t.CS_Executive_Id ='".$CS["CS_Executive_Id"]."' AND t.IsActive = 1 AND p.IsActive = 1 AND p.Team_Leader_Id = '".$CS["Team_Leader_Id"]."'");

												$rowCount=$result->num_rows;

												if($rowCount > 0)
												{
													while($row = $result->fetch_assoc())
													{
														echo '<tr>
																<td>'.$row["Proposal_Id"].'</td>
																<td>'.$row["Project_Name"].'</td>
																<td>'.$row["Client_Name"].'</td>
																<td>';
																// $result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["CS_Executive_Id"]."'");
															 	// $row1=$result1->fetch_assoc();
														echo    $row["Team_Name"];
														echo   '</td>
															    <td>';
																$result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["Team_Leader_Id"]."'");
															    $row1=$result1->fetch_assoc();
														echo    $row1["Employee_Name"];
														echo   '</td>
															    <td>'.$row["Probability"].'%</td>
																<td>'.$row["Proposal_Status"].'</td>
																<td>';
														
															$temp = $conn->query("SELECT Role FROM team_member_master WHERE Team_Name = '".$CS["Team_Name"]."' and 
																		Team_Member_Id = '".$_SESSION["Employee_Id"]."' and IsActive = 1 ");
															$temp1=$temp->fetch_assoc();
																if($temp1["Role"]==1)
																	{	
																	if($row["Probability"]!=100)
																		echo '<a href="proposal-create.php?data='.$row["Proposal_Id"].'&but=save"><button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a>';
																	else
																		echo '<a href="proposal-view.php?data='.$row["Proposal_Id"].'"><button class="btn btn-sm btn-default">
																			<span class="fa fa-eye">
																			</span></button></a>';
																	}
																else
																	{
																		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="proposal-view.php?data='.$row["Proposal_Id"].'"><button class="btn btn-sm btn-default">
																			<span class="fa fa-eye">
																			</span></button></a>';
																	}										
													}
												}
											}
										}
									}}}

								}
							?>
						</tbody>
					</table>
				<!-- </div> -->
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	
	<div class="modal fade" id="Copy_Proposal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"	aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
						<i class="font-icon-close-2"></i>
					</button>
					<h4 class="modal-title" id="myModalLabel">Copy Proposal</h4>
				</div>
				<div class="modal-body">
					<form id="copyprop" name="copyprop" method="post" action="php/proposal_copy_back.php">
						<div class="row" style="margin-top: 30px; margin-bottom: 30px">
							<div class="col-lg-6 col-xs-7">
								<input 	type="text"	class="form-control" id="Proposal_Id_1" name="Proposal_Id" placeholder="Enter Proposal ID" required />
							</div>
							<div class="col-lg-6 col-xs-3">								
									<button type="submit"  id="submit" class="btn btn-inline btn-primary">Create Copy</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--.modal--> 

	<?php include 'include/commonjs.html';?>
	<script src="js/lib/bootstrap-table/bootstrap-table.js"></script>
	<script src="js/lib/bootstrap-table/bootstrap-table-filter-control.min.js"></script>
	<script src="js/lib/bootstrap-table/bootstrap-table-mobile.min.js"></script>
	<script>
		$(document).ready(function(){
		    $('#Proposal_Id_1').focus(function(){
				$('#Proposal_Id_1').blur(function(){	
					var letters = /^\w{3}\d{5}$/;
					if(document.forms["copyprop"]["Proposal_Id_1"].value.match(letters))
					{
						document.getElementById("Proposal_Id_1").className = "form-control form-control-success";
						$('#submit').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Proposal_Id_1").className = "form-control form-control-danger";
						$('#submit').attr('disabled','disabled');
					}
				});
			});		
		});
	</script>

	<script>
		$(document).ready(function() {
		    var $table = $('#table');

		    $table.bootstrapTable({
		        iconsPrefix: 'font-icon',
		        icons: {
		            paginationSwitchDown:'font-icon-arrow-square-down',
		            paginationSwitchUp: 'font-icon-arrow-square-down up',
		            refresh: 'font-icon-refresh',
		            toggle: 'font-icon-list-square',
		            columns: 'font-icon-list-rotate',
		            export: 'font-icon-download',
		            detailOpen: 'font-icon-plus',
		            detailClose: 'font-icon-minus-1'
		        },
		        paginationPreText: '<i class="font-icon font-icon-arrow-left"></i>',
		        paginationNextText: '<i class="font-icon font-icon-arrow-right"></i>',
		    });

		    $('#table select').selectpicker({
		        style: '',
		        width: '100%',
		        size: 8
		    });
		});
	</script>
</body>
</html>