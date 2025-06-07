<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['add_email'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($email)) {
            echo "Email is empty";
        }

        else {
            $insert = mysqli_query($connection, "INSERT INTO email (email) VALUE ('$email')");
            if ($insert) {
                echo "email has been successfully added, return back to the email page";
                header('location: ' . URL . 'admin/email.php');
            }
        }
    }

    else {
        header('location: ' . URL . 'admin/email.php');
    }