<?php
      require_once '../config/connection.php';
      
    //   $uid = 3;
    //   $add1 = 3;
    //   $add2 = 3;
    //   $city = 3;
    //   $state = 3;
    //   $pin = 3;

    $add1 = $_POST['add1'];
    $add2 = $_POST['add2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pin = $_POST['pin'];
    $uid = $_POST['uid'];

    if(mysqli_query($conn, "update user set address = '$add1', address2 = '$add2' ,
        state = '$state', city = '$city', pincode = '$pin' where id = '$uid'"))
    {
        $responce['success']=true;
        $responce['message']="Your address updated successfully..!"; 
    }
    else
    {
        $responce['success']=false;
        $responce['message']="Oops, Unable to update your address..!"; 
    }

    echo json_encode($responce);
