<?php

    $host = "localhost";
    $db = "my_database1";
    $user = "root";
    $pass = "";

    // echo "Success";
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE users (id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(50) NOT NULL)";

        $pdo->exec($sql);

        echo "Table created succesfully";
    } catch(Exception $e){
        echo "Error creating table: ".$e->getMessage();
    }

?>