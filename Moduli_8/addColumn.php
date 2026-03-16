<?php

    require "db.php";

    $sql = "ALTER TABLE users ADD email VARCHAR(100)";

    $pdo->exec($sql);

    echo "Column added successfully";

?>