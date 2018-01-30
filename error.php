<?php include 'include/head.html';?>
</head>
<body style="background:#fff">
	<?php include 'include/header.php';?>
		<div class="page-content">
			<div class="container-fluid">			
				<center>
					<img src="img/test.gif" style="height: 400px; width: 365px">
					<h2> Error <?php echo $_SESSION["Error_Code"]; $_SESSION["Error_Code"]="" ?> Detected</h2>
					<p class="lead color-blue-grey-lighter">Developers are working the solution.</p>
					<div class="row">
						<div class="col-md-4"></div>	
						<div class="col-md-2" style="margin-top: 10px">					
							<a href="proposal-list.php" class="btn" style="width: 100%">Dashboard</a>
						</div>
						<div class="col-md-2" style="margin-top: 10px">
							<a href="#" onclick="history.go(-1)" class="btn" style="width: 100%">Return</a>
						</div>						
						<div class="col-md-4"></div>
					</div>
				</center>
			</div>
		</div>
	<?php include 'include/commonjs.html';?>
</body>
</html>