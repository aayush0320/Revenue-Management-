<?php include 'include/head.html';?>

	<link rel="stylesheet" href="css/separate/vendor/typeahead.min.css">
	<link rel="stylesheet" href="css/lib/ion-range-slider/ion.rangeSlider.css">
	<link rel="stylesheet" href="css/lib/ion-range-slider/ion.rangeSlider.skinHTML5.css">
  	<link rel="stylesheet" href="css/separate/vendor/bootstrap-daterangepicker.min.css">
</head>

<body class="with-side-menu">
	<?php

		include 'include/header.php';
	    include 'include/dbConfig.php';
		include 'include/sidebar.php';
		$data="";
		$but="";	
		if(isset($_GET["data"]))
		{
		    $data = $_GET["data"];
			$_SESSION["Proposal_Id"] = $data;
		}
		if(isset($_GET["but"]))
		{
			$but = $_GET["but"];
		}
		if(isset($_SESSION["copy_proposal"]) && ($_SESSION["copy_proposal"]!=""))
		{
		    $data = $_SESSION["copy_proposal"];
		}


	    //Include database configuration file

	    // FOR SHOWING BUSSINESS UNIT NAME
        $sql = "SELECT * FROM business_master WHERE IsActive = 1";
        $result = $conn->query($sql);
        $rowCount = $result->num_rows;

        // FOR SHOWING EMPLOYING NAME IN CS
        // $sql1 = "SELECT * FROM employee_master WHERE Employee_Designation = 1 AND Country_Id = ".$_SESSION["Country_Id"]." AND Office_Id = ".$_SESSION["Office_Id"];
        // $result1 = $conn->query($sql1);
        // $rowCount1 = $result1->num_rows;

		//FOR SHOWING DATA INTO TEAM DROPDOWN
		$result1 = $conn->query("SELECT * from team_master WHERE IsActive = 1 AND CS_Executive_Id = '".$_SESSION["Employee_Id"]."'");
		$rowCount1 = $result1->num_rows;

        // FOR EDITING MODE
        $sql2 = "SELECT * FROM proposal_master WHERE Proposal_Id = '".$data."'";
        $result2 = $conn->query($sql2);
        $row1=$result2->fetch_assoc();

        // FOR PRINTING CS NAME IN EDITING MODE
        $result3=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row1["CS_Executive_Id"]."'");
        $row2=$result3->fetch_assoc();

        // FOR DELETING INACTIVE DATA FROM adhoc_subscription and onetime_track
        $temp=$conn->query("DELETE FROM adhoc_subscription WHERE Proposal_Id='1'");
        $temp=$conn->query("DELETE FROM onetime_track WHERE Proposal_Id='1'");
	?>
		<div class="page-content">
			<div class="container-fluid">
			<form name="form1" method="post" action="php/proposal_back.php" enctype="multipart/form-data">
				<section class="tabs-section">
					<div class="tabs-section-nav tabs-section-nav-icons">
						<div class="tbl">
							<ul class="nav" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="#tabs-1-tab-1" role="tab" data-toggle="tab">
										<span class="nav-link-in">Basic Info</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
										<span class="nav-link-in">Client Info</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#tabs-1-tab-3" role="tab" data-toggle="tab">
										<span class="nav-link-in">Statistics</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#tabs-1-tab-4" role="tab" data-toggle="tab">
										<span class="nav-link-in">Products</span>
									</a>
								</li>
							</ul>
						</div>
					</div><!--.tabs-section-nav-->

					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="tabs-1-tab-1">
						<section>
							<div class="row">
								<div class="col-lg-6">
										<label class="form-label semibold" for="Project_Name">Project Name</label>
									<fieldset id="Proposal_Name_Fieldset" class="form-group">
										<div class="form-control-wrapper">
											<?php
											echo'	
												<input type="text" class="form-control" id="Project_Name"  onBlur="Proposal_Name()" name="Project_Name" placeholder="Name" 
												value="'.$row1["Project_Name"].'">';
											?>
											<div id="Proposal_Name_Tooltip" class="form-tooltip-error" style="display:none">Invalid Name ! No special characters allowed.</div>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="CS_Executive">CS Executive</label>
										<?php 
										if($row1["Project_Name"]!="")
										{
											echo'<input type="text" class="form-control" id="CS_Executive_Id" value = "'.$row2["Employee_Name"].'" name="CS_Executive_Id" readonly>'; 										
										}
										else
										{
											echo'<input type="text" class="form-control" id="CS_Executive_Id" value = "'.$_SESSION["Employee_Name"].'" name="CS_Executive_Id" readonly>';										
										}
										?>
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="Team_Name">Team Name</label>
	 									<select class="form-control" name="Team_Name" onchange="showname()" id="Team_Name">
						                    <?php
						                      	if ($row1["Project_Name"]!="") 
						                      	{
						                    	echo '<option value="'.$row1["Team_Name"].'">'.$row1['Team_Name'].'</option>';
						                      	}
						                      	else
						                      	{
							                        if($rowCount1 > 0){
							                        	echo $rowCount1;
							                        	echo '<option value="">Select Team</option>';
							                            while($row = $result1->fetch_assoc()){ 
							                                echo '<option value="'.$row['Team_Name'].'">'.$row['Team_Name'].'</option>';
							                            }
							                        }else{
							                            echo '<option value="">Team not available</option>';
							                        }
						                    	}    
					                    	?>
										</select>
									
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="Team_Leader">Team Lead</label>
									<?php 
										$result10=$conn->query("SELECT Employee_Name FROM employee_master WHERE Employee_Id='".$row1["Team_Leader_Id"]."'");
										$row10=$result10->fetch_assoc();
										echo'<input type="text" class="form-control" id="Team_Leader" name="Team_Leader" placeholder="Select CS Executive First" value="'.$row10["Employee_Name"].'" readonly>';
									?>
										
									</fieldset>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<fieldset class="form-group">
										<label class="form-label semibold" for="Zone">Zone</label>
									<?php 
									if($row1["Project_Name"]!="")
									{
										echo'<input type="text" class="form-control" id="Zone" name="Zone" placeholder="Select CS Executive First" 
										value="'.$row1["Zone"].'" readonly>';
									}
									else
									{
										$temp = $conn->query("SELECT o.Zone FROM office_master o join employee_master e on o.Office_Id = e.Office_Id WHERE 
											e.Employee_Id = '".$_SESSION["Employee_Id"]."'");
										$Zone = $temp->fetch_assoc();
										echo'<input type="text" class="form-control" id="Zone" value = "'.$Zone["Zone"].'" name="Zone" readonly>';		
									}
									?>															
 									</fieldset>	
 									<br/>
									<br/>
								</div>
							</div>
						</section>
						</div><!--.tab-pane-->
						<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
							<section>
								<div class="row">
									<div class="col-lg-6">
										<fieldset class="form-group">
											<label class="form-label semibold" for="Client_Name">Client Name</label>
											<div class="typeahead-container">
												<div class="typeahead-field">
													<span class="typeahead-query">
														<input id="Client_Name"
											   					class="form-control"
											   					name="Client_Name"
											   					type="search"
											   					autocomplete="off"
											   					onblur="showname1()"
											   					<?php echo 'value="'.$row1["Client_Name"].'"';?>>
													</span>
													<span class="typeahead-button">
														<button type="submit">
															<span class="font-icon-search"></span>
														</button>
													</span>
												</div>
											</div>
										</fieldset>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<fieldset class="form-group">
											<label class="form-label semibold" for="Client_Group">Client Group</label>
											<input type="text" class="form-control" id="Client_Group" name="Client_Group" placeholder="Name" readonly>
										</fieldset>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6">
										<fieldset class="form-group">
											<label class="form-label semibold" for="Industry_Group">Industry Group</label>
											<input type="text" class="form-control" id="Industry_Group" name="Industry_Group" placeholder="Name" readonly>
										</fieldset>
									</div>
								</div>
							</section>
						</div><!--.tab-pane-->
						<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-3">
							<section>
								<div class="row">
									<div class="col-lg-6">
										<fieldset class="form-group">
										<label class="form-label semibold" for="Probability">
											Probability&emsp;<span id="ton" class="fa fa-info-circle"></span>
										</label>
											<div class="form-group range-slider-green">
												<input type="text" id="range-slider-3" name="Probability" />
											</div>
										</fieldset>
											<?php
													echo'<div class="Proposal_Status">
																<label class="form-label semibold" for="Proposal_Status">Proposal Status</label>
																<select class="form-control" id="Proposal_Status" name="Proposal_Status" >';
												if($row1["Proposal_Status"]!="")
												{
													echo'<option style="font:bold">'.$row1["Proposal_Status"].'</option>';										
												}else{
													echo'<option>Select Proposal Status</option>';	
												}										
												echo'	
															<option>In-progress</option>
															<option>Pending</option>
															<option>Cancelled</option>
														</select>
												</div>';
												
											?>	
										<div class="EOA">
											<div style=" position: relative;">
												<label class="form-label semibold" for="fileToUpload">Upload EoA</label>
												<input type="file" class="form-control" name="fileToUpload" id="fileToUpload" style="display: none;" onchange='uploadFile(this)'/>
												<label for="fileToUpload" style="padding: 0px 120px 15px 0px">
												    <span id="file-name" class="form-control" style="border:solid 1px rgba(197,214,222,.7);-webkit-box-shadow:none;box-shadow:none;font-size:1rem;color:#343434!important 
												    											display: inline-block;
																								width: 100%;
																								padding: 5px 0px 5px 5px;											
																								height: calc(3rem - 3px);"></span>
												    <span class="file-button" style=" padding:10px;background:#00a8ff;border:none;-webkit-transition:none;-o-transition:none;transition:none; position: absolute; top: 30px; right: 0px; color: #ffffff; border-radius: 3px; cursor: pointer; ">
												      <i class="fa fa-upload" aria-hidden="true"></i>
												      Select File
												    </span>
												</label>
											</div>
										</div>											
									</div>
									<div id="ttt" class="col-lg-6">
										<div class="table-responsive" style="height: 380px">
										<table class="table table-bordered table-hover font-4">
										<thead>
												<tr>
													<th>Probability</th>
													<th>Description</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><code>0%</code></td>
													<td>Proposal Dead </td>
												</tr>
												<tr>
													<td><code>10%</code></td>
													<td>Target Client Identified </td>
												</tr>
												<tr>
													<td><code>20%</code></td>
													<td>Initial Client Meeting – Opportunities Discussed </td>
												</tr>
												<tr>
													<td><code>30%</code></td>
													<td>Brief(RFP/RFQ) Received for A Specific Issue </td>
												</tr>
												<tr>
													<td><code>40%</code></td>
													<td>Brief Prepared by Nielsen </td>
												</tr>
												<tr>
													<td><code>50%</code></td>
													<td>Competitive Proposal Submitted/Presented </td>
												</tr>
												<tr>
													<td><code>60%</code></td>
													<td>Competitive Proposal – favourable to Nielsen </td>
												</tr>
												<tr>
													<td><code>70%</code></td>
													<td>Non- Competitive Proposal Submitted/Presented </td>
												</tr>
												<tr>
													<td><code>80%</code></td>
													<td>Repeat business – Renewal Likely</td>
												</tr>
												<tr>
													<td><code>90%</code></td>
													<td>Proposal Accepted – Verbal/Written Confirmation </td>
												</tr>
												<tr>
													<td><code>100%</code></td>
													<td>Contract Signed </td>
												</tr>
											</tbody>
										</table>
										</div>  										
									</div>
								</div>						
							</section>
						</div><!--.tab-pane-->
						
						<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-4">
							<?php
								if($but!="save")
									{
										echo '<div class="row">
											<fieldset class="form-group">				
												<div class="col-md-2 col-xs-12">
													<button class="btn btn-inline btn-primary" data-toggle="modal" data-target="#addproduct" type="button" style="width: 100%">Add</button>
								    			</div>
												<div class="col-md-6 col-xs-12"></div>											
												<div class="col-md-2 col-xs-6">
													<input type="text" class="form-control" id="Delete_Product" name="Delete_Product">
												</div>
												<div class="col-md-2 col-xs-6">
													<button class="btn btn-inline btn-primary" id="btndel" type="button"  style="width: 100%">Delete</button>
												</div>
											</fieldset>
							    		</div>
							    		<div class="row table-details">
											<div class="col-lg-12" id="table">
												<table class="table table-bordered">
														<thead>
														<tr>
															<th width="2">No.</th>
															<th>Business Unit</th>
															<th>Product</th>
															<th>Service</th>
															<th width="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>';
							    	}
							    else
							    	{
							    	echo'<div class="row">
											<fieldset class="form-group">				
												<div class="col-md-2 col-xs-12">
													<button class="btn btn-inline btn-primary" data-toggle="modal" data-target="#addproduct" type="button" style="width: 100%">Add</button>
								    			</div>
												<div class="col-md-6 col-xs-12"></div>											
												<div class="col-md-2 col-xs-6">
													<input type="text" class="form-control" id="Delete_Product" name="Delete_Product">
												</div>
												<div class="col-md-2 col-xs-6">
													<button class="btn btn-inline btn-primary" id="btndel" type="button"  style="width: 100%">Delete</button>
												</div>
											</fieldset>
										</div>
											<div class="row table-details">
											<div class="col-lg-12" id="table">
								        		<table class="table table-bordered">
								                    <thead>
								                        <tr>
								                            <th width="2">No.</th>
								                            <th>Business Unit</th>
								                            <th>Product</th>
								                            <th>Service</th>
								                            <th width="1"></th>
								                        </tr>
								                    </thead>
								                    <tbody>';

        $result15 = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM adhoc_subscription WHERE IsActive = 1 AND Proposal_Id='".$row1["Proposal_Id"]."'");
        $rowCount = $result15->num_rows;
        if($rowCount>0)
        {
            while($row15 = $result15->fetch_assoc())
            {
                echo'   <tr>
                            <td>';
                                echo 'AS'.$row15["Id"]. 
                            '</td>
                            <td>';
                                $result20 = $conn->query("SELECT Business_Name FROM business_master WHERE Business_Id = '".$row15["Business_Id"]."'");
                                $row20 = $result20->fetch_assoc();
                                echo $row20["Business_Name"]. 
                            '</td>
                            <td>';
                                $result21 = $conn->query("SELECT Product_Name FROM Product_master WHERE Product_Id = '".$row15["Product_Id"]."'");
                                $row21 = $result21->fetch_assoc();
                                echo $row21["Product_Name"].
                            '</td>
                            <td>';
                                $result22 = $conn->query("SELECT Service_Name FROM Service_master WHERE Service_Id = '".$row15["Service_Id"]."'");
                                $row22 = $result22->fetch_assoc();
                                echo $row22["Service_Name"].'
                            </td>
                            <td>                                                
                                <a href="#myModal1'.$row15["Id"].'" data-toggle="modal">
                                    <button class="btn btn-sm btn-info">
                                        <span>More</span>
                                    </button>
                                </a>
                            </td>';
        echo    '<div class="modal fade" id="myModal1'.$row15["Id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Product Info</h4>
                            </div>
                            <div class="modal-body">';
                            if($row22["Service_Name"]=="Adhoc")
                            {
                                $result23 = $conn->query("SELECT Month_Of_Delivery, Revenue from adhoc_subscription WHERE IsActive = 1 AND Id=".$row15["Id"]." AND Service_Id=".$row15["Service_Id"]);
                                $rowcount=$result23->num_rows;
                                $row23= $result23->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row20["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row21["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row22["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Month of Delivery</div>
                                            <div class="col-md-3">'.$row23["Month_Of_Delivery"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue</div>
                                            <div class="col-md-3">'.$row23["Revenue"].'</div>
                                        </div>';
                                }

                            }
                            else
                            {
                                $result23 = $conn->query("SELECT Start_Month, End_Month, Frequency, Revenue from adhoc_subscription WHERE IsActive = 1 AND Id=".$row15["Id"]." AND Service_Id=".$row15["Service_Id"]);
                                $rowcount=$result23->num_rows;
                                $row23= $result23->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row20["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row21["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row22["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Start Month</div>
                                            <div class="col-md-3">'.$row23["Start_Month"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">End Month</div>
                                            <div class="col-md-3">'.$row23["End_Month"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Frequency</div>
                                            <div class="col-md-3">'.$row23["Frequency"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue</div>
                                            <div class="col-md-3">'.$row23["Revenue"].'</div>
                                        </div>';
                                }
                            }
                        echo'       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';               
            }
        }

        $result15 = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM onetime_track WHERE IsActive = 1 AND Proposal_Id='".$row1["Proposal_Id"]."'");
        $rowCount = $result15->num_rows;
        if($rowCount>0)
        {
            while($row15 = $result15->fetch_assoc())
            {
                echo'   <tr>
                            <td>';
                                echo 'OT'.$row15["Id"]. 
                            '</td>
                            <td>';
                                $result20 = $conn->query("SELECT Business_Name FROM business_master WHERE Business_Id = '".$row15["Business_Id"]."'");
                                $row20 = $result20->fetch_assoc();
                                echo $row20["Business_Name"]. 
                            '</td>
                            <td>';
                                $result21 = $conn->query("SELECT Product_Name FROM Product_master WHERE Product_Id = '".$row15["Product_Id"]."'");
                                $row21 = $result21->fetch_assoc();
                                echo $row21["Product_Name"].
                            '</td>
                            <td>';
                                $result22 = $conn->query("SELECT Service_Name FROM Service_master WHERE Service_Id = '".$row15["Service_Id"]."'");
                                $row22 = $result22->fetch_assoc();
                                echo $row22["Service_Name"].'
                            </td>
                            <td>                                                
                                <a href="#myModal'.$row15["Id"].'" data-toggle="modal">
                                    <button class="btn btn-sm btn-info">
                                        <span>More</span>
                                    </button>
                                </a>
                            </td>';
        echo    '<div class="modal fade" id="myModal'.$row15["Id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Product Info</h4>
                            </div>
                            <div class="modal-body">';
                            if($row22["Service_Name"]=="OneTime")
                            {
                                $result23 = $conn->query("SELECT Month_Of_Delivery, Number_Of_Store, Revenue_Per_Store, Total_Revenue from onetime_track WHERE IsActive = 1 AND Id=".$row15["Id"]." AND Service_Id=".$row15["Service_Id"]);
                                $rowcount=$result23->num_rows;
                                $row23= $result23->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row20["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row21["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row22["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Month Of Delivery</div>
                                            <div class="col-md-3">'.$row23["Month_Of_Delivery"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Number Of Store</div>
                                            <div class="col-md-3">'.$row23["Number_Of_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue Per Store</div>
                                            <div class="col-md-3">'.$row23["Revenue_Per_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Total Revenue</div>
                                            <div class="col-md-3">'.$row23["Total_Revenue"].'</div>
                                        </div>';
                                }

                            }
                            else
                            {
                                $result23 = $conn->query("SELECT Start_Date, End_Date, Frequency, Number_Of_Store, Revenue_Per_Store, Total_Revenue from onetime_track WHERE IsActive = 1 AND Id=".$row15["Id"]." AND Service_Id=".$row15["Service_Id"]);
                                $rowcount=$result23->num_rows;
                                $row23= $result23->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row20["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row21["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row22["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Start Date</div>
                                            <div class="col-md-3">'.$row23["Start_Date"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">End Date</div>
                                            <div class="col-md-3">'.$row23["End_Date"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Frequency</div>
                                            <div class="col-md-3">'.$row23["Frequency"].'</div>
                                        </div>                                                                                
                                        <div class="row">
                                            <div class="col-md-4">Number Of Store</div>
                                            <div class="col-md-3">'.$row23["Number_Of_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue Per Store</div>
                                            <div class="col-md-3">'.$row23["Revenue_Per_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Total Revenue</div>
                                            <div class="col-md-3">'.$row23["Total_Revenue"].'</div>
                                        </div>';
                                }
                            }
                        echo'
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';             
            }
        }
        echo        '</tbody>
                </table>';
									echo'	</div>
										</div>';
							    	}
					    	?>				    			
				    		<div class="row" style="position: absolute; right: 36px; bottom: 0;">
				    			<button class="btn btn-inline btn-primary" id="submit" type="submit">
									<?php	
										if($but!="save")
											{	
												echo'Submit';
					    					}
					    				else
					    					{
												echo'Save';
					    					}
					    			?>
					    		</button>
				    		</div>						
						</div><!--.tab-pane-->
					</div><!--.tab-content-->
				</section><!--.tabs-section-->
			</form>
			</div><!--.container-fluid-->
		</div><!--.page-content-->

	<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"	aria-hidden="true">
	<div class="modal-dialog  modal-lg" role="document" style="height:100%;min-width:100%;width:100%;margin:0px;padding:0px">
		<div class="modal-content"  style="height:auto;min-height:100%;border-radius:0px">
			<div class="modal-header">
				<button type="button" class="modal-close btnSave" data-dismiss="modal" aria-label="Close">
					<i class="font-icon-close-2"></i>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Product</h4>
			</div>
			<div class="modal-body">
			 <section>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Business_Name">Business Unit</label>
                                            <select class="form-control" id="Business_Name" name="Business_Name" >
                                                      <?php
                                                        if($rowCount > 0){
                                                            echo '<option>Select Business Unit</option>';
                                                            while($row = $result->fetch_assoc()){ 
                                                                echo '<option value="'.$row['Business_Id'].'">'.$row['Business_Name'].'</option>';
                                                            }
                                                        }else{
                                                            echo '<option value="">Business Unit not available</option>';
                                                        }
                                                      ?>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Product_Name">Product</label>
                                            <select class="form-control" id="Product_Name" name="Product_Name">
                                                <option value="">Select Business Unit first</option>                            
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Service_Name">Service</label>
                                            <select class="form-control" id="Service_Name" name="Service_Name">
                                                <option value="">Select Product First</option>                          
                                            </select>
                                        </fieldset>
                                    </div>                                  
                                </div>
                            </section>
                            <section id="Adhoc">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label semibold" for="Month_Of_Delivery">Delivery Month</label>
                                        <select class="form-control" id="Month_Of_Delivery" name="Month_Of_Delivery">
                                            <option>Select Delivery Month</option>
                                            <option value='January'>January</option>
                                            <option value='February'>February</option>
                                            <option value='March'>March</option>
                                            <option value='April'>April</option>
                                            <option value='May'>May</option>
                                            <option value='June'>June</option>
                                            <option value='July'>July</option>
                                            <option value='August'>August</option>
                                            <option value='September'>September</option>
                                            <option value='October'>October</option>
                                            <option value='November'>November</option>
                                            <option value='December'>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Revenue_a">Revenue</label>
                                            <input type="text" class="form-control" id="Revenue_a" name="Revenue_a" placeholder="Enter Revenue" required>
                                        </fieldset>
                                    </div>
                                </div>
                            </section>
                            <section id="Subscription">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label semibold" for="Start_Month">Start Month</label>
                                        <select class="form-control" id="Start_Month" name="Start_Month">
                                            <option>Select Month</option>
                                            <option value='January'>January</option>
                                            <option value='February'>February</option>
                                            <option value='March'>March</option>
                                            <option value='April'>April</option>
                                            <option value='May'>May</option>
                                            <option value='June'>June</option>
                                            <option value='July'>July</option>
                                            <option value='August'>August</option>
                                            <option value='September'>September</option>
                                            <option value='October'>October</option>
                                            <option value='November'>November</option>
                                            <option value='December'>December</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label semibold" for="End_Month">End Month</label>
                                        <select class="form-control" id="End_Month" name="End_Month">
                                            <option>Select Month</option>
                                            <option value='January'>January</option>
                                            <option value='February'>February</option>
                                            <option value='March'>March</option>
                                            <option value='April'>April</option>
                                            <option value='May'>May</option>
                                            <option value='June'>June</option>
                                            <option value='July'>July</option>
                                            <option value='August'>August</option>
                                            <option value='September'>September</option>
                                            <option value='October'>October</option>
                                            <option value='November'>November</option>
                                            <option value='December'>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label semibold" for="Frequency">Frequency</label>
                                        <select class="form-control" id="Frequency" name="Frequency">
                                            <option>Select frequency</option>
                                            <option value='Monthly'>Montly</option>
                                            <option value='Quaterly'>Quaterly</option>
                                            <option value='Half-Yearly'>Half-Yearly</option>
                                            <option value='Yearly'>Yearly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Revenue">Revenue</label>
                                            <input type="text" class="form-control" id="Revenue" name="Revenue" placeholder="Enter Revenue" required>
                                        </fieldset>
                                    </div>
                                </div>
                            </section>
                            <section id="OneTime">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label semibold" for="Month_Of_Delivery_O">Select Delivery Month</label>
                                        <select class="form-control" id="Month_Of_Delivery_O" name="Month_Of_Delivery_O">
                                            <option>Select Month</option>
                                            <option value='January'>January</option>
                                            <option value='February'>February</option>
                                            <option value='March'>March</option>
                                            <option value='April'>April</option>
                                            <option value='May'>May</option>
                                            <option value='June'>June</option>
                                            <option value='July'>July</option>
                                            <option value='August'>August</option>
                                            <option value='September'>September</option>
                                            <option value='October'>October</option>
                                            <option value='November'>November</option>
                                            <option value='December'>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Number_Of_Store_O">No. of Stores</label>
                                            <input type="text" class="form-control" id="Number_Of_Store_O" name="Number_Of_Store_O" placeholder="Enter number of Store" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Revenue_Per_Store_O">Revenue per Store</label>
                                            <input type="text" class="form-control" id="Revenue_Per_Store_O" name="Revenue_Per_Store_O" placeholder="Enter Revenue per Store" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Total_Revenue_O">Total Revenue</label>
                                            <input type="text" class="form-control" id="Total_Revenue_O" name="Total_Revenue_O" placeholder="">
                                        </fieldset>
                                    </div>
                                </div> -->
                            </section>
                            <section id="Track">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label semibold" for="Start_Date_T">Start Date</label>
                                        <div class='input-group date'><!-- value="10/24/2000" -->
											<input id="Start_Date_T" name="Start_Date_T" type="text" class="form-control">
										</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label semibold" for="End_Date_T">End Date</label>
                                      	<div class='input-group date'><!-- value="10/24/2000" -->
											<input id="End_Date_T" name="End_Date_T" type="text" class="form-control">
										</div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <label class="form-label semibold" for="Frequency_T">Frequency</label>
                                        <select class="form-control" id="Frequency_T" name="Frequency_T">
                                            <option>Select frequency</option>
                                            <option value='Monthly'>Montly</option>
                                            <option value='Quaterly'>Quaterly</option>
                                            <option value='Half-Yearly'>Half-Yearly</option>
                                            <option value='Yearly'>Yearly</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="Number_Of_Store_T">No. of Stores</label>
                                            <input type="text" class="form-control" id="Number_Of_Store_T" name="Number_Of_Store_T" placeholder="Enter number of Store" required>
                                        </fieldset>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <fieldset class="form-group">
                                            	<label class="form-label semibold" for="Revenue_Per_Store_T">Revenue per Store</label>
                                            	<input type="text" class="form-control" id="Revenue_Per_Store_T" name="Revenue_Per_Store_T" placeholder="Enter Revenue per Store" required>
                                        	</fieldset>
                                    	</div>
                                    </div>
                            </section>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btnSave" data-dismiss="modal">Save changes</button>
			</div>
		</div>
	</div>
</div>


	<?php include 'include/commonjs.html';?>
  	<script src="js/lib/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="js/lib/typeahead/jquery.typeahead.min.js"></script>
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
  
<!-- Date Picker -->	
	<script src="js/lib/moment/moment-with-locales.min.js"></script>
  	<script src="js/lib/daterangepicker/daterangepicker.js"></script>  
	<script>
	    $(function() {
		    $('#Start_Date_T').daterangepicker({
		        singleDatePicker: true,
		        showDropdowns: true
		    });
		    $('#End_Date_T').daterangepicker({
		        singleDatePicker: true,
		        showDropdowns: true
		    });
	    });
	</script>

<!--ion Slider-->

<script type="text/javascript">
	$(document).ready(function() {
	    $("#range-slider-3").ionRangeSlider({
	        min: 0,
	        max: 100,
	        from: "<?php if($data!="")
	        			{	if($row1["Probability"]==100)
	        				{
	        					echo '0';	
							}
							else
								echo $row1["Probability"];
	        				}
	        		   else
	        		     {echo '0';}?>",
	        step: 10,
	        grid: true,
	        grid_num: 10
	    });
	});
</script>  

<script src="js/lib/ion-range-slider/ion.rangeSlider.js"></script>


<!-- BUSINESS UNIT & PRODUCT & SERVICE -->

<script type="text/javascript">
	$(document).ready(function(){
	    $('#Business_Name').on('change',function(){
	        var Business_Name = $(this).val();
	        if(Business_Name){
	            $.ajax({
	                type:'POST',
	                url:'ajax/createproposal-ajaxData.php',
	                data:'Business_Name='+Business_Name,
	                success:function(html){
	                    $('#Product_Name').html(html);
	                    $('#Service_Name').html('<option value="">Select Product first</option>'); 
	                }
	            }); 
	        }else{
	            $('#Product_Name').html('<option value="">Select Business unit first</option>');
	            $('#Service_Name').html('<option value="">Select Product first</option>'); 
	        }
	    });
	    
	    $('#Product_Name').on('change',function(){
	        var Product_Name = $(this).val();
	        if(Product_Name){
	            $.ajax({
	                type:'POST',
	                url:'ajax/createproposal-ajaxData.php',
	                data:'Product_Name='+Product_Name,
	                success:function(html){
	                    $('#Service_Name').html(html);
	                }
	            }); 
	        }else{
	            $('#Service_Name').html('<option value="">Select product first</option>'); 
	        }
	    });
	});
</script>


<!-- FOR MODAL WINDOW DATA HIDDING AND SHOWING -->

<script type="text/javascript">
	$(document).ready(function(){

 		    $("#Adhoc").hide();
		    $("#Subscription").hide();
 		    $("#OneTime").hide();
		    $("#Track").hide();

	    $("#Business_Name").change(function(){
	                $("#Adhoc").hide();
	                $("#Subscription").hide();
	                $("#OneTime").hide();
	                $("#Track").hide();	            
	    }).change();

	    $("#Product_Name").change(function(){
	                $("#Adhoc").hide();
	                $("#Subscription").hide();
	                $("#OneTime").hide();
	                $("#Track").hide();	            
	    }).change();

	    $("#Service_Name").change(function(){
	        $(this).find("option:selected").each(function(){
	            var optionValue = $(this).attr("value");

	            if(optionValue==""){
	                $("#Adhoc").hide();
	                $("#Subscription").hide();
	                $("#OneTime").hide();
	                $("#Track").hide();	            
	            }

	            if(optionValue=="Adhoc"){
	                $("#Adhoc").show();
	                $("#Subscription").hide();
	                $("#OneTime").hide();
	                $("#Track").hide();	            
	            }
	            if(optionValue=="Subscription"){
	                $("#Adhoc").hide();
	                $("#Subscription").show();
	                $("#OneTime").hide();
	                $("#Track").hide();	            
	            }
	            if(optionValue=="OneTime"){
	                $("#Adhoc").hide();
	                $("#Subscription").hide();
	                $("#OneTime").show();
	                $("#Track").hide();	            
	            }
	            if(optionValue=="Track"){
	                $("#Adhoc").hide();
	                $("#Subscription").hide();
	                $("#OneTime").hide();
	                $("#Track").show();	            
	            }	            
	        });
	    }).change();
	});
</script>


<!-- CS & SALES TEAM & TEAM LEAD -->

<script>
	var compInfoArray = [

	        <?php 

	                $result4=$conn->query("SELECT * FROM team_master WHERE IsActive = 1");
	            $rowCount = $result4->num_rows;
	            if($rowCount > 0){
	                while($row = $result4->fetch_assoc()){ 
	                	$result10=$conn->query("SELECT Employee_Name from employee_master WHERE Employee_Id='".$row['Team_Leader_Id']."'");
	                	$row10=$result10->fetch_assoc();
	                echo '{';
	                // echo 'CS_Executive : "'. $row['CS_Executive_Id'].'",';
	                echo 'Team_Leader :  "'.$row10['Employee_Name'].'",';
	                echo 'Team_Name : "'.$row['Team_Name'].'"';
	               	// $result7 = $conn->query("SELECT o.Zone FROM office_master o Join employee_master e on o.Office_Id = e.Office_Id WHERE Employee_Id ='".$row['CS_Executive_Id']."'");
	               	// $row4 = $result7->fetch_assoc();
	                // echo 'Zone :  "'.$row4['Zone'].'"';
	                echo '},';
	                }
	            }
		        ?>
	    ];

	function showname() {
	  var id = document.form1.Team_Name.value;
	  var index = compInfoArray.contains(id); 
	  // document.form1.Team_Name.value = compInfoArray[index]["Team_Name"];
	  document.form1.Team_Leader.value = compInfoArray[index]["Team_Leader"];
	  // document.form1.Zone.value = compInfoArray[index]["Zone"];
	}

	window.onload = function() {
	  showname();
	}


	Array.prototype.contains = function(needle) {
	  for (var i in this) {
	    for (var key in this[i]) {
	      if (this[i][key] == needle) {
	        return i;
	      }
	    }
	  }
	  return false;
	}
</script>


<!-- TYPE-AHEAD-->

<script>
	$(document).ready(function() {
		var clients = [<?php 
	                $result5=$conn->query("SELECT Client_Name FROM client_master");
                $rowCount = $result5->num_rows;
                if($rowCount > 0){
                    while($row = $result5->fetch_assoc()){ 
	                echo  '"'.$row['Client_Name'].'",';
                    }
                }
		        ?>];
		 $.typeahead({
	        input: "#Client_Name",
	        order: "asc",
	        minLength: 1,
	        source: {
	            data: clients
	        }
	});
	});
</script>


<!-- CLIENT NAME AND CLIENT GROUP AND INDUSTRY GROUP -->
   	
<script>
	var compInfoArray1 = [

	        <?php 
	            $result6=$conn->query("SELECT * FROM client_master");
	            $rowCount = $result6->num_rows;
	            if($rowCount > 0){
	                while($row = $result6->fetch_assoc()){ 
	                echo '{';
	                echo 'Client_Name : "'. $row['Client_Name'].'",';
	                echo 'Client_Group :  "'.$row['Client_Group'].'",';
	                echo 'Industry_Group : "'.$row['Industry_Group'].'"';
	                echo '},';
	                }
	            }
		        ?>
	    ];

	function showname1() {
	  var id = document.form1.Client_Name.value;
	  var index = compInfoArray1.contains(id);
	  document.form1.Client_Group.value = compInfoArray1[index]["Client_Group"];
	  document.form1.Industry_Group.value = compInfoArray1[index]["Industry_Group"];
	}

	window.onload = function() {
	  showname1();
	}


	Array.prototype.contains = function(needle) {
	  for (var i in this) {
	    for (var key in this[i]) {
	      if (this[i][key] == needle) {
	        return i;
	      }
	    }
	  }
	  return false;
	}
</script>


<!-- FOR VISIBILTY OF PROPOSAL STATUS AND EOA UPLOAD -->

<script>
	$(document).ready(function(){

 		$(".EOA").hide();
 		$(".Proposal_Status").show();	 		

		$("#range-slider-3").change(function(){

			var id = document.form1.Probability.value;
			
			if(id<90)
				{
			 		$(".EOA").hide();
		 			$(".Proposal_Status").show();
				}
			else
				{
			 		$(".EOA").show();
		 			$(".Proposal_Status").hide();
				}
		}).change();				
	});
</script>

<!-- FOR DELETING RECORDS FROM TABLE (BUSINESS, PRODUCTS, SERVICE) -->

<script>
	$(document).ready(function(){
		$("#btndel").click(function(){
            var Id = document.getElementById('Delete_Product').value;
            $.ajax({
            	type:'POST',
            	url:'ajax/createproposal-service-delete-ajaxData.php',
            	data:{Id :Id},
	            success:function(html){
	                $('#table').html(html);
	            }            	
            });		
		});
	});
</script>

<!-- FOR MODAL WINDOW BUTTON CLICKING DATA HIDE  &&&& FOR PRINTING DATA IN TABLE-->

<script>
	$(document).ready(function() {
	    $(".btnSave").click(function(){

                $("#Adhoc").hide();
                $("#Subscription").hide();
                $("#OneTime").hide();
                $("#Track").hide();	            

            $.ajax({
            	type:'POST',
                url:'ajax/createproposal-products-ajaxData.php',
                data:'BPS='+"Business",
                success:function(html){
                    $('#Business_Name').html(html);
                }
            }); 

            $.ajax({
            	type:'POST',
                url:'ajax/createproposal-products-ajaxData.php',
                data:'BPS='+'Product',
                success:function(html){
                    $('#Product_Name').html(html);
                }
            }); 

            $.ajax({
            	type:'POST',
                url:'ajax/createproposal-products-ajaxData.php',
                data:'BPS='+'Service',
                success:function(html){
                    $('#Service_Name').html(html);
                }
            });

    // FOR DISPLAYING DATA INTO TABLE        

            if(document.getElementById('Service_Name').value=="Subscription")
            {  
            	var service = "Subscription";
            	var Service_Id = document.getElementById('Service_Name').value;
            	var Product_Id = document.getElementById('Product_Name').value;
            	var Business_Id = document.getElementById('Business_Name').value;
            	var Start_Month = document.getElementById('Start_Month').value;
            	var End_Month = document.getElementById('End_Month').value;
            	var Frequency = document.getElementById('Frequency').value;
            	var Revenue = document.getElementById('Revenue').value;
   	            $.ajax({
	            	type:'POST',
	            	url:'ajax/createproposal-service-ajaxData.php',
	            	data: {service: service, Business_Id: Business_Id, Product_Id: Product_Id, Service_Id: Service_Id, Start_Month: Start_Month, 
	            		Revenue: Revenue, End_Month: End_Month, Frequency: Frequency},
		            success:function(html){
		                $('#table').html(html);
		            }
              	});            	
            }
 
    // FOR DISPLAYING DATA INTO TABLE

            if(document.getElementById('Service_Name').value=="Adhoc")
            {  
            	var service = "Adhoc";
            	var Service_Id = document.getElementById('Service_Name').value;
            	var Product_Id = document.getElementById('Product_Name').value;
            	var Business_Id = document.getElementById('Business_Name').value;
            	var Month_Of_Delivery = document.getElementById('Month_Of_Delivery').value;
            	var Revenue = document.getElementById('Revenue_a').value;
   	            $.ajax({
	            	type:'POST',
	            	url:'ajax/createproposal-service-ajaxData.php',
	            	data: {service: service, Business_Id: Business_Id, Product_Id: Product_Id, Service_Id: Service_Id, Month_Of_Delivery: Month_Of_Delivery, Revenue: Revenue},
		            success:function(html){
		                $('#table').html(html);
		            }
              	});            	
            }

    // FOR DISPLAYING DATA INTO TABLE

            if(document.getElementById('Service_Name').value=="OneTime")
            {
            	var service = "OneTime";
            	var Service_Id = document.getElementById('Service_Name').value;
            	var Product_Id = document.getElementById('Product_Name').value;
            	var Business_Id = document.getElementById('Business_Name').value;
            	var Month_Of_Delivery = document.getElementById('Month_Of_Delivery_O').value;
            	var Number_Of_Store = document.getElementById('Number_Of_Store_O').value;
            	var Revenue_Per_Store = document.getElementById('Revenue_Per_Store_O').value;
            	// var Total_Revenue = document.getElementById('Total_Revenue_O').value;
   	            $.ajax({
	            	type:'POST',
	            	url:'ajax/createproposal-service-ajaxData.php',
	            	data: {service: service, Business_Id: Business_Id, Product_Id: Product_Id, Service_Id: Service_Id, Month_Of_Delivery: Month_Of_Delivery, 
	            		Number_Of_Store: Number_Of_Store, Revenue_Per_Store: Revenue_Per_Store},
		            success:function(html){
		                $('#table').html(html);
		            }
              	});            	
            }

    // FOR DISPLAYING DATA INTO TABLE

            if(document.getElementById('Service_Name').value=="Track")
            {
            	var service = "Track";
            	var Service_Id = document.getElementById('Service_Name').value;
            	var Product_Id = document.getElementById('Product_Name').value;
            	var Business_Id = document.getElementById('Business_Name').value;
            	var Start_Date = document.getElementById('Start_Date_T').value;
            	var End_Date = document.getElementById('End_Date_T').value;
            	var Frequency = document.getElementById('Frequency_T').value;
             	var Number_Of_Store = document.getElementById('Number_Of_Store_T').value;
            	var Revenue_Per_Store = document.getElementById('Revenue_Per_Store_T').value;
            	// var Total_Revenue = document.getElementById('Total_Revenue_T').value;
   	            $.ajax({
	            	type:'POST',
	            	url:'ajax/createproposal-service-ajaxData.php',
	            	data: {service: service, Business_Id: Business_Id, Product_Id: Product_Id, Service_Id: Service_Id, Start_Date: Start_Date, 
	            		End_Date: End_Date, Frequency: Frequency, Number_Of_Store: Number_Of_Store, Revenue_Per_Store: Revenue_Per_Store},
		            success:function(html){
		                $('#table').html(html);
		            }
              	});            	
            }

	    }); 
	});
</script>
<!--File Upload-->
<script type="text/javascript">
	function uploadFile(target) {
	document.getElementById("file-name").innerHTML = target.files[0].name;
}
</script>

<!-- Validation -->

<script>
	$(document).ready(function(){

	    $('#Revenue_a').focus(function(){
			$('#Revenue_a').blur(function(){	
				if(!isNaN(document.getElementById("Revenue_a").value) && $(this).val().length<=15 && document.getElementById("Revenue_a").value!='')
				{
					document.getElementById("Revenue_a").className = "form-control form-control-success";
					$('.btnSave').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Revenue_a").className = "form-control form-control-danger";
					$('.btnSave').attr('disabled','disabled');
				}
			});
		});

	    $('#Revenue').focus(function(){
			$('#Revenue').blur(function(){	
				if(!isNaN(document.getElementById("Revenue").value) && $(this).val().length<=15 && document.getElementById("Revenue").value!='')
				{
					document.getElementById("Revenue").className = "form-control form-control-success";
					$('.btnSave').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Revenue").className = "form-control form-control-danger";
					$('.btnSave').attr('disabled','disabled');
				}
			});
		});

	    $('#Number_Of_Store_O').focus(function(){
			$('#Number_Of_Store_O').blur(function(){	
				if(!isNaN(document.getElementById("Number_Of_Store_O").value) && $(this).val().length<=10 && document.getElementById("Number_Of_Store_O").value!='')
				{
					document.getElementById("Number_Of_Store_O").className = "form-control form-control-success";
					$('.btnSave').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Number_Of_Store_O").className = "form-control form-control-danger";
					$('.btnSave').attr('disabled','disabled');
				}
			});
		});

	    $('#Revenue_Per_Store_O').focus(function(){
			$('#Revenue_Per_Store_O').blur(function(){	
				if(!isNaN(document.getElementById("Revenue_Per_Store_O").value) && $(this).val().length<=10 && document.getElementById("Revenue_Per_Store_O").value!='')
				{
					document.getElementById("Revenue_Per_Store_O").className = "form-control form-control-success";
					$('.btnSave').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Revenue_Per_Store_O").className = "form-control form-control-danger";
					$('.btnSave').attr('disabled','disabled');
				}
			});
		});

	    $('#Number_Of_Store_T').focus(function(){
			$('#Number_Of_Store_T').blur(function(){	
				if(!isNaN(document.getElementById("Number_Of_Store_T").value) && $(this).val().length<=10 && document.getElementById("Number_Of_Store_T").value!='')
				{
					document.getElementById("Number_Of_Store_T").className = "form-control form-control-success";
					$('.btnSave').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Number_Of_Store_T").className = "form-control form-control-danger";
					$('.btnSave').attr('disabled','disabled');
				}
			});
		});

	    $('#Revenue_Per_Store_T').focus(function(){
			$('#Revenue_Per_Store_T').blur(function(){	
				if(!isNaN(document.getElementById("Revenue_Per_Store_T").value) && $(this).val().length<=10 && document.getElementById("Revenue_Per_Store_T").value!='')
				{
					document.getElementById("Revenue_Per_Store_T").className = "form-control form-control-success";
					$('.btnSave').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Revenue_Per_Store_T").className = "form-control form-control-danger";
					$('.btnSave').attr('disabled','disabled');
				}
			});
		});								
	
	    $('#Delete_Product').focus(function(){
			$('#Delete_Product').blur(function(){
				var letters = /^[(OT)(AS)](0-9){2}$/;
				if(document.getElementById("Delete_Product").value!='')				
				{
					document.getElementById("Delete_Product").className = "form-control form-control-success";
					$('#btndel').removeAttr('disabled');
				}
				else
				{
					document.getElementById("Delete_Product").className = "form-control form-control-danger";
					$('#btndel').attr('disabled','disabled');
				}
			});
		});

	});	
</script>
</body>
</html>