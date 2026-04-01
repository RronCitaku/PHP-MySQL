<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moduli 11</title>
    <style>
        form>input{
            margin-bottom: 10px;
            padding: 5px;
            font-size: 20px;
        }
        button{
            background: none;
            border: 1px solid black;
            padding: 10px 40px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="add.php" method="POST">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="text" name="name" placeholder="Name"><br>
        <input type="text" name="surname" placeholder="Surname"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit" name="submit">Add</button>
    </form>
</body>
</html>