<?php
    
    // function helloWorld(){
    //     echo "Hello World";
    // }

    // helloWorld();


    // function sum($x, $y){
    //     // return x + y;
    //     $z = $x + $y;
    //     echo $z;
    // }

    // sum(4, 6);

    // function maximum($x, $y){
    //     if ($x > $y){
    //         return $x;
    //     }else{
    //         return $y;
    //     }
    // }

    // $result = maximum(5, 3);
    // echo "The max is: $result";



    //Function to check if a random number is divisible by the number 2
    function divide($x){
        if(($x % 2)==0){
            return "$x is divisible by 2";
        }
        else{
            return "$x is not divisible by 2";
        }
    }

    print_r(divide(4). "<br>");

?>