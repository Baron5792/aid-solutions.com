<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['submit'])) {
        $cover_letter = filter_var($_POST['cover_letter'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = $_POST['users_id'];

        if (empty($cover_letter)) {
            $_SESSION['resume-error'] = "A resume and cover letter must be uploaded!!";
        }
        else {
            $update = mysqli_query($connection, "UPDATE users SET cover_letter= '$cover_letter' WHERE id= '$id'");
            if ($update) {
                $_SESSION['resume-success'] = "<b>Well done!</b> Your profile's cover letter has been updated successfully. Good luck with your job applications!";
                header('location: ' . URL . 'user/my-resume.php');
            }

            else {
                $_SESSION['resume-error'] = "An error occured during update, please try again";
            }
        }

        if (isset($_SESSION['resume-error'])) {
            $_SESSION['resume-data'] = $_POST;
            header('location: ' . URL . 'user/my-resume.php');
            die;
        }

    }

    else {
        header('location: ' . URL . 'user/my-resume.php');
    }



