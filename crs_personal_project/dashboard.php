<?php
session_start();
require_once "config.php";
require_once "helpers.php";

if(!isset($_SESSION["user_Id"])){
    redirect_to("login.php");
}

$cars = mysqli_query($conn, "SELECT * FROM cars WHERE status='available'");
?>
<h2>Available Cars</h2>
<a href="my_rentals.php">My Rentals</a>
<a href="logout.php">Logout</a>
<hr>

<?php
while($car = mysqli_fetch_assoc($cars));
?>

<div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
    <b><?php $car["brand"] ?>
       <?php $car["model"] ?></b><br>
       Year: <?php $car["year"] ?><br>
       Price per day: <?php $car["price_per_day"] ?><br>

       <form method="POST" action="rent_car.php">
            <input type="hidden" name="car_id" value="<?= $car["id"] ?>">
            Start: <input type="date" name="start_date" required>
            End: <input type="date" name="end_date" required>
            <button type="submit">Rent</button>
        </form>
</div>
<?php endwhile; ?>