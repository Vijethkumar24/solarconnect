<?php 
    session_start();

    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    else if(isset($_POST['change']))
    {
        $image = "product/".$_FILES["image"]["name"];
        if(move_uploaded_file($_FILES["image"]["tmp_name"],"product/".$_FILES["image"]["name"]))
        {
            $pname = $_POST['name'];
            $cat = $_POST['category'];
            $price = $_POST['price'];
            $warranty = $_POST['warranty'];
            $description = $_POST['description'];

            if(mysqli_query($conn, "insert into product(category_id, name, price, descrption, image, warranty, status)values('$cat','$pname','$price','$description','$image','$warranty',true)"))
            {
                echo "<script>alert('Product updated successfully..!');</script>";
            }
            else
            {
                echo "<script>alert('Unable to add product..!');</script>";
            }
        }
        else
        {
            echo "<script>alert('Unable to upload your image on server..!');</script>";
        }                  
    }

    include 'link.php';
    include 'admin_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:25px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Add Product</h3>
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="category" id="selector1" class="form-control1" required>
                                    <option value="">Choose Category</option>
                                    <?php $res = mysqli_query($conn, "select id, name from category where status=true");
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
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <input type="text" class="form-control1 icon" name="name" placeholder="Product Name" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12"><textarea name="description" cols="50" rows="5" class="form-control1" placeholder="Description" style="height: 100px;" required></textarea></div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-tag"></i>
                                    </span>
                                    <input type="number" class="form-control1 icon" name="price" placeholder="Price" min="1" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>			
                                    <input type="text" class="form-control1 icon" name="warranty" placeholder="Warranty" style="padding-left:18px" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="validationDefault02" class="input__label">Product Image</label>
                            <input type="file" class="form-control input-style" style="padding-bottom:30px" id="validatedCustomFile" name="image" accept="image/*" required>
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
    include 'admin_sidebar.php';
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