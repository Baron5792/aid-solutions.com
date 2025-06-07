<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['submit'])) {
        $userId = $_POST['user_id'];
        $new_password = filter_var($_POST['new_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $old_password = filter_var($_POST['old_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);

        if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
            $_SESSION['password-error'] = "Please do not leave any field empty and try again";
        }

        elseif ($new_password !== $confirm_password) {
            $_SESSION['password-error'] = "Passwords do not match";
        }

        elseif (strlen($new_password) < 5) {
            $_SESSION['password-error'] = "New password must have more than 5 letters";
        } 

        elseif ($new_password == $old_password) {
            $_SESSION['password-error'] = "New password cannot be your old password, try again";
        }
        
        elseif (!preg_match('`[a-z]`', $new_password)) {
            $_SESSION['password-error'] = "New password must have at least one lowercase!";
        }

        elseif (!preg_match('`[0-9]`', $new_password)) {
            $_SESSION['password-error'] = "New password must have one number!";
        }

        elseif (!preg_match('`[A-Z]`', $new_password)) {
            $_SESSION['password-error'] = "New password must have at least one uppercase!";
        }

        else {
            // query current password
            $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
            if (mysqli_num_rows($query) == 1) {
                $details = mysqli_fetch_assoc($query);
                $db_password = $details['password'];

                if (password_verify($old_password, $db_password)) {
                    // hash and reupdate
                    $hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $update = mysqli_query($connection, "UPDATE users SET password= '$hash' WHERE id= '$userId'");
                    if ($update) {
                        $_SESSION['password-success'] = "<b>Congratulations</b> your password have been successfully updated";
                        header('location: ' . URL . 'user/change-password.php');
                    }

                    else {
                        $_SESSION['password-error'] = "Error during update try again";
                    }
                }

                else {
                    $_SESSION['password-error'] = "Please check your current password and try again";
                }
            }
        }

        if (isset($_SESSION['password-error'])) {
            $_SESSION['password-data'] = $_POST;
            header('location: ' . URL . 'user/change-password.php');
            die;
        }
    }

    else {
        header('location: ' . URL . 'user/change-password.php');
    }
