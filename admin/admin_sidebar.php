<?php
  $email = $_SESSION['email'];
  $user = $_SESSION['username'];
  include 'config.php';
  $res = mysqli_query($conn, "select first_name, last_name, image, username from user where email = '$email' and username='$user'");
  $row = mysqli_fetch_assoc($res);
  $image = $row['image'];
  $ulname = $row['last_name'];
  $ufname = $row['first_name'];
  $username = $row['username'];
?>
<div class="sidebar-menu">
    <header class="logo">
        <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="index.php"> <span id="logo"> <h1>Solar Edge</h1></span></a> 
    </header>
    <div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
        <div class="down">	
            <a href="index.php"><img src="<?php echo $image; ?>" width="75" height="75"></a>
            <a href="index.php"><span class=" name-caret"><?php echo $ufname." ".$ulname; ?></span></a>
        </div>
							   <!--//down-->
                           <div class="menu">
									<ul id="menu" >
										<li><a href="index.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
										 <li id="menu-academico" ><a href="#"><i class="fa fa-table"></i> <span> Category</span> <span class="fa fa-angle-right" style="float: right"></span></a>
										   <ul id="menu-academico-sub" >
											<li id="menu-academico-boletim" ><a href="add_category.php">Add Category</a></li>
											<li id="menu-academico-avaliacoes" ><a href="view_category.php">View Category</a></li>
											
										  </ul>
										</li>
										 <li id="menu-academico" ><a href="#"><i class="fa fa-user"></i> <span>Employee</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											 <ul id="menu-academico-sub" >
											 <li id="menu-academico-boletim" ><a href="add_employee.php">Add Employee</a></li>
											<li id="menu-academico-avaliacoes" ><a href="view_employee.php">View Employee</a></li>
											  </ul>
										 </li>

										 <li id="menu-academico" ><a href="#"><i class="fa fa-shopping-cart"></i> <span>Product</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											 <ul id="menu-academico-sub" >
											 <li id="menu-academico-boletim" ><a href="add_product.php">Add Product</a></li>
											<li id="menu-academico-avaliacoes" ><a href="view_product.php">View Product</a></li>
											  </ul>
										 </li>

										 <li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i> <span>Online Sales Report</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											 <ul id="menu-academico-sub" >
											 <li id="menu-academico-boletim" ><a href="sales_history_admin.php">Sales Report</a></li>
											<li id="menu-academico-avaliacoes" ><a href="monthly_sale.php">Monthly Sales Report</a></li>
											  </ul>
										 </li>

										 <li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i> <span>Offine Sales Report</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											 <ul id="menu-academico-sub" >
											 <li id="menu-academico-boletim" ><a href="purchase.php">Sales Report</a></li>
											<li id="menu-academico-avaliacoes" ><a href="monthly_purchase.php">Monthly Sales Report</a></li>
											  </ul>
										 </li>

										 <li id="menu-academico" ><a href="#"><i class="fa fa-file-text-o"></i> <span>Service Report</span> <span class="fa fa-angle-right" style="float: right"></span></a>
											 <ul id="menu-academico-sub" >
											 <li id="menu-academico-boletim" ><a href="service.php">Service Report</a></li>
											<li id="menu-academico-avaliacoes" ><a href="monthly_service.php">Monthly Service Report</a></li>
											  </ul>
										 </li>

									<li><a href="view_feedback.php"><i class="fa fa-thumbs-up"></i> <span>Feedback</span></a></li>
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