<?php
    include __DIR__ . "/../database.php";
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // fetch current users balance and substract
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $fullname = $data['firstname'] . " " . $data['lastname'];
            $email = $data['email'];
            $phone = $data['phone'];
            $balance = $data['balance'];
            
            
            $insert = mysqli_query($connection, "INSERT INTO transactions (userId, fullname, email, phone, amount, status) VALUE ('$id', $fullname', '$email', '$phone', '0', 'Pending')");
            if ($insert) {
                header('location: ' . URL . "admin/pay_user.php");
            }
            
            else {
                echo "Error 404";
            }
            
        }
        
        else {
            echo "user doesnt exist";
        }
    }
    
    else {
        exit();
    }