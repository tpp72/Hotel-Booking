<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'hotel_booking';

    $conn = new mysqli($hostname, $username, $password, $database);
    if ($conn->connect_error) {
        trigger_error($conn->connect_error, E_USER_ERROR);
    }

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if (!$conn) {
        die("Error : " . mysqli_connect_error());
    }

    mysqli_query($conn, "SET NAMES 'utf8' ");
?>