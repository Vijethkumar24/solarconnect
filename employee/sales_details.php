<?php 
    session_start();
    include 'config.php';
    $trano = $_GET['trno'];
    $total=0;
    $resm = mysqli_query($conn, "select product.price, purchase_track.quantity from purchase_track join product on product.id = purchase_track.product_id where purchase_track.track_no = '$trano'");
    while($rowm = mysqli_fetch_assoc($resm))
    {
        $total+=$rowm['price']*$rowm['quantity'];
    }
    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    if(isset($_POST['change']))
    {
        $uid = $_SESSION['id'];
        $trno = $_GET['trno'];
        $payno = "PAY".rand(10000, 99999);
        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $pin = $_POST['pin'];
        $payment = $_POST['payment'];

        if(mysqli_query($conn, "insert into purchase(employee_id, product_track, user_fullname, user_address, user_city,user_pin, amount, payment_method, payment_no, payment_status)values('$uid','$trano','$name','$address', '$city','$pin', '$total', '$payment', '$payno', true)"))
        {
            echo "<script>alert('Order placed successfully..');window.location.href='index.php';</script>";
        }
        else
        {
            echo "<script>alert('Unable to place order..');</script>";
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
                    <h3 class="inner-tittle t-inner">Billing</h3>
                    <h4 class="inner-tittle t-inner">Total Amount: <?php echo $total;?></h4>
                    <form method="post" action="#">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <input type="text" class="form-control1 icon" name="name" placeholder="Full Name" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12"><textarea name="address" cols="50" rows="5" class="form-control1" placeholder="Address" style="height: 75px;" required></textarea></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">	
                                    <input type="text" class="form-control1 icon" name="city" placeholder="City" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">	
                                    <input type="text" class="form-control1 icon" name="pin" placeholder="Pin Code" pattern="[0-9]{6}" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="payment" id="selector1" class="form-control1" required>
                                    <option value="">Choose Payment Method</option>
                                    <option value="Cash">Cash</option> 
                                    <option value="Debit Card">Debit Card</option> 
                                    <option value="Credit Card">Credit Card</option> 
                                    <option value="Online Payment Card">Online Payment</option> 
                                </select>
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