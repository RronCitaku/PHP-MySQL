<?php
session_start();
require_once "../config.php";

if(!isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1){
    die("Access denied");
}

$id = (int)$_GET["id"];

$result = mysqli_query($conn, "SELECT * FROM cars WHERE id = $id");
$car = mysqli_fetch_assoc($result);

if(!$car){
    die("Car not found.");
}

if(isset($_POST["update"])){
    $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
    $model = mysqli_real_escape_string($conn, $_POST["model"]);
    $year = (int)$_POST["year"];
    $price = (float)$_POST["price"];
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    mysqli_query($conn, "UPDATE cars SET
    brand='$brand',
    model='$model',
    year=$year,
    price_per_day=$price,
    status='$status';
    WHERE id=$id
    ");

    header("Location: dashboard.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit car</title>
</head>
<body>
    <h2>Edit Car</h2>

    <form method="POST">
        Brand:<br>
        <input type="text" name="brand" value="<?= $car["brand"] ?>" required><br><br>
        Model:<br>
        <input type="text" name="model" value="<?= $car["model"] ?>" required><br><br>
        Year:<br>
        <input type="number" name="year" value="<?= $car["year"] ?>" required><br><br>
        Price Per Day:<br>
        <input type="number" step="0.01" name="price" value="<?= $car["price_per_day"] ?>" required><br><br>
        Status:<br>
        <select name="status">
            <option value="available" <?= $car["status"] == "available" ? "selected" : "" ?>>Available</option>
            <option value="rented" <?= $car["status"] == "rented" ? "selected" : "" ?>>Rented</option>
        </select>

        <br><br>

        <button type="submit" name="update">Update Car</button>
    </form>

    <br>

    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>