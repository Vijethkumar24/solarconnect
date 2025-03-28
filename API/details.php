<?php

require_once '../config/connection.php';
// $cat = 3;
$cat = $_POST['catid'];

$response=array();

$qry = "select product.warranty, product.category_id, category.name as cname, product.name, product.id as pid, 
    product.descrption, product.price, product.image from product 
    join category on product.category_id = category.id where 
    product.category_id = '$cat' and product.status = 1 order 
    by product.category_id DESC";

$res = mysqli_query($conn, $qry);
if(mysqli_num_rows($res)>0)
{
    while($rows = mysqli_fetch_assoc($res))
    {
        $send["category_id"] = $rows['category_id'];
        $send["category_name"] = $rows['cname'];
        $send["description"] = $rows['descrption'];
        $send["name"] = $rows['name'];
        $send["productid"] = $rows['pid'];
        $send["price"] = $rows['price'];
        $send["image"] = $rows['image'];
        $send["warranty"] = $rows['warranty'];

        array_push($response,$send);
    }
}
else
{
    $response=null;
}  
echo (json_encode($response));
?>