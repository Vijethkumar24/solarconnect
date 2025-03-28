<?php
   require_once '../config/connection.php';

$response=array();
// $id = 3;
$id = $_POST['uid'];
$qry = "select distinct product.id, product.name from product join orders on orders.productId = product.id where orders.userid= ' $id' AND status=true and orders.orderStatus='Paid'";
$res = mysqli_query($conn, $qry);
if(mysqli_num_rows($res)>0)
{
    while($rows = mysqli_fetch_assoc($res))
    {
        $send["product"] = $rows['name'];

        array_push($response,$send);
    }
}
else
{
    $response=null;
}  
echo (json_encode($response));
?>