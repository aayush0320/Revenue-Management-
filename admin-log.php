<?php include 'include/head.html';?>
<link rel="stylesheet" href="css/separate/pages/activity.min.css">
<link rel="stylesheet" href="css/separate/vendor/typeahead.min.css">
</head>
<body class="with-side-menu">
	<?php include 'include/header.php';?>
	<?php include 'include/admin-sidebar.php';
		//Include database configuration file
		include('include/dbConfig.php');
	?>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						<section class="card">
							<header class="card-header">
								Find Log
							</header>
							<div class="card-block">
								 <form>
								 	<div class="row">
              							<div class="typeahead-container col-md-9 col-xs-8">
              								<input type="text" class="form-control" id="Employee_Id" name="Employee_Id" placeholder="Enter Name Employee Id">
            							</div>        
            							<div class="col-md-3 col-xs-4">		
											<button type="button"  id="but" style="width: 100%" class="btn btn-primary">Get log</button>
										</div>    					
            						</div>
            					</form>        
							</div>
						</section>						
					</div>
				</div>
				<div class="row">					
					<div class="col-md-8" id="print"></div>
				</div>
			</div><!--.container-fluid-->
		</div><!--.page-content-->
	<?php include 'include/commonjs.html';?>

<script src="js/lib/typeahead/jquery.typeahead.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
	     	var employee = [<?php 
                $result=$conn->query("SELECT * FROM employee_master");
            	$rowCount = $result->num_rows;
                if($rowCount > 0){
                    while($row = $result->fetch_assoc()){ 
	                echo  '"'.$row['Employee_Id']. ' - ' . $row['Employee_Name'].'",';
                    }
                }
	        ?>];
			 $.typeahead({
		        input: "#Employee_Id",
		        order: "asc",
		        minLength: 1,
		        source: {
		            data: employee
		        }
			});


			$('#but').click(function(){
	            var Id = document.getElementById('Employee_Id').value;
				if(Id!="")
				{
					$.ajax({
						type:'post',
						url:'ajax/log-ajaxData.php',
						data:{Id : Id},
						success:function(html){
							$('#print').html(html);
						}
					});
				}
				else
				{
					$('#print').html();
				}

			});
		});
	</script>

</body>
</html>