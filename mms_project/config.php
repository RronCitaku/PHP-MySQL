<?php
    $conn = mysqli_connect ("localhost", "root", "", "mms");

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
?>