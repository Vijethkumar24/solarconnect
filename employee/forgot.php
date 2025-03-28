<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
  require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
  require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

  $mail = new PHPMailer(true);

  include 'config.php';
  session_start();
  if(isset($_SESSION['login']))
  {
      header ("Location: index.php");
  }
  else
  {
      if(isset($_POST['submit']))
      {
        $email = $_POST['email'];
        $res = mysqli_query($conn, "select first_name, password, email from user where email = '$email' and status = true ");
        if(mysqli_num_rows($res)>0)
        {
            $rows = mysqli_fetch_assoc($res);
            $name1 = $rows['first_name'];
            $useremail1 = $rows['email'];
            $password1 = $rows['password'];
            $appname = "Solar Power";

            try 
            {
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPAuth = true;
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
              $mail->Port = 587;

              $mail->Username = 'project.head1994@gmail.com'; // YOUR gmail email
              $mail->Password = 'MAnoj143'; // YOUR gmail password

              // Sender and recipient settings
              $mail->setFrom('project.head1994@gmail.com', $appname);
              $mail->addAddress($useremail1, $name1);
              $mail->addReplyTo('project.head1994@gmail.com', $appname); // to set the reply to

              // Setting the email content
              $mail->IsHTML(true);
              $mail->Subject = "Forgot Password : ".$appname;
              $mail->Body = 'Dear '.$name1.'<br> You recently requested reset your password<br> Password : '.$password1.'<br><br> Thank you<br>Team '.$appname;
              $mail->AltBody = 'Forgot password reset email';

              $mail->send();
              // echo "Email message sent.";
              
              echo "<script>alert('Password has been sent to your registered email..!');location.href='index.php'</script>";
            } 
            catch (Exception $e) 
            {
                // echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                echo "<script>alert('Invalid data you provided..!');</script>";

            }

        }
        else
        {
          echo "<script>alert('Invalid data you provided..!');</script>";
        }

      }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Solar Power</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Augment Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<script src="js/jquery-1.10.2.min.js"></script>
<!--clock init-->
</head> 
<body>
    <div class="error_page">
        <div class="error-top">
        <h2 class="inner-tittle page">Solar Power</h2>
            <div class="login">
            <h3 class="inner-tittle t-inner">Password Reset</h3>
                <form method="post" action="#">
                    <div class="form-group" style="margin-top:50px">
                        <div class="col-md-12">
                            <div class="input-group">							
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control1 icon" name="email" placeholder="Email Address" style="padding-left:18px" required>
                            </div>
                        </div>
                    </div>

                    <p class="sign" style="float:right">Remember your password ? <a href="login.php">Sign In </a></p>
                    <div class="submit"><input type="submit" value="Reset" name="submit"></div>
                    <div class="clearfix"></div>
                    
                    <div class="new">
                        <p class="sign">Do not have an account ? <a href="signup.php">Sign Up</a></p>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>          
        </div>
    </div>
    <div class="footer">
        <p>&copy 2021 Solar Power . All Rights Reserved </p>
    </div>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>