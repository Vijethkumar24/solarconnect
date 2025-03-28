<?php
require_once '../config/connection.php';

$uid = $_POST['id'];
$desc = $_POST['feedback'];
$product = $_POST['product'];

$prod = "select id from product where name='$product'";
$res = mysqli_query($conn, $prod);
if (mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_assoc($res);
    $id = $row['id'];

    $insert_query = "INSERT INTO feedback (userid,product_id,feedback,date,status) 
     VALUES ('$uid','$id', '$desc', NOW(), 1 )";

    if (mysqli_query($conn, $insert_query)) {

        $response['success'] = true;
        $response['message'] = "Your feedback has been submitted successfully..!";
    } else {
        $response['success'] = false;
        $response['message'] = "Ooops, Unable to send your feedback..!";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Ooops, Unable to send your request..!";
}
echo json_encode($response);
