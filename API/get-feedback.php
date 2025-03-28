<?php
   require_once '../config/connection.php';

$response=array();
// $id = 3;
$id = $_POST['uid'];
$qry = "select product.name as pname, feedback.id, user.first_name, user.last_name, user.username, user.contact, feedback.feedback, feedback.date, feedback.status from feedback join user on feedback.userid=user.id join product on product.id = feedback.product_id where feedback.userid = '$id' order by feedback.id desc";
$res = mysqli_query($conn, $qry);
if(mysqli_num_rows($res)>0)
{
    while($rows = mysqli_fetch_assoc($res))
    {
        $send["name"] = $rows['first_name']." ".$rows['last_name'];
        $send["product"] = $rows['pname'];
        $send["contact"] = $rows['contact'];
        $send["feedback"] = $rows['feedback'];
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