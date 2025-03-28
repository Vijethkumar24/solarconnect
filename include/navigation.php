<div class="header-wrap classicHeader animated d-flex shadow">
    	<div class="container-fluid my-2">        
            <div class="row align-items-center">
                <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                    <a href="index.php">
                    	<img src="assets/images/logo/logo-g.png" height="75"/>
                    </a>
                </div>
                <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                	<div class="d-block d-lg-none">
                        <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        	<i class="icon anm anm-times-l"></i>
                            <i class="anm anm-bars-r"></i>
                        </button>
                    </div>
                	<nav class="grid__item" id="AccessibleNav">
                        <ul id="siteNav" class="site-nav medium right hidearrow">
                            <li class="lvl1 parent megamenu"><a href="index.php">Home <i class="anm anm-angle-down-l"></i></a></li>
                            <li class="lvl1 parent"><a href="shop.php">Shop <i class="anm anm-angle-down-l"></i></a></li>
                        <li class="lvl1 parent"><a href="my-order.php">Orders <i class="anm anm-angle-down-l"></i></a></li>
                        <li class="lvl1 parent dropdown"><a href="#">Service <i class="anm anm-angle-down-l"></i></a>
                          <ul class="dropdown">
                            <li><a href="request_service.php" class="site-nav">Request Service</a></li>
                            <li><a href="view_request_user.php" class="site-nav">Your Request</a></li>
                          </ul>
                        </li>
                        <li class="lvl1 parent dropdown"><a href="#">Feedback <i class="anm anm-angle-down-l"></i></a>
                          <ul class="dropdown">
                            <li><a href="add_feedback.php" class="site-nav">Add Feedback</a></li>
                            <li><a href="view_feedback_user.php" class="site-nav">Your Feedback</a></li>
                          </ul>
                        </li>
                        <li class="lvl1 parent dropdown"><a href="#">Settings <i class="anm anm-angle-down-l"></i></a>
                          <ul class="dropdown">
                            <li><a href="profile.php" class="site-nav">Your Profile</a></li>
                            <li><a href="change_password.php" class="site-nav">Update Password</a></li>
                          </ul>
                        </li>
                        <li class="lvl1 parent"><a href="include/logout.php">Logout <i class="anm anm-angle-down-l"></i></a></li>
                      </ul>
                    </nav>
                </div>
                <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                <div class="site-cart">
                    	<a href="#;" class="site-header__cart" title="Cart">
                        	<i class="icon anm anm-bag-l"></i>
                            <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count"><?php if(!empty($_SESSION['cart'])){echo count($_SESSION['cart']);}else {echo '0';} ?></span>
                        </a>
                        
                        <div id="header-cart" class="block block-cart">
                        	<ul class="mini-products-list">
                                
                          
                          <?php
                          if(!empty($_SESSION['cart'])){
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
                                <li class="item">
                                	<a class="product-image" href="product-details.php?id=<?php echo $row['id'];?>">
                                    	<img src="assets/images/<?php echo $row['image'];?>" />
                                    </a>
                                    <div class="product-details">
                                        <a class="pName" href="product-details.php?id=<?php echo $row['id'];?>"><?php echo $row['name']; ?></a>
                                        <div>Qty: <?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></div>
                                        <div class="priceRow">
                                        	<div class="product-price">
                                            	<span class="money">Rs. <?php echo number_format(($row['price']) * ($_SESSION['cart'][$row['id']]['quantity']),2); ?></span>
                                            </div>
                                         </div>
									</div>
                                </li>
                                <?php
                                }}}?>


                            </ul>
                            <?php
                            if(!empty($_SESSION['cart'])){ ?>
                            <div class="total">
                            	<div class="total-in">
                                	<span class="label">Cart Subtotal:</span><span class="product-price"><span class="money"><?php echo "Rs"." ".number_format($totalprice, 2); ?></span></span>
                                </div>
                                 <div class="buttonSet text-center">
                                    <a href="checkout.php" class="btn btn-secondary btn--small w-100">Checkout</a>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>


                    <div class="site-header__search">
                    	<button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                    </div>
                </div>
        	</div>
        </div>
    </div>