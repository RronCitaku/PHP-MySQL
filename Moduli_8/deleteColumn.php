<?php

    require "db.php";

    $sql = "ALTER TABLE users DROP COLUMN email";

    $pdo->exec($sql);

    echo "Column deleted successfully";

?>