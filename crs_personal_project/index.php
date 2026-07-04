<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/helpers.php";

$name = "";
$username = "";
$email = "";
$error = "";

if (isset($_POST["signup"])) {
    $name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";

    if ($name == "" || $username == "" || $email == "" || $password == "" || $confirm_password == "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif ($password != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $name_sql = mysqli_real_escape_string($conn, $name);
        $username_sql = mysqli_real_escape_string($conn, $username);
        $email_sql = mysqli_real_escape_string($conn, $email);

        $sql = "SELECT * FROM users WHERE username = '$username_sql' OR email = '$email_sql'";
        $existing_user = mysqli_query($conn, $sql);

        if (mysqli_num_rows($existing_user) > 0) {
            $error = "Username or email is already registered.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $password_sql = mysqli_real_escape_string($conn, $password_hash);

            $sql = "INSERT INTO users (name, username, email, password, confirm_password, is_admin)
                    VALUES ('$name_sql', '$username_sql', '$email_sql', '$password_sql', '$password_sql', 0)";
            mysqli_query($conn, $sql);

            redirect_to("login.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System-Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
     crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <h2 class="mb-4 text-center">Sign Up</h2>

            <?php if ($error != ""): ?>
                <div class="alert alert-danger"><?php echo safe_text($error); ?></div>
            <?php endif; ?>

            <form method="POST" autocomplete="off">

                <div class="mb-3">
                    <input type="text"
                           class="form-control"
                           name="name"
                           value="<?php echo safe_text($name); ?>"
                           placeholder="Name"
                           required>
                </div>

                <div class="mb-3">
                    <input type="text"
                           class="form-control"
                           name="username"
                           value="<?php echo safe_text($username); ?>"
                           placeholder="Username"
                           required>
                </div>

                <div class="mb-3">
                    <input type="email"
                           class="form-control"
                           name="email"
                           value="<?php echo safe_text($email); ?>"
                           placeholder="Email"
                           required>
                </div>

                <div class="mb-3">
                    <input type="password"
                           class="form-control"
                           name="password"
                           placeholder="Password"
                           required>
                </div>

                <div class="mb-3">
                    <input type="password"
                           class="form-control"
                           name="confirm_password"
                           placeholder="Confirm Password"
                           required>
                </div>

                <button type="submit" name="signup" class="btn btn-primary w-100">Sign Up</button>

                <p class="text-center mt-3">
                    Already have an account? <a href="login.php">Login here</a>
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