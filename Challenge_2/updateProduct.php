<?php
include "config.php";

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

$sql = "UPDATE products 
        SET name='$name', price='$price', description='$description'
        WHERE id=$id";

$conn->query($sql);

header("Location: index.php");
?>