<?php 
    session_start();
    $id = $_SESSION['id'];
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    else if(isset($_POST['change']))
    {
        if(!empty($_FILES['image']['name']))
        {

            $image = "user/".$_FILES["image"]["name"];
            if(move_uploaded_file($_FILES["image"]["tmp_name"],"user/".$_FILES["image"]["name"]))
            {

                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $designation = $_POST['designation'];
                $email = $_POST['email'];
                $num = $_POST['contact'];
                $address = $_POST['address'];
                
                if(mysqli_query($conn, "update user set first_name = '$fname', last_name = '$lname', email = '$email', image = '$image', address = '$address', contact = '$num', designation = '$designation' where id = '$id'"))
                {     
                    echo "<script>alert('Profile updated successfully..!');location.href='employee_profile.php'</script>";
                }
                else
                {
                    echo "<script>alert('Unable to update profile..!');</script>";
                }    
            }
            else
            {
                echo "<script>alert('Unable to upload your image on server..!');</script>";
            } 
        }
        else
        {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $designation = $_POST['designation'];
            $email = $_POST['email'];
            $num = $_POST['contact'];
            $address = $_POST['address'];
            
            if(mysqli_query($conn, "update user set first_name = '$fname', last_name = '$lname', email = '$email', address = '$address', contact = '$num', designation = '$designation' where id = '$id'"))
            {     
                echo "<script>alert('Profile updated successfully..!');location.href='employee_profile.php'</script>";
            }
            else
            {
                echo "<script>alert('Unable to update profile..!');</script>";
            }  
        }            
    }

    include 'link.php';
    include 'employee_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 30px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:10px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Profile Update</h3>
                    <form method="post" action="#" enctype="multipart/form-data">
                        <?php
                        $res = mysqli_query($conn,"select * from user where id = '$id'");
                        $row=mysqli_fetch_assoc($res);?>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" disabled class="form-control1 icon" value="<?php echo $row['username'];?>"  placeholder="Designation" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <input type="text" class="form-control1 icon" name="fname" value="<?php echo $row['first_name'];?>" placeholder="First Name" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">			
                                <input type="text" class="form-control1 icon" name="lname" placeholder="Last Name" value="<?php echo $row['last_name'];?>" style="padding-left:18px" required>
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control1 icon" name="email" value="<?php echo $row['email'];?>" placeholder="Email Address" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                    <input type="text" title="Please enter 10 digit valid number" value="<?php echo $row['contact'];?>" pattern="[6789][0-9]{9}" class="form-control1 icon" name="contact" placeholder="Contact Number" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12"><textarea name="address" cols="50" rows="5" class="form-control1" placeholder="Address" style="height: 75px;" required><?php echo $row['address'];?></textarea></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                    <input type="text" class="form-control1 icon" name="designation"  value="<?php echo $row['designation'];?>" placeholder="Designation" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="validationDefault02" class="input__label">Profile Image</label>
                            <input type="file" class="form-control input-style" style="padding-bottom:30px" id="validatedCustomFile" name="image" accept="image/*">
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