<?php
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$car_id = $_GET['car_id'];

$check = mysqli_query($conn, "SELECT * FROM cars WHERE id='$car_id'");
$car = mysqli_fetch_assoc($check);

if(!$car){
    die("Car not found");
}

if($car['status'] != "Available"){
    die("Car is already rented");
}

mysqli_query($conn, "UPDATE cars SET status='Rented' WHERE id='$car_id'");

mysqli_query($conn, "INSERT INTO rentals(user_id, car_id, rent_date)
VALUES('$user_id', '$car_id', CURDATE())");

header("Location: dashboard.php");
exit();
?>