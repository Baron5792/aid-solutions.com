<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['language'])) {
        $label = htmlspecialchars($_POST['language_label']);
        $level = htmlspecialchars($_POST['language_level']);
        $userId = $_POST['userId'];

        // check if it exists in the DB alreaady
        $check = mysqli_query($connection, "SELECT * FROM language WHERE userId= '$userId'");
        if (mysqli_num_rows($check) > 0) {
            $update = mysqli_query($connection, "UPDATE language SET label= '$label', level= '$level' WHERE userId= '$userId' ORDER BY date DESC LIMIT 1");
            if ($update) {
                $_SESSION['experience-success'] = "Your language history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
            }

            else {
                header('location: ' . URL . 'error/error.php');
            }

        }  else {
            $insert = mysqli_query($connection, "INSERT INTO language (userId, label, level) VALUE ('$userId', '$label', '$level')");
            if ($insert) {
                $_SESSION['experience-success'] = "Your experience history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
            }

            else {
                header('location: ' . URL . 'error/error.php');
            }
        }

        if (isset($_SESSION['experience-success'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }

    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }