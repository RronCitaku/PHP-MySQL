<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>

    <form action="insertProduct.php" method="POST">
        Name: <input type="text" name="name"><br><br>
        Price: <input type="text" name="price"><br><br>
        Description: <textarea name="description"></textarea><br><br>
        <button type="submit">Add</button>
    </form>
</body>
</html>