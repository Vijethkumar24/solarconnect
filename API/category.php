<?php
require_once '../config/connection.php';
$response=array();

$qry = "select name,id from category where status = 1";
$res = mysqli_query($conn, $qry);
if(mysqli_num_rows($res)>0)
{
    while($rows = mysqli_fetch_assoc($res))
    {
        $send["name"] = $rows['name'];
        $send["catid"] = $rows['id'];

        array_push($response,$send);
    }
}
else
{
    $response=null;
}  
echo (json_encode($response));
?>
