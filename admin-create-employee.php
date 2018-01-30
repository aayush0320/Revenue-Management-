<?php include 'include/head.html';?>
<link rel="stylesheet" href="css/separate/vendor/bootstrap-daterangepicker.min.css">
<link rel="stylesheet" href="css/intlTelInput.css">
<link rel="stylesheet" href="css/separate/vendor/blockui.min.css">
<link rel="stylesheet" href="css/toastr.min.css"/>
</head>

<body class="with-side-menu">
	<?php 
		include 'include/header.php';
		include 'include/admin-sidebar.php';

		//Include database configuration file
		include('include/dbConfig.php');

		$data="";
		if(isset($_SESSION["mod_emp"]))
		{
			$data=$_SESSION["mod_emp"];
		}
			$stmt=$conn->query("SELECT * From employee_master where Employee_Id = '".$data."'");
			$emp=$stmt->fetch_assoc();	

		if($data!="")
		{
			$stmt = $conn->query("SELECT * from country_master where Country_Id = ".$emp["Country_Id"]);	
			$country=$stmt->fetch_assoc();

			$stmt=$conn->query("SELECT * from office_master where Office_Id = ".$emp["Office_Id"]);
			$office=$stmt->fetch_assoc();			
		}

		$sql = "SELECT * FROM country_master WHERE IsActive = 1";
		$result = $conn->query($sql);
		$rowCount = $result->num_rows;
	?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<section class="card" id="blockui-element-container-default">
							<div class="card-block">
								<form name="myForm" method="post" action="php/employee_back.php">
						         	<div class="row" >	
										<div class="form-group col-md-4">
						            		<label class="form-label semibold" for="Employee_Name">Employee Name</label>
								            	<?php echo'<input type="text" class="form-control" id="Employee_Name" name="Employee_Name" 
						            						value="'.$emp["Employee_Name"].'" required placeholder="Employee Name">';?>
						          		</div>
						          		<div class="form-group col-md-4">
							          		<label class="form-label semibold" for="Employee_Dob">Date of Birth</label>
								            <div class='input-group date'><!-- value="10/24/2000" -->
								            	<?php echo'<input id="Employee_Dob" name="Employee_Dob" type="text" class="form-control 
						            						value="'.$emp["Employee_Dob"].'">';?>
											</div>						              
								         </div>
						          	</div>

						          	<div class="row" >
								    	<div class="form-group col-md-4">
								            <label class="form-label semibold" for="Employee_Contact_No">Contact Number</label>
								            	<?php echo'<input type="tel" id="demo" class="form-control" name="Employee_Contact_No"  
								            				placeholder="Contact Number" style="min-width: 320px" value="'.$emp["Employee_Contact_No"].'">';?>
								        </div>

								        <div class="form-group col-md-4">
								            <label class="form-label semibold" for="Email">Email Id</label>
								            <?php echo'<input type="email" class="form-control" id="Email" name="Email" placeholder="Email Address of Employee" value="'.$emp["Email"].'" required>';?>
								        </div>
								    </div>

						         	<div class="row" >			            
							            <div class="form-group col-md-4">
							                <div class="form-group">
							                    <?php
										            echo'<label class="form-label semibold" for="Country_Name">Country Name</label>
										                <select class="form-control" name="Country_Name" id="Country_Name">';
							                    	if($data!="")
							                    	{
							            				echo '<option value="'.$emp["Country_Id"].'">'.$country["Country_Name"].'</option>';
							                    	}
							                    	else
							                    	{
											            echo'<option value="">Select Country</option>';							                    		
							                    	}
								                   	    if($rowCount > 0)
								                   	    {
								                            while($row = $result->fetch_assoc())
								                            { 
								                                if($row['Country_Id']!=$emp["Country_Id"])
								                                	echo '<option value="'.$row['Country_Id'].'">'.$row['Country_Name'].'</option>';
								                        	}
								                        }
								                        else
								                        {
								                            echo '<option value="">Country not available</option>';
								                        }								                    		
							                    	echo'</select>';
							                    ?>              
								            </div>
							            </div>

							            <div class="form-group col-md-4">
							              <div class="form-group">
						                    <?php
								                echo'
									              	<label class="form-label semibold" for="Office_Name">Office Name</label>
									                <select class="form-control" id="Office_Name" name="Office_Name">';
						                    	if($data!="")
						                    	{ 
						            				echo'<option value="'.$emp["Office_Id"].'">'.$office["Office_Name"].'</option>';
						                    	}
						                    	else
						                    	{
									            	echo'<option value="">Select office first</option>';
						                    	}
									            echo'</select>';
						                    ?>
							              </div>
							            </div>
						          	</div>

								    <div class="row" >
								    	<div class="form-group col-md-4">
								            <label class="form-label semibold" for="Department">Department</label>
							            	<?php echo'<input type="text" class="form-control" id="Department" name="Department" required placeholder="Enter Department Name" value="'.$emp["Department_Id"].'">';?>							            
								        </div>								         
								        <div class="form-group col-md-4">
								        	<label class="form-label semibold" for="Employee_Designation">Employee Designation</label>							
											<select class="form-control" name="Employee_Designation" id="Employee_Designation">
												<?php
													if($data!="")
													{
														echo'<option value="'.$emp["Employee_Designation"].'">';
														if($emp["Employee_Designation"]==0)
														{
															echo'Viewer
																</option>
																<option value="1">CS</option>';
														}
														else
														{
															echo'CS
																</option>
																<option value="0">Veiwer</option>';
														}
														
													}
													else
													{
														echo'<option>Select Designation</option>
															<option value="0">Veiwer</option>
															<option value="1">CS</option>';	
													}
												?>
											</select>						            
								        </div>
								    </div>						          	
									
									<div class="row" >
								    	<div class="form-group col-md-8">
						            		<label class="form-label semibold" for="Residance_Address">Residential Address</label>
						            		<textarea class="form-control" id="Residance_Address" name="Residance_Address" placeholder="Employee's Residential Address" required><?php echo $emp["Residance_Address"];?></textarea>
						          		</div>
						          	</div>

						          	<div class="row" >	
										<div class="form-group col-md-4">
							          		<div class="checkbox">
												<input type="checkbox" name="IsActive" id="IsActive" checked="checked" value="selected">
												<label class="form-label semibold" for="IsActive">Is Active</label>
									  		</div>
									  	</div>
									  	<div class="form-group col-md-6"></div>
									  		<button type="submit" id="test" class="btn btn-primary">
										  		<?php
										  			if($data!="")
										  			{
														echo'Save';									  				
										  			}
										  			else
										  			{
														echo'Submit';
											        }
											    ?>
											</button>
							        </div>
						        </form>
						    </div>
						</section>
					</div>
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
		    	toastr.success('Success ! Employee has been successfully Created.');
		    }
		    if(<?php if(isset($_SESSION["success"]) && $_SESSION["success"]==0){echo 'true';$_SESSION["success"]=2;}else{echo 'false';} ?>)		    
		    {
		    	toastr.error('Error ! There was an error in Employee creation.');
		    }
		}(window.jQuery);
    </script>
<!-- Date Picker -->	
	<script src="js/lib/moment/moment-with-locales.min.js"></script>
  	<script src="js/lib/daterangepicker/daterangepicker.js"></script>  
	<script>
	    $(function() {
		    $('#Employee_Dob').daterangepicker({
		        singleDatePicker: true,
		        showDropdowns: true
		    });
	    });
	</script>
<!-- Country Code Selector -->
	<script src="js/intlTelInput.js"></script>
	<script>
		$(document).ready(function(){
			$("#demo").intlTelInput();
		});
	</script>

	
	<?php include 'include/country-office-cs-team.html'; ?>

	<script type="text/javascript" src="js/lib/blockUI/jquery.blockUI.js"></script>
    <script>
		$(function() {
			$('#test').on('click', function() {
				$('#blockui-element-container-default').block({
					message: '<div class="blockui-default-message"><i class="fa fa-circle-o-notch fa-spin"></i><h6>We are processing your request. <br> Please be patient.</h6></div>',
					overlayCSS:  {
						background: 'rgba(142, 159, 167, 0.8)',
						opacity: 1,
						cursor: 'wait'
					},
					css: {
						width: '50%'
					},
					blockMsgClass: 'block-msg-default'
				});

				setTimeout(function() {
					$('#blockui-element-container-default').unblock()
				}, 17000);
			});
		});
	</script>
	
	<script>
		$(document).ready(function(){
		    $('#Employee_Name').focus(function(){
				$('#Employee_Name').blur(function(){	
					var letters = /^[A-Za-z ']+$/;
					if(document.forms["myForm"]["Employee_Name"].value != '' && document.forms["myForm"]["Employee_Name"].value.match(letters)  && $(this).val().length<=50)
					{
						document.getElementById("Employee_Name").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Employee_Name").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});

		    $('#Department').focus(function(){
				$('#Department').blur(function(){
					var letters = /^[A-Za-z ']+$/;	
					if(document.forms["myForm"]["Department"].value != '' && document.forms["myForm"]["Department"].value.match(letters)  && $(this).val().length<=30)
					{
						document.getElementById("Department").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Department").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});

		    $('#Residance_Address').focus(function(){
				$('#Residance_Address').blur(function(){	
					if(document.forms["myForm"]["Residance_Address"].value != '' && $(this).val().length<=50)
					{
						document.getElementById("Residance_Address").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Residance_Address").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});

		    $('#Email').focus(function(){
				$('#Email').blur(function(){
					var letters = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;	
					if(document.forms["myForm"]["Email"].value != '' && document.forms["myForm"]["Email"].value.match(letters) && $(this).val().length<=200)
					{
						document.getElementById("Email").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Email").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});

		});		
	</script>
</body>
</html>