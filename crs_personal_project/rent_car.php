<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$car_id = $_POST["car_id"];
$start = $_POST["start_date"];
$end = $_POST["end_date"];

$car = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cars WHERE id=$car_id"));

$days = (strtotime($end) - strtotime($start)) / 86400;
$total = $days * $car["price_per_day"];

mysqli_query($conn, "INSERT INTO rentals (user_id, car_id, start_date, end_date, total_price)
VALUES ($user_id, $car_id, '$start', '$end', $total)");

mysqli_query($conn, "UPDATE cars SET status='rented' WHERE id=$car_id");

header("Location: my_rentals.php");
exit();
?>