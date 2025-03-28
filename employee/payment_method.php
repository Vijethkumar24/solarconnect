<?php 
    session_start();
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    if (isset($_POST['submit'])) {

		$tridm = $_GET['trackid'];
		$amt = $_GET['amt'];

		$pyno = "PAY987".$tridm."MM".$tridm;
        mysqli_query($conn,"insert into user_payment (payment_no, user_id, amount, payment_status, track_id) values('$pyno', '".$_SESSION['id']."','$amt', 'PAID', '$tridm')");

        $resb = mysqli_query($conn,"select payment_id from user_payment where track_id = '$tridm'");
        $rowb = mysqli_fetch_assoc($resb);
        $pid = $rowb['payment_id'];

        date_default_timezone_set('Asia/Kolkata');
        $dateo = date('Y-m-d h:i:s a');
        mysqli_query($conn,"update orders set orderStatus = 'Paid', order_remark = 'Order has been begin', orderDate = '$dateo', payment_id='$pid' where userid='".$_SESSION['id']."' and trackid = '$tridm'");

        unset($_SESSION['cart']);
        header('location:my-order.php');
	}

    include 'link.php';
    include 'header.php';
?>
    <div class="outter-wp">
    
<form name="payment" method="post">
    <div class="row">
	</div><br><br>
    <div  style="margin-left:20px">
    <div>
        
    <div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Payment Details
                    </h3>
                </div>
                
                <div class="panel-body">
                    <div class="form-group">
                        <label for="cardNumber">
                            CARD NUMBER</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number" pattern="[0-9]{16}"
                                required autofocus />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7 col-md-7">
                            <div class="form-group">
                                <label for="expityMonth">
                                    EXPIRY DATE</label>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityMonth" placeholder="MM" required pattern="[0-9]{2}"/>
                                </div>
                                <div class="col-xs-6 col-lg-6 pl-ziro">
                                    <input type="text" class="form-control" id="expityYear" placeholder="YY" required pattern="[0-9]{2}"/></div>
                            </div>
                        </div>
                        <div class="col-xs-5 col-md-5 pull-right">
                            <div class="form-group">
                                <label for="cvCode">
                                    CV CODE</label>
                                <input type="password" class="form-control" id="cvCode" placeholder="CV" required pattern="[0-9]{3}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"> Final Payment &nbsp;&nbsp;&nbsp;<?php echo "Rs. ".$_GET['amt'];?></a>
                </li>
            </ul>
            </div>
            <input type="submit" value="submit" name="submit" class="btn btn-success btn-lg btn-block" style="padding: 15px;">
        </div>
    </div>
</div>



    </div>

    <div style="margin-left:100px;">
        
    </div>
    <br><br>
</div>

	    </form>	

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