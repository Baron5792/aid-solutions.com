<?php
    include __DIR__ . "/../database.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
        if (mysqli_num_rows($query) == 1) {
            $details = mysqli_fetch_assoc($query);
            $avatar_name = $details['avatar'];
            $avatar_path = "../assets/images/avatar/" . $avatar_name;

            if ($avatar_path) {
                unlink($avatar_path);
            }

            $delete_user = mysqli_query($connection, "DELETE FROM users WHERE id= '$id'");
            if ($delete_user) {
                $_SESSION['delete-success'] = "User has been deleted successfully";
                header('location: ' . URL . 'admin/manage-users.php');
            }

            else {
                $_SESSION['delete'] = "User wasn't deleted";
            }
        }

        else {
            $_SESSION['delete'] = "User is not found in the database, try again";
        }

        if ($_SESSION['delete']) {
            header('location: ' . URL . 'admin/manage-users.php');
            die();
        }
    }

    else {
        header('location: ' . URL . 'admin/manage-users.php');
    }