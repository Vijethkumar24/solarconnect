<?php include 'config.php'; ?>

<div class="inner-content">
    <div class="header-section">
        <div class="top_menu">
            <div class="main-search">
                <form method = "post" action="#">
                    <input type="text" name="stext" value="Search" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Search';}" class="text"/>
                    <input type="submit" value="" name="search">
                </form>
            <div class="close"><img src="images/cross.png" /></div>
        </div>
        <div class="srch"><button></button></div>
        <script type="text/javascript">
                $('.main-search').hide();
            $('button').click(function (){
                $('.main-search').show();
                $('.main-search text').focus();
            }
            );
            $('.close').click(function(){
                $('.main-search').hide();
            });
        </script>
                
                <div class="profile_details_left">
                    <ul class="nofitications-dropdown">
                    <li class="dropdown note">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-shopping-cart"></i> <span class="badge"><?php if(!empty($_SESSION['cart']))
                                {echo count($_SESSION['cart']); }?></span></a>
                                <?php
                                if(!empty($_SESSION['cart']))
                                {
                                ?>
									<ul class="dropdown-menu two">
										<li>
											<div class="notification_header">
												<h3>You have <?php echo count($_SESSION['cart']); ?> items in your cart</h3>
											</div>
										</li>
                                        <?php
                                        $sql = "SELECT * FROM product WHERE id IN(";
                                            foreach($_SESSION['cart'] as $id => $value){
                                            $sql .=$id. ",";
                                            }
                                            $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                                            $query = mysqli_query($conn,$sql);
                                            $totalprice=0;
                                            $totalqunty=0;
                                            if(!empty($query)){
                                            while($row = mysqli_fetch_array($query)){
                                                $quantity=$_SESSION['cart'][$row['id']]['quantity'];
                                                $subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['price'];
                                                $totalprice += $subtotal;
                                                $_SESSION['qnty']=$totalqunty+=$quantity;

                                            ?>

                                            <li><a href="#">
                                                <div class="user_img"><img src="<?php echo $row['image'];?>" alt=""></div>
                                            <div class="notification_desc">
                                                <p><?php echo $row['name']; ?></p>
                                                <p><span>Rs. <?php echo ($row['price']); ?> * <?php echo $_SESSION['cart'][$row['id']]['quantity']; ?> = <?php echo ($row['price']) * ($_SESSION['cart'][$row['id']]['quantity']); ?></span></p>
                                                </div>
                                            <div class="clearfix"></div>	
                                            </a></li>
                                         <?php } }?>
										 <li>
											<div class="notification_bottom">
												<a href="mycart.php">See all items</a>
											</div> 
										</li>
									</ul>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                <ul class="dropdown-menu two">
										<li>
											<div class="notification_header">
												<h3>No items in your cart</h3>
											</div>
										</li>
									</ul>
                                <?php
                                }
                                    ?>
							</li>	
                        <li class="dropdown note">
                            <a href="change_password.php"><i class="fa fa-cog"></i></a>
                        </li>
						<li class="dropdown note">
                            <a href="logout.php"><i class="fa fa-power-off"></i></a>
                        </li>		   							   		
                        <div class="clearfix"></div>	
                    </ul>
                </div>
                <div class="clearfix"></div>	
            </div>
            <div class="clearfix"></div>
        </div>