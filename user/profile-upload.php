<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['profile'])) {
        $img = $_FILES['profilePicture'];
        $id = $_POST['users_id'];


        if (empty($img)) {
            $_SESSION['upload_error'] = "Please select a photo";
        }

        else {
            $time = time();
            $img_name = $time . $img['name'];
            $tmp_name = $img['tmp_name'];
            $location = '../assets/images/avatar/' . $img_name;

            // make sure the file is allowed
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $img_name);
            $extension = end($extension);

            if (in_array($extension, $allowed_files)) {

                if ($img['size'] < 3000000)  {
                    move_uploaded_file($tmp_name, $location);
                    $update = mysqli_query($connection, "UPDATE users SET avatar= '$img_name' WHERE id= '$id'");

                    if ($update) {
                        $_SESSION['profile-success'] = "Photo has been updated";
                        header('location: ' . $_SERVER['HTTP_REFERER']);
                    }

                    else {
                        $_SESSION['upload_error'] = "Picture wasn't uploaded";
                    }
                }

                else {
                    $_SESSION['upload_error'] = "File size should'nt exceed 3MB";
                }
            }

            else {
                $_SESSION['upload_error'] = "File is'nt an image";
            }
        }

        if (isset($_SESSION['upload_error'])) {
            $_SESSION['profile-data'] = $_POST;
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }