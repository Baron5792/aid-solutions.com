<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['edit'])) {
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $admin = filter_var($_POST['admin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = $_POST['id'];


        if (empty($firstname) || empty($lastname) || empty($username) || empty($email)) {
            $_SESSION['edit'] = "Firstname, lastname, username or email can't be empty";
        }

        else {
            $update = mysqli_query($connection, "UPDATE users SET firstname= '$firstname', lastname= '$lastname', username= '$username', email= '$email', admin= '$admin' WHERE id='$id'");

            if ($update) {
                $_SESSION['edit-success'] = "User has been edited successfully";
                header('location: ' . URL . 'admin/manage-users.php');
            }

            else {
                $_SESSION['edit'] = "Error during edit, try again";
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }
        }

        if (isset($_SESSION['edit'])) {
            $_SESSION['edit-data'] = $_POST;
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }

    }

    else {
        header('location: ' . URL . 'admin/manage-users.php');
    }



