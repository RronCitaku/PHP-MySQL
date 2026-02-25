<?php

    // $age = 16;
    
    // switch($age){
    //     case($age >= 0 && $age < 18):
    //         echo "You are a minor  <br>";
    //         break;
    //     case($age >= 18 && $age <= 25):
    //         echo "You are a young adult  <br>";
    //         break;
    //     case($age > 25):
    //         echo "You are an adult  <br>";
    //         break;
    //     default:
    //         echo "Invalid age input  <br>";
    //         break;

    // }

    $day = "Friday";

    switch ($day){
        case 'Monday';
            echo "Its monday the start of the week!";
            break;
        case 'Tuesday';
            echo "Its tuesday! Keep pushing through!";
            break;
        case 'Wednesday';
            echo "Its wednesday! Midweek!";
            break;
        case 'Thursday';
            echo "Its thursday! Almost there!";
            break;
        case 'Friday';
            echo "Its friday! Weekend is around the corner!";
            break;
        case 'Saturday';
            echo "Its saturday! Enjoy your weekend!";
            break;
        case 'Sunday';
            echo "Its sunday! Rest and recharge!";
            break;
        default:
            echo "Invalid day";
            break;
    }

?>