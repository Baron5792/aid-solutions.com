<?php
    include __DIR__ . "/../database.php";

    if (isset($_GET['id']) && isset($_GET['job-id'])) {
        $job_id = $_GET['job-id'];
        $user_id = $_GET['id'];
        
        $delete = mysqli_query($connection, "DELETE FROM favorites WHERE job_id= '$job_id' AND user_id= '$user_id'");
        if ($delete) {
            header('location: '. URL . 'user/favorite.php');
        }

        else {
            $_SESSION['favorite-error'] = "fatal error please try again";
        }

    }

    if (isset($_SESSION['favorite-error'])) {
        header('location: ' . URL . 'user/favorite.php');
    }

    else {
        header('location: '. URL . 'user/favorite.php');
    }