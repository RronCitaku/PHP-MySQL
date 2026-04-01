<?php
    include 'db.php';
    include 'functions.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = validateInput($_POST['name']);
        $email = validateInput($_POST['email']);
        $age = validateInput($_POST['age']);

        $students = [$name, $email, $age];

        if(!empty($name) && !empty($email) && !empty($age)){
            $sql = "INSERT INTO students (name, email, age) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
        }
    }
?>