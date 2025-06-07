<?php
    include __DIR__ . "/../../user/emails/email_constant.php"; 

    if (isset($_POST['reset']))  {
        $username_email = htmlspecialchars($_POST['username-email']);
        $resetCode = $_POST['resetCode'];
        $track = $_POST['track'];

        // check if username or emaol exists
        $query = mysqli_query($connection, "SELECT * FROM users WHERE username= '$username_email' OR email= '$username_email' LIMIT 1");
        if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_assoc($query);
            $email = $data['email'];
            $userId = $data['id'];
            $fullname = $data['firstname'] . " " . $data['lastname'];
            
            $insert = mysqli_query($connection, "INSERT INTO reset (userId, email, resetCode, track) VALUE ('$userId', '$email', '$resetCode', '$track')");
            if ($insert) {

                // reset code sent here
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Password Reset Request for Your AID Account";
                $mail->Body = 
                    "   
                        Hi " . $fullname . "<br>". "
                        We received a request to reset the password for your AID account. Use the code below to reset your password: <br>

                        Your Password Reset Code: <b>" . " " . $resetCode .  "</b> <br>

                        Please enter this code on the password reset page to continue. <br>

                        For your security, this code will expire in 60 minutes. If you did not request this, you can safely ignore this email and your account will remain secure. <br>

                        If you need further assistance, feel free to contact our support team. <br>

                        Best regards, <br>
                        The AID Support Team
                    ";

                $mail->send();

                if ($mail->send()) {
                    header('location: ' . URL . "account/reset/reset?user=$userId&&track=$track&&reset=otp");
                }
                
                else {
                    echo "Error 400";
                }
            }

            else {
                echo "Internal error found, try again later";
            }
        }

        else {
            $_SESSION['reset-error'] = "<b>username or email</b> not found, please try again!";
        }

        if (isset($_SESSION['reset-error'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    else {
        header('location: ' . URL . "account/login?request=true");
    }