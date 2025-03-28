<?php
   require_once '../config/connection.php';

$response=array();

$qry = "select product.*, category.name as cname from product join category on category.id = product.category_id where product.status = true";
$res = mysqli_query($conn, $qry);
if(mysqli_num_rows($res)>0)
{
    while($rows = mysqli_fetch_assoc($res))
    {
        $send["id"] = $rows['id'];
        $send["product"] = $rows['name'];
        $send["category"] = $rows['cname'];
        $send["image"] = $rows['image'];
        $send["descrption"] = $rows['descrption'];
        $send["warranty"] = $rows['warranty'];
        $send["price"] = $rows['price'];
        
        array_push($response,$send);
    }
}
else
{
    $response=null;
}  
echo (json_encode($response));
