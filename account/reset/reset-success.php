<?php
    include "../../database.php";

    if (isset($_POST['submit'])) {
        $userId = $_POST['userId'];
        $password = $_POST['password'];

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $update = mysqli_query($connection, "UPDATE users SET password= '$hash' WHERE id= '$userId'");
        if ($update) {
            $_SESSION['register-success'] = "<strong>Password Reset Successful!</strong> Your password has been updated. You can now log in with your new password.";
            header('location: ' . URL . "account/login.php");
        }

        else {
            echo "An internal error occured, please try again";
        }
    }   
    

    else {
        header('location: ' . URL . "account/login.php");
    }