<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['edit'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email_id = $_POST['email_id'];


        $update = mysqli_query($connection, "UPDATE email SET email= '$email' WHERE id= '$email_id'");

        if ($update) {
            header('location: ' . URL . 'admin/email.php');
        }
    }

    else {
        header('location: ' . URL . 'admin/email.php');
    }