<?php

$host = getenv('DB_HOST');
$port = (int) getenv('DB_PORT');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

$conn = mysqli_connect($host, $username, $password, $database, $port);




if (!$conn) {
    die("Unable to connect database : " . mysqli_connect_error());
}
?>