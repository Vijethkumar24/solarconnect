<?php 
    session_start();
    include 'config.php';
    $trano = $_GET['trno'];

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    if(isset($_POST['submitadd']))
    {
        $presc = $_POST['product'];
        $qty = $_POST['quantity'];

        $resn = mysqli_query($conn, "select quantity from stock where product_id = '$presc'");
        if(mysqli_num_rows($resn)>0)
        {
            $rown = mysqli_fetch_assoc($resn);
            if(($rown['quantity']-$qty)>=0)
            {
                if(mysqli_query($conn, "INSERT INTO `purchase_track`( `product_id`, `quantity`,  `track_no`) VALUES('$presc','$qty', '$trano')"))
                {
                    $fqty = $rown['quantity']-$qty;
                    mysqli_query($conn, "update stock set quantity = '$fqty' where product_id = '$presc'");
                }
                else
                {
                    echo "<script>alert('Unable to add product..');</script>";
                }
            }
            else
            {
                echo "<script>alert('No stock available..');</script>";
            }
        }
        else
        {
            echo "<script>alert('No stock available..');</script>";
        }
    }


    include 'link.php';
    include 'employee_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-5" style="margin-left:25px;padding: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:25px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Select Product</h3>
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="product" id="selector1" class="form-control1" required>
                                    <option value="">Choose Product</option>
                                    <?php $res = mysqli_query($conn, "select product.id, product.name, stock.quantity from product join stock on product.id = stock.product_id where product.status=true");
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            echo $row['quantity'];
                                            if($row['quantity']>=1)
                                            {?>
                                                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                            <?php
                                            }
                                        }?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="input-group col-md-12">	
                                    <input type="number" class="form-control1 icon" name="quantity" placeholder="Quantity" min="1" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="submit" class="btn" value="Add" name="submitadd" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 text-center">
                                <a  class="text-center btn" style="font-size: 20px;
    font-weight: 400;
    color: #fff;
    cursor: pointer;
    outline: none;
    padding: 10px 15px;
    width: 100%;
    border: 2px solid #ea4c89;
    background: #ea4c89;
    margin: 0;
    font-family: 'Roboto', sans-serif;" href="sales_details.php?trno=<?php echo $trano;?>">Purchase</a>
                            </div>
                        </div>
                        
                        
                        <div class="clearfix"></div>
                    </form>
                </div>  
            </div>
            <div class="col-lg-6">
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>Product</th>
										<th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>

            <?php
                        $res = mysqli_query($conn, "select purchase_track.quantity, product.name from purchase_track join product on purchase_track.product_id = product.id where track_no = '$trano'");
                        if(mysqli_num_rows($res)>0)
                        {
                            $count=1;
                            while($row=mysqli_fetch_assoc($res))
                            {
                                ?>
                                <tr><td><?php echo $count;?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['quantity'];?></td>
                                </tr>
                            <?php
                            $count++;
                            }
                        }
                    ?></tbody>			
                            </table>
            </div>
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