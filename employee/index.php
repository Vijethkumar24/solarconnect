<?php 
    session_start();
    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    
        include 'link.php';
        include 'employee_header.php';
        ?>
        <div class="outter-wp">
        <div class="custom-widgets">
            <div class="row" >
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"><img src="images/employee.jpg" height="300"></div>
                    <div class="col-lg-4"></div>
                </div>
                <div class="row-one" >
                    <div class="col-md-3 widget" style="margin-top:50px" ><a href="sales_history.php">
                        <div class="stats-left ">
                            <h5>Total</h5>
                            <h4> Sales</h4>
                        </div>
                        <div class="stats-right">
                            <label><?php $uid = $_SESSION['id']; include 'config.php'; $res = mysqli_query($conn, "select count(*) as tot from purchase where employee_id = '$uid'"); $row = mysqli_fetch_assoc($res); echo $row['tot'];?></label>
                        </div>
                        <div class="clearfix"> </div>	</a>
                    </div>
                    <div class="col-md-3 widget states-mdl" style="margin-top:50px"><a href="employee_service_request.php">
                        <div class="stats-left">
                            <h5>Total</h5>
                            <h4>Service</h4>
                        </div>
                        <div class="stats-right">
                            <label> <?php include 'config.php'; $res = mysqli_query($conn, "select count(*) as tot from service "); $row = mysqli_fetch_assoc($res); echo $row['tot'];?></label>
                        </div>
                        <div class="clearfix"> </div>	</a>
                    </div>
                    <div class="col-md-3 widget states-thrd" style="margin-top:50px"><a href="employee_view_feedback.php">
                        <div class="stats-left">
                            <h5>Total</h5>
                            <h4>Feedback</h4>
                        </div>
                        <div class="stats-right">
                            <label><?php include 'config.php'; $res = mysqli_query($conn, "select count(*) as tot from feedback  where status=true"); $row = mysqli_fetch_assoc($res); echo $row['tot'];?></label>
                        </div>
                        <div class="clearfix"> </div>	</a>
                    </div>
                    <div class="col-md-3 widget states-last" style="margin-top:50px"><a href="view_product_employee.php">
                        <div class="stats-left">
                            <h5>Total</h5>
                            <h4>Product</h4>
                        </div>
                        <div class="stats-right">
                            <label><?php include 'config.php'; $res = mysqli_query($conn, "select count(*) as tot from product where status=true"); $row = mysqli_fetch_assoc($res); echo $row['tot'];?></label>
                        </div>
                        <div class="clearfix"> </div>	</a>
                    </div>
                
                </div><div class="clearfix"> </div>
                
                
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
        <?php

    