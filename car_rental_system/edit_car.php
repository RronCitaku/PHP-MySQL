<?php
include "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1){
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM cars WHERE id='$id'");
$car = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE cars SET 
        brand='$brand',
        model='$model',
        year='$year',
        price='$price',
        status='$status'
        WHERE id='$id'
    ");

    header("Location: dashboard.php");
    exit();
}
?>

<h2>Edit Car</h2>

<form method="POST">
    <input type="text" name="brand" value="<?= $car['brand'] ?>" required><br>
    <input type="text" name="model" value="<?= $car['model'] ?>" required><br>
    <input type="number" name="year" value="<?= $car['year'] ?>" required><br>
    <input type="number" step="0.01" name="price" value="<?= $car['price'] ?>" required><br>

    <select name="status">
        <option value="Available" <?= $car['status']=="Available" ? "selected" : "" ?>>Available</option>
        <option value="Rented" <?= $car['status']=="Rented" ? "selected" : "" ?>>Rented</option>
    </select><br><br>

    <button type="submit" name="update">Update</button>
</form>

<br>
<a href="dashboard.php">Back</a>