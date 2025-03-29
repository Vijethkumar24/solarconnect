<?php
$host = "metro.proxy.rlwy.net";  // Railway MySQL Host
$port = "52356";                 // Railway MySQL Port
$username = "root";               // Railway MySQL Username
$password = "SGkaAIcqtrRTCGkuRAZTngQRDhLvAEgK"; // Railway MySQL Password
$database = "railway";
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Unable to connect database : " . mysqli_connect_error());
}
?>