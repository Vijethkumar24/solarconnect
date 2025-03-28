<?php 
    session_start();
    include 'config.php';

    if(!isset($_SESSION['login']))
    {
        header("Location: login.php");
    }
    else if(isset($_POST['change']))
    {
        $cat = $_POST['category'];
        
        if(mysqli_query($conn, "insert into category(name, status)values('$cat',true)"))
        {
            echo "<script>alert('Category added successfully..!');location.href='view_category.php'</script>";
        }
        else
        {
            echo "<script>alert('Unable to add category..!');</script>";
        }                    
    }

    include 'link.php';
    include 'admin_header.php';
?>
    <div class="outter-wp">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6" style="padding: 50px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:50px">
                <div class="login">
                    <h3 class="inner-tittle t-inner">Add Category</h3>
                    <form method="post" action="#">
                        <div class="form-group" style="margin-top:50px">
                            <div class="col-md-12">	
                                <input type="text" name="category" class="form-control1 icon" placeholder="Category Name" style="padding-left:18px" required>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12" style="margin-top:15px"></div>
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