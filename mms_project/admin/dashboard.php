<?php
    session_start();
    include("../config.php");

    if(!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !=1){
        header("Location: ../login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <h3>Admin Dashboard</h3>
        <p class="text-muted">You are logged in as an admin</p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <h5>Manage Movies</h5>
                    <a href="manage_movies.php" class="btn btn-primary mt-2">Go</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center p-3">
                    <h5>Manage Users</h5>
                    <a href="manage_users.php" class="btn btn-primary mt-2">Go</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center p-3">
                    <h5>Manage Bookings</h5>
                    <a href="manage_bookings.php" class="btn btn-primary mt-2">Go</a>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>