<?php 
include 'include/head.html';?>
<link rel="stylesheet" href="css/separate/vendor/typeahead.min.css">
<link rel="stylesheet" href="css/toastr.min.css"/>
</head>
<body class="with-side-menu">
	<?php 

		include 'include/header.php';
		include 'include/admin-sidebar.php';
		$_SESSION["total_records"]=1;

		//Include database configuration file
		include('include/dbConfig.php');

		$sql = "SELECT * FROM country_master WHERE IsActive = 1";
		$result = $conn->query($sql);
		$rowCount = $result->num_rows;

	?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
							<section class="card">
							<div class="card-block" style="overflow: auto;">
								<form name="myForm" method="post" action="php/team_back.php">

							         	<div class="row" >			            
								            <div class="form-group col-md-4">
								                <div class="form-group">
									                <label  class="form-label semibold" for="Country_Name">Country Name</label>
									                <select class="form-control" name="Country_Name" id="Country_Name">
								                      	<option value="">Select Country</option>
									                    <?php
									                   	    if($rowCount > 0){
									                            while($row = $result->fetch_assoc()){ 
									                                echo '<option value="'.$row['Country_Id'].'">'.$row['Country_Name'].'</option>';
									                            }
									                        }else{
									                            echo '<option value="">Country not available</option>';
									                        }
									                    ?>
									                </select>              
									            </div>
								            </div>

								            <div class="form-group col-md-4">
								              <div class="form-group">
								              	<label class="form-label semibold" for="Office_Name">Office Name</label>
								                <select class="form-control" id="Office_Name" name="Office_Name">
								                  <option value="">Select Country first</option>
								                </select>
								              </div>
								            </div>

								            <div class="form-group col-md-4">							          	
									            <div class="form-group">
									              	<label class="form-label semibold" for="CS_Executive_Id">CS Executive Name</label>
									                <select class="form-control" id="CS_Executive_Id" name="CS_Executive_Id">
									                  <option value="">Select office first</option>
									                </select>
									            </div>
									        </div>									        
								        </div>

										<div class="row">
											<div class="form-group col-md-6">
												<label class="form-label semibold" for="Team_Name"> Team Name </label>
												<input type="text" class="form-control" id="Team_Name" name="Team_Name" placeholder="Enter Team Name" required>
											</div>
										</div>

										<div class="row">
											<div class="form-group col-md-3 col-xs-6">
												<button id="add_row" class="btn btn-primary" type="button" style="width: 100%"">Add Row</button>
											</div>
											<div class="form-group col-md-3 col-xs-6">
												<button id="delete_row" class="btn btn-primary" type="button" style="width: 100%"">Delete Row</button>
											</div>
										</div>

							    	<div class="row">
										<div class="col-md-12">
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
													</tr>
												</thead>
												<tbody>
													<tr id="addr0">
														<td class="text-center">
														1
														</td>
																<td>										
																	<div class="typeahead-container">
																		<input type="text" name="Team_Leader_Id"  id ="test" placeholder="Team Leader ID" class="form-control"/>
																	</div>
																</td>

																<td>
																<select class="form-control" name="Role" id="Role">
																	<option>Select Role</option>														
																	<option value="0">View</option>
																	<option value="1">Edit</option>
																</select>
																</td>																	
															
													</tr>
								                    <tr id="addr1"></tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row" style="margin-top: 20px">	
										<div class="form-group col-md-2"></div>
										<div class="form-group col-md-2"></div>
										<div class="form-group col-md-3"></div>
										<div class="form-group col-md-3" style="padding-top: 10px">
							          		<div class="checkbox">
												<input type="checkbox" name="IsActive" id="IsActive" checked="checked" value="selected">
												<label class="form-label semibold" for="IsActive">Is Active</label>
									  		</div>
								  		</div>											  	
									  	<div class="form-group col-md-2">
						          			<button type="submit" id="but" class="btn btn-primary">Submit</button>
						          		</div>
						        	</div>
									<div id="null"></div>
								</form>
							</div>
						</section>
					</div>
					<div class="col-md-4"></div>
				</div>
				</div><div style="clear:both;"></div> </div>
			</div><!--.container-fluid-->
		</div><!--.page-content-->

<?php include 'include/commonjs.html';?>
	<script src="js/toastr.min.js"></script>
    <script>
		!function ($) {
		    "use strict";
		    toastr.options = {
		        "debug": false,
		        "newestOnTop": false,
		        "positionClass": "toast-bottom-right",
		        "closeButton": true,
		        "progressBar": true
		    };

		    if(<?php if(isset($_SESSION["success"]) && $_SESSION["success"]==1){echo 'true';$_SESSION["success"]=2;}else{echo 'false';} ?>)
		    {
		    	toastr.success('Success ! Team has been successfully Created.');
		    }
		    if(<?php if(isset($_SESSION["success"]) && $_SESSION["success"]==0){echo 'true';$_SESSION["success"]=2;}else{echo 'false';} ?>)		    
		    {
		    	toastr.error('Error ! There was an error in Team creation.');
		    }
		}(window.jQuery);
    </script>
<script src="js/lib/typeahead/jquery.typeahead.min.js"></script>

<?php include 'include/country-office-cs-team.html'; ?>

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
		        input: "#test",
		        order: "asc",
		        minLength: 1,
		        source: {
		            data: employee
		        }
			});

		    var i=1;
	        $("#add_row").click(function(){
	            $('#addr'+i).html("<td class='text-center'>"+ (i+1) +"</td><td><div class='typeahead-container'><input name='Team_Member_Id[]' id='test"+i+"' type='text' placeholder='Employee ID' class='form-control input-md'  /></div></td><td><select class='form-control' name='role[]'><option>Select Role</option><option value='0'>View</option><option value='1'>Edit</option></select></td>");

	        	$('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
	            i++; 
        		
        		 $.typeahead({
			        input: "#test1",
			        order: "asc",
			        minLength: 1,
			        source: {
			            data: employee
			        }
				});
        		  $.typeahead({
			        input: "#test2",
			        order: "asc",
			        minLength: 1,
			        source: {
			            data: employee
			        }
				});
        		   $.typeahead({
			        input: "#test3",
			        order: "asc",
			        minLength: 1,
			        source: {
			            data: employee
			        }
				});
        		 $.typeahead({
			        input: "#test4",
			        order: "asc",
			        minLength: 1,
			        source: {
			            data: employee
			        }
				});
        		  $.typeahead({
			        input: "#test5",
			        order: "asc",
			        minLength: 1,
			        source: {
			            data: employee
			        }
				});
        		   $.typeahead({
			        input: "#test6",
			        order: "asc",
			        minLength: 1,
			        source: {
			            data: employee
			        }
				});
        		$.ajax({
			        type:'POST',
			        url:'ajax/team-button-ajaxData.php',
			        data:'data='+i,
	                success:function(html){
	                    $('#null').html(html);
	                }
		        });	      
			});
	        
	        $("#delete_row").click(function(){
	    	    if(i>1)
	    	    {
			 		$("#addr"+(i-1)).html('');
			 		i--;
	
	        		$.ajax({
				        type:'POST',
				        url:'ajax/team-button-ajaxData.php',
				        data:'data='+i,
	                	success:function(html){
	                    	$('#null').html(html);
	                	}
			        });			 
			 	}
		 	});

		});
</script>
	//validation

<script>
	$(document).ready(function(){
	    $('#Team_Name').focus(function(){
			$('#Team_Name').blur(function(){	
				if(document.forms["myForm"]["Team_Name"].value != '' && $(this).val().length<=30)
				{
					document.getElementById("Team_Name").className = "form-control form-control-success";
					$('#but').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Team_Name").className = "form-control form-control-danger";
					$('#but').attr('disabled','disabled');
				}
			});
		});		
	});
</script>
</body>
</html>