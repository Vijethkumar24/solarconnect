<?php
$host = "mysql.railway.internal";  // Railway MySQL Host
$port = 3306;                 // Railway MySQL Port
$username = "root";               // Railway MySQL Username
$password = "SGkaAIcqtrRTCGkuRAZTngQRDhLvAEgK"; // Railway MySQL Password
$database = "railway";
$conn = mysqli_connect($host, $username, $password, $database, $port);
if (!$conn) {
    die("Unable to connect database : " . mysqli_connect_error());
}
?>