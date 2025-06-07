<?php
    include __DIR__ . "/../database.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // check if post is featured
        $query = mysqli_query($connection, "SELECT * FROM comment WHERE id= '$id'");
        if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_assoc($query);
            $featured = $data['featured'];
        }

        if ($featured == 0) {
            $delete = mysqli_query($connection, "DELETE FROM comment WHERE id=$id");
            if ($delete) {
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }

            else {
                echo "Error found during deletion";
            }
        }

        else {
            echo "Sorry, a featured post cant be deleted";
        }
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }