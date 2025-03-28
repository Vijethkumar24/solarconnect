<?php 
    session_start();

    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    else if(isset($_POST['change']))
    {
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $uid = $_SESSION['id'];

        $res6 = mysqli_query($conn, "select quantity from stock where product_id = '$product' and employee_id = '$uid'");
        
        if(mysqli_num_rows($res6)>0)
        {
            $row6 = mysqli_fetch_assoc($res6);
            $qty = $row6['quantity']+$quantity;  
            if(mysqli_query($conn, "update stock set quantity = '$qty' where product_id = '$product' and employee_id = '$uid'"))
            {
                echo "<script>alert('Stock updated successfully..!');</script>";
            }
            else
            {
                echo "<script>alert('Unable to add stock..!');</script>";
            }
        }
        else
        {
            if(mysqli_query($conn, "insert into stock(product_id, employee_id, quantity, status)values('$product','$uid','$quantity',true)"))
            {
                echo "<script>alert('Stock updated successfully..!');</script>";
            }
            else
            {
                echo "<script>alert('Unable to add stock..!');</script>";
            } 
        }
                      
    }

    include 'link.php';
    include 'employee_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:25px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Update Stock</h3>
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="product" id="selector1" class="form-control1" required>
                                    <option value="">Choose Product</option>
                                    <?php $res = mysqli_query($conn, "select id, name from product where status=true");
                                        while($row = mysqli_fetch_assoc($res))
                                        {?>
                                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                        <?php
                                        }?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </span>
                                    <input type="number" class="form-control1 icon" name="quantity" placeholder="Quantity" min="1" style="padding-left:18px" required>
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