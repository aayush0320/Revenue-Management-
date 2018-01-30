<?php include 'include/head.html';?>
<link rel="stylesheet" href="css/separate/pages/invoice.min.css">
<style>
@page {
	size:A3 landscape;
	margin-left: 1cm;
    margin-right: 1cm;
}
</style>
</head>
<body class="with-side-menu">
	<?php 
		include 'include/header.php';
		include 'include/dbConfig.php';
		include 'include/sidebar.php';
		$data="";
		if($_GET["data"]!="")
		{
			$data=$_GET["data"];
		$stmt=$conn->query("SELECT * FROM activity_master");
		$Id=$stmt->num_rows;

		$stmt = $conn->prepare("INSERT INTO activity_master (Id, Day, Time, Date, Employee_Id, Proposal_Id, Mode) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("iisssss", $Id, $Day, $Time, $Date, $Employee_Id, $Proposal_Id, $Mode);
		$Id = $Id;
		$Date = date("m-d-Y");					
		$Day = date('w', strtotime($Date));
		$Time = date("h-i-sa");
		$Employee_Id = $_SESSION["Employee_Id"];
		$Proposal_Id = $_GET["data"];
		$Mode = "View";

		if($stmt->execute())
		{
			$result=$conn->query("SELECT * FROM proposal_master WHERE Proposal_Id = '".$data."'");
			$row=$result->fetch_assoc();
		}
		}
	?>
		<div class="page-content">
			<div class="container-fluid">			
				<section class="card"><!-- 
					<header class="card-header card-header-lg">
						Contract Creation
					</header> -->
					<div class="card-block invoice">
						<div class="row">
							<div class="col-md-6 company-info">
								<h5><?php echo $row["Client_Name"];?></h5>
								<p><?php echo $row["Client_Group"];?></p>
								<p><?php echo $row["Industry_Group"];?></p>

								<div class="invoice-block">
									<div>
										<?php
											$stmt=$conn->query('SELECT * FROM client_master WHERE Client_Name = "'.$row["Client_Name"].'"');
											$row1=$stmt->fetch_assoc();										
											echo $row1["Client_Address"];
										?>
									</div>
								</div>

								<div class="invoice-block">
									<div>Office: <?php echo $row1["Client_Office_No"] ?></div>
									<div>Personal: <?php echo $row1["Client_Personal_No"] ?></div>
									<div>Email: <?php echo $row1["Client_Email"] ?></div>
								</div>

								<div class="invoice-block">
									<h5>EoA:</h5>
									<div><?php $target_path = "uploads/"; echo "<a href=" . $target_path . basename($row['EOA']) . ">{$row['EOA']}</a>";?></div>
								</div>
							</div>
							<div class="col-md-6 clearfix invoice-info">
								<div class="text-lg-right">
									<h5><?php echo 'Proposal Id #'.$data; ?></h5>
									<div>Proposal Created: <?php echo $row["Created"] ?></div>
									<div>Proposal Approved: <?php echo $row["Approved"] ?></div>
								</div>

								<div class="payment-details">
									<strong>Proposal Details</strong>
									<table>
										<tr>
											<td>CS Executive:</td>
											<td>
												<?php 
													$stmt=$conn->query("SELECT Employee_Name from employee_master WHERE 
														Employee_Id = '".$row["CS_Executive_Id"]."'");
													$row1=$stmt->fetch_assoc();
													echo $row1["Employee_Name"]; 
												?>
											</td>
										</tr>
										<tr>
											<td>Team Lead:</td>
											<td>
												<?php 
													$stmt=$conn->query("SELECT Employee_Name from employee_master WHERE 
														Employee_Id = '".$row["Team_Leader_Id"]."'");
													$row1=$stmt->fetch_assoc();
													echo $row1["Employee_Name"]; 
												?>
											</td>
										</tr>
										<tr>
											<td>Country:</td>
											<td>
												<?php 
													$stmt=$conn->query("SELECT c.Country_Name, o.Zone, o.Office_Name from country_master c join office_master o on c.Country_Id = o.Country_Id join employee_master e on o.Office_Id = e.Office_Id join proposal_master p on e.Employee_Id = p.CS_Executive_Id WHERE p.Proposal_Id = '".$data."'");
													$row1=$stmt->fetch_assoc();
													echo $row1["Country_Name"]; 
												?>

											</td>
										</tr>
										<tr>
											<td>Zone:</td>
											<td><?php echo $row1["Zone"]; ?></td>
										</tr>
										<tr>
											<td>City:</td>
											<td><?php echo $row1["Office_Name"]; ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="row table-details">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th class="text-center">#</th>										
											<th>Business Unit</th>
											<th>Product</th>
											<th>Service</th>
											<th>Revenue</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$i=1;
										$total=0;
										$stmt=$conn->query("SELECT * FROM adhoc_subscription WHERE IsActive = 1 AND Proposal_Id = '".$data."'");
										$rowcount=$stmt->num_rows;
										if($rowcount>0)
										{
											while($row1=$stmt->fetch_assoc())
											{
												$stmt1=$conn->query("SELECT Business_Name from business_master WHERE Business_Id = ".$row1["Business_Id"]);
												$row2=$stmt1->fetch_assoc();
												$stmt2=$conn->query("SELECT Product_Name from product_master WHERE Product_Id = ".$row1["Product_Id"]);
												$row3=$stmt2->fetch_assoc();
												$stmt3=$conn->query("SELECT Service_Name from service_master WHERE Service_Id = ".$row1["Service_Id"]);
												$row4=$stmt3->fetch_assoc();
												echo'
												<tr>
													<td class="text-center" >'.$i.'</td>
													<td>'.$row2["Business_Name"].'</td>
													<td>'.$row3["Product_Name"].'</td>
													<td>'.$row4["Service_Name"].'</td>
													<td>'.number_format($row1["Revenue"]).'</td>
												</tr>';
												$i=$i+1;
												$total=$total=$row1["Revenue"];
											}
										}

										$stmt=$conn->query("SELECT * FROM onetime_track WHERE IsActive = 1 AND Proposal_Id = '".$data."'");
										$rowcount=$stmt->num_rows;
										if($rowcount>0)
										{
											while($row1=$stmt->fetch_assoc())
											{
												$stmt1=$conn->query("SELECT Business_Name from business_master WHERE Business_Id = ".$row1["Business_Id"]);
												$row2=$stmt1->fetch_assoc();
												$stmt2=$conn->query("SELECT Product_Name from product_master WHERE Product_Id = ".$row1["Product_Id"]);
												$row3=$stmt2->fetch_assoc();
												$stmt3=$conn->query("SELECT Service_Name from service_master WHERE Service_Id = ".$row1["Service_Id"]);
												$row4=$stmt3->fetch_assoc();
												echo'
												<tr>
													<td class="text-center" >'.$i.'</td>
													<td>'.$row2["Business_Name"].'</td>
													<td>'.$row3["Product_Name"].'</td>
													<td>'.$row4["Service_Name"].'</td>
													<td>'.number_format($row1["Total_Revenue"]).'</td>
												</tr>';
												$i=$i+1;
												$total=$total+$row1["Total_Revenue"];
											}
										}		
									?>

									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-7 terms-and-conditions">
								<strong>Description</strong>
								The Client has agreed over the policies as stated under Nielsen Accords 349C. 
							</div>
							<div class="col-md-5 clearfix">
								<div class="total-amount">
									<div>Total amount: <b><span class="colored"><?php echo number_format($total); ?></span></b></div>
									<div class="actions">
										<a href="#" onclick="history.go(-1)"><button class="btn btn-secondary btn-inline">Back</button></a>
										<button class="btn btn-inline" id="print">Print</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div><!--.container-fluid-->
		</div><!--.page-content-->
	<?php include 'include/commonjs.html';?>
	<script>
		$(document).ready(function() {
			$('#print').click(function(){
				window.print();
			});
		});
	</script>
</body>
</html>