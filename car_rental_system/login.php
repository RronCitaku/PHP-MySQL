<?php
include "config.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width: 400px;">

    <div class="card shadow">
        <div class="card-body p-4">

            <h3 class="text-center mb-4">Login</h3>

            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form method="POST">

                <input class="form-control mb-2" type="text" name="username" placeholder="Username" required>

                <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

                <button class="btn btn-dark w-100" name="login">
                    Login
                </button>

            </form>

            <p class="text-center mt-3">
                No account?
                <a href="register.php">Register</a>
            </p>

        </div>
    </div>

</div>

</body>
</html>