<?php
session_start();
include("../config.php");

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1){
    header("location: ../login.php");
    exit();
}

//DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    header("Location: manage_users.php");
    exit();
}

//UPDATE
if(isset($_POST['update_user'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $is_admin = $_POST['is_admin'];

    mysqli_query($conn, "UPDATE users SET
        name='$name',
        username='$username',
        email='$email',
        is_admin='$is_admin',
        WHERE id= '$id'");
    header("Location: manage_users.php");
    exit();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
          crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">Movie Management System</span>
    <div>
        <a href="dashboard.php" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
        <a href="../logout.php" class="btn btn-outline-light btn-sm me-2">Logout</a>
    </div>
</nav>

<div class="container mt-5">
    <h3 class="mb-4">Manage Users</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($user = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['is_admin'] == 1 ? 'Admin' : 'User'; ?></td>
                <td>
                    <button class=" btn btn-warning btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target='#editModal<?php echo $user['id'];?>'>
                        Edit
                    </button>
                    <a href="manage_users.php?delete=<?php echo $user [id]; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure?')">
                        Delete
                    </a>
                </td>
            </tr>

            <!--Edit Modal-->
            <div class="modal fade" id="editModal<?php echo $user['id']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input  type="text"
                                            class="form-control"
                                            name="name"
                                            value="<?php echo $user['name']; ?>"
                                            required>
                                </div>

                                <div class="mb-3">
                                    <label>Username</label>
                                    <input  type="text"
                                            class="form-control"
                                            name="username"
                                            value="<?php echo $user['username']; ?>"
                                            required>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input  type="text"
                                            class="form-control"
                                            name="email"
                                            value="<?php echo $user['email']; ?>"
                                            required>
                                </div>

                                <div class="mb-3">
                                    <label for="">Role</label>
                                    <select name="is_admin" class="form-control">
                                        <option value="0" <?php if($user('is_admin')==0) echo 'selected'; ?>>User</option>
                                        <option value="1" <?php if($user('is_admin')==1) echo 'selected'; ?>>Admin</option>
                                    </select>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" name="update-user" class="btn btn-success" data-bs-dismiss="modal">Save Changes</button>
                            </div>                  
                        </form>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous"></script>
</body>
</html>