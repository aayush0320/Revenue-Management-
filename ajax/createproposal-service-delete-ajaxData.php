<?php
session_start();
include('../include/dbConfig.php');

$flag=0;
$flag1=0;
    if($_SESSION["Proposal_Id"]!="")
    {
        if(isset($_POST["Id"]) && $_POST["Id"]!="")
        {
        $l = 2 - strlen($_POST["Id"]);
        $id =  substr($_POST["Id"], $l);
        $table = substr($_POST["Id"],0,2);

        if($table == "AS")
        {   
                $stmt = $conn->query("UPDATE adhoc_subscription SET IsActive = 0 WHERE id = '".$id."'");
                if($stmt)
                {
                    $flag=1;
                }
                else
                {
                    $_SESSION["Error_Code"]="951";
                    header('Location: ../error.php');
                    exit();             
                }
        }
        elseif($table == "OT")
        {
                $stmt = $conn->query("UPDATE onetime_track SET IsActive = 0 WHERE id = '".$id."'");
                if($stmt)
                {
                    $flag=1;
                }
                else
                {
                    $_SESSION["Error_Code"]="952";
                    header('Location: ../error.php');
                    exit();             
                }
        }
        else
        {

        }        
    }
    if($flag==1)
    {$flag=0;

                echo    '<table class="table table-bordered">
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


        $result15 = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM adhoc_subscription WHERE IsActive = 1 AND Proposal_Id='".$_SESSION["Proposal_Id"]."'");
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

        $result15 = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM onetime_track WHERE IsActive = 1 AND Proposal_Id='".$_SESSION["Proposal_Id"]."'");
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
    }
            echo        '</tbody>
                </table>';

}
	if(isset($_POST["Id"]) && $_POST["Id"]!="" && $_SESSION["Proposal_Id"]=="")
	{
		$l = 2 - strlen($_POST["Id"]);
		$id =  substr($_POST["Id"], $l);
		$table = substr($_POST["Id"],0,2);

		if($table == "AS")
		{   
            $stmt = $conn->query("SELECT Proposal_Id from adhoc_subscription WHERE id = '".$id."'");
            $stmt1 = $stmt->fetch_assoc();
            if($stmt1["Proposal_Id"]==1)
            {
    			$stmt = $conn->query("UPDATE adhoc_subscription SET IsActive = 0 WHERE id = '".$id."'");
    			if($stmt)
    			{
    				$flag=1;
    			}
                else
                {
                    $_SESSION["Error_Code"]="951";
                    header('Location: ../error.php');
                    exit();             
                }
            }
            else
            {
                $flag=1;
            }
		}
		elseif($table == "OT")
		{
            $stmt = $conn->query("SELECT Proposal_Id from onetime_track WHERE id = '".$id."'");
            $stmt1 = $stmt->fetch_assoc();
            if($stmt1["Proposal_Id"]==1)
            {
    			$stmt = $conn->query("UPDATE onetime_track SET IsActive = 0 WHERE id = '".$id."'");
    			if($stmt)
    			{
    				$flag=1;
    			}
                else
                {
                    $_SESSION["Error_Code"]="952";
                    header('Location: ../error.php');
                    exit();             
                }
            }
            else
            {
                $flag=1;
            }		
        }
		else
		{

		}


    if($flag==1)
    {
        $flag=0;

        echo    '<table class="table table-bordered">
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

        $result = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM adhoc_subscription WHERE IsActive = 1 AND Proposal_Id='1';");
        $rowCount = $result->num_rows;
        if($rowCount>0)
        {	
        	$flag1=1;
            while($row = $result->fetch_assoc())
            {
                echo'   <tr>
                            <td>';
                                echo 'AS'.$row["Id"]. 
                            '</td>
                            <td>';
                                $result1 = $conn->query("SELECT Business_Name FROM business_master WHERE Business_Id = '".$row["Business_Id"]."'");
                                $row1 = $result1->fetch_assoc();
                                echo $row1["Business_Name"]. 
                            '</td>
                            <td>';
                                $result2 = $conn->query("SELECT Product_Name FROM Product_master WHERE Product_Id = '".$row["Product_Id"]."'");
                                $row2 = $result2->fetch_assoc();
                                echo $row2["Product_Name"].
                            '</td>
                            <td>';
                                $result3 = $conn->query("SELECT Service_Name FROM Service_master WHERE Service_Id = '".$row["Service_Id"]."'");
                                $row3 = $result3->fetch_assoc();
                                echo $row3["Service_Name"].'
                            </td>
                            <td>                                                
                                <a href="#myModal1'.$row["Id"].'" data-toggle="modal">
                                    <button class="btn btn-sm btn-info">
                                        <span>More</span>
                                    </button>
                                </a>
                            </td>';
        echo    '<div class="modal fade" id="myModal1'.$row["Id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Product Info</h4>
                            </div>
                            <div class="modal-body">';
                            if($row3["Service_Name"]=="Adhoc")
                            {
                                $result4 = $conn->query("SELECT Month_Of_Delivery, Revenue from adhoc_subscription WHERE IsActive = 1 AND Id=".$row["Id"]." AND Service_Id=".$row["Service_Id"]);
                                $rowcount=$result4->num_rows;
                                $row4= $result4->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row1["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row2["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row3["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Month of Delivery</div>
                                            <div class="col-md-3">'.$row4["Month_Of_Delivery"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue</div>
                                            <div class="col-md-3">'.$row4["Revenue"].'</div>
                                        </div>';                                     
                                }

                            }
                            else
                            {
                                $result4 = $conn->query("SELECT Start_Month, End_Month, Frequency, Revenue from adhoc_subscription WHERE IsActive = 1 AND Id=".$row["Id"]." AND Service_Id=".$row["Service_Id"]);
                                $rowcount=$result4->num_rows;
                                $row4= $result4->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row1["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row2["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row3["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Start Month</div>
                                            <div class="col-md-3">'.$row4["Start_Month"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">End Month</div>
                                            <div class="col-md-3">'.$row4["End_Month"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Frequency</div>
                                            <div class="col-md-3">'.$row4["Frequency"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue</div>
                                            <div class="col-md-3">'.$row4["Revenue"].'</div>
                                        </div>';
                                }
                            }
                        echo'       
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';   
            }
        }

        $result = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM onetime_track WHERE IsActive = 1 AND Proposal_Id='1';");
        $rowCount = $result->num_rows;
        if($rowCount>0)
        {
        	$flag1=1;
            while($row = $result->fetch_assoc())
            {
                echo'   <tr>
                            <td>';
                                echo 'OT'.$row["Id"]. 
                            '</td>
                            <td>';
                                $result1 = $conn->query("SELECT Business_Name FROM business_master WHERE Business_Id = '".$row["Business_Id"]."'");
                                $row1 = $result1->fetch_assoc();
                                echo $row1["Business_Name"]. 
                            '</td>
                            <td>';
                                $result2 = $conn->query("SELECT Product_Name FROM Product_master WHERE Product_Id = '".$row["Product_Id"]."'");
                                $row2 = $result2->fetch_assoc();
                                echo $row2["Product_Name"].
                            '</td>
                            <td>';
                                $result3 = $conn->query("SELECT Service_Name FROM Service_master WHERE Service_Id = '".$row["Service_Id"]."'");
                                $row3 = $result3->fetch_assoc();
                                echo $row3["Service_Name"].'
                            </td>
                            <td>                                                
                                <a href="#myModal'.$row["Id"].'" data-toggle="modal">
                                    <button class="btn btn-sm btn-info">
                                        <span>More</span>
                                    </button>
                                </a>
                            </td>';
        echo    '<div class="modal fade" id="myModal'.$row["Id"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Product Info</h4>
                            </div>
                            <div class="modal-body">';
                            if($row3["Service_Name"]=="OneTime")
                            {
                                $result4 = $conn->query("SELECT Month_Of_Delivery, Number_Of_Store, Revenue_Per_Store, Total_Revenue from onetime_track WHERE IsActive = 1 AND Id=".$row["Id"]." AND Service_Id=".$row["Service_Id"]);
                                $rowcount=$result4->num_rows;
                                $row4= $result4->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row1["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row2["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row3["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Month Of Delivery</div>
                                            <div class="col-md-3">'.$row4["Month_Of_Delivery"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Number Of Store</div>
                                            <div class="col-md-3">'.$row4["Number_Of_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue Per Store</div>
                                            <div class="col-md-3">'.$row4["Revenue_Per_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Total Revenue</div>
                                            <div class="col-md-3">'.$row4["Total_Revenue"].'</div>
                                        </div>';
                                }

                            }
                            else
                            {
                                $result4 = $conn->query("SELECT Start_Date, End_Date, Frequency, Number_Of_Store, Revenue_Per_Store, Total_Revenue from onetime_track WHERE IsActive = 1 AND Id=".$row["Id"]." AND Service_Id=".$row["Service_Id"]);
                                $rowcount=$result4->num_rows;
                                $row4= $result4->fetch_assoc();
                                if($rowcount==1)
                                {
                                echo    '<div class="row">
                                            <div class="col-md-4">Business Unit Name</div>
                                            <div class="col-md-3">'.$row1["Business_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Product Name</div>
                                            <div class="col-md-3">'.$row2["Product_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Service Name</div>
                                            <div class="col-md-3">'.$row3["Service_Name"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Start Date</div>
                                            <div class="col-md-3">'.$row4["Start_Date"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">End Date</div>
                                            <div class="col-md-3">'.$row4["End_Date"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Frequency</div>
                                            <div class="col-md-3">'.$row4["Frequency"].'</div>
                                        </div>                                                                                
                                        <div class="row">
                                            <div class="col-md-4">Number Of Store</div>
                                            <div class="col-md-3">'.$row4["Number_Of_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Revenue Per Store</div>
                                            <div class="col-md-3">'.$row4["Revenue_Per_Store"].'</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Total Revenue</div>
                                            <div class="col-md-3">'.$row4["Total_Revenue"].'</div>
                                        </div>';
                                }
                            }
                        echo'
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
        if($flag1==0)
        {
			echo'<tr>
			        <td width="2"></td>
			        <td></td>
			        <td></td>
			        <td></td>
			        <td width="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			    </tr>';       	
        }
        echo        '</tbody>
                </table>';
    }
    else
    {
        $_SESSION["Error_Code"]="953";
        header('Location: ../error.php');
        exit();
    }}
?>