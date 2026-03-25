<?php

include_once 'config.php';

if(isset(&_POAST['submit'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, lastname, email) VALUES (:name, :lastname, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);

    $stmt->execute();

    echo "Data saved successfully";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    <a href="index.php">Dashboard</a>
    <form action="add.php" method="POST">
        <input type="text" name="name" placeholder="Enter your name"><br>
        <input type="text" name="lastname" placeholder="Enter your lastname"><br>
        <input type="email" name="email" placeholder="Enter your email"><br>
        <button type="submit" name="submit">Add User</button>
    </form>
</body>
</html>