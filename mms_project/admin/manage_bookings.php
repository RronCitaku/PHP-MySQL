<?php
session_start();
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../helpers.php";

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    redirect_to("../login.php");
}

if (isset($_POST["booking_action"])) {
    $id = isset($_POST["booking_id"]) ? (int) $_POST["booking_id"] : 0;
    $action = isset($_POST["booking_action"]) ? $_POST["booking_action"] : "";

    if ($id && $action == "approve") {
        $sql = "UPDATE bookings SET status = 'approved' WHERE id = $id";
        mysqli_query($conn, $sql);
    } elseif ($id && $action == "cancel") {
        $sql = "UPDATE bookings SET status = 'cancelled' WHERE id = $id";
        mysqli_query($conn, $sql);
    } elseif ($id && $action == "delete") {
        $sql = "DELETE FROM bookings WHERE id = $id";
        mysqli_query($conn, $sql);
    }

    redirect_to("manage_bookings.php");
}

$user_names = [];
$user_result = mysqli_query($conn, "SELECT * FROM users");

while ($user = mysqli_fetch_assoc($user_result)) {
    $user_id = (int) $user["id"];
    $user_names[$user_id] = $user["username"];
}

$movie_names = [];
$movie_result = mysqli_query($conn, "SELECT * FROM movies");

while ($movie = mysqli_fetch_assoc($movie_result)) {
    $movie_id = (int) $movie["id"];
    $movie_names[$movie_id] = $movie["movie_name"];
}

$bookings = [];
$result = mysqli_query($conn, "SELECT * FROM bookings ORDER BY id DESC");

while ($row = mysqli_fetch_assoc($result)) {
    $bookings[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css
"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-dark bg-dark px-4 border-bottom border-secondary">
    <span class="navbar-brand">MMS Admin</span>
    <div>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
        <a href="manage_movies.php" class="btn btn-outline-light btn-sm me-2">Movies</a>
        <a href="manage_users.php" class="btn btn-outline-light btn-sm me-2">Users</a>
        <a href="manage_bookings.php" class="btn btn-light btn-sm me-2">Bookings</a>
        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h3 class="mb-4">Manage Bookings</h3>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
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
                    <td colspan="8" class="text-center text-muted">No bookings found.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($bookings as $booking): ?>
                <?php
                    $booking_id = (int) $booking["id"];
                    $user_id = (int) $booking["user_id"];
                    $movie_id = (int) $booking["movie_id"];
                    $booking_user = isset($user_names[$user_id]) ? $user_names[$user_id] : "Deleted user";
                    $booking_movie = isset($movie_names[$movie_id]) ? $movie_names[$movie_id] : "Deleted movie";
                    $status = $booking["status"];
                    if ($status == "") {
                        $status = "pending";
                    }
                ?>
                <tr>
                    <td><?php echo safe_text($booking_id); ?></td>
                    <td><?php echo safe_text($booking_user); ?></td>
                    <td><?php echo safe_text($booking_movie); ?></td>
                    <td><?php echo safe_text($booking["nr_tickets"]); ?></td>
                    <td><?php echo safe_text($booking["date"]); ?></td>
                    <td><?php echo safe_text($booking["time"]); ?></td>
                    <td>
                        <span class="badge <?php echo safe_text(booking_status_badge_class($status)); ?>">
                            <?php echo safe_text(ucfirst($status)); ?>
                        </span>
                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-2">
                            <?php if ($status != "approved"): ?>
                                <form method="POST">
                                    <input type="hidden" name="booking_id" value="<?php echo safe_text($booking_id); ?>">
                                    <button type="submit" name="booking_action" value="approve" class="btn btn-success btn-sm">
                                        Approve
                                    </button>
                                </form>
                            <?php endif; ?>

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