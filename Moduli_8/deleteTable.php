<?php

    require "db.php";

    $sql = "DROP TABLE users";

    $pdo->exec($sql);

    echo "Table deleted successfully";

?>