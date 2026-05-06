<?php
    include '../config/database.php';

    if (isset($_POST['register'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    if ($conn->query($sql)){
        echo "Registration successful!";
    }else{
        echo "Error: ".$conn->error;
    }
    }
?>

<?php include '../includes/header.php'; ?>
<div class="container" mt-3>
    <h2>Sign Up</h2>
    <form action="">
        <input type="text" name="name" class="form-control mb-3" placeholder="Full Name">
        <input type="email" name="email" class="form-control mb-3" placeholder="Email">
        <input type="password" name="password" class="form-control mb-3" placeholder="Password">
        <input type="password" name="confirm_password" class="form-control mb-3" placeholder="Confirm Password">
    
        <button class="btn btn-success">Register</button>
    </form>
</div>

<?php
    include '../includes/footer.php';
?>