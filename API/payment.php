<?php
require_once '../config/connection.php';

date_default_timezone_set('Asia/Kolkata');

$name = $_POST['name'];
$number = $_POST['number'];
$month = $_POST['month'];
$year = $_POST['year'];
$cvv = $_POST['cvv'];
$uid = $_POST['uid'];
$cart = $_POST['cart'];

$items = explode('},', $cart);
$data = [];

foreach ($items as $item) {
    $item = str_replace(['{', '}', '[', ']'], '', $item);
    $item = str_replace(' product', 'product', $item);
    $pairs = explode(', ', $item);

    $entry = [];
    foreach ($pairs as $pair) {
        list($key, $value) = explode('=', $pair);
        $entry[trim($key)] = trim($value);
    }
    $data[] = $entry;
}

$amt = 0;
foreach ($data as $item) {
    $amt += (int) $item['price'];
}

$trackno = "BBORD" . $uid . "TRC" . date("YmdHis");
$trstatus = "Paid";
$trremark = "Order has been initiated";

$sql = "INSERT INTO trackorder (userid, trackno, status, remark) VALUES ('$uid', '$trackno', '$trstatus', '$trremark')";

if (mysqli_query($conn, $sql)) {
    $trid = mysqli_insert_id($conn);
    $pyno = "PAY987" . $trid . "MM" . $trid;
    $dateo = date('Y-m-d H:i:s');

    if (mysqli_query($conn, "INSERT INTO user_payment (payment_no, user_id, amount, payment_status, track_id, date) VALUES ('$pyno', '$uid', '$amt', 'Success', '$trid', '$dateo')")) {
        $pyid = mysqli_insert_id($conn);
        foreach ($data as $item) {
            $productId = is_numeric($item['pid']) ? $item['pid'] : getProductID($item['pid'], $conn);
            if (!$productId) {
                $responce['success'] = false;
                $responce['message'] = "Product '{$item['pid']}' not found.";
                echo json_encode($responce);
                exit();
            }

            $sqlOrder = "INSERT INTO orders (userid, trackid, productId, quantity, orderStatus, order_remark, orderDate, payment_id) VALUES ('$uid', '$trid', '$productId', '{$item['quantity']}', '$trstatus', '$trremark', '$dateo', '$pyid')";
            if (!mysqli_query($conn, $sqlOrder)) {
                $responce['success'] = false;
                $responce['message'] = "Error placing order.";
                echo json_encode($responce);
                exit();
            }
        }

        $responce['success'] = true;
        $responce['message'] = "Your order has been placed successfully!";
    } else {
        $responce['success'] = false;
        $responce['message'] = "Payment processing failed.";
    }
} else {
    $responce['success'] = false;
    $responce['message'] = "Tracking order failed.";
}

echo json_encode($responce);

function getProductID($productName, $conn)
{
    $productName = mysqli_real_escape_string($conn, $productName);
    $query = "SELECT id FROM product WHERE name = '$productName' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id'];
    }
    return false;
}
