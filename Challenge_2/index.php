<?php include "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h2>Products List</h2>
    <a href="addProduct.php">Add Product</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Timestamp</th>
        </tr>

        <?php
            $result = $conn->query("SELECT * FROM products");

            while($row = $result->fetch_assoc()){
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['description']}</td>
                    <td>
                        <a href='editProduct.php?
            id={$row['id']}'>Edit</a>
                        <a href='deleteProduct.php?
            id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        ?>

    </table>
</body>
</html>