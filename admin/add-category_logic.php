<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['submit'])) {
        $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($category)) {
            $_SESSION['category'] = "Category cant be empty";
        }

        else {
            $insert = mysqli_query($connection, "INSERT INTO category (name) VALUE ('$category')");
            if ($insert) {
                $_SESSION['success'] = "Category has been added successfully";
            }

            else {
                $_SESSION['category'] = "Category wasnt added, try again";
            }
        }

        if (isset($category)) {
            header('location: ' . URL . 'admin/add-category.php');
            die();
        }
    }

    else {
        header('location: ' . URL . 'admin/add-category.php');
    }