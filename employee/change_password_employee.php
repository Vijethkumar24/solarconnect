<?php 
    session_start();
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    else if(isset($_POST['change']))
    {
        $cpass = $_POST['cpassword'];
        $npass = $_POST['npassword'];
        $opass = $_POST['opassword'];

        if($cpass == $npass)
        {
            $email = $_SESSION['email'];
            $user = $_SESSION['username'];

            $res = mysqli_query($conn, "select password from user where email = '$email' and username='$user'");
            if(mysqli_num_rows($res)>0)
            {
                $row = mysqli_fetch_assoc($res);
                $oldpass = $row['password'];
                if($opass == $oldpass)
                {
                    if(mysqli_query($conn, "update user set password = '$npass' where email = '$email' and username='$user' "))
                    {
                        echo "<script>alert('Password updated successfully..!');</script>";
                    }
                    else
                    {
                        echo "<script>alert('Unable to update your password..!');</script>";
                    }
                }
                else
                {
                    echo "<script>alert('Invalid current password..!');</script>";
                }
            }
            else
            {
                echo "<script>alert('Unable to update your password..!');</script>";
            }
        }
        else
        {
            echo "<script>alert('Passwords dont match..!');</script>";
        }                    
    }

    include 'link.php';
    include 'employee_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:50px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Change Password</h3>
                    <form method="post" action="#">
                        <div class="form-group" style="margin-top:50px">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="opassword" class="form-control1 icon" placeholder="Current Password" style="padding-left:18px" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:50px">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="npassword" class="form-control1 icon" placeholder="New Password" style="padding-left:18px" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:50px">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                    <input type="password" name="cpassword" class="form-control1 icon" placeholder="Confirm Password" style="padding-left:18px" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                            </div>
                        </div>

                        <div class="submit"><input type="submit" value="Update" name="change"></div>
                        <div class="clearfix"></div>
                    </form>
                </div>  
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
        
<?php
    include 'footer.php';
    include 'employee_sidebar.php';
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