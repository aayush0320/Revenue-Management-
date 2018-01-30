<?php include 'include/head.html';?>
<link rel="stylesheet" href="css/separate/vendor/blockui.min.css">
</head>

<body class="with-side-menu">
	<?php 

		include 'include/header.php';
	    include 'include/admin-sidebar.php';

	    //Include database configuration file
	    include('include/dbConfig.php');

        $sql = "SELECT * FROM business_master";
        $result = $conn->query($sql);
        $rowCount = $result->num_rows;
        $sql1 = "SELECT b.Business_Name, p.Product_Name, p.Product_Id, p.IsActive from business_master b JOIN product_master p on p.Business_Id=b.Business_Id";
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
										<h3>Products</h3>
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
												<th>BU</th>
												<th>Product</th>
												<th>Is Active</th>
												<th width="1"></th>
											</tr>
										</thead>
										<tbody>
											<?php
		                        				if($rowCount > 0)
		                        				{
		                        					echo "";
		                        					while($row = $result1->fetch_assoc())
		                        					{ 
		                        						echo '<tr>
		                        							  <td>'.$row['Business_Name'].'</td>
		                        							  <td>'.$row['Product_Name'].'</td>
		                        							  <td>';
		                        						if($row['IsActive']=='1')
		                        				    	{
		                        				    		echo 'Yes</td>
		                        				    		   <td><a href="php/inactive.php?product_d='.$row['Product_Id'].'"><button class="btn btn-sm btn-success"><span class="fa fa-power-off"></span></button></a></td>';
		                        						}
		                        						else
		                        						{
		                        							echo 'No</td>
		                        				    		   <td><a href="php/inactive.php?product_s='.$row['Product_Id'].'"><button class="btn btn-sm btn-danger"><span class="fa fa-power-off"></span></button></a></td>';
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
								Add New Product
							</header>
							<div class="card-block display-table" style="min-height: 300px">
								 <form method="post" action="php/product_back.php">
								 	 <div class="form-group">
                						<label class="form-label semibold" for="Business_Name">Select Business Unit to which product is to be added.</label>
                						<select class="form-control" name="Business_Name" id="Business_Name">
                     					 <?php
                        					if($rowCount > 0){
                        						echo '<option value="">Select Business Unit</option>';                        
                            					while($row = $result->fetch_assoc()){ 
                                					echo '<option value="'.$row['Business_Id'].'">'.$row['Business_Name'].'</option>';
                            					}
                        					}else{
                            					echo '<option value="">No Business Units Available</option>';
                        					}
                      					?>
                						</select>              
            						</div>
								 	<div class="form-group">
              							<label class="form-label semibold" for="Product_Name">Product Name</label>
              							<input type="text" class="form-control" id="Product_Name" name="Product_Name" placeholder="Enter Name">
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
			</div><!--.container-fluid-->
		</div><!--.page-content-->

	<?php include 'include/commonjs.html';?>
	<script type="text/javascript" src="js/lib/blockUI/jquery.blockUI.js"></script>
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