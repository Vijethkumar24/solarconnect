<?php
require_once '../config/connection.php';

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['emailaddress'];
$user = $_POST['username'];
$pass = $_POST['regpassword'];
$add = $_POST['address'];
$cont = $_POST['contact'];
$pin = $_POST['pincode'];
$city = $_POST['city'];

// $fname="manisha";
// $lname="salian";
// $email="mani123@gmail.com";
// $user="manisha";
// $pass="123456789";
// $confi="123456789";
// $add="mangalore";
// $cont=9874563210;
// $pin=575019;
// $city="surathkal";



$defaultImage = "default_image.jpg"; // Set a default image path
$designation = "User";
$add2 = "India";
$sql = "INSERT INTO user (first_name, last_name, email, username, password, image, address, contact,designation,address2, date, pincode, city, status, type)
        VALUES ('$fname', '$lname', '$email', '$user', '$pass','$defaultImage', '$add', '$cont','$designation', '$add2', NOW(), '$pin', '$city', 1, 'User')";

if (mysqli_query($conn, $sql)) {
    $response['success'] = true;
    $response['message'] = "User registered successfully";
    ;
} else {
    $response['success'] = false;
    $response['message'] = "Unable to register user";
}



echo json_encode($response);




