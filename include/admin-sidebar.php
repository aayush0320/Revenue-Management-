<?php
    if($_SESSION['Employee_Designation']!=2)
    {
        header("location:login.php");
    }
?>
<div class="mobile-menu-left-overlay"></div>
<nav class="side-menu">
    <ul class="side-menu-list">
    	<li class="blue with-sub">
            <a href="admin-dashboard.php">
                <i class="font-icon font-icon-dashboard"></i>
                <span class="lbl">Dashboard</span>
            </a>
        </li>
        <li class="red with-sub">
            <span>
                <span class="font-icon font-icon-contacts"></span>
                <span class="lbl">Employee</span>
            </span>
            <ul>
                <li><a href="admin-create-employee"><span class="lbl">Create</span></a></li>
                <li><a href="#E-mod" data-toggle="modal"><span class="lbl">Modify</span></a></li>
            </ul>
        </li>
         <li class="green with-sub">
            <span>
                <span class="fa fa-black-tie"></span>
                <span class="lbl">Team</span>
            </span>
            <ul>
            	<li><a href="admin-team-creation"><span class="lbl">Create</span></a></li>
            	<li><a href="admin-team-modify"><span class="lbl">Modify</span></a></li>
            </ul>
        </li> 
        <li class="blue with-sub">
            <span>
                <span class="fa fa-credit-card"></span>
                <span class="lbl">Clients</span>
            </span>
            <ul>
                <li><a href="admin-create-client"><span class="lbl">Add</span></a></li>
                <li><a href="#C-mod" data-toggle="modal"><span class="lbl">Modify</span></a></li>
            </ul>
        </li>  
        <li class="pink with-sub">
            <a href="admin-create-businessunit">
                <i class="fa fa-industry"></i>
                <span class="lbl">Business Units</span>
            </a>
        </li>            
        <li class="green with-sub">
            <a href="admin-create-product">
                <i class="fa fa-puzzle-piece"></i>
                <span class="lbl">Products</span>
            </a>
        </li>        
    	<li class="red with-sub">
            <a href="admin-create-service">
                <i class="fa fa-server"></i>
                <span class="lbl">Services</span>
            </a>
        </li>                	          
        <li class="blue-dirty with-sub">
            <a href="admin-create-country">
                <i class="fa fa-map"></i>
                <span class="lbl">Country</span>
            </a>
        </li>        
    	<li class="aquamarine with-sub">
            <a href="admin-create-office">
                <i class="fa fa-building"></i>
                <span class="lbl">Offices</span>
            </a>
        </li>            
        <li class="gold">
            <a href="admin-log">
                <i class="font-icon font-icon-speed"></i>
                <span class="lbl">Activity Log</span>
            </a>
        </li>

        <li class="green with-sub">
            <a href="#Proposal_Active" data-toggle="modal">
                <i class="fa fa-play-circle"></i>
                <span class="lbl">Activate Proposal</span>
            </a>
        </li>
    
    </ul>	    
</nav><!--.side-menu-->

    <div class="modal fade" id="E-mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Employee Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/employee-modify.php">
                        <div class="row">
                            <div class="col-lg-9 col-xs-7">                                 
                                <fieldset class="form-group typeahead-container">
                                    <input  type="text" class="form-control" id="Employee_Id_s" name="Employee_Id" placeholder="Enter Employee ID" />
                                </fieldset>
                            </div>
                            <div class="col-lg-3 col-xs-3">                             
                                    <button type="submit" class="btn btn-inline btn-primary">Modify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="C-mod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Client Details</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/client-modify.php">
                        <div class="row">
                            <div class="col-lg-9 col-xs-7">                                 
                                <fieldset class="form-group typeahead-container">
                                    <input  type="text" class="form-control" id="Client_Name_s" name="Client_Name" placeholder="Enter Client Name"/>
                                </fieldset>
                            </div>
                            <div class="col-lg-3 col-xs-3">                             
                                    <button type="submit" class="btn btn-inline btn-primary">Modify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Proposal_Active" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Proposal Activation</h4>
                </div>
                <div class="modal-body">
                    <form name="myForm1" method="post" action="php/proposal-activate.php">
                        <div class="row">
                            <div class="col-lg-9 col-xs-7">                                 
                                <fieldset class="form-group typeahead-container">
                                    <input  type="text" class="form-control" id="Proposal_Id_s" name="Proposal_Id" placeholder="Enter Proposal ID" required/>
                                </fieldset>
                            </div>
                            <div class="col-lg-3 col-xs-3">                             
                                    <button type="submit" id = "Submit" class="btn btn-inline btn-primary">Activate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>