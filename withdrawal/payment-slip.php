<?php
    include __DIR__ . "/../user/emails/email_constant.php";
    
    if (isset($_POST['submitBtn'])) {
        $file = $_FILES['receipt'];
        $userId = $_POST['userId'];
        $percent = $_POST['percentage'];
        $account_number = $_POST['account_number'];
        $bank = $_POST['bank'];
        $transactionId = $_POST['transactionId'];
        $amount = $_POST['amount'];
        
        
        
        if (empty($file['name'])) {
            $_SESSION['slip-error'] = "A payment recepit is required to proceed";
        }
        
        else {
            $time = time();
            $file_name = $time . $file['name'];
            $tmp_name = $file['tmp_name'];
            $location = "./payment-receipts/" . $file_name;
            
            $allowed_files = ['jpeg', 'jpg', 'pdf', 'png', 'gif', 'docx'];
            $extension = explode('.', $file_name);
            $extension = end($extension);
            
            if (in_array($extension, $allowed_files)) {
                if ($file['size'] <= 3145728) {
                    move_uploaded_file($tmp_name, $location);
                    $insert = mysqli_query($connection, "INSERT INTO withdrawal (userId, amount, percent, account_number, bank, file) VALUE ('$userId', '$amount', '$percent', '$account_number', '$bank', '$file_name')");
                    if ($insert) {
                        // check for where transacion ID matches 
                        // insert into transaction history
                        $check = mysqli_query($connection, "SELECT * FROM transactions WHERE userId= '$userId' AND transactionId= '$transactionId' ORDER BY date DESC LIMIT 1");
                        if (mysqli_num_rows($check) > 0) {
                            $update = mysqli_query($connection, "UPDATE transactions SET status= 'Pending' WHERE userId= '$userId' AND transactionId= '$transactionId'");
                            if ($update) {
                                // query the users balance and substract the amount from it
                                $fetchUser = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
                                if (mysqli_num_rows($fetchUser) > 0) {
                                    $data = mysqli_fetch_assoc($fetchUser);
                                    $current_bal = $data['balance'];
                                    $email = $data['email'];
                                    $fullname = $data['lastname'] . " " . $data['firstname'];
                                    
                                    // fetch the total withdrew amount from the transaction tabel using the transaction ID
                                    // fetch amount withdrew
                                    $fetchId = mysqli_query($connection, "SELECT * FROM transactions WHERE transactionId= '$transactionId' LIMIT 1");
                                    if (mysqli_num_rows($fetchId) > 0) {
                                        $details = mysqli_fetch_assoc($fetchId);
                                        $withdrewAmount = $details['amount'];
                                    }
                                    $officialBal = $current_bal - $withdrewAmount;
                                    
                                    // update withdrawal track
                                    $withdrawalTrack = mysqli_query($connection, "UPDATE users SET withdrawal_track= '0' WHERE id= '$userId'");
                                    if ($withdrawalTrack) {
                                        $replace = mysqli_query($connection, "UPDATE users SET balance= '$officialBal' WHERE id= '$userId'");
                                        if ($replace) {
                                            $mail->addAddress($email);
                                            $mail->isHTML(true);
                                            $mail->Subject = "Confirmation of Transaction Slip Upload on Aid-solutions";
                                            $siteEmail = "<a href='mailto:support@aid-solutions.com'>support email</a>";
                                            $mail->Body = 
                                            "
                                                <html>
                                                    <body>
                                                        <div style='width: 80%; margin: auto; padding-bottom: 40px'>
                                                            <img src='$logo' alt='aid-solutions.com' style='width: 100%'>
                                                        </div>
                                                        <p>Dear $fullname</p>
                                                        
                                                        <p>Thank you for uploading your transaction slip on AID. We have successfully received your document, and it is currently under review.</p> <br>
                                                        
                                                        <b>Next Steps</b>
                                                        
                                                        <p>Our team will verify the details and process the transaction accordingly. This review may take up to 1-3 business days. Once complete, you will receive a follow-up email with the status of your transaction.</p><br>
                                                        
                                                        <b>Need Help?</b> <br>
                                                        
                                                        <p>If you have any questions or need further assistance, please feel free to reach out to our support team at $siteEmail or via our website's support page.</p>
                                                        
                                                        <p>Thank you for choosing AID. We’re here to support you every step of the way!</p> <br>
                                                        
                                                        <b>Best regards,</b>
                                                        <p>The AID Team</p>
                                                    </body>
                                                </html>
                                            ";
                                            
                                            $mail->send();
                                            $_SESSION['slip-success'] = "Success! Your transaction receipt has been uploaded. We'll process it shortly.";
                                            header('location: ' . URL . "withdrawal/payment-withdraw-process");
                                        }
                                        
                                        else {
                                            echo "error during insertion";
                                        }
                                    }
                                }
                                
                                else {
                                    echo "User is not found";
                                }
                                    
                            }
                            
                            else {
                                $_SESSION['slip-error'] = "We couldn't upload your receipt due to an error. If the problem persists, please contact support.";
                            }
                        }
                        
                        else {
                            $_SESSION['slip-error'] = "No transaction history found";
                        }
                    }
                    
                    else {
                        $_SESSION['slip-error'] = "An error 400 occured during payment processing. Please try again.";
                    }
                }
                
                else {
                    $_SESSION['slip-error'] = "File size exceeds 3 MB.";
                }
            }
            
            else {
                $_SESSION['slip-error'] = "Invalid file format. Please upload a receipt in JPG, JPEG, PNG, GIF, PDF, or DOCX format.";
            }
        }
        
        if (isset($_SESSION['slip-error'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }
    
    else {
        header('location: ' . URL . "withdrawal/payment-processing");
    }