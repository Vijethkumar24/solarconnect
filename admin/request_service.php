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
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:75px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Service Request</h3>
                    <form method="post" action="#">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="product" id="selector1" class="form-control1" required>
                                    <option value="">Choose Product</option>
                                    <?php $res = mysqli_query($conn, "select distinct product.id, product.name from product join orders on orders.productId = product.id where status=true and orders.orderStatus='Paid'");
                                        while($row = mysqli_fetch_assoc($res))
                                        {?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                                        }?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12" style="margin-top:15px"><textarea name="service" cols="50" rows="5" class="form-control1" placeholder="Write your problem" style="height: 75px;" required></textarea></div>
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