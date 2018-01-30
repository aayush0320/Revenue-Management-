<?php include 'include/head.html';?>
	<link rel="stylesheet" href="css/lib/bootstrap-table/bootstrap-table.min.css">
</head>
<?php
	

?>
<body class="with-side-menu">

	
	<?php
		include 'include/header.php';
		include 'include/dbConfig.php'; 
		include 'include/sidebar.php';
		$result=$conn->query("SELECT * FROM proposal_master WHERE IsActive = 1");
		$Result=$result;
		$rowCount=$result->num_rows;
	?>

	<div class="page-content">
		<div class="container-fluid">
			<section class="box-typical scrollable">
	    		<!-- <div class="table-responsive"> -->
	    			<div id="toolbar">
						<STRONG>Proposal List</STRONG>
					</div>
			    	<table id="table"
			    		data-toolbar="#toolbar"
			    		data-show-columns="true"
			    		data-detail-view="true"
			    		data-detail-formatter="detailFormatter"
						data-minimum-count-columns="3"
						data-show-export="true"
						data-show-pagination-switch="true"
						data-pagination="true"
						data-page-list="[5, 10, 15, 20, 25, 50, 100, ALL]"
						data-response-handler="responseHandler">
						<thead>
							<tr>
								<th data-sortable="true">Proposal Id</th>
								<th data-sortable="true">Proposal Name</th>
								<th data-sortable="true">Client Name</th>
								<th data-sortable="true">CS Name</th>
								<th data-sortable="true">Team Lead</th>
								<th data-sortable="true">Probability</th>
								<th data-sortable="true">Status</th>
								<th width="1"></th>
							</tr>
						</thead>
						<tbody>
						<?php
							if($rowCount > 0)
							{
								while($row = $result->fetch_assoc())
								{
									echo '<tr>
											<td>'.$row["Proposal_Id"].'</td>
											<td>'.$row["Project_Name"].'</td>
											<td class="color-blue-grey-lighter">'.$row["Client_Name"].'</td>
											<td>';
											$result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["CS_Executive_Id"]."'");
										    $row1=$result1->fetch_assoc();
									echo    $row1["Employee_Name"];
									echo   '</td>
										    <td>';
											$result1=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row["Team_Leader_Id"]."'");
										    $row1=$result1->fetch_assoc();
									echo    $row1["Employee_Name"];
									echo   '</td>
										    <td>'.$row["Probability"].'%</td>
											<td>'.$row["Proposal_Status"].'</td>
											<td>
												<a href="proposal-view?data='.$row["Proposal_Id"].'"><button class="btn btn-sm btn-default">
													<span class="fa fa-eye"></span></button>
												</a>
											</td>
										</tr>';
								}
							}
						?>
						</tbody>
					</table>
				<!-- </div> -->
			</section>
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	
<?php include 'include/commonjs.html';?>
	<script src="js/lib/bootstrap-table/bootstrap-table.js"></script>
	<script src="js/lib/bootstrap-table/bootstrap-table-mobile.min.js"></script>
	<script src="js/lib/bootstrap-table/bootstrap-table-export.min.js"></script>
	<script src="js/lib/bootstrap-table/tableExport.min.js"></script>
	<script>
		$(document).ready(function() {
		    var $table = $('#table');

		    $table.bootstrapTable({
		        iconsPrefix: 'font-icon',
		        icons: {
		            paginationSwitchDown:'font-icon-arrow-square-down',
		            paginationSwitchUp: 'font-icon-arrow-square-down up',
		            refresh: 'font-icon-refresh',
		            toggle: 'font-icon-list-square',
		            columns: 'font-icon-list-rotate',
		            export: 'font-icon-download',
		            detailOpen: 'font-icon-plus',
		            detailClose: 'font-icon-minus-1'
		        },
		        paginationPreText: '<i class="font-icon font-icon-arrow-left"></i>',
		        paginationNextText: '<i class="font-icon font-icon-arrow-right"></i>',
		    });

		    $('#table select').selectpicker({
		        style: '',
		        width: '100%',
		        size: 8
		    });
		});
	</script>

	<script>
    function detailFormatter(index, row) {

	  // var html = [];
	  // $.each(row, function (key, value) {
	  //       html.push('<p><b>' + key + ':</b> ' + value + '</p>');
	  //});
	  //return html.join('');

       //  var myVariable = "<?php 
       //  					$row= $Result->fetch_assoc();
       //  					$result5=$conn->query("SELECT Business_Name FROM business_master WHERE Business_Id=3");
							// $row5=$result5->fetch_assoc();
							// $temp=$row5["Business_Name"];
       //  					echo ('&nbsp;&nbsp;&nbsp;'.$temp); ?>";

       	var myVariable = "<?php echo "<div class='col-md-2'></div><div class='col-md-4'>Business Unit : RMS<br>Product : Retail Index<br>Service : Adhoc</div><div class='col-md-4'>Month of Delivery : October<br>Revenue : 12000</div> ";?>"
        return myVariable;
    }
	</script>	
</body>
</html>