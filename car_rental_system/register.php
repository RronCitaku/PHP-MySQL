<?php
include "config.php";

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check duplicates
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");

    if(mysqli_num_rows($check) > 0){
        $error = "Username or Email already exists!";
    } else {
        mysqli_query($conn, "INSERT INTO users(name, username, email, password)
        VALUES('$name','$username','$email','$password')");

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width: 450px;">

    <div class="card shadow">
        <div class="card-body p-4">

            <h3 class="text-center mb-4">Create Account</h3>

            <?php if(isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form method="POST">

                <input class="form-control mb-2" type="text" name="name" placeholder="Full Name" required>

                <input class="form-control mb-2" type="text" name="username" placeholder="Username" required>

                <input class="form-control mb-2" type="email" name="email" placeholder="Email" required>

                <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

                <button class="btn btn-primary w-100" name="register">
                    Register
                </button>

            </form>

            <p class="text-center mt-3">
                Already have an account?
                <a href="login.php">Login</a>
            </p>

        </div>
    </div>

</div>

</body>
</html>