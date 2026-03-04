<?php

    //$sport = array('Football', 'Basketball', 'Handball', 'Volleyball')

    $sports = ['Football', 'Basketball', 'Handball', 'Volleyball'];

    // echo $sports[0];
    // echo end($sports);
    // echo count($sports);

    // for ($i = 0; $i < 4; $i++){
    //     echo $sports[$i], "\n";
    // }

    // $len = count($sports);
    
    // for ($i = 0; $i < $len; $i++){
    //     echo $sports[$i], "\n";
    // }
    
    //array_push
    array_push($sports, 'Golf');
    // var_dump($sports);

    //array_pop
    array_pop($sports);
    // var_dump($sports);

    array_unshift($sports, 'Tennis');
    // var_dump($sports);

    array_shift($sports);
    var_dump($sports);
?>