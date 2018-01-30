<?php include 'include/head.html';?>
	<link rel="stylesheet" href="css/separate/vendor/typeahead.min.css">
</head>
<body class="with-side-menu">
	<?php 
		include 'include/header.php';
		include 'include/admin-sidebar.php';
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
							<form method="post" action="php/team-modify-back.php">
								<div class="card-block">
								 	<div class="row" >			            
								        <div class="form-group col-md-6">
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

								        <div class="form-group col-md-6">
								          <div class="form-group">
								          	<label class="form-label semibold" for="Office_Name">Office Name</label>
								            <select class="form-control" id="Office_Name" name="Office_Name">
								              <option value="">Select Country first</option>
								            </select>
								          </div>
								        </div>
								    </div>

								 	<div class="row" >			            
								        <div class="form-group col-md-6">							          	
								            <div class="form-group">
								              	<label class="form-label semibold" for="CS_Executive_Id">CS Executive Name</label>
								                <select class="form-control" id="CS_Executive_Id" name="CS_Executive_Id">
								                  <option value="">Select office first</option>
								                </select>
								            </div>
								        </div>

								        <div class="form-group col-md-6">							          	
								            <div class="form-group">
								              	<label class="form-label semibold" for="Team_Name">Team Name</label>
								                <select class="form-control" id="Team_Name" name="Team_Name">
								                  <option value="">Select CS Executive first</option>
								                </select>
								            </div>
								        </div>				        				        									        
								    </div>

								    <div class="row">
								    	<div class="col-md-10"></div>
								    	<div class="col-md-2">
									    	<button type="submit" class="btn btn-primary" id="editbtn" style="width: 100%">Edit</button>
									    </div>
									</div>
								</div>
							</form>
						</section>
					</div>
				</div>
			</div><!--.container-fluid-->
		</div><!--.page-content-->
	<?php include 'include/commonjs.html';?>
	<script src="js/lib/typeahead/jquery.typeahead.min.js"></script>

	<script>
		$(document).ready(function(){
			var employee = [<?php 
                $result=$conn->query("SELECT * FROM employee_master WHERE IsMember = 0");
            	$rowCount = $result->num_rows;
                if($rowCount > 0){
                    while($row = $result->fetch_assoc()){ 
	                echo  '"'.$row['Employee_Id']. ' - ' . $row['Employee_Name'].'",';
                    }
                }
	        ?>];
			 $.typeahead({
		        input: "#test1",
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

<?php include 'include/country-office-cs-team.html'; ?>

</body>
</html>