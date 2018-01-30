<?php include 'include/head.html';?>

<link rel="stylesheet" href="css/separate/pages/widgets.min.css">
</head>
<body class="with-side-menu">
	<?php 
		include 'include/header.php';
		include 'include/admin-sidebar.php';
		include 'include/dbConfig.php';

		$JAN=0;
		$FEB=0;
		$MAR=0;
		$APR=0;
		$MAY=0;
		$JUN=0;
		$JUL=0;
		$AUG=0;
		$SEP=0;
		$OCT=0;
		$NOV=0;
		$DEC=0;

		$stmt = $conn->query("SELECT * FROM proposal_master");
		$total_proposal = $stmt->num_rows;

		if($total_proposal > 0)
		{
			while($result = $stmt->fetch_assoc())
			{
				$date = $result["Created"];
				$month = substr($date,3,2);
				if($month == '01')
					{
						$JAN = $JAN + 1;
					}
				elseif($month == '02')
					{
						$FEB = $FEB + 1;					
					}
				elseif($month == '03')
					{
						$MAR = $MAR + 1;					
					}
				elseif($month == '04')
					{
						$APR = $APR + 1;					
					}										
				elseif($month == '05')
					{
						$MAY = $MAY + 1;					
					}
				elseif($month == '06')
					{
						$JUN = $JUN + 1;					
					}
				elseif($month == '07')
					{
						$JUL = $JUL + 1;					
					}
				elseif($month == '08')
					{
						$AUG = $AUG + 1;					
					}
				elseif($month == '09')
					{
						$SEP = $SEP + 1;					
					}
				elseif($month == '10')
					{
						$OCT = $OCT + 1;					
					}
				elseif($month == '11')
					{
						$NOV = $NOV + 1;					
					}				
				elseif($month == '12')
					{
						$DEC = $DEC + 1;					
					}
				else{}																															
			}
		}

		$stmt = $conn->query("SELECT p.Proposal_Id from proposal_master p join employee_master e on e.Employee_Id = p.CS_Executive_Id join country_master c on e.Country_Id = c.Country_Id
								WHERE c.Country_Name = 'India'");
		$india = $stmt->num_rows;

		$stmt = $conn->query("SELECT p.Proposal_Id from proposal_master p join employee_master e on e.Employee_Id = p.CS_Executive_Id join country_master c on e.Country_Id = c.Country_Id
								WHERE c.Country_Name = 'USA'");
		$usa = $stmt->num_rows;

		$stmt = $conn->query("SELECT SUM(a.Revenue) as total from adhoc_subscription a join proposal_master p on p.Proposal_Id=a.Proposal_Id 
								WHERE p.Proposal_Status != 'Complete' and p.Proposal_Status != 'Cancelled'");
		$open = $stmt->fetch_assoc();
		$total1 = $open["total"];

		$stmt = $conn->query("SELECT SUM(a.Total_Revenue) as total from onetime_track a join proposal_master p on p.Proposal_Id=a.Proposal_Id 
								WHERE p.Proposal_Status != 'Complete' and p.Proposal_Status != 'Cancelled'");
		$open = $stmt->fetch_assoc();
		$total1 = $total1 + $open["total"];

		$stmt = $conn->query("SELECT SUM(a.Revenue) as Total from adhoc_subscription a join proposal_master p on p.Proposal_Id=a.Proposal_Id 
								WHERE p.Proposal_Status = 'Complete'");
		$open = $stmt->fetch_assoc();
		$total2 = $open["Total"];

		$stmt = $conn->query("SELECT SUM(a.Total_Revenue) as Total from onetime_track a join proposal_master p on p.Proposal_Id=a.Proposal_Id 
								WHERE p.Proposal_Status = 'Complete'");
		$open = $stmt->fetch_assoc();
		$total2 = $total2 + $open["Total"];

		$stmt = $conn->query("SELECT SUM(a.Revenue) as total1 from adhoc_subscription a join proposal_master p on p.Proposal_Id=a.Proposal_Id 
								WHERE p.Proposal_Status = 'Cancelled'");
		$open = $stmt->fetch_assoc();
		$total3 = $open["total1"];

		$stmt = $conn->query("SELECT SUM(a.Total_Revenue) as total1 from onetime_track a join proposal_master p on p.Proposal_Id=a.Proposal_Id 
								WHERE p.Proposal_Status = 'Cancelled'");
		$open = $stmt->fetch_assoc();
		$total3 = $total3 + $open["total1"];
		
		if(($total2+$total3)==0)
		{
			$dif=0;
		}
		else
		{
		$dif = ($total2/($total2+$total3))*100;			
		}
	?>
	<div class="page-content">
		<div class="container-fluid">			
			<div class="row">
                <div class="col-md-3">
                    <article class="statistic-box red" style="background-image:url(img/statistic-box-red.png)">
                        <div style="background:url(img/statistic-box-grid.png) 50% 0;background-size:21px 20px;">
                            <div class="number" style="font-size:40px"><?php echo '$ '.number_format($total1); ?></div>
                            <div class="caption"><div>Pipeline Revenue</div></div>
                        </div>
                    </article>
                </div>
                <div class="col-md-3">
                    <article class="statistic-box purple" style="background-image:url(img/statistic-box-purple.png)">
                        <div style="background:url(img/statistic-box-grid.png) 50% 0;background-size:21px 20px;">
                            <div class="number" style="font-size:40px"><?php echo '$ '.number_format($total2); ?></div>
                            <div class="caption"><div>Generated Revenue</div></div>
                        </div>
                    </article>
                </div>
                <div class="col-md-3">
                    <article class="statistic-box yellow" style="background-image:url(img/statistic-box-yellow.png)">
                        <div style="background:url(img/statistic-box-grid.png) 50% 0;background-size:21px 20px;">
                            <div class="number" style="font-size:40px"><?php echo '$ '.number_format($total3); ?></div>
                            <div class="caption"><div>Cancelled Revenue</div></div>
                        </div>
                    </article>
                </div>
                <div class="col-md-3">
                    <article class="statistic-box green" style="background-image:url(img/statistic-box-green.png)">
                        <div style="background:url(img/statistic-box-grid.png) 50% 0;background-size:21px 20px;">
                            <div class="number" style="font-size:40px"><?php echo floor($dif) .'%'; ?></div>
                            <div class="caption"><div>Success Rate</div></div>
                        </div>
                    </article>
                </div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<section class="widget widget-chart-extra">
						<div class="widget-chart-extra-blue">
							<div class="widget-chart-extra-blue-title">Proposals Generated</div>
							<div id="chart_line" class="chart"></div>
						</div>
					</section>					
				</div>
				
				<div class="col-md-6">
 					<section class="widget widget-pie-chart" style="height: 302px">
						<div class="widget-pie-chart-header">
							<div class="col-60">
								<div class="widget-pie-chart-header-title">Country Proposals</div>
							</div>
						</div>
						<div class="tbl tbl-grid">
							<div class="tbl-row">
								<div class="tbl-cell tbl-cell-60">
									<div class="ggl-pie-chart-container size-180">
										<div id="donutchart3" class="ggl-pie-chart"></div>
										<div class="ggl-pie-chart-title">
											<div class="caption">Total</div>
											<div class="number"><?php echo $total_proposal; ?></div>
										</div>
									</div>
								</div>
								<div class="tbl-cell tbl-cell-40">
									<ul class="chart-legend-list font-16">
										<li>
											<div class="dot blue"></div>
											India
										</li>
										<li>
											<div class="dot purple"></div>
											USA
										</li>
									</ul>
								</div>
							</div>
						</div>
					</section>					
				</div>				
			</div>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	<?php include 'include/commonjs.html';?>
	<script src="js/loader.js"></script>
	<script>
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawBasic);

		function drawBasic() {

			var data = google.visualization.arrayToDataTable([
				['Month', 'Value'],
				['JAN', <?php echo $JAN; ?>],
				['FEB', <?php echo $FEB; ?>],
				['MAR', <?php echo $MAR; ?>],
				['APR', <?php echo $APR; ?>],
				['MAY', <?php echo $MAY; ?>],
				['JUN', <?php echo $JUN; ?>],
				['JUL', <?php echo $JUL; ?>],
				['AUG', <?php echo $AUG; ?>],
				['SEP', <?php echo $SEP; ?>],
				['OCT', <?php echo $OCT; ?>],
				['NOV', <?php echo $NOV; ?>],
				['DEC', <?php echo $DEC; ?>]	
			]);

			var options = {
				legend: 'none',
				areaOpacity: 0.18,
				tooltip: { trigger: 'none' },
				hAxis: {
					textStyle: {
						color: '#fff',
						fontName: 'Proxima Nova',
						fontSize: 11,
						bold: true
					},
					gridlines: 'null'
				},
				vAxis: {
					minValue: 0,
					textStyle: {
						color: '#fff',
						fontName: 'Proxima Nova',
						fontSize: 11,
						bold: true
					},
					baselineColor: '#16b4fc',
					// ticks: [0,4,8,12,16,20,24,28,32,36],
					gridlines: {
						color: '#1ba0fc',
						count: 7
					},
				},
				lineWidth: 2,
				colors: ['#fff'],
				curveType: 'function',
				pointSize: 5,
				pointShapeType: 'circle',
				pointFillColor: '#f00',
				backgroundColor: {
					fill: '#008ffb',
					strokeWidth: 0
				},
				chartArea:{
					left: '10%',
					top: 5,
					width:'80%',
					height: 200
				}
			};

			var chart = new google.visualization.AreaChart(document.getElementById('chart_line'));

			chart.draw(data, options);
		}
		$(window).resize(function(){
			drawBasic();
		});
	</script>
	<script type="text/javascript">
		google.charts.setOnLoadCallback(drawChart3);
		function drawChart3() {
			var data = google.visualization.arrayToDataTable([
				['Titles', 'Values'],
				['India', <?php echo $india; ?>],
				['USA', <?php echo $usa; ?>]
				// ['Social media', 12],
				// ['Adwords', 41],
				// ['E-Commerce', 39]
			]);

			var options = {
				legend: 'none',
				pieSliceText: 'none',
				chartArea: {
					width: '90%',
					height: '90%',
				},
				colors:['#00a8ff','#ac6bec'],//'#46c35f','#fa424a','#e84f9a','#fdad2a',
				slices: {
					0: { color: '#00a8ff' },
					1: { color: '#ac6bec' }
				},
				pieHole: 0.8,
				tooltip: { trigger: 'none' }
			};

			var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
			chart.draw(data, options);
		}
	</script>
	<script>
		setTimeout(function(){
		   window.location.reload(1);
		}, 5000);
	</script>

</body>
</html>