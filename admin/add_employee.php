<?php 
    session_start();

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

    // require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
    // require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
    // require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

    // // passing true in constructor enables exceptions in PHPMailer
    // $mail = new PHPMailer(true);
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    else if(isset($_POST['change']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = "USR".rand(100000,999999)."EM";
        $pass = "PAs".rand(100000,999999);
        $designation = $_POST['designation'];
        $email = $_POST['email'];
        $num = $_POST['contact'];
        $address = $_POST['address'];
        
        if(mysqli_query($conn, "insert into user(first_name, last_name, email, type, username, password, image, status, address, contact,designation)values('$fname', '$lname', '$email', 'Employee', '$uname', '$pass', 'user/user_image.jpg', true, '$address', '$num','$designation')"))
        {
            $name1 = $fname." ".$lname;
            $useremail1 = $email;
            $appname = "Solar Power";

            try 
            {
                // $mail->isSMTP();
                // $mail->Host = 'smtp.gmail.com';
                // $mail->SMTPAuth = true;
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                // $mail->Port = 587;

                // $mail->Username = 'project.head1994@gmail.com';
                // $mail->Password = 'MAnoj143';

                // $mail->setFrom('project.head1994@gmail.com', $appname);
                // $mail->addAddress($useremail1, $name1);
                // $mail->addReplyTo('project.head1994@gmail.com', $appname); 

                // $mail->IsHTML(true);
                // $mail->Subject = "User Registration : ".$appname;
                // $mail->Body = 'Dear '.$name1.'<br> You have recently registered to our webpage.<br> USER ID : '.$uname.'<br>Pasword : '.$pass.'<br><br> Thank you<br>Team '.$appname;
                // $mail->AltBody = 'User Registration Email';

                // $mail->send();
                
                echo "<script>alert('User registered successfully, and User Id and password has been sent to registered email..!');location.href='index.php'</script>";
            } 
            catch (Exception $e) 
            {
                // echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                echo "<script>alert('Unable to process, Kindly try after sometimes..');</script>";
            }
        }
        else
        {
            echo "<script>alert('Unable to add category..!');</script>";
        }                    
    }

    include 'link.php';
    include 'admin_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:25px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Add Employee</h3>
                    <form method="post" action="#">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <input type="text" class="form-control1 icon" name="fname" placeholder="First Name" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">			
                                <input type="text" class="form-control1 icon" name="lname" placeholder="Last Name" style="padding-left:18px" required>
                            
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control1 icon" name="email" placeholder="Email Address" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="text" title="Please enter 10 digit valid number" pattern="[6789][0-9]{9}" class="form-control1 icon" name="contact" placeholder="Contact Number" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12"><textarea name="address" cols="50" rows="5" class="form-control1" placeholder="Address" style="height: 75px;" required></textarea></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control1 icon" name="designation"  placeholder="Designation" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="submit"><input type="submit" value="Submit" name="change"></div>
                        <div class="clearfix"></div>
                    </form>
                </div>  
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
        
<?php
    include 'footer.php';
    include 'admin_sidebar.php';
?>
<!--js -->
<link rel="stylesheet" href="css/vroom.css">
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>