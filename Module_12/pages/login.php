<?php
    include '../includes/header.php';
    include '../config/database.php';

    if (isset($_POST['register'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $user = $result->fetch_assoc();

            if(password_verify($password, $user['password'])){
                $_SESSION['user'] = $user['name'];

                header("Location: dashboard.php");
            }else{
                echo "Wrong password!";
            }
        }else{
            echo "User not found!";
        }
    }
?>

<div class="container mt-5">
    <h2>Login</h2>
    <form action="POST">
        <div>
        <label for="Email"></label>
        <input type="email" class="form-control mb-3" placeholder="Enter email">
        </div>

        <div>
        <label for="Password"></label>
        <input type="password" class="form-control mb-3" placeholder="Enter password">
        </div>

        <button class="btn btn-primary">Log In</button>
    </form>
</div>

<?php
    include '../includes/footer.php';
?>