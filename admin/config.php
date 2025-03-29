<?php
$host = $_ENV['MYSQLHOST'] ?? 'localhost';
$port = (int) ($_ENV['MYSQLPORT'] ?? 3306);
$username = $_ENV['MYSQLUSER'] ?? 'root';
$password = $_ENV['MYSQLPASSWORD'] ?? '';
$database = $_ENV['MYSQLDATABASE'] ?? 'test_db';


$conn = mysqli_connect($host, $username, $password, $database, $port);
if (!$conn) {
    die("Unable to connect database : " . mysqli_connect_error());
}
?>