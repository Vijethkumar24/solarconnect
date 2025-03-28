<?php
   require_once '../config/connection.php';

$response=array();
// $id = 3;
$id = $_POST['uid'];
$qry = "select product.name as pname, service.id, service.amount, service.service_no,
 user.first_name, user.last_name, user.username, user.contact, service.problem, service.date, 
 service.status from service join user on service.userid=user.id join product on 
 product.id = service.product_id WHERE user.id =' $id' order by service.id desc";
$res = mysqli_query($conn, $qry);
if(mysqli_num_rows($res)>0)
{
    while($rows = mysqli_fetch_assoc($res))
    {
        $send["name"] = $rows['first_name']." ".$rows['last_name'];
        $send["product"] = $rows['pname'];
        $send["number"] = $rows['service_no'];
        $send["problem"] = $rows['problem'];
        $send["amount"] = number_format($rows['amount'], 00);
        if($rows['status']){$send["status"] = 'Active';}else{$send["status"] = 'In-Active';}
        $send["date"] = date_format(date_create($rows['date']), 'd, M Y');

        array_push($response,$send);
    }
}
else
{
    $response=null;
}  
echo (json_encode($response));
?>