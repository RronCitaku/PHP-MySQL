<?php
    session_start();
    include("config.php");

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>

    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand">MMS</span>
    </nav>
    <div>
        <span class="text-black me-3">Welcome, <?php echo $_SESSION['username'] ?>!</span>
        <a href="logout.php" class="btn btn-outline-dark btn-sm">Logout</a>
    </div>

    <div class="container mt-5">
        <h3>Welcome to Movie Managment System</h3>
        <p class="text-muted">You are logged in as a regular user.</p>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>