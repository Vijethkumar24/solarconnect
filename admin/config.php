<?php

    $conn = mysqli_connect("localhost", "root", "", "solar_edge");
    if(!$conn)
    {
        die ("Unable to connect database : ".mysqli_connect_error());
    }
?>