<?php
session_start();
require_once '../config/connection.php';
// Start session
$user = $_POST['username'];
$pass = $_POST['lgpassword'];

// $user="User";
// $pass="user123";

$login = mysqli_query($conn, "SELECT id, type, username, password from user 
    WHERE username='$user' and password='$pass' and status = 1 AND type = 'User'");
if (mysqli_num_rows($login) > 0) {
    $row = mysqli_fetch_assoc($login);
    $response['success'] = true;
    $_SESSION['user_id'] = $row['id'];
    $response['id'] = $row['id'];
    $response['message'] = "You have Logged in Successfully";
} else {
    $response['success'] = false;
    $response['message'] = "Invalid credentials you have entered";
}
echo json_encode($response);
?>