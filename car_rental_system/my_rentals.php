<?php
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
SELECT rentals.*, cars.brand, cars.model, cars.year, cars.price
FROM rentals
JOIN cars ON rentals.car_id = cars.id
WHERE rentals.user_id = '$user_id'
");
?>

<h2>My Rentals</h2>

<a href="dashboard.php">Back</a> | <a href="logout.php">Logout</a>

<hr>

<table border="1" cellpadding="10">
    <tr>
        <th>Car</th>
        <th>Year</th>
        <th>Price</th>
        <th>Rent Date</th>
    </tr>

<?php while($row = mysqli_fetch_assoc($query)) { ?>

<tr>
    <td><?= $row['brand'] ?> <?= $row['model'] ?></td>
    <td><?= $row['year'] ?></td>
    <td><?= $row['price'] ?> €</td>
    <td><?= $row['rent_date'] ?></td>
</tr>

<?php } ?>

</table>