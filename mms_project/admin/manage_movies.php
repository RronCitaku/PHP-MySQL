<?php
session_start();
include('../config.php');

if(!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1){
    header("Location: ../login.php");
    exit();
}

//DELETE
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM movies WHERE id='$id'");
    header("Location: manage_movies.php");
    exit();
}

//ADD
if(isset($_GET['add_movie'])){
    $movie_name = $_POST['movie_name'];
    $movie_desc = $_POST['movie_desc'];
    $movie_quality = $_POST['movie_quality'];
    $movie_rating = $_POST['movie_rating'];
    $movie_image = $_POST['movie_image'];

    mysqli_query($conn, "INSERT INTO movies (movie_name, movie_desc, movie_quality, movie_rating, movie_image)
                        VALUES('$movie_name', '$movie_desc', '$movie_quality', '$movie_rating', '$movie_image')");
    header ("Location: manage_movies.php");
    exit();
}   

//Update
if(isset($_GET['add_movie'])){
    $id = $_POST['id'];
    $movie_name = $_POST['movie_name'];
    $movie_desc = $_POST['movie_desc'];
    $movie_quality = $_POST['movie_quality'];
    $movie_rating = $_POST['movie_rating'];
    $movie_image = $_POST['movie_image'];

    mysqli_query($conn, "UPDATE movies SET
        movie_name = '$movie_name',
        movie_desc = '$movie_desc',
        movie_quality = '$movie_quality',
        movie_rating = '$movie_rating',
        movie_image = '$movie_image',
        WHERE id = '$id'");
    header("Location: manage_movies.php");
    exit();

}
$result = mysqli_query($conn, "SELECT * FROM movies");
?>