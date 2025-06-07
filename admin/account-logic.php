<?php
    include __DIR__ . "/../database.php";
    
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $bank = $_POST['bank'];
        
        if (empty($name) || empty($number) || empty($bank)) {
            echo "Input is empty";
        }
        
        else {
            $insert = mysqli_query($connection, "INSERT INTO account (account_name, account_number, account_bank) VALUE ('$name', '$number', '$bank')");
            if ($insert) {
                $_SESSION['success'] = "Account Details has been updated successfully";
                header('location: ' . URL . "admin/account-value.php");
            }
            
            else {
                $_SESSION['error'] = "Error during update, please try again";
            }
        }
    }
    
    else {
        header('location: ' . URL . "admin/admin/account-value.php");
    }