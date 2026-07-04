<?php
require_once "../config.php";

$id = $_GET["id"];

mysqli_query($conn, "DELETE FROM cars WHERE id=$id");

header("Location: dashboard.php");
exit();
?>