<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['award'])) {
        $award = htmlspecialchars($_POST['award']);
        $year = htmlspecialchars($_POST['year']);
        $awardMessage = htmlspecialchars($_POST['awardMessage']);
        $userId = $_POST['userId'];


        // check if it exists in the database already
        $check = mysqli_query($connection, "SELECT * FROM award WHERE userId= '$userId'");
        if (mysqli_num_rows($check) > 0) {
            $update = mysqli_query($connection, "UPDATE award SET award= '$award', year= '$year', message= '$awardMessage' WHERE userId= '$userId' ORDER BY date DESC LIMIT 1");
            if ($update) {
                $_SESSION['experience-success']= "Your award history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
            }

            else {
                header('location: ' . URL . 'error/error.php');
            }
        }

        else {
            $insert = mysqli_query($connection, "INSERT INTO award (award, year, message, userId) VALUE ('$award', '$year', '$awardMessage', '$userId')");
            if ($insert) {
                $_SESSION['experience-success']= "Your award history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
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