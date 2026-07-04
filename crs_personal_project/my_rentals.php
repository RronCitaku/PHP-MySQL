<?php
session_start();
require_once "config.php";

$user_id = $_SESSION["user_id"];

$sql = "SELECT rentals.*, cars.brand, cars.model
        FROM rentals
        JOIN cars ON rentals.car_id = cars.id
        WHERE rentals.user_id = $user_id";

$result = mysqli_query($conn, $sql);
?>

<h2>My Rentals</h2>
<a href="dashboard.php">Back</a>

<hr>
<?php while ($r = mysqli_fetch_assoc($result)); ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                <b><?= $r["brand"] ?>  <?= $r["model"] ?></b><br>
                From: <?= $r["start_date"] ?> To: <?= $r["end_date"] ?><br>
                Total: $<?= $r[total_price] ?><br>
                Status: <?= $r["status"] ?>
        </div>
<?php endwhile; ?>