<?php
session_start();
require_once "../config.php";

if($_SESSION["is_admin"] != 1) die("No access");

if(isset($_POST["submit"])){
    $b = $_POST["brand"];
    $m = $_POST["model"];
    $y = $_POST["year"];
    $p = $_POST["price"];

    mysqli_query($conn, "INSERT INTO cars (brand, model, year, price_per_day, status)
    VALUES ('$b','$m','$y','$p','available')");

    header("Location: dashboard.php");
}
?>

<form method="POST">
    Brand: <input name="brand"><br>
    Model: <input name="model"><br>
    Year: <input name="year"><br>
    Price: <input name="price"><br>
    <button name="submit">Add</button>
</form>