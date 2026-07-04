<?php
include "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1){
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

// delete car
mysqli_query($conn, "DELETE FROM cars WHERE id='$id'");

header("Location: dashboard.php");
exit();
?>