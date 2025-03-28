<?php
     require_once '../config/connection.php';

     
    
    // $id =3;
    $id = $_POST['id'];

    $res = mysqli_query($conn, "select id, date, username, contact, email, address from user where id = '$id'");
    if(mysqli_num_rows($res)>0)
    {
        $row = mysqli_fetch_assoc($res);
        $responce['id']=$row['id'];
        $responce['address']=$row['address'];
        $responce['username']=$row['username'];
        $responce['number']=$row['contact'];
        $responce['email']=$row['email'];
        $responce['success']=true;
        $responce['message']="Your data fetched";
    }
    else
    {
        $responce['success']=false;
        $responce['message']="unable to fetch Your data";
    }
     echo json_encode($responce);
?>