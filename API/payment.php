<?php
require_once '../config/connection.php';

//   $uid = 3;
//   $name = 3;
//   $number = 3;
//   $year = 3;
//   $cvv = 3;
//   $month = 3;
// $cart = "[{image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=7}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=8}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=9}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=10}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=11}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=12}, {image=product/2.png, product=ETC Solar Water Heater, quantity=1, price=13760, pid=ETC Solar Water Heater, id=13}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=14}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=ZunSolar 150Ah 12 Battery, id=15}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=16}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=17}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=18}, {image=product/batter6.png, product=ZunSolar 150Ah 12 Battery, quantity=1, price=2985, pid=1, id=19}]";
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

    $item = str_replace(['{', '}'], '', $item);
    $item = str_replace(' product', 'product', $item);
    $item = str_replace('[', '', $item);
    $item = str_replace(']', '', $item);

    $pairs = explode(', ', $item);

    $entry = [];
    foreach ($pairs as $pair) {
        list($key, $value) = explode('=', $pair);
        $entry[$key] = $value;
    }

    $data[] = $entry;
}

// print_r($data);

$amt = 0;
foreach ($data as $item) {
    $amt += $item['price'];
}

// echo $amt;

$trackno = "BBORD" . $uid . "TRC" . date("YmdHis");

$trstatus = "Paid";
$trremark = "Order has been begin";
$trid = 0;
date_default_timezone_set('Asia/Kolkata');
$dateo = date('Y-m-d h:i:s a');

$sql = "INSERT INTO trackorder (userid, trackno, status, remark, date) 
        VALUES ('$uid', '$trackno', '$trstatus', '$trremark', '$dateo')";

if (mysqli_query($conn, $sql)) {

    $sql1 = "SELECT id FROM trackorder WHERE trackno = '$trackno' ";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {

        $trid = 0;
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $trid = $row1["id"];
        }



        $pyno = "PAY987" . $trid . "MM" . $trid;
        $sql2 = "INSERT INTO user_payment(payment_no, user_id, amount, payment_status, track_id, date) 
        VALUES ('$pyno', '$uid', '$amt', 'Success', '$trid', '$dateo')";
        if (
            mysqli_query($conn, $sql2)
        ) {

            $pyid = mysqli_insert_id($conn);

            foreach ($data as $item) {
                $sql3 = "INSERT INTO orders (userid, trackid, productId, quantity, orderStatus, 
                            order_remark, orderDate, payment_id) 
        VALUES ('$uid', '$trid', '{$item['pid']}', '{$item['quantity']}', '$trstatus', 
                '$trremark', '$dateo', '$pyid')";

                if (
                    mysqli_query($conn, $sql3)
                ) {

                    $responce['success'] = true;
                    $responce['message'] = "Your order placed successfully..!";

                } else {
                    $responce['success'] = false;
                    $responce['message'] = "Oops, Unable to process..!";
                }
            }
        } else {

            $responce['success'] = false;
            $responce['message'] = "Oops, Unable to process..!";
        }

    } else {

        $responce['success'] = false;
        $responce['message'] = "Oops, Unable to process..!";
    }
} else {

    $responce['success'] = false;
    $responce['message'] = "Oops, Unable to process..!";
}






echo json_encode($responce);