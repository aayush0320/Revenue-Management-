<?php
include('../include/dbConfig.php');
session_start();

$flag=0;

if($_SESSION["Proposal_Id"]!="")
{
    if($_POST["service"]=="Adhoc")
    {
        $sql = "SELECT * FROM adhoc_subscription";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'Adhoc' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO adhoc_subscription (Id, Proposal_Id, Month_Of_Delivery, Revenue, Service_Id, Product_Id, Business_Id, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiiii", $Id, $Proposal_Id, $Month_Of_Delivery, $Revenue, $Service_Id, $Product_Id, $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id=$_SESSION["Proposal_Id"];
        $Month_Of_Delivery=$_POST["Month_Of_Delivery"];
        $Revenue=$_POST["Revenue"];
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;

        if($stmt->execute())
        {
            $flag=1;
        }
        else
        {
                $_SESSION["Error_Code"]="954";
                header('Location: ../error.php');
                exit();            
        }
    }

    if($_POST["service"]=="Subscription")
    {
        $sql = "SELECT * FROM adhoc_subscription";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'Subscription' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO adhoc_subscription (Id, Proposal_Id, Start_Month, End_Month, Frequency, Revenue, Service_Id, Product_Id, Business_Id,
            IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssiiii", $Id, $Proposal_Id, $Start_Month, $End_Month, $Frequency, $Revenue, $Service_Id, $Product_Id, $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id=$_SESSION["Proposal_Id"];
        $Start_Month=$_POST["Start_Month"];
        $End_Month=$_POST["End_Month"];
        $Frequency=$_POST["Frequency"];
        $Revenue=$_POST["Revenue"];
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;

        if($stmt->execute())
        {
            $flag=1;

        }
        else
        {
                $_SESSION["Error_Code"]="955";
                header('Location: ../error.php');
                exit();            
        }     
    }

    if($_POST["service"]=="OneTime")
    {
        $sql = "SELECT * FROM onetime_track";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'OneTime' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO onetime_track (Id, Proposal_Id, Month_Of_Delivery, Number_Of_Store, Revenue_Per_Store, Total_Revenue, Service_Id, Product_Id, Business_Id, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssiiii", $Id, $Proposal_Id, $Month_Of_Delivery, $Number_Of_Store, $Revenue_Per_Store, $Total_Revenue, $Service_Id, $Product_Id, 
            $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id=$_SESSION["Proposal_Id"];
        $Month_Of_Delivery=$_POST["Month_Of_Delivery"];
        $Number_Of_Store=$_POST["Number_Of_Store"];
        $Revenue_Per_Store=$_POST["Revenue_Per_Store"];
        $Total_Revenue=($Number_Of_Store*$Revenue_Per_Store);
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;

        if($stmt->execute())
        {
            $flag=1;

        }
        else
        {
                $_SESSION["Error_Code"]="956";
                header('Location: ../error.php');
                exit();        
        }  
    }

    if($_POST["service"]=="Track")
    {
        $sql = "SELECT * FROM onetime_track";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'Track' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO onetime_track (Id, Proposal_Id, Start_Date, End_Date, Frequency, Number_Of_Store, Revenue_Per_Store, Total_Revenue, Service_Id, Product_Id, Business_Id, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssiiii", $Id, $Proposal_Id, $Start_Date, $End_Date, $Frequency, $Number_Of_Store, $Revenue_Per_Store, $Total_Revenue, $Service_Id,
            $Product_Id, $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id=$_SESSION["Proposal_Id"];
        $Start_Date=$_POST["Start_Date"];
        $End_Date=$_POST["End_Date"];
        $Frequency=$_POST["Frequency"];
        $Number_Of_Store=$_POST["Number_Of_Store"];
        $Revenue_Per_Store=$_POST["Revenue_Per_Store"];
        $Total_Revenue=($Number_Of_Store*$Revenue_Per_Store);
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;
        if($stmt->execute())
        {
            $flag=1;
        }
        else
        {
                $_SESSION["Error_Code"]="957";
                header('Location: ../error.php');
                exit();
        }
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

        $result = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM adhoc_subscription WHERE IsActive = 1 and Proposal_Id='".$_SESSION["Proposal_Id"]."'");
        $rowCount = $result->num_rows;
        if($rowCount>0)
        {
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

        $result = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM onetime_track WHERE IsActive = 1 and Proposal_Id='".$_SESSION["Proposal_Id"]."'");
        $rowCount = $result->num_rows;
        if($rowCount>0)
        {
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
        echo        '</tbody>
                </table>';
    }    
}
else
{
    if($_POST["service"]=="Adhoc")
    {
        $sql = "SELECT * FROM adhoc_subscription";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'Adhoc' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO adhoc_subscription (Id, Proposal_Id, Month_Of_Delivery, Revenue, Service_Id, Product_Id, Business_Id, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiiii", $Id, $Proposal_Id, $Month_Of_Delivery, $Revenue, $Service_Id, $Product_Id, $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id="1";
        $Month_Of_Delivery=$_POST["Month_Of_Delivery"];
        $Revenue=$_POST["Revenue"];
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;

        if($stmt->execute())
        {
            $flag=1;
        }
        else
        {
                $_SESSION["Error_Code"]="954";
                header('Location: ../error.php');
                exit();            
        }
    }

    if($_POST["service"]=="Subscription")
    {
        $sql = "SELECT * FROM adhoc_subscription";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'Subscription' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO adhoc_subscription (Id, Proposal_Id, Start_Month, End_Month, Frequency, Revenue, Service_Id, Product_Id, Business_Id,
            IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssiiii", $Id, $Proposal_Id, $Start_Month, $End_Month, $Frequency, $Revenue, $Service_Id, $Product_Id, $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id="1";
        $Start_Month=$_POST["Start_Month"];
        $End_Month=$_POST["End_Month"];
        $Frequency=$_POST["Frequency"];
        $Revenue=$_POST["Revenue"];
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;

        if($stmt->execute())
        {
            $flag=1;

        }
        else
        {
                $_SESSION["Error_Code"]="955";
                header('Location: ../error.php');
                exit();            
        }     
    }

    if($_POST["service"]=="OneTime")
    {
        $sql = "SELECT * FROM onetime_track";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'OneTime' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO onetime_track (Id, Proposal_Id, Month_Of_Delivery, Number_Of_Store, Revenue_Per_Store, Total_Revenue, Service_Id, Product_Id, Business_Id, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssiiii", $Id, $Proposal_Id, $Month_Of_Delivery, $Number_Of_Store, $Revenue_Per_Store, $Total_Revenue, $Service_Id, $Product_Id, 
            $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id="1";
        $Month_Of_Delivery=$_POST["Month_Of_Delivery"];
        $Number_Of_Store=$_POST["Number_Of_Store"];
        $Revenue_Per_Store=$_POST["Revenue_Per_Store"];
        $Total_Revenue=($Number_Of_Store*$Revenue_Per_Store);
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;

        if($stmt->execute())
        {
            $flag=1;

        }
        else
        {
                $_SESSION["Error_Code"]="956";
                header('Location: ../error.php');
                exit();        
        }  
    }

    if($_POST["service"]=="Track")
    {
        $sql = "SELECT * FROM onetime_track";
        $result = $conn->query($sql);
        $Id=$result->num_rows+1;

        $result = $conn->query("SELECT Service_Id from service_master WHERE Service_Name = 'Track' and Product_Id = '".$_POST["Product_Id"]."'");
        $row = $result->fetch_assoc();

        $stmt = $conn->prepare("INSERT INTO onetime_track (Id, Proposal_Id, Start_Date, End_Date, Frequency, Number_Of_Store, Revenue_Per_Store, Total_Revenue, Service_Id, Product_Id, Business_Id, IsActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssiiii", $Id, $Proposal_Id, $Start_Date, $End_Date, $Frequency, $Number_Of_Store, $Revenue_Per_Store, $Total_Revenue, $Service_Id,
            $Product_Id, $Business_Id, $IsActive);

        $Id=$Id;
        $Proposal_Id="1";
        $Start_Date=$_POST["Start_Date"];
        $End_Date=$_POST["End_Date"];
        $Frequency=$_POST["Frequency"];
        $Number_Of_Store=$_POST["Number_Of_Store"];
        $Revenue_Per_Store=$_POST["Revenue_Per_Store"];
        $Total_Revenue=($Number_Of_Store*$Revenue_Per_Store);
        $Service_Id=$row['Service_Id'];
        $Product_Id=$_POST['Product_Id'];
        $Business_Id=$_POST['Business_Id'];
        $IsActive = 1;
        if($stmt->execute())
        {
            $flag=1;
        }
        else
        {
                $_SESSION["Error_Code"]="957";
                header('Location: ../error.php');
                exit();
        }
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

        $result = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM adhoc_subscription WHERE IsActive = 1 and Proposal_Id='1';");
        $rowCount = $result->num_rows;
        if($rowCount>0)
        {
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

        $result = $conn->query("SELECT Id, Service_Id, Product_Id, Business_Id FROM onetime_track WHERE IsActive = 1 and Proposal_Id='1';");
        $rowCount = $result->num_rows;
        if($rowCount>0)
        {
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
        echo        '</tbody>
                </table>';
    }
}
?>