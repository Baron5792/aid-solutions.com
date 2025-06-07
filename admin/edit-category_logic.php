<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['submit'])) {
        $category_name = filter_var($_POST['category_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($category_name)) {
            $_SESSION['error'] = "Category name cannot be empty";
        }

        else {
            $update = mysqli_query($connection, "UPDATE category SET name= '$category_name' WHERE id= '$category_id'");
            if ($update) {
                $_SESSION['success'] = "Category has been updated successfully";
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }

            else {
                $_SESSION['error'] = "error during update, try again";
            }
        }

        if (isset($_SESSION['error'])) {
            header('location: ' . URL . 'admin/edit-category.php');
        }
    }

    else {
        header('location: ' . URL . 'admin/edit-category.php');
    }