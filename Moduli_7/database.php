<?php

    //Setting MySQL database parameters
    
    $host = 'localhost';
    $user = 'root';
    $pass = '';

    try{
        $conn = new PDO("mysql:host=$host;, $user, $pass");
        //echo "Connected";
        $sql = "CREATE DATABASE testdb";
        $conn->exec($sql);
        echo "Database is created";
    }catch(Exception $e){
        echo "Not connected";
    }

?>