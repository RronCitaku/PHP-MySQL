<?php
include "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1){
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['add'])){
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];

    mysqli_query($conn, "INSERT INTO cars(brand, model, year, price, status)
    VALUES('$brand','$model','$year','$price','Available')");

    header("Location: dashboard.php");
    exit();
}
?>

<h2>Add Car</h2>

<form method="POST">
    <input type="text" name="brand" placeholder="Brand" required><br>
    <input type="text" name="model" placeholder="Model" required><br>
    <input type="number" name="year" placeholder="Year" required><br>
    <input type="number" step="0.01" name="price" placeholder="Price per day" required><br>
    <button type="submit" name="add">Add Car</button>
</form>

<br>
<a href="dashboard.php">Back</a>