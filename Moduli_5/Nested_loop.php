<?php

    // $array = array(
    //     array(1, 4, 6),
    //     array(1, 4, 6),
    //     array(1, 4, 6),
    // );

    // for($i=1; $i<4; $i++){
    //     for($j=1; $j<4; $j++){
    //         echo "Array: $i Element: $j <br>";
    //     }
    // }

    for($i = 1; $i<5; $i++){
        for($j = $i; $j<=5;$j++){
            echo "&nbsp;";
        }
        for($j=1;$j<=$i;$j++){
            echo " * ";
        }
        echo '</br>';
    }


?>