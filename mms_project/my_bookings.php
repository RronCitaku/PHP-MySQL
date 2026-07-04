<?php
session_start();
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/helpers.php";

if (!isset($_SESSION["user_id"])) {
    redirect_to("login.php");
}

$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "User";
$user_id = (int) $_SESSION["user_id"];

if (isset($_POST["booking_action"])) {
    $booking_id = isset($_POST["booking_id"]) ? (int) $_POST["booking_id"] : 0;
    $action = isset($_POST["booking_action"]) ? $_POST["booking_action"] : "";

    if ($booking_id && $action == "cancel") {
        $sql = "UPDATE bookings SET status = 'cancelled' WHERE id = $booking_id AND user_id = $user_id";
        mysqli_query($conn, $sql);
    } elseif ($booking_id && $action == "delete") {
        $sql = "DELETE FROM bookings WHERE id = $booking_id AND user_id = $user_id";
        mysqli_query($conn, $sql);
    }

    redirect_to("my_bookings.php");
}

$movie_names = [];
$movie_result = mysqli_query($conn, "SELECT * FROM movies");

while ($movie = mysqli_fetch_assoc($movie_result)) {
    $movie_id = (int) $movie["id"];
    $movie_names[$movie_id] = $movie["movie_name"];
}

$bookings = [];
$sql = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css
"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-dark bg-dark px-4 border-bottom border-secondary">
    <span class="navbar-brand">MMS</span>
    <div>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
        <a href="movies.php" class="btn btn-outline-light btn-sm me-2">Movies</a>
        <a href="my_bookings.php" class="btn btn-light btn-sm me-2">My Bookings</a>
        <span class="text-light me-3">Welcome, <?php echo safe_text($username); ?>!</span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>My Bookings</h3>
        <a href="movies.php" class="btn btn-primary">Book Another Movie</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Movie</th>
                <th>Tickets</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($bookings) == 0): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">You do not have any bookings yet.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($bookings as $booking): ?>
                <?php
                    $booking_id = (int) $booking["id"];
                    $movie_id = (int) $booking["movie_id"];
                    $movie_name = isset($movie_names[$movie_id]) ? $movie_names[$movie_id] : "Deleted movie";
                    $status = $booking["status"];
                    if ($status == "") {
                        $status = "pending";
                    }
                ?>
                <tr>
                    <td><?php echo safe_text($booking_id); ?></td>
                    <td><?php echo safe_text($movie_name); ?></td>
                    <td><?php echo safe_text($booking["nr_tickets"]); ?></td>
                    <td><?php echo safe_text($booking["date"]); ?></td>
                    <td><?php echo safe_text($booking["time"]); ?></td>
                    <td>
                        <span class="badge <?php echo safe_text(booking_status_badge_class($status)); ?>">
                            <?php echo safe_text(ucfirst($status)); ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <?php if ($status != "cancelled"): ?>
                                <form method="POST">
                                    <input type="hidden" name="booking_id" value="<?php echo safe_text($booking_id); ?>">
                                    <button type="submit"
                                            name="booking_action"
                                            value="cancel"
                                            class="btn btn-warning btn-sm"
                                            onclick="return confirm('Cancel this booking?')">
                                        Cancel
                                    </button>
                                </form>
                            <?php endif; ?>

                            <form method="POST">
                                <input type="hidden" name="booking_id" value="<?php echo safe_text($booking_id); ?>">
                                <button type="submit"
                                        name="booking_action"
                                        value="delete"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this booking?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php render_footer(); ?>

<script src="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js
"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html> 