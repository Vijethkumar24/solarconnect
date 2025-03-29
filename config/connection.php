<?php
var_dump(getenv('MYSQLHOST'));
var_dump(getenv('PORT'));
var_dump(getenv('MYSQLUSER'));
var_dump(getenv('MYSQLPASSWORD'));
var_dump(getenv('MYSQLDATABASE'));

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