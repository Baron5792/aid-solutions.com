<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['comment'])) {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $star = $_POST['star'];
        $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $country = $_POST['country'];
        $avatar = $_FILES['avatar'];
        $status = $_POST['status'];

        $time = time();
        $avatar_name = $time . $avatar['name'];
        $tmp_name = $avatar['tmp_name'];
        $location = "../comment/" . $avatar_name;

        // allowed files
        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $avatar_name);
        $extension = end($extension);

        if (in_array($extension, $allowed_files)) {
            move_uploaded_file($tmp_name, $location);

            if ($status == 0) {
                $insert = mysqli_query($connection, "INSERT INTO comment (avatar, firstname, lastname, star, country, message, featured) VALUE ('$avatar_name', '$firstname', '$lastname', '$star', '$country', '$message', '$status')");
            }

            else {
                $update = mysqli_query($connection, "UPDATE comment SET featured= '0'");
                if ($update) {
                    $insert = mysqli_query($connection, "INSERT INTO comment (avatar, firstname, lastname, star, country, message, featured) VALUE ('$avatar_name', '$firstname', '$lastname', '$star', '$country', '$message', '$status')");
                }

                else {
                    echo "Error during update, try again";
                }
            }

            if ($insert) {
                $_SESSION['reset-success'] = "Comment added successfully";
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }

            else {
                $_SESSION['reset-error'] = "Error during insertion";
            }
        }

        else {
            $_SESSION['reset-error'] = "File must be an image";
        }

        if (isset($_SESSION['reset-error'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }