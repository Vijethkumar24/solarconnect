<?php
$host = getenv('MYSQLHOST');
$port = (int) getenv('MYSQLPORT');
$username = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$database = getenv('MYSQLDATABASE');
$conn = mysqli_connect($host, $username, $password, $database, $port);
if (!$conn) {
    die("Unable to connect database : " . mysqli_connect_error());
}
?>