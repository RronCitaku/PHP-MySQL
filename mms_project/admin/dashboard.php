<?php
session_start();
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../helpers.php";

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    redirect_to("../login.php");
}

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "Admin";

$movies = [];
$result = mysqli_query($conn, "SELECT * FROM movies ORDER BY id");

while ($row = mysqli_fetch_assoc($result)) {
    $movies[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css
"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <style>
        .movie-poster {
            height: 280px;
            object-fit: cover;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-dark bg-dark px-4 border-bottom border-secondary">
    <span class="navbar-brand">MMS</span>
    <div>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
        <a href="manage_movies.php" class="btn btn-outline-light btn-sm me-2">Movies</a>
        <a href="manage_users.php" class="btn btn-outline-light btn-sm me-2">Users</a>
        <a href="manage_bookings.php" class="btn btn-outline-light btn-sm me-2">Bookings</a>
        <span class="text-light me-3">Welcome, <?php echo safe_text($username); ?>!</span>
        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h3>Admin Dashboard</h3>
    <p class="text-muted">You are logged in as an admin.</p>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Manage Movies</h5>
                <a href="manage_movies.php" class="btn btn-primary mt-2">Go</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Manage Users</h5>
                <a href="manage_users.php" class="btn btn-primary mt-2">Go</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center p-3">
                <h5>Manage Bookings</h5>
                <a href="manage_bookings.php" class="btn btn-primary mt-2">Go</a>
            </div>
        </div>

    </div>

    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <h4 class="mb-0">Movies</h4>
        <a href="manage_movies.php" class="btn btn-outline-primary btn-sm">Manage Movies</a>
    </div>

    <div class="row g-4">
        <?php if (count($movies) == 0): ?>
            <div class="col-12">
                <div class="alert alert-info">No movies are available right now.</div>
            </div>
        <?php endif; ?>

        <?php foreach ($movies as $movie): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <img src="<?php echo safe_text(movie_image_url($movie["movie_image"], "../")); ?>"
                         class="card-img-top movie-poster"
                         alt="<?php echo safe_text($movie["movie_name"]); ?> poster">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo safe_text($movie["movie_name"]); ?></h5>
                        <p class="card-text text-muted"><?php echo safe_text($movie["movie_desc"]); ?></p>
                        <p class="mb-1"><strong>Quality:</strong> <?php echo safe_text($movie["movie_quality"]); ?></p>
                        <p class="mb-3"><strong>Rating:</strong> <?php echo safe_text($movie["movie_rating"]); ?></p>
                        <a href="manage_movies.php" class="btn btn-primary mt-auto">Edit Movies</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php render_footer(); ?>

<script src="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js
"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>