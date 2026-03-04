<?php

    $grade = array(
        "Math"=>"4",
        "Art"=>"5",
        "History"=>"4",
        "Music"=>"4",
    );

    // $grade=['Math'] = "4",
    // $grade=['Art'] = "5",
    // $grade=['his'] = "4",
    // $grade=['music'] = "4",

    // echo "Math grade is ".$grade['Math'];
    // echo "Art grade is ".$grade['Art'];
    // echo "History grade is ".$grade['History'];
    // echo "Music grade is ".$grade['Music'];

    foreach($grade as $Subject => $grade){
        echo "Subject: ".$Subject.", Grade: ".$grade;
        echo "<br>";
    }

?>