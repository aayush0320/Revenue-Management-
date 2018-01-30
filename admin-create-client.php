<?php include 'include/head.html';?>
<link rel="stylesheet" href="css/intlTelInput.css">
<link rel="stylesheet" href="css/toastr.min.css"/>
</head>

<body class="with-side-menu">
	<?php 
		include 'include/header.php';
		include 'include/admin-sidebar.php';

	    //Include database configuration file
	    include('include/dbConfig.php');

		$data="";
		if(isset($_SESSION["mod_client"]))
		{
			$data=$_SESSION["mod_client"];
		}
			$stmt=$conn->query("SELECT * From client_master where Client_Name = '".$data."'");
			$client=$stmt->fetch_assoc();	

		if($data!="")
		{
			$stmt = $conn->query("SELECT * from country_master where Country_Id = ".$client["Country_Id"]);	
			$country=$stmt->fetch_assoc();
		}

	    $sql = "SELECT * FROM country_master";
	    $result = $conn->query($sql);
	    $rowCount = $result->num_rows;
	?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<section class="card">
							<div class="card-block"> 
								<form name="myForm"  method="post" action="php/client_back.php">
							        <div class="row" >	
										<div class="form-group col-md-8">
	    									<label class="form-label semibold" for="Client_Name"> Client Name </label>
	   											<?php 
			   										echo'<input type="text" class="form-control" id="Client_Name_1" name="Client_Name" placeholder="Enter Clients Name" required value = "'.$client["Client_Name"].'" required>';
	   											?>
	 									</div>
	 								</div>

						         	<div class="row" >	
										<div class="form-group col-md-4">
	        								<label class="form-label semibold" for="Client_Group"> Client Group </label>
	   											<?php 
			   										echo'<input type="text" class="form-control" id="Client_Group" name="Client_Group" placeholder="Enter Clients Name" value = "'.$client["Client_Group"].'" required>';
	   											?>
	     								</div>      
	      								<div class="form-group col-md-4">
	        								<label class="form-label semibold" for="Industry_Group">Industry Group</label>
	        								<select class="form-control" id="Industry_Group" name="Industry_Group">
								                <?php
								                	if($data!="")
								                		{
								                			if($client["Industry_Group"]=="FMCG")
								                			{
													            echo'<option value="FMCG">FMCG</option>
													                <option value="Auto">Auto</option>
													                <option value="Finance">Finance</option>
													                <option value="Durables">Durables</option>
													                <option value="Media">Media</option>';
								                			}
								                			elseif($client["Industry_Group"]=="Auto")
								                			{
													            echo'<option value="Auto">Auto</option>
													            	<option value="FMCG">FMCG</option>
													                <option value="Finance">Finance</option>
													                <option value="Durables">Durables</option>
													                <option value="Media">Media</option>';
								                			}
								                			elseif($client["Industry_Group"]=="Finance")
								                			{
													            echo'<option value="Finance">Finance</option>
													            	<option value="FMCG">FMCG</option>
													                <option value="Auto">Auto</option>      
													                <option value="Durables">Durables</option>
													                <option value="Media">Media</option>';
								                			}
								                			elseif($client["Industry_Group"]=="Durables")
								                			{
													            echo'<option value="Durables">Durables</option>
													            	<option value="FMCG">FMCG</option>
													                <option value="Auto">Auto</option>
													                <option value="Finance">Finance</option>	                
													                <option value="Media">Media</option>';
								                			}
								                			else
								                			{
													            echo'<option value="Media">Media</option>
													            	<option value="FMCG">FMCG</option>
													                <option value="Auto">Auto</option>
													                <option value="Finance">Finance</option>
													                <option value="Durables">Durables</option>';
								                			}
								                		}
								                	else
								                		{
											            echo'<option>Select Industry Group</option>
											                <option value="FMCG">FMCG</option>
											                <option value="Auto">Auto</option>
											                <option value="Finance">Finance</option>
											                <option value="Durables">Durables</option>
											                <option value="Media">Media</option>';
								                		}
								                ?>
								            </select>
	      								</div>
	      							</div>

	      							<div class="row" >	
										<div class="form-group col-md-4">
	        								<label class="form-label semibold" for="Client_Office_No">Contact Number</label>
	   											<?php 
			   										echo'<input type="tel" id="demo" class="form-control" name="Client_Office_No" placeholder="Client Office" style="min-width: 320px" value = "'.$client["Client_Office_No"].'">';
	   											?>
	      								</div>
	      								<div class="form-group col-md-4">
	        								<label class="form-label semibold" for="Client_Personal_No">Contact Number</label>
	   											<?php 
			   										echo'<input type="tel" id="demo1" class="form-control" name="Client_Personal_No" placeholder="Client Personal" style="min-width: 320px" value = "'.$client["Client_Personal_No"].'">';
	   											?>
	      								</div>
	      							</div>

									<div class="row" >	
										<div class="form-group col-md-4">
											<label class="form-label semibold" for="exampleInputEmail1">Email address</label>
	   											<?php 
			   										echo'<input type="email" class="form-control" name="Client_Email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required 
			   											value = "'.$client["Client_Email"].'" required>';
	   											?>											
										</div>
										<div class="form-group col-md-4">
						                    <?php
									            echo'<label class="form-label semibold" for="Country_Name">Country Name</label>
									                <select class="form-control" name="Country_Name" id="Country_Name">';
						                    	if($data!="")
						                    	{
						            				echo '<option value="'.$client["Country_Id"].'">'.$country["Country_Name"].'</option>';
						                    	}
						                    	else
						                    	{
										            echo'<option value="">Select Country</option>';							                    		
						                    	}
							                   	    if($rowCount > 0)
							                   	    {
							                            while($row = $result->fetch_assoc())
							                            { 
							                                if($row['Country_Id']!=$client["Country_Id"])
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

									<div class="row" >	
										<div class="form-group col-md-8">
											<label class="form-label semibold" for="Client_Address">Address</label>
											<textarea  class="form-control" name="Client_Address" id="Client_Address" placeholder="Enter Company Address" required><?php echo $client["Client_Address"];?></textarea>
										</div>
									</div>


									
	      							<div class="row" >	
										<div class="form-group col-md-4">
<!-- 							          		<div class="checkbox">
												<input type="checkbox" name="IsActive" id="IsActive" checked="checked" value="selected">
												<label class="form-label semibold" for="IsActive">Is Active</label>
									  		</div> -->
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
		    	toastr.success('Success ! Client has been successfully Created.');
		    }
		    if(<?php if(isset($_SESSION["success"]) && $_SESSION["success"]==0){echo 'true';$_SESSION["success"]=2;}else{echo 'false';} ?>)		    
		    {
		    	toastr.error('Error ! There was an error in client creation.');
		    }
		}(window.jQuery);
    </script> 

	<!-- Country Code Selector -->
	<script src="js/intlTelInput.js"></script>
	<script>
		$(document).ready(function(){
			$("#demo").intlTelInput();			
			$("#demo1").intlTelInput();
		});
	</script>
	<script>
		$(document).ready(function(){

		    $('#Client_Name_1').focus(function(){
				$('#Client_Name_1').blur(function(){
					var letters = /^[A-Za-z ']+$/;	
					if(document.forms["myForm"]["Client_Name_1"].value != '' && document.forms["myForm"]["Client_Name_1"].value.match(letters) && $(this).val().length<=50)
					{
						document.getElementById("Client_Name_1").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Client_Name_1").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});

		    $('#Client_Group').focus(function(){
				$('#Client_Group').blur(function(){
					var letters = /^[A-Za-z ']+$/;	
					if(document.forms["myForm"]["Client_Group"].value != '' && document.forms["myForm"]["Client_Group"].value.match(letters)  && $(this).val().length<=50)
					{
						document.getElementById("Client_Group").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Client_Group").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});

		    $('#Client_Address').focus(function(){
				$('#Client_Address').blur(function(){
					var letters = /^[A-Za-z ,.'0-9]+$/;	
					if(document.forms["myForm"]["Client_Address"].value != '' && document.forms["myForm"]["Client_Address"].value.match(letters) && $(this).val().length<=200)
					{
						document.getElementById("Client_Address").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Client_Address").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});

		    $('#exampleInputEmail1').focus(function(){
				$('#exampleInputEmail1').blur(function(){
					var letters = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;	
					if(document.forms["myForm"]["exampleInputEmail1"].value != '' && document.forms["myForm"]["exampleInputEmail1"].value.match(letters) && $(this).val().length<=200)
					{
						document.getElementById("exampleInputEmail1").className = "form-control form-control-success";
						$('#test').removeAttr('disabled');
					}
					else
					{
						document.getElementById("exampleInputEmail1").className = "form-control form-control-danger";
						$('#test').attr('disabled','disabled');
					}
				});
			});		    
		});		
	</script>	
</body>
</html>