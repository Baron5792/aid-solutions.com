<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['upload'])) {
        $user_id = $_POST['user_id'];
        $cv = $_FILES['cv'];

        if (empty($cv['name'])) {
            $_SESSION['cv'] = "Please select a CV file to proceed";
        }

        else {
            $time = time();
            $file_name = $time . $cv['name'];
            $tmp_name = $cv['tmp_name'];
            $location = "../documents/resume/" . $file_name;

            // allowed files
            $allowed_files = ['doc', 'docx', 'pdf'];
            $extension = explode('.', $file_name);
            $extension = end($extension);

            if (in_array($extension, $allowed_files)) {
                if ($cv['size'] < 307200) {
                    move_uploaded_file($tmp_name, $location);
                    $update = mysqli_query($connection, "UPDATE users SET resume= '$file_name' WHERE id= '$user_id'");

                    if ($update) {
                        $_SESSION['cv-success'] = "<b>Congratulations!</b> your Resume has been uploaded";
                        header('location: ' . URL . 'user/cv-manager.php');
                    }   

                    else {
                        $_SESSION['cv'] = "Error during upload, please try again";
                    }
                }

                else {
                    $_SESSION['cv'] = "File size exceeds <b>3KB</b>";
                }
            }

            else {
                $_SESSION['cv'] = "File should have a <b>.doc, .docx, .pdf</b> extension";
            }

        }

        if (isset($_SESSION['cv'])) {
            header('location: ' . URL . 'user/cv-manager.php');
            die;
        }

    }

    else {
        header('location: ' . URL . 'user/cv-manager.php');
    }



