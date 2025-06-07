<?php
    include __DIR__ . "/../database.php";

    if (isset($_GET['ref']) && isset($_GET['transactionId'])) {
        $userRef = $_GET['ref'];
        $transactionId = $_GET['transactionId'];

        // query for user ID
        $query = mysqli_query($connection, "SELECT * FROM users WHERE ref_code= '$userRef'");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $userId = $data['id'];

            $check = mysqli_query($connection, "SELECT * FROM transactions WHERE userId= '$userId' AND transactionId= '$transactionId'");
            if (mysqli_num_rows($check) > 0) {
                // update the users withdrawal track to value 2 in users table
                $update = mysqli_query($connection, "UPDATE users SET withdrawal_track= '2' WHERE id= '$userId' LIMIT 1");
                if ($update) {
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                }

                else {
                    header('location' . URL . "error/error.php");
                }
            }

            else {
                header('location: ' . URL . "error/error.php");
                exit();
            }
        }

        else {
            header('location: ' . URL . "error/error.php");
        }

        
    }

    else {
        header('location: ' . URL . "account/login.php");
    }