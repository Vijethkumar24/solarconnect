<?php
session_start();
require_once '../config/connection.php'; // Ensure correct database connection


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch values from POST
    $uid = $_SESSION['id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $cvv = $_POST['cvv'];
    $cartJson = $_POST['cart'];

    // Decode cart JSON
    $cart = json_decode($cartJson, true);
    if (!$cart) {
        die(json_encode(['success' => false, 'message' => 'Invalid cart data!']));
    }

    // Calculate total amount
    $amt = 0;
    foreach ($cart as $item) {
        $amt += $item['price'] * $item['quantity'];
    }

    // Generate tracking number
    $trackno = "BBORD" . $uid . "TRC" . date("YmdHis");
    $trstatus = "Paid";
    $trremark = "Order has begun";
    date_default_timezone_set('Asia/Kolkata');
    $dateo = date('Y-m-d H:i:s');

    // Insert into trackorder table
    $stmt = $conn->prepare("INSERT INTO trackorder (userid, trackno, status, remark, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $uid, $trackno, $trstatus, $trremark, $dateo);
    $stmt->execute();
    $track_id = $conn->insert_id; // Get the last inserted ID

    if ($track_id) {
        // Insert into payment table
        $pyno = "PAY987" . $track_id . "MM" . $track_id;
        $stmt = $conn->prepare("INSERT INTO user_payment (payment_no, user_id, amount, payment_status, track_id, date) VALUES (?, ?, ?, 'Success', ?, ?)");
        $stmt->bind_param("siisi", $pyno, $uid, $amt, $track_id, $dateo);
        $stmt->execute();
        $payment_id = $conn->insert_id;

        if ($payment_id) {
            // Insert each cart item into orders table
            $stmt = $conn->prepare("INSERT INTO orders (userid, trackid, productId, quantity, orderStatus, order_remark, orderDate, payment_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            foreach ($cart as $item) {
                $stmt->bind_param("iiissssi", $uid, $track_id, $item['pid'], $item['quantity'], $trstatus, $trremark, $dateo, $payment_id);
                $stmt->execute();
            }

            // Clear cart session
            unset($_SESSION['cart']);

            echo json_encode(['success' => true, 'message' => "Your order has been placed successfully!"]);
            exit();
        }
    }

    // If anything fails
    echo json_encode(['success' => false, 'message' => "Oops, unable to process order!"]);
    exit();
}
?>