<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Managment System - Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <h2 class="mb-4 text-center">Sign Up</h2>

          <?php if(isset($error)){ ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
          <?php } ?>

        

    <form method="POST">
    <div class="mb-3">
    <input type="text"
      class="form-control"
      placeholder="Userame"
      name="username"
      required>
  </div>

  <div class="mb-3">
    <input type="password"
      class="form-control"
      placeholder="Password"
      name="password"
      required>
  </div>


  <button type="submit" name="login" class="btn btn-primary">Log In</button>
  <p>
    Don't you have an account?<a href="index.php">Sign Up</a>
  </p>

  </form>

      </div>
    </div>
  </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>