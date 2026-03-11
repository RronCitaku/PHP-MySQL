<?php
    
    $file = fopen("Example.txt", "r+");

    //r=read, w=write, a=append, x=create new file, r+ = read and write

    $text = "Hello, this is my first PHP file.";
    fwrite($file, $text);

    $append_text = "This line was added later.";
    fwrite($file, $append_text);

    // echo fread($file, filesize("example.txt"));

    // while(!feof($file)){
    //     echo fgets($file)."<br>";
    // }

    rename("example.txt", "newfile.txt");
    echo "file renamed successfully!";


    //delete a file
    unlink("test.txt");
    echo "file deleted successfully!";

    fclose($file);

    //fopen -> open or create a file
    //fwrite -> write data
    //fread -> read file;
    //fgets -> read line
    //fclose -> close file
    //rename -> rename file
    //unlink -> delete file
    //file_exists -> check file
?>