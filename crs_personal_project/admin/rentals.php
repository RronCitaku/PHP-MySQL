<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    die("Access denied");
}

$sql = "SELECT rentals.*, users.name, cars.brand, cars.model
        FROM rentals
        JOIN users ON rentals.user_id = users.id
        JOIN cars ON rentals.car_id = cars.id
        ORDER BY rentals.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Rentals</title>
</head>
<body>

<h2>All Rentals</h2>

<a href="dashboard.php">Back to Dashboard</a>

<hr>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Customer</th>
    <th>Car</th>
    <th>Start</th>
    <th>End</th>
    <th>Total</th>
    <th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>

<tr>

<td><?= $row["id"] ?></td>

<td><?= $row["name"] ?></td>

<td><?= $row["brand"] ?> <?= $row["model"] ?></td>

<td><?= $row["start_date"] ?></td>

<td><?= $row["end_date"] ?></td>

<td>$<?= $row["total_price"] ?></td>

<td><?= $row["status"] ?></td>

</tr>

<?php endwhile; ?>

</table>

</body>
</html>