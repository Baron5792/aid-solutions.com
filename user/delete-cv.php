<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['delete'])) {
        $user_id = $_POST['user_id'];
        
        // unlink users updated resume
        $queryUser = mysqli_query($connection, "SELECT * FROM users WHERE id= '$user_id'");
        if (mysqli_num_rows($queryUser) == 1) {
            $details = mysqli_fetch_assoc($queryUser);
            $cv = $details['resume'];
            $location = "../documents/resume/" . $cv;
            if ($location) {
               $delete = mysqli_query($connection, "UPDATE users SET resume= '' WHERE id= '$user_id'");
                if ($delete) {
                    unlink($location);
                    $_SESSION['cv-success'] = "The resume has been successfully removed from your profile";
                    header('location: ' . URL . 'user/cv-manager.php');
                }
            }
        }
            

        else {
            $_SESSION['delete'] = "Error during deletion of CV, please try again";
            header('location: ' . URL . 'user/cv-manager.php');
        }
    }

    else {
        header('location: ' . URL . 'user/cv-manager.php');
    }