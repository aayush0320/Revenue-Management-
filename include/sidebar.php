<?php include 'dbConfig.php';?>

<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
	    <ul class="side-menu-list">
            <li class="gold">
                <a href="proposal-list">
                    <i class="fa fa-stack-overflow"></i>
                    <span class="lbl">Proposals</span>
                </a>
            </li>
            <li class="blue">
                <a href="report">
                    <i class="fa fa-file-text"></i>
                    <span class="lbl">Reports</span>
                </a>
            </li>
<?php
        if($_SESSION["Employee_Designation"]==1)
        {
            echo '
                <li>
                    <a data-target="#team" data-toggle="modal">
                        <span class="fa fa-black-tie"></span>
                        <span class="lbl">Team Profile</span>
                    </a>
                </li>';
        }
?>
<?php    if($_SESSION["Employee_Designation"]==2)
    {
        echo'
            <li class="red">
                <a href="admin-dashboard">
                    <i class="fa fa-user"></i>
                    <span class="lbl">Admin Panel</span>
                </a>
            </li>';
    }else{
        echo ' 
            <li class="orange-red with-sub">
                <span>
                    <i class="font-icon font-icon-help"></i>
                    <span class="lbl">Support</span>
                </span>
                <ul>
                    <li><a href="documentation"><span class="lbl">FAQ\'s</span></a></li>
                    <li><a href="mailto:no-reply.nielsen@hotmail.com?cc=demipat90@gmail.com&subject=Need%20Urgent%20Assistance&body=I%20have%20an%20issue%20that%20needs%20to%20be%20resolved." target="_top"><span class="lbl">Contact Admin</span></a></li>
                </ul>
            </li>';
    }
?>
        </ul>
    </nav>

    <div class="modal fade" id="team" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Team Details</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $result = $conn->query("SELECT * From team_master where CS_Executive_Id = '".$_SESSION["Employee_Id"]."'");
                        $rowcount = $result->num_rows;

                        if($rowcount > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                $stmt = $conn->query("SELECT * from team_member_master where IsActive = 1 and Team_Name = '".$row["Team_Name"]."'");
                                $rowcount1 = $stmt->num_rows;
                                $result1 = $conn->query("SELECT Employee_Name from employee_master where Employee_Id = '".$row["Team_Leader_Id"]."'");
                                $row2 = $result1->fetch_assoc();
                                    echo'
                                        <table class="table table-bordered table-hover" id="tab_logic">                                            
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        Team Name : '.$row["Team_Name"].'
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                </tr>
                                                <tr>
                                                    <th>Team Member</th>
                                                    <th>Role</th>
                                                </tr>
                                                <tr>
                                                    <td>'.$row["Team_Leader_Id"].' - '.$row2["Employee_Name"].'</td>
                                                    <td>';
                                                    if($row["Role"]==1)
                                                    {
                                                        echo "Edit";
                                                    }
                                                    else
                                                    {
                                                        echo "View";
                                                    }
                                                echo'</td>
                                                </tr>';                                    

                                if($rowcount1 > 0)
                                {

                                    while($row1 = $stmt->fetch_assoc())
                                    {
                                        $result1 = $conn->query("SELECT Employee_Name from employee_master where Employee_Id = '".$row1["Team_Member_Id"]."'");
                                        $row2 = $result1->fetch_assoc();                                        
                                        echo'<tr>
                                                <td>'.$row1["Team_Member_Id"].' - '.$row2["Employee_Name"].'</td>
                                                <td>';
                                                if($row1["Role"]==1)
                                                {
                                                    echo "Edit";
                                                }
                                                else
                                                {
                                                    echo "View";
                                                }
                                            echo'</td>
                                            </tr>'; 
                                    }
                                    echo'
                                        </tbody></table><br/>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>