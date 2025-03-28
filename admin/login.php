<?php
    require_once 'include/header-ink.php';
    include 'config/connection.php';

    session_start();
    if(!empty($_SESSION['login']))
    {
        header ("Location: index.php");
    }
    
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        $res = mysqli_query($conn, "select * from user where status = true and username = '$username' and password ='$pass' AND (type = 'Admin' OR type = 'Employee')");
        if(mysqli_num_rows($res)>0)
        {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['type'] = $row['type'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['contact'] = $row['contact'];
            $_SESSION['login'] = true;
            
            if($row['type']=='Admin'){

                header("Location: admin/index.php");
            } else if($row['type']=='Employee'){

                header("Location: employee/index.php");
            }
            
        }
        else
        {
            echo "<script>alert('Invalid credentials..Kindly try with valid data')</script>";
        }
        
    }
?>

 <body style="background-image:url('assets/images/advertisement-photo.png'); background-repeat: no-repeat;">
    <div id="page-content" style="margin-top: 200px;">        
        <div class="container">
        	<div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                	<div class="mb-4 card p-5">
                        <div class="page-title">
                            <div class="wrapper text-center"><h1 class="page-width">Sign In</h1></div>
                        </div>
                       <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form mt-4">	
                          <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" autocorrect="off" autocapitalize="off" autofocus="" required>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" required>                        	
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                <input type="submit" name="submit" class="btn mb-3" value="Sign In">
                            </div>
                         </div>
                     </form>
                    </div>
               	</div>
            </div>
        </div>
        
    </div>
    
    
    <?php 
        require_once 'include/footer-link.php';
    ?>