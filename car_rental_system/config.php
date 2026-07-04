<?php

$conn = mysqli_connect("localhost","root","","crs");

if(!$conn){
    die("Connection Failed");
}

session_start();

?>