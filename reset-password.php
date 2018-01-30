<?php 
	include 'include/head.html';    
    session_start();
	// $_SESSION['err']=0;
 //    $_SESSION['suc']=0; 
?>
    <link rel="stylesheet" href="css/separate/pages/login.min.css">
    <link rel="stylesheet" href="css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="css/separate/vendor/sweet-alert-animations.min.css">
</head>

    <?php
    
        include ('include/dbConfig.php');
        $result=$conn->query("SELECT * from employee_master WHERE Employee_Id = '".$_SESSION['eid']."'");
        if($result->num_rows==1){            
            $row=$result->fetch_assoc();
         	$email = $row["Email"];//use this to compare the mail input with 
            $em   = explode("@",$email);
            $name = implode(array_slice($em, 0, count($em)-1), '@');
            $olen = strlen($name);
            $len  = floor(strlen($name)/2);
            $len1 = $olen-$len;
            $username = substr($name,0, $len) . str_repeat('*', $len1) . "@" . end($em); 
        }
    ?>

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
						<label class="form-label semibold">Mail ID: <?php echo $username; ?></label>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name = "email" id = "email" placeholder="Enter above mentioned Email ID" required/>
                    </div>
                    <button type="submit"  class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <?php 
        //Comparing the input with $email
    if (isset($_REQUEST["email"]) && $_REQUEST["email"] != "") 
    {

        $email1 = $_POST["email"];

        if($email1 == $email)
        {
            //Random Password Generation
            $characters = 'abcdefghijklmnopqrstuvwxyz0123456789_*#$@!(){}';
            $string = '';
            $max = strlen($characters) - 1;
            for ($i = 0; $i < 6; $i++) {
              $string .= $characters[mt_rand(0, $max)];
            }

            $stmt1 = $conn->query("UPDATE login SET Password = '".md5($string)."' WHERE Employee_Id = '".$_SESSION["eid"]."'");

            if($stmt1)
            {           
                $account="no-reply.nielsen@hotmail.com";
                $password="Nielsen_rockz";
                $to = $email;
                $from="no-reply.nielsen@hotmail.com";
                $from_name="Nielsen Inc.";
                $subject = "Nielsen Employee Credentials";

                $msg = "<b>Dear ".$row["Employee_Name"]." ,<br/></b>";
                $msg .= "<p>Your New LogIn Credentials are </p>";
                $msg .= "<p>Username : ".$row["Employee_Id"]." </p>";
                $msg .= "<p>Password : ".$string." </p>";      


                include("php/phpmailer/class.phpmailer.php");
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->CharSet = 'UTF-8';
                $mail->Host = "smtp.live.com"; //smtp.gmail.com
                $mail->SMTPAuth= true;
                $mail->Port = 587; //465
                $mail->Username= $account;
                $mail->Password= $password;
                $mail->SMTPSecure = 'tls'; //ssl
                $mail->From = $from;
                $mail->FromName= $from_name;
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $msg;
                $mail->addAddress($to);
                if(!$mail->send()){
                    //echo "Mailer Error: " . $mail->ErrorInfo;
                    $_SESSION["Error_Code"]="961";
                    header('Location: ../error.php');
                    exit(); 
                }else{
                    $conn->close();  
                    $_SESSION["suc"]=1;   
                    header('Location: reset-password.php');
                    exit();
                }           
            }

            else
            {
                    $_SESSION["Error_Code"]="962";
                    header('Location: ../error.php');
                    exit();
            }            
        }
        else
        {
            $_SESSION['err']=1;
            // header("location : reset-password.php");
            // exit();
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
                    text: "Email ID don't match.",
                    confirmButtonClass: "btn-danger",
                    imageUrl: 'img/Cancel.png'
                });
        	});
        }
        if(<?php if (isset($_SESSION['suc'])  && $_SESSION['suc'] != 0) {$_SESSION['suc']=0;echo 'true'; } else { echo "false";} ?>){
        	$(window).load(function(e){
                e.preventDefault();
                swal({
                    title: "Success!",
                    text: "New password is sent to your Email ID.",
                    confirmButtonClass: "btn-success",
                    imageUrl: 'img/faq-3.png'
                },
                  function(){
                    window.location.href = 'login.php';
                });
        	});
        }
    </script>

</body>
</html>