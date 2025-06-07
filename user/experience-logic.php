<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['experience'])) {
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $company = filter_var($_POST['company'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userId = $_POST['userId'];

        if (empty($title) || empty($company)) {
            echo "Error detected on SERVER 5637. Please try again to proceed";
        }

        else {
            $query = mysqli_query($connection, "SELECT * FROM experience WHERE userId= '$userId'");
            if (mysqli_num_rows($query) > 0) {
                $update = mysqli_query($connection, "UPDATE experience SET userId= '$userId', title= '$title', company= '$company' WHERE userId= '$userId' ORDER BY date DESC LIMIT 1");

                if ($update) {
                    $_SESSION['experience-success'] = "Your experience history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
                }

                else {
                    header('location: ' . URL . "error/error.php");
                }

            } else {
                $insert = mysqli_query($connection, "INSERT INTO experience (userId, title, company) VALUE ('$userId', '$title', '$company')");
                if ($insert) {
                    $_SESSION['experience-success'] = "Your experience history has been successfully saved! This information helps showcase your qualifications to potential clients. Keep your profile up-to-date for better opportunities.";
                }

                else {
                    header('location: ' . URL . "error/error.php");
                }
            }
        }

        if (isset($_SESSION['experience-success'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    else {
        header('location: ' . URL . "error/error.php");
    }