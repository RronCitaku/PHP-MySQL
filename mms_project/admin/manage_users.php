<?php
session_start();
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../helpers.php";

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["is_admin"]) || $_SESSION["is_admin"] != 1) {
    redirect_to("../login.php");
}

$error = "";

if (isset($_GET["delete"])) {
    $id = (int) $_GET["delete"];

    if ($id) {
        $sql = "DELETE FROM users WHERE id = $id";
        mysqli_query($conn, $sql);
    }

    redirect_to("manage_users.php");
}

if (isset($_POST["update_user"])) {
    $id = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $is_admin = isset($_POST["is_admin"]) ? (int) $_POST["is_admin"] : 0;

    if ($is_admin != 1) {
        $is_admin = 0;
    }

    if (!$id || $name == "" || $username == "" || $email == "") {
        $error = "Please fill in all user fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        $name_sql = mysqli_real_escape_string($conn, $name);
        $username_sql = mysqli_real_escape_string($conn, $username);
        $email_sql = mysqli_real_escape_string($conn, $email);

        $sql = "UPDATE users SET
                    name = '$name_sql',
                    username = '$username_sql',
                    email = '$email_sql',
                    is_admin = $is_admin
                WHERE id = $id";
        mysqli_query($conn, $sql);

        redirect_to("manage_users.php");
    }
}

$users = [];
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id");

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css
"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-dark bg-dark px-4 border-bottom border-secondary">
    <span class="navbar-brand">Movie Management System</span>
    <div>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
        <a href="manage_movies.php" class="btn btn-outline-light btn-sm me-2">Movies</a>
        <a href="manage_users.php" class="btn btn-light btn-sm me-2">Users</a>
        <a href="manage_bookings.php" class="btn btn-outline-light btn-sm me-2">Bookings</a>
        <a href="../logout.php" class="btn btn-outline-light btn-sm me-2">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h3 class="mb-4">Manage Users</h3>

    <?php if ($error != ""): ?>
        <div class="alert alert-danger"><?php echo safe_text($error); ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($users) == 0): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">No users found.</td>
                </tr>
            <?php endif; ?>

            <?php foreach ($users as $user): ?>
                <?php $user_id = (int) $user["id"]; ?>
                <tr>
                    <td><?php echo safe_text($user_id); ?></td>
                    <td><?php echo safe_text($user["name"]); ?></td>
                    <td><?php echo safe_text($user["username"]); ?></td>
                    <td><?php echo safe_text($user["email"]); ?></td>
                    <td><?php echo ((int) $user["is_admin"] == 1) ? "Admin" : "User"; ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo safe_text($user_id); ?>">
                            Edit
                        </button>
                        <a href="manage_users.php?delete=<?php echo safe_text($user_id); ?>"
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

<?php foreach ($users as $user): ?>
    <?php $user_id = (int) $user["id"]; ?>
    <div class="modal fade" id="editModal<?php echo safe_text($user_id); ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo safe_text($user_id); ?>">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text"
                                   class="form-control"
                                   name="name"
                                   value="<?php echo safe_text($user["name"]); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text"
                                   class="form-control"
                                   name="username"
                                   value="<?php echo safe_text($user["username"]); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="<?php echo safe_text($user["email"]); ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <select name="is_admin" class="form-control">
                                <option value="0" <?php echo ((int) $user["is_admin"] == 0) ? "selected" : ""; ?>>User</option>
                                <option value="1" <?php echo ((int) $user["is_admin"] == 1) ? "selected" : ""; ?>>Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_user" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php render_footer(); ?>

<script src="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js
"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html> 