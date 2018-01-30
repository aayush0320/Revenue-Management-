<?php 
	include 'include/head.html';    
    session_start();
	$_SESSION['err']=0; 
?>
    <link rel="stylesheet" href="css/separate/pages/login.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="css/separate/vendor/sweet-alert-animations.min.css">
</head>



<body>
    <div class="background-bl" style="position:fixed; left:0px; bottom:0px ">
        <img src="img/insightbr.png">
    </div>
    <div class="background-tr" style="position:fixed; right:10px; top:0px ">
        <img src="img/logo-mob1.png">
    </div>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
               <form class="sign-box" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="padding-top: 40px; opacity: 0.9">
                    <div class="form-group">
                        <input type="text" class="form-control" name="Login_Id" id="Login_Id" placeholder="Employee ID" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required/>
                    </div>
                    <div class="form-group" id="set">
                        <div class="float-right reset">
                            <a href="reset-password">Reset Password</a>
                        </div>
                    </div>
                    <div id="print"></div>
                    <button type="submit"  class="btn btn-primary">Log In</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    
        include ('include/dbConfig.php');
        if (isset($_REQUEST["Login_Id"]) && $_REQUEST["Login_Id"] != "") {

            $result=$conn->query("SELECT * from login WHERE Login_Id = '".$_REQUEST["Login_Id"]."'");
            if($result->num_rows==1)
            {
                $row=$result->fetch_assoc();
                if(($row["Login_Id"]==$_REQUEST["Login_Id"]) && ($row["Password"]==md5($_REQUEST["Password"])))
                {
                    $result=$conn->query("SELECT * from employee_master WHERE Employee_Id = '".$row["Employee_Id"]."'");
                    if($result->num_rows==1)
                    {
                        $row=$result->fetch_assoc();

                        $_SESSION["Employee_Designation"]=$row["Employee_Designation"];
                        $_SESSION["Employee_Id"]=$row["Employee_Id"];
                        $_SESSION["Employee_Name"]=$row["Employee_Name"];   
                        $_SESSION["Country_Id"]=$row["Country_Id"];
                        $_SESSION["Office_Id"]=$row["Office_Id"];
                        $_SESSION["IsMember"]=$row["IsMember"];
                                           
                        if($row["Employee_Designation"]=='0')
                        {
                            $conn->close();
                            header('Location: proposal-list');
                            exit();                                                         
                        }

                        if($row["Employee_Designation"]=='1')
                        {
                            $conn->close();
                            header('Location: proposal-list');
                            exit();                 
                        }

                        if($row["Employee_Designation"]=='2')
                        {
                            $conn->close();
                            header('Location: admin-dashboard');
                            exit();                 
                        }
                    }
                }
                else{   
                    $_SESSION['err']=1;    
                    $conn->close();
                }
            }
            else
            {   
                $_SESSION['err']=1;    
                $conn->close();
            }
        }
    ?>
    
    <?php include 'include/commonjs.html';?>
    <script type="text/javascript" src="js/lib/match-height/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
    
    <!-- SweetAlert -->
    <script src="js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
    <script>
        if (<?php if (isset($_SESSION['err'])  && $_SESSION['err'] != 0) {$_SESSION['err']=0;echo 'true'; } else { echo "false";} ?>) {
            $(window).load(function(e){
                e.preventDefault();
                swal({
                    title: "Error!",
                    text: "Username or Password might be Incorrect.",
                    confirmButtonClass: "btn-danger",
                    imageUrl: 'img/Cancel.png'
                });
        });
        }
    </script>

    <script>
        $(document).ready(function(){
            
            $("#set").hide();
            
            $("#Login_Id").focus(function(){
                $("#Login_Id").blur(function(){
                    var letters = /^\w{5}\d{5}$/;
                    if(document.getElementById("Login_Id").value.match(letters))
                    {
                        $("#set").show();
                        document.getElementById("Login_Id").className = "form-control form-control-success";
                        $('#submit').removeAttr('disabled');
                        var Id = document.getElementById("Login_Id").value;
                        $.ajax({
                            type:'POST',
                            url:'ajax/reset-ajaxData.php',
                            data:{Id : Id},
                            success:function(html){
                                $('#print').html(html);
                            }
                        });                        
                    }
                    else
                    {
                        $("#set").hide();
                        document.getElementById("Login_Id").className = "form-control form-control-danger";
                        $('#submit').attr('disabled','disabled');
                    }                
                });
            });

         });
    </script>
</body>
</html>