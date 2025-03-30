<?php
session_start();
require_once '../config/connection.php';

$response = array();

// Debugging: Log session data
$id = $_POST['uid'];

// Use prepared statements for the main query
$qry = "SELECT trackid, orderDate, orderStatus 
        FROM orders 
        WHERE userid = ? 
        GROUP BY trackid, orderDate, orderStatus 
        ORDER BY MAX(id) DESC";

$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    while ($row2 = $res->fetch_assoc()) {
        $trackid = $row2['trackid'];

        // Use prepared statements for track order query
        $sql3 = "SELECT Trackno FROM trackorder WHERE id = ?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("i", $trackid);
        $stmt3->execute();
        $res3 = $stmt3->get_result();
        $row3 = $res3->fetch_assoc();

        // Use prepared statements for product and order details
        $sqlamt = "SELECT product.price, orders.quantity 
                   FROM product 
                   JOIN orders ON product.id = orders.productId 
                   WHERE orders.trackid = ?";
        $stmtAmt = $conn->prepare($sqlamt);
        $stmtAmt->bind_param("i", $trackid);
        $stmtAmt->execute();
        $resamt = $stmtAmt->get_result();

        $totalprice = 0;
        while ($rowamt = $resamt->fetch_assoc()) {
            $subtotal = $rowamt['quantity'] * $rowamt['price'];
            $totalprice += $subtotal;
        }

        $send["trackid"] = $row2['trackid'];
        $send["number"] = $row3['Trackno'];
        $send["amount"] = number_format((float) ($totalprice ?? 0), 2);
        // Ensure $totalprice is not null
        $send["status"] = $row2['orderStatus'];
        $send["date"] = date_format(date_create($row2['orderDate']), 'd, M Y');

        // Use prepared statements for user details
        $sql = "SELECT first_name, last_name, contact, address, address2, state, city, pincode 
                FROM user 
                WHERE id = ?";
        $stmtUser = $conn->prepare($sql);
        $stmtUser->bind_param("i", $id);
        $stmtUser->execute();
        $resUser = $stmtUser->get_result();
        $row = $resUser->fetch_assoc();

        $send["name"] = $row['first_name'] . " " . $row['last_name'];
        $send["contact"] = $row['contact'];
        $send["address"] = $row['address'] . ", " . $row['address2'] . ", " . $row['state'] . ", " . $row['city'] . " PIN: " . $row['pincode'];

        array_push($response, $send);
    }
} else {
    $response = null;
}

echo json_encode($response);
?>