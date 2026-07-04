<?php include "config.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg px-3">
    <a class="navbar-brand" href="dashboard.php">CRS</a>

    <div class="ms-auto">
        <?php if(isset($_SESSION['user_id'])) { ?>
            <a class="btn btn-light btn-sm" href="my_rentals.php">My Rentals</a>
            <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
        <?php } ?>
    </div>
</nav>

<div class="container mt-4">