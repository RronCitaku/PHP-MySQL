<?php
session_start();
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/helpers.php";

if (!isset($_SESSION["user_id"])) {
    redirect_to("login.php");
}

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "User";
$error = "";

if (isset($_POST["book_movie"])) {
    $user_id = (int) $_SESSION["user_id"];
    $movie_id = isset($_POST["movie_id"]) ? (int) $_POST["movie_id"] : 0;
    $nr_tickets = isset($_POST["nr_tickets"]) ? (int) $_POST["nr_tickets"] : 0;
    $date = isset($_POST["date"]) ? trim($_POST["date"]) : "";
    $time = isset($_POST["time"]) ? trim($_POST["time"]) : "";

    if (!$movie_id || !$nr_tickets || $nr_tickets < 1 || $nr_tickets > 10 || $date == "" || $time == "") {
        $error = "Please choose a movie, date, time, and 1 to 10 tickets.";
    } else {
        $date_sql = mysqli_real_escape_string($conn, $date);
        $time_sql = mysqli_real_escape_string($conn, $time);

        $sql = "SELECT * FROM movies WHERE id = $movie_id";
        $movie_result = mysqli_query($conn, $sql);

        if (!mysqli_fetch_assoc($movie_result)) {
            $error = "Selected movie was not found.";
        } else {
            $sql = "INSERT INTO bookings (user_id, movie_id, nr_tickets, date, time, status)
                    VALUES ($user_id, $movie_id, $nr_tickets, '$date_sql', '$time_sql', 'pending')";
            mysqli_query($conn, $sql);

            redirect_to("my_bookings.php");
        }
    }
}

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
    <title>Movies</title>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css
"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <style>
        .movie-poster {
            height: 320px;
            object-fit: cover;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-dark bg-dark px-4 border-bottom border-secondary">
    <span class="navbar-brand">MMS</span>
    <div>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
        <a href="movies.php" class="btn btn-light btn-sm me-2">Movies</a>
        <a href="my_bookings.php" class="btn btn-outline-light btn-sm me-2">My Bookings</a>
        <span class="text-light me-3">Welcome, <?php echo safe_text($username); ?>!</span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h3 class="mb-4">Movies</h3>

    <?php if ($error != ""): ?>
        <div class="alert alert-danger"><?php echo safe_text($error); ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (count($movies) == 0): ?>
            <div class="col-12">
                <div class="alert alert-info">No movies are available right now.</div>
            </div>
        <?php endif; ?>

        <?php foreach ($movies as $movie): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <img src="<?php echo safe_text(movie_image_url($movie["movie_image"])); ?>"
                         class="card-img-top movie-poster"
                         alt="<?php echo safe_text($movie["movie_name"]); ?> poster">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo safe_text($movie["movie_name"]); ?></h5>
                        <p class="card-text text-muted"><?php echo safe_text($movie["movie_desc"]); ?></p>
                        <p class="mb-1"><strong>Quality:</strong> <?php echo safe_text($movie["movie_quality"]); ?></p>
                        <p class="mb-3"><strong>Rating:</strong> <?php echo safe_text($movie["movie_rating"]); ?></p>

                        <form method="POST">
                            <input type="hidden" name="movie_id" value="<?php echo safe_text($movie["id"]); ?>">

                            <div class="mb-2">
                                <label class="form-label">Tickets</label>
                                <input type="number" class="form-control" name="nr_tickets" min="1" max="10" value="1" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" name="time" required>
                            </div>

                            <button type="submit" name="book_movie" class="btn btn-primary w-100">Book Movie</button>
                        </form>
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