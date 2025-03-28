<?php 
    session_start();
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    else if(isset($_POST['change']))
    {
        $uid = $_SESSION['id'];
        $amount = $_POST['amount'];
        $sid = $_GET['id'];
        
        if(mysqli_query($conn, "update service set employee_id = '$uid', status = false, amount = '$amount' where id = '$sid'"))
        {
            echo "<script>alert('Service updated successfully..!');location.href='employee_service_request.php';</script>";
        }
        else
        {
            echo "<script>alert('Unable to update service..!');</script>";
        }                    
    }

    include 'link.php';
    include 'employee_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:75px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Service Update</h3>
                    <form method="post" action="#">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-rupee"></i>
                                    </span>
                                    <input type="number" min="1" class="form-control1 icon" name="amount" placeholder="Service Charge" style="padding-left:18px" required>
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