<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "crs";

$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?> 
