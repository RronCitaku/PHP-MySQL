<?php

    require "db.php";

    $sql = "INSERT INTO users(username, password)
    VALUES ('john', 'mypassword')";

    $pdo -> exec($sql);

    echo "New record created successfully";

?>