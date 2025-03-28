<?php
  $email = $_SESSION['email'];
  $user = $_SESSION['username'];
  include 'config.php';
  $res1 = mysqli_query($conn, "select first_name, last_name, image, username from user where email = '$email' and username='$user'");
  $row1 = mysqli_fetch_assoc($res1);
  $image = $row1['image'];
  $ulname = $row1['last_name'];
  $ufname = $row1['first_name'];
  $username = $row1['username'];
?>
<div class="sidebar-menu">
    <header class="logo">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="index.php"> <span id="logo"> <h1>Solar Edge</h1></span></a> 
    </header>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
        <div class="down">	
            <a href="index.php"><img src="<?php echo $image; ?>" width="75" height="75"></a>
            <a href="index.php"><span class=" name-caret"><?php echo $ufname." ".$ulname; ?></span></a>
            <ul>
                <li><a class="tooltips" href="employee_profile.php"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
                <li><a class="tooltips" href="change_password_employee.php"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
                <li><a class="tooltips" href="logout.php"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
            </ul>
        </div>
							   <!--//down-->
                           <div class="menu">
									<ul id="menu" >
										<li><a href="index.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
                                        <li id="menu-academico" ><a href="employee_profile.php"><i class="fa fa-user"></i> <span>Profile</span></a>
										 </li>
										 <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>Sales</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											<ul>
												<li><a href="sales.php?trno=<?php echo "PROD".rand(10000,99999);?>">Sales</a></li>
												<li><a href="sales_history.php">Sales History</a></li>
											</ul>
											</li>

										 <li><a href="#"><i class="fa fa-file-text-o"></i> <span>Stock</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											<ul>
												<li><a href="add_stock.php">Update Stock</a></li>
												<li><a href="stock.php">View Stock</a></li>
											</ul>
											</li>

										 <li><a href="#"><i class="fa fa-smile-o"></i> <span>Service</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											<ul>
												<li><a href="employee_service_request.php">Service Request</a></li>
												<li><a href="history.php">Service History</a></li>
											</ul>
											</li>

									<li><a href="employee_view_feedback.php"><i class="fa fa-thumbs-up"></i> <span>Feedback</span></a></li>
									<li><a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>
								
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>