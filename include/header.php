<?php 
	session_start();
	if(!isset($_SESSION['Employee_Name'])){

		header("location:login");

	}
	date_default_timezone_set("Asia/Kolkata");
	?>
	<header class="site-header">
	    <div class="container-fluid">	        
	
	       <!--
            <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button> -->
            
             <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>

			<a href="proposal-list" class="site-logo">
	            <img class="hidden-md-down" src="img/logo.png" alt="">
	            <img class="hidden-lg-up" src="img/logo-mob.png" alt="">
	        </a>

	        <div class="site-header-content">
	            <div class="site-header-content-in">
	                <div class="site-header-shown">
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                           
	                        <?php echo $_SESSION["Employee_Name"]; ?> <img src="img/avatar-2-64.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            <a class="dropdown-item" href="php/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	                </div><!--.site-header-shown-->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header><!--.site-header-->
