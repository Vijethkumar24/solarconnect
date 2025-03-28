<?php
  $idd = $_SESSION['id'];
  $email = $_SESSION['email'];
  $user = $_SESSION['username'];
  include 'config.php';
  $res11 = mysqli_query($conn, "select first_name, last_name, image, username from user where id = '$idd'");
  $row11 = mysqli_fetch_assoc($res11);
  $image = $row11['image'];
  $ulname = $row11['last_name'];
  $ufname = $row11['first_name'];
  $username = $row11['username'];
?>
<div class="sidebar-menu">
    <header class="logo">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="index.php"> <span id="logo"> <h1>Energy</h1></span></a> 
    </header>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
        <div class="down">	
            <a href="index.php"><img src="<?php echo $image; ?>" width="75" height="75"></a>
            <a href="index.php"><span class=" name-caret"><?php echo $ufname." ".$ulname; ?></span></a>
            <p><?php echo $username; ?></p>
            <ul>
                <li><a class="tooltips" href="profile.php"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
                <li><a class="tooltips" href="change_password.php"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
                <li><a class="tooltips" href="logout.php"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
            </ul>
        </div>
							   <!--//down-->
                           <div class="menu">
									<ul id="menu" >
										<li><a href="index.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
										 <li id="menu-academico" ><a href="my-order.php"><i class="fa fa-shopping-cart"></i> <span> Orders</span> </a>
										   
										</li>
										 <li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span>Service</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											 <ul id="menu-academico-sub" >
												<li id="menu-academico-avaliacoes" ><a href="request_service.php">Request Service</a></li>
												<li id="menu-academico-boletim" ><a href="view_request_user.php">View Request</a></li>
											  </ul>
										 </li>
									<li><a href="#"><i class="fa fa-smile-o"></i> <span>Feedback</span> <span class="fa fa-angle-right" style="float: right"></span></a>
									  <ul>
										<li><a href="add_feedback.php">Add Feedback</a></li>
										<li><a href="view_feedback_user.php">View Feedback</a></li>
									</ul>
									</li>
									<li><a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span> </span></a>
									</li>
									
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