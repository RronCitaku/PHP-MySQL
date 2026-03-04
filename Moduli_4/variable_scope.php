<?php
    // $x = 5; //global variable

    // function localVariable(){
    //     $y = 10; //local variable
    //     echo $y;
    // }

    // localVariable();

    // $x = 5;
    // $y = 7;

    // function sum(){
    //     global $x, $y;
    //     $y = $x + $y;
    // }

    // sum();
    // echo $y;

    function callCounter(){
        static $count = 0;
        $count++;
        echo "The value of count variable is: $count <br>";
    }
    callCounter();
    callCounter();
?>