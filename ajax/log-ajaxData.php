<?php
include '../include/dbConfig.php';

	if(isset($_POST["Id"]) && $_POST["Id"]!="")
	{
		$cs=$_POST["Id"];
		$employee = substr($cs,0,10);
		$stmt = $conn->query("SELECT * FROM activity_master WHERE Employee_Id = '".$employee."'");
		$row = $stmt->num_rows;
	}

	echo'			<section>
					<article class="activity-line-item box-typical">

						<header class="activity-line-item-header">
							<div class="activity-line-item-user">
								<div class="activity-line-item-user-photo">
									<a href="#">
										<img src="img/avatar-2-64.png" alt="">
									</a>
								</div>
								<div class="activity-line-item-user-name">';
									$result=$conn->query("SELECT Employee_Name From employee_master WHERE 
															Employee_Id = '".$employee."'");
									$result1=$result->fetch_assoc();
									echo $result1["Employee_Name"].'
								</div>
								<div class="activity-line-item-user-status">'.$employee.'</div>
							</div>
						</header>
						<section  style="height: 280px; overflow : auto">';

	if($row>0)
	{
		while($row = $stmt->fetch_assoc())
		{
			echo'

						<div class="activity-line-action-list">
							<section class="activity-line-action">
								<div class="time" style="width : 50%">'.$row["Date"].'  '.$row["Time"].'</div>
								<div class="cont">
									<div class="cont-in">
										<p>';
										if($row["Mode"]=="New")
											{
												echo 'Created Proposal #'.$row["Proposal_Id"];
											}
										elseif($row["Mode"]=="Edit")
											{
												echo 'Edited Proposal #'.$row["Proposal_Id"];
											}
										else
											{
												echo 'Viewed Proposal #'.$row["Proposal_Id"];
											}	
										echo'
										</p>
									</div>
								</div>
							</section><!--.activity-line-action-->
						</div><!--.activity-line-action-list-->
			';					
		}

	}
	else{
		echo '<div class="activity-line-action-list">
							<section class="activity-line-action">
								<div class="time" style="width : 50%"></div>
								<div class="cont">
									<div class="cont-in">
										<center>No Records Found</center>
									</div>
								</div>
							</section><!--.activity-line-action-->
						</div><!--.activity-line-action-list-->';
	}
	echo'				</section>		
					</article><!--.activity-line-item-->
				</section><!--.activity-line-->';

?>