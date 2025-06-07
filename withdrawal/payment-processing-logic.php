<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['submitData'])) {
        $userId = htmlspecialchars($_POST['userId']);
        $transactionId = htmlspecialchars($_POST['transactionId']);
        $fullname = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $bank_name = htmlspecialchars($_POST['bank_name']);
        $accountNo = htmlspecialchars($_POST['accountNo']);
        $accountType = htmlspecialchars($_POST['accountType']);
        $id = htmlspecialchars($_POST['id']);
        $amount = htmlspecialchars($_POST['amount']);


        $insert = mysqli_query($connection, "INSERT INTO transactions (userId, fullname, email, phone, amount, bankName, accountNo, accountType, gov_id, transactionId, status) VALUE ('$userId', '$fullname', '$email', '$phone', $amount, '$bank_name', '$accountNo', '$accountType', '$id', '$transactionId', 'null')");

        if ($insert) {
            $update = mysqli_query($connection, "UPDATE users SET withdrawal_track= '1' WHERE id= '$userId'");
            if ($update) {
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }
            else {
                header('location: ' . URL . 'error/error.php');
            }
        }

        else {
            header('location: ' . URL . 'error/error.php');
        }


    }

    else {
        header('location: ' . URL . "account/login.php");
        exit();
    }