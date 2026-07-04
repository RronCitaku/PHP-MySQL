<?php include "includes/header.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$cars = mysqli_query($conn, "SELECT * FROM cars");
?>

<h2 class="mb-4">Available Cars</h2>

<?php if($_SESSION['is_admin'] == 1){ ?>
    <a class="btn btn-success mb-3" href="add_car.php">+ Add Car</a>
<?php } ?>

<div class="row">

<?php while($car = mysqli_fetch_assoc($cars)) { ?>

<div class="col-md-4 mb-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">
                <?= $car['brand'] ?> <?= $car['model'] ?>
            </h5>

            <p class="text-muted">
                Year: <?= $car['year'] ?>
            </p>

            <p>
                <b>Price:</b> <?= $car['price'] ?> € / day
            </p>

            <p>
                <span class="badge bg-<?= $car['status']=="Available" ? "success" : "danger" ?>">
                    <?= $car['status'] ?>
                </span>
            </p>

            <?php if($car['status'] == "Available") { ?>
                <a href="rent.php?car_id=<?= $car['id'] ?>" class="btn btn-primary btn-sm">
                    Rent
                </a>
            <?php } ?>

            <?php if($_SESSION['is_admin'] == 1){ ?>
                <a href="edit_car.php?id=<?= $car['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_car.php?id=<?= $car['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>

</div>

<?php include "includes/footer.php"; ?>