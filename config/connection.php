<?php
$host = $_ENV['MYSQLHOST'];
$port = (int) $_ENV['MYSQLPORT'];
$username = $_ENV['MYSQLUSER'];
$password = $_ENV['MYSQLPASSWORD'];
$database = $_ENV['MYSQLDATABASE'];

$conn = mysqli_connect($host, $username, $password, $database, $port);




if (!$conn) {
    die("Unable to connect database : " . mysqli_connect_error());
}
?>