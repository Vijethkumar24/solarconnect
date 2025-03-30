<?php
session_start();
require_once '../config/connection.php';

var_dump($_SESSION);
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$id = $_SESSION['user_id'];
$response = array();


$qry = "SELECT trackid, orderDate, orderStatus 
        FROM orders 
        WHERE userid = '$id' 
        GROUP BY trackid, orderDate, orderStatus 
        ORDER BY MAX(id) DESC";


$res = mysqli_query($conn, $qry);
if (mysqli_num_rows($res) > 0) {
    while ($row2 = mysqli_fetch_assoc($res)) {

        $trackid = $row2['trackid'];
        $sql3 = "select Trackno from trackorder where id = '$trackid'";
        $res3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($res3);

        $sqlamt = "SELECT product.price,  orders.quantity FROM product join orders on product.id=orders.productId where orders.trackid='$trackid'";
        $resamt = mysqli_query($conn, $sqlamt);
        $totalprice = 0;
        while ($rowamt = mysqli_fetch_assoc($resamt)) {

            $subtotal = $rowamt['quantity'] * $rowamt['price'];
            $totalprice += $subtotal;
        }

        $send["trackid"] = $row2['trackid'];
        $send["number"] = $row3['Trackno'];
        $send["amount"] = number_format($totalprice, 2);
        $send["status"] = $row2['orderStatus'];
        $send["date"] = date_format(date_create($row2['orderDate']), 'd, M Y');

        $sql = "select first_name,last_name, contact, address, address2, state, city, pincode from user where id = '" . $id . "'";
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $send["name"] = $row['first_name'] . " " . $row['last_name'];
        $send["contact"] = $row['contact'];
        $send["address"] = $row['address'] . ", " . $row['address2'] . ", " . $row['state'] . ", " . $row['city'] . " PIN: " . $row['pincode'];


        array_push($response, $send);
    }
} else {
    $response = null;
}
echo (json_encode($response));