<?php include 'include/head.html';?>
<link rel="stylesheet" href="css/separate/vendor/blockui.min.css">
<link rel="stylesheet" href="css/toastr.min.css"/>
</head>

<body class="with-side-menu">
	<?php 
		include 'include/header.php';
	    include 'include/admin-sidebar.php';

	    //Include database configuration file
	    include('include/dbConfig.php');

	    $sql = "SELECT * FROM region_master";
	    $result = $conn->query($sql);
	    $rowCount = $result->num_rows;
	    $sql1 = "SELECT r.Region_Name, c.Country_Name, c.Country_Id, c.IsActive from region_master r JOIN country_master c on c.Region_Id=r.Region_Id";
	    $result1 = $conn->query($sql1);
	    $rowCount1 = $result1->num_rows;
	?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 col-lg-6">
						<section class="box-typical box-typical-max-280 scrollable" style="height: 350px;">
							<header class="box-typical-header">
								<div class="tbl-row">
									<div class="tbl-cell tbl-cell-title">
										<h3>Countries</h3>
									</div>
									<div class="tbl-cell" style="position:absolute;right: 20px">										
										<span id="ton" class="fa fa-plus"></span>
									</div>
								</div>
							</header>
							<div class="box-typical-body">
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Region</th>
												<th>Country</th>
												<th>Is Active</th>
												<th width="1"></th>
											</tr>
										</thead>
										<tbody>
										 <?php
	                        				if($rowCount > 0){
	                        					echo "";
	                        					while($row = $result1->fetch_assoc())
	                        					{ 
	                        						echo '<tr>
	                        							  <td>'.$row['Region_Name'].'</td>
	                        							  <td>'.$row['Country_Name'].'</td>
	                        							  <td>';
	                        						if($row['IsActive']=='1')
	                        				    	{
	                        				    		echo 'Yes</td>
	                        				    		   <td><a href="php/inactive.php?country_d='.$row['Country_Id'].'"><button class="btn btn-sm btn-success"><span class="fa fa-power-off"></span></button></a></td>';
	                        						}
	                        						else
	                        						{
	                        							echo 'No</td>
	                        				    		   <td><a href="php/inactive.php?country_s='.$row['Country_Id'].'"><button class="btn btn-sm btn-danger"><span class="fa fa-power-off"></span></button></a></td>';
	                        						}
	                        						echo'</tr>';
	                            				}
	                        				}
	                      				?>
										</tbody>
									</table>
								</div>
							</div>
						</section>
					</div>
					<div id="ttt" class="col-md-4 col-lg-6">
						<section id="blockui-element-container-default" class="card">
							<header class="card-header">
								Add New Country
							</header>
							<div class="card-block display-table" style="min-height: 300px">
								 <form name="myForm" method="post" action="php/country_back.php">
								 	 <div class="form-group">
                						<label class="form-label semibold" for="Region_Name">Select Region in which country is to be added.</label>
                						<select class="form-control" name="Region_Name" id="Region_Name">
                     					 <?php
                        					if($rowCount > 0){
                        						echo '<option value="">Select Region</option>';                        
                            					while($row = $result->fetch_assoc()){ 
                                					echo '<option value="'.$row['Region_Id'].'">'.$row['Region_Name'].'</option>';
                            					}
                        					}else{
                            					echo '<option value="">No active Regions available</option>';
                        					}
                      					?>
                						</select>              
            						</div>
								 	<div class="form-group">
              							<label class="form-label semibold" for="Country_Name">Country Name</label>
              							<input type="text" class="form-control" id="Country_Name" name="Country_Name" placeholder="Enter Name" required>
            						</div>
            						<div class="checkbox">
										<input type="checkbox" name="IsActive" id="IsActive" checked="checked" value="selected">
										<label for="IsActive">Is Active</label>
									</div>
									<div class="form-group">
										<button type="submit" id="blockui-block-element-default" class="btn btn-primary">Add</button>
									</div>
            					</form>        
							</div>
						</section>
					</div>
				</div>
				<div style="clear:both;"></div>
			</div><!--.container-fluid-->
		</div><!--.page-content-->

	<?php include 'include/commonjs.html';?>
	<script src="js/toastr.min.js"></script>
	<script>
	    $(window).load(function(){
		    $("#ttt").hide();
	    });

		$(document).ready(function(){
		    $("#ton").click(function(){
		        $("#ttt").toggle();
		    });
		});
	</script>
	<script>
		$(document).ready(function()
		{
			// $('#blockui-block-element-default').attr('disabled','disabled');
		    $('#Country_Name').focus(function(){
				$('#Country_Name').blur(function(){	
				    var letters = /^[A-Za-z ']+$/;			
					if(document.forms["myForm"]["Country_Name"].value != '' && document.forms["myForm"]["Country_Name"].value.match(letters) && 
							document.forms["myForm"]["Country_Name"].value.length <=30){
    					document.getElementById("Country_Name").className = "form-control form-control-success";
    					$('#blockui-block-element-default').removeAttr('disabled');
					}
					else
					{
						document.getElementById("Country_Name").className = "form-control form-control-danger";	
						$('#blockui-block-element-default').attr('disabled','disabled');
					}
				});
			});				
		});
	</script>
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
		    	toastr.success('Success ! Country has been successfully Created.');
		    }
		    if(<?php if(isset($_SESSION["success"]) && $_SESSION["success"]==0){echo 'true';$_SESSION["success"]=2;}else{echo 'false';} ?>)		    
		    {
		    	toastr.error('Error ! There was an error in Country creation.');
		    }
		}(window.jQuery);
    </script>
	<script type="text/javascript" src="js/lib/blockUI/jquery.blockUI.js"></script>
	<script>
		$(function() {
			$('#blockui-block-element-default').on('click', function() {
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
				}, 2000);
			});
		});
	</script>
</body>
</html>