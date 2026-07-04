<?php
session_start();
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../helpers.php";

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    redirect_to("../login.php");
}

$error = "";
$quality_options = ["SD", "HD", "Full HD", "4K"];

if (isset($_GET["delete"])) {
    $id = (int) $_GET["delete"];

    if ($id) {
        $sql = "DELETE FROM movies WHERE id = $id";
        mysqli_query($conn, $sql);
    }

    redirect_to("manage_movies.php");
}

if (isset($_POST["add_movie"]) || isset($_POST["update_movie"])) {
    $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
    $movie_name = isset($_POST["movie_name"]) ? trim($_POST["movie_name"]) : "";
    $movie_desc = isset($_POST["movie_desc"]) ? trim($_POST["movie_desc"]) : "";
    $movie_quality = isset($_POST["movie_quality"]) ? trim($_POST["movie_quality"]) : "";
    $movie_rating = isset($_POST["movie_rating"]) ? trim($_POST["movie_rating"]) : "";
    $movie_image = isset($_POST["movie_image"]) ? trim($_POST["movie_image"]) : "";

    if ($movie_name == "" || $movie_desc == "" || $movie_quality == "" || $movie_rating == "" || $movie_image == "") {
        $error = "Please fill in all movie fields.";
    } elseif (!in_array($movie_quality, $quality_options, true)) {
        $error = "Please choose a valid movie quality.";
    } elseif (!is_numeric($movie_rating) || (float) $movie_rating < 1 || (float) $movie_rating > 10) {
        $error = "Movie rating must be between 1 and 10.";
    } elseif (isset($_POST["update_movie"]) && $id <= 0) {
        $error = "Invalid movie selected.";
    } elseif (isset($_POST["add_movie"])) {
        $movie_name_sql = mysqli_real_escape_string($conn, $movie_name);
        $movie_desc_sql = mysqli_real_escape_string($conn, $movie_desc);
        $movie_quality_sql = mysqli_real_escape_string($conn, $movie_quality);
        $movie_rating_sql = mysqli_real_escape_string($conn, $movie_rating);
        $movie_image_sql = mysqli_real_escape_string($conn, $movie_image);

        $sql = "INSERT INTO movies (movie_name, movie_desc, movie_quality, movie_rating, movie_image)
                VALUES ('$movie_name_sql', '$movie_desc_sql', '$movie_quality_sql', '$movie_rating_sql', '$movie_image_sql')";
        mysqli_query($conn, $sql);

        redirect_to("manage_movies.php");
    } else {
        $movie_name_sql = mysqli_real_escape_string($conn, $movie_name);
        $movie_desc_sql = mysqli_real_escape_string($conn, $movie_desc);
        $movie_quality_sql = mysqli_real_escape_string($conn, $movie_quality);
        $movie_rating_sql = mysqli_real_escape_string($conn, $movie_rating);
        $movie_image_sql = mysqli_real_escape_string($conn, $movie_image);

        $sql = "UPDATE movies SET
                    movie_name = '$movie_name_sql',
                    movie_desc = '$movie_desc_sql',
                    movie_quality = '$movie_quality_sql',
                    movie_rating = '$movie_rating_sql',
                    movie_image = '$movie_image_sql'
                WHERE id = $id";
        mysqli_query($conn, $sql);

        redirect_to("manage_movies.php");
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
    <title>Manage Movies</title>
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
        <a href="manage_movies.php" class="btn btn-light btn-sm me-2">Movies</a>
        <a href="manage_users.php" class="btn btn-outline-light btn-sm me-2">Users</a>
        <a href="manage_bookings.php" class="btn btn-outline-light btn-sm me-2">Bookings</a>
        <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manage Movies</h3>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            + Add Movie
        </button>
    </div>

    <?php if ($error != ""): ?>
        <div class="alert alert-danger"><?php echo safe_text($error); ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quality</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($movies) == 0): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">No movies found.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($movies as $movie): ?>
                <?php $movie_id = (int) $movie["id"]; ?>
                <tr>
                    <td><?php echo safe_text($movie_id); ?></td>
                    <td><?php echo safe_text($movie["movie_name"]); ?></td>
                    <td><?php echo safe_text($movie["movie_desc"]); ?></td>
                    <td><?php echo safe_text($movie["movie_quality"]); ?></td>
                    <td><?php echo safe_text($movie["movie_rating"]); ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo safe_text($movie_id); ?>">
                            Edit
                        </button>
                        <a href="manage_movies.php?delete=<?php echo safe_text($movie_id); ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php foreach ($movies as $movie): ?>
    <?php $movie_id = (int) $movie["id"]; ?>
    <div class="modal fade" id="editModal<?php echo safe_text($movie_id); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Movie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo safe_text($movie_id); ?>">

                        <div class="mb-3">
                            <label>Movie Name</label>
                            <input type="text"
                                   class="form-control"
                                   name="movie_name"
                                   value="<?php echo safe_text($movie["movie_name"]); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="form-control"
                                      name="movie_desc"
                                      rows="3"
                                      required><?php echo safe_text($movie["movie_desc"]); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Quality</label>
                            <select class="form-control" name="movie_quality">
                                <?php foreach ($quality_options as $quality): ?>
                                    <option value="<?php echo safe_text($quality); ?>" <?php echo ($movie["movie_quality"] == $quality) ? "selected" : ""; ?>>
                                        <?php echo safe_text($quality); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Rating</label>
                            <input type="number"
                                   class="form-control"
                                   name="movie_rating"
                                   value="<?php echo safe_text($movie["movie_rating"]); ?>"
                                   min="1" max="10" step="0.1"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Image Filename</label>
                            <input type="text"
                                   class="form-control"
                                   name="movie_image"
                                   value="<?php echo safe_text($movie["movie_image"]); ?>"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_movie" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Movie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <div class="modal-body">

                    <div class="mb-3">
                        <label>Movie Name</label>
                        <input type="text" class="form-control" name="movie_name" required>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea class="form-control" name="movie_desc" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Quality</label>
                        <select class="form-control" name="movie_quality">
                            <?php foreach ($quality_options as $quality): ?>
                                <option value="<?php echo safe_text($quality); ?>"><?php echo safe_text($quality); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Rating</label>
                        <input type="number" class="form-control" name="movie_rating" min="1" max="10" step="0.1" required>
                    </div>

                    <div class="mb-3">
                        <label>Image Filename</label>
                        <input type="text" class="form-control" name="movie_image" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_movie" class="btn btn-success">Add Movie</button>
                </div>
            </form>
        </div>
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