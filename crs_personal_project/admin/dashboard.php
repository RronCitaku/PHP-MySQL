<?php 
session_start();
require_once "../config.php";

if($_SESSION['is_admin'] != 1){
    die("Access denied");
}

$cars = mysqli_query($conn, "SELECT * FROM cars");
?>

<h2>Admin Dashboard</h2>
<a href="add_car.php">Add Car</a> |
<a href="rentals.php">View Rentals</a> |
<a href="../logout.php">Logout</a>

<hr>

<?php while($car = mysqli_fetch_assoc($cars)); ?>
    <div>
        <?= $car["brand"] ?> <?= $car["model"] ?>
        <a href="edit_car.php?id=<?= $car["id"] ?>">Edit</a>
        <a href="delete_car.php?id=<? $car["id"] ?>">Delete</a>
    </div>
<?php endwhile; ?>