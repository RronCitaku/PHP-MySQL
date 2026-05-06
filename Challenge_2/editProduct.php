<?php
include "config.php";

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<body>

<h2>Edit Product</h2>

<form action="updateProduct.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

    Name: <input type="text" name="name" value="<?php echo $product['name']; ?>"><br><br>
    Price: <input type="text" name="price" value="<?php echo $product['price']; ?>"><br><br>
    Description: <textarea name="description"><?php echo $product['description']; ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>