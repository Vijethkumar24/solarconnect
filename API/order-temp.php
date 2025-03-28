<?php
   require_once '../config/connection.php';

$response=array();
// $trackid = "1";
$trackid = $_POST['trackid'];

$qry = "select product.id, product.name, product.price ,orders.quantity 
from orders join product on product.id = orders.productId where orders.trackid='$trackid'";
    
$res = mysqli_query($conn, $qry);
if(mysqli_num_rows($res)>0)
{
    while($row3 = mysqli_fetch_assoc($res))
    {

        $send["name"] = $row3['name'];
        $send["quantity"] = $row3['quantity'];
        $send["price"] = $row3['price'];
        $send["total"] = $row3['price']*$row3['quantity'];

        array_push($response,$send);
    }
}
else
{
    $response=null;
}  
echo (json_encode($response));
?>