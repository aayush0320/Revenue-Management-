<?php		
   $account="no-reply.nielsen@hotmail.com";
   $password="Nielsen_rockz";
   $to = "98118238088093@delhi.hutch.co.in";
   $from="no-reply.nielsen@hotmail.com";
   $from_name="Deep Patel";
   $subject = "Testing";
   $msg = "Test Mail";     


   include("phpmailer/class.phpmailer.php");
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
      echo $account;
      echo $password;
      echo "Mailer Error: " . $mail->ErrorInfo;
   }else{

   echo $to;
    echo "E-Mail has been sent";
   }
?>