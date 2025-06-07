<?php
    include __DIR__ . "/./database.php";

    if (isset($_POST['send'])) {
        $firstname = htmlspecialchars($_POST['firstname']);
        $email = htmlspecialchars($_POST['email']);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $userId = $_POST['userId'];

        if (empty($firstname) || empty($email) || empty($message))  {
            $_SESSION['contact'] = "Please fill in every required field to proceed";
        }

        else {
            // insert into the contact table
            $insert = mysqli_query($connection, "INSERT INTO contact_us (userId, firstname, email, message) VALUE ('$userId', '$firstname', '$email', '$message')");
            if ($insert) {
                $_SESSION['contact-success'] = "Thank you, your message has been sent successfully. We will get back to you shortly.";
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }

            else {
                $_SESSION['contact'] = "Unexpected error during insertion please try again";
            }

        }

        if (isset($_SESSION['contact'])) {
            $_SESSION['contact-data'] = $_POST;
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }