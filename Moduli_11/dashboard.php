<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        table{
            border: 1px solid black;
        }
        tr,td,th{
            border: 1px solid black;
        }
        table,tr,td{
            border-collapse: collapse;
        }
        td{
            padding: 10px;
        }
    </style>
</body>
<?php
    include_once('config.php');

    $getUsers = $conn->prepare("SELECT * FROM users");
    $getUsers->execute();
    $users = $getUsers->fetchAll();
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Update</th>
        </tr>
    </thead>
</table>
</html>

