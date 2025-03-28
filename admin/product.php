
<div class="row">
<?php 
    include 'config.php';

    if(isset($_GET['add_to_cart']))
	{
		$id = intval($_GET['product_id']);

		$verres = mysqli_query($conn, "select id from product where id = '$id'");
		if(mysqli_num_rows($verres)>0)
		{
			if(isset($_SESSION['cart'][$id]))
			{
				$_SESSION['cart'][$id]['quantity']++;
				echo "<script>alert('Product has been added to the cart');location.href='index.php';</script>";
			}
			else
			{
				$sql_p = "SELECT * FROM product WHERE id={$id}";
				$query_p = mysqli_query($conn, $sql_p);
				if(mysqli_num_rows($query_p) > 0)
				{
					$row_p=mysqli_fetch_array($query_p);
					$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['price']);
					echo "<script>alert('Product has been added to the cart');location.href='index.php';</script>";
				}
				else
				{
					echo "<script>alert('Unable to add product on cart');location.href='index.php';</script>";
				}
			}
		}
		else 
		{
			echo "<script>alert('Unable to add product on cart');location.href='index.php';</script>";
		}
		
	}

    $sql = "select product.id, category.name as cname, product.name, product.price, product.descrption, product.image, product.warranty from product join category on category.id = product.category_id where product.status = true";
    if(isset($_POST['search']))
    {
        $text = $_POST['stext'];
        $sql = "select product.id, category.name as cname, product.name, product.price, product.descrption, product.image, product.warranty from product join category on category.id = product.category_id where product.status = true and product.name LIKE '%".$text."%'";
    }
    $res4 = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res4)>0)
    {
        while($row4 = mysqli_fetch_assoc($res4))
        {?>
            <div class="col-lg-6" style="margin-bottom:50px">
                <div class="card">
                    <div class="left">
                        <img src="<?php echo $row4['image'];?>" alt="shoe" height="280" width="220">
                    </div>
                    <div class="right" >
                        <div class="product-info" >
                            <div class="details" style="margin-right:30px">
                                <h3 class="text-primary" style="margin-top: 36px; font-size: 18px;font-weight: 500;"><?php echo $row4['cname'];?></h3>
                                <h2 style=" color: #ffffff; margin-top: 10px;font-size: 22px;"><?php echo substr($row4['name'],0,50);?></h2>
                                <h5 style=" color: #ffffff;"><?php echo $row4['warranty'];?> Warranty</h5>
                                <span style=" color: #ffffff;font-size: 15px;"><?php echo substr($row4['descrption'],0,210);?></span>
                                <h3 class="text-primary" style="font-size: 21px;">RS. <?php echo $row4['price'];?></h3>
                            </div>
                            <a href = "index.php?add_to_cart&product_id=<?php echo $row4['id'];?>" class="text-danger btn btn-outline-primary"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    else
    {
        echo "<h1>No Product Found..</h1>";
    }
?>

</div>
