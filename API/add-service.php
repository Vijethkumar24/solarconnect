<?php
require_once '../config/connection.php';

$uid = $_POST['id'];
$desc = $_POST['service'];
$product = $_POST['product'];
$service_no = "SER".rand(100000, 999999);

$prod = "select id from product where name='$product'";
$res = mysqli_query($conn, $prod);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $id = $row['id'];

    $insert_query = "INSERT INTO service(userid, problem, status, product_id, service_no, date)
     VALUES ('$uid', '$desc', 1, '$id','$service_no', NOW())";
     
    if (mysqli_query($conn, $insert_query)) {

        $response['success'] = true;
        $response['message'] = "Your service request has been submitted successfully..!";
    } else {
        $response['success'] = false;
        $response['message'] = "Ooops, Unable to send your request..!";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Ooops, Unable to send your request..!";
}
echo json_encode($response);
