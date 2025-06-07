<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['education'])) {
        $title = htmlspecialchars($_POST['title']);
        $institute = htmlspecialchars($_POST['institute']);
        $startDate = htmlspecialchars($_POST['startDate']);
        $endDate = htmlspecialchars($_POST['endDate']);
        $description = htmlspecialchars($_POST['description']);
        $userId = $_POST['userId'];

        if (empty($title) || empty($institute) || empty($startDate) || empty($endDate) || empty($description)) {
            echo "Empty inputs found, please try again";
        }

        else {
            // check if an education details is found in the DB
            $query = mysqli_query($connection, "SELECT * FROM education WHERE userId= '$userId'");
            if (mysqli_num_rows($query) > 0) {
                $update = mysqli_query($connection, "UPDATE education SET title= '$title', institute= '$institute', startDate= '$startDate', endDate= '$endDate', description= '$description', userId= '$userId' WHERE userId ORDER BY date DESC LIMIT 1");

                if ($update) {
                    $_SESSION['education-success'] = "Your education history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                }

                else {
                    echo "An internal error has occured, please try again.";
                }
            }

            else {
                $insert = mysqli_query($connection, "INSERT INTO education (userId, title, institute, startDate, endDate, description) VALUE ('$userId', '$title', '$institute', '$startDate', '$endDate', '$description')");

                if ($insert) {
                    $_SESSION['education-success'] = "Your education history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                }

                else {
                    echo "An internal error has occured, please try again.";
                }
            }
        }

    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }