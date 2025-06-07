<?php
    include __DIR__ . "/../database.php";

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        // delete all in applied
        $deleteAll = mysqli_query($connection, "DELETE FROM applied WHERE users_id= '$userId' AND status= 'Pending'");
        if ($deleteAll) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
   
        else {
            header('location: ' . URL . "error/error.php");
        }
    }

    else {
        header('location: ' . URL . 'user/applied-jobs.php');
    }


    