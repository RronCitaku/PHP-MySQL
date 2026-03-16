<?php

    require "db.php";

    $sql = "INSERT INTO users(username, password)
    VALUES ('anna', '123456')";

    $pdo -> exec($sql);

    $last_id = $pdo->lastInsertId();

    echo "New record created. Last ID is: ".$last_id;

?>