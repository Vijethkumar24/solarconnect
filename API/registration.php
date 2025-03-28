<?php
require_once '../config/connection.php';

$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$email=$_POST['emailaddress'];
$user=$_POST['username'];
$pass=$_POST['regpassword'];
$add=$_POST['address'];
$cont=$_POST['contact'];
$pin=$_POST['pincode'];
$city=$_POST['city'];

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


    if(mysqli_query($conn, "INSERT INTO user (first_name,last_name,email,username,password,address,contact,date,pincode,city,status,type) VALUES('$fname','$lname','$email','$user','$pass','$add','$cont',NOW(),'$pin','$city',1,'User')")){

        $response['success']=true;
        $response['message']="User registered successfully";
    } else{
        $response['success']=false;
        $response['message']="Unable to register user";
    }
echo json_encode($response);




