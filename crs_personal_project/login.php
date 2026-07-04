<?php
session_start();
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/helpers.php";

$username = "";
$error = "";

if (isset($_POST["login"])) {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    if ($username == "" || $password == "") {
        $error = "Please enter your username and password.";
    } else {
        $username_sql = mysqli_real_escape_string($conn, $username);

        $sql = "SELECT * FROM users WHERE username = '$username_sql'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        $password_is_correct = false;

        if ($user) {
            $stored_password = (string) $user["password"];
            $password_is_correct = password_verify($password, $stored_password) || $password == $stored_password;
        }

        if ($user && $password_is_correct) {
            $_SESSION["user_id"] = (int) $user["Id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["is_admin"] = (int) $user["is_admin"];

            if ((int) $user["is_admin"] == 1) {
                redirect_to("admin/dashboard.php");
            }

            redirect_to("dashboard.php");
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System - Login</title>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css
"
          rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <h2 class="mb-4 text-center">Login</h2>

            <?php if ($error != ""): ?>
                <div class="alert alert-danger"><?php echo safe_text($error); ?></div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <input type="text"
                           class="form-control"
                           name="username"
                           value="<?php echo safe_text($username); ?>"
                           placeholder="Username"
                           required>
                </div>

                <div class="mb-3">
                    <input type="password"
                           class="form-control"
                           name="password"
                           placeholder="Password"
                           required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>

                <p class="text-center mt-3">
                    Don't have an account? <a href="index.php">Sign up here</a>
                </p>

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