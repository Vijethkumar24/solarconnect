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
        $service = $_POST['service'];
        $prod = $_POST['product'];
        $service_no = "SER".rand(100000, 999999);
        
        if(mysqli_query($conn, "insert into service(userid, problem, status, product_id, service_no)values('$uid','$service',true, '$prod', '$service_no')"))
        {
            echo "<script>alert('Service request sent successfully..!');</script>";
        }
        else
        {
            echo "<script>alert('Unable to send your request..!');</script>";
        }                    
    }

    include 'link.php';
    include 'header.php';
?>
    <div class="outter-wp">
    <div class="col-lg-12" style="margin-bottom:50px">
                <div class="card">
                    <div class="left">
                        <img src="images/admin.jpg" alt="shoe" height="300" width="250">
                    </div>
                    <div class="right">
                        <div class="product-info">
                            <div class="details">
                                <h3 class="text-primary" style="margin-top: 45px; font-size: 20px;font-weight: 500;"><?php echo $row4['cname'];?></h3>
                                <h2 style=" color: #ffffff; margin-top: 10px;font-weight: 800;font-size: 29px;"><?php echo $row4['name'];?></h2>
                                <h5 style=" color: #ffffff;"><?php echo $row4['warranty'];?></h5>
                                <span style=" color: #ffffff;"><?php echo $row4['descrption'];?></span>
                                <h3 class="text-primary"><span class="fa fa-dollar"></span><?php echo $row4['price'];?></h3>
                            </div>
                            <a href = "product_details.php?id=<?php echo $row4['id'];?>" class="text-danger btn btn-outline-primary"><i class="fa fa-shopping-cart"></i> Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        
<?php
    include 'footer.php';
    include 'sidebar.php';
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