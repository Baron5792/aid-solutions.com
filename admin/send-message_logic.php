<?php
    include __DIR__ . "/../user/emails/email_constant.php";

    if (isset($_POST['submit'])) {
        $userId = $_POST['userId'];
        $jobId = $_POST['jobId'];
        $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // query users details
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $email = $data['email'];
            $firstname = $data['firstname'];
        }

        if (empty($message)) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }

        else {
            $insert = mysqli_query($connection, "INSERT INTO chat (user_id, job_id, message, track) VALUE ('$userId', '$jobId', '$message', '2')");
            if ($insert) {
                $update = mysqli_query($connection, "UPDATE users SET message_track= '2' WHERE id= '$userId'");
                if ($update) {
                    // send mail to the user
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = "You've Got a Reply from the Job Owner!";
                    $mail->Body =     
                    "
                        Dear $firstname, <br> We are happy to inform you that the job owner you recently contacted has replied to your message! <br> 
                        To view the response, simply log in to your account and head to your messages. You can continue the conversation, ask any follow-up questions, or discuss the next steps. <br>
                        If you have any questions or need further assistance, feel free to reach out to our support team. <br><br>
                        Best regards, <br>
                        The AID Team

                    ";
                    $mail->send();
                    header('location: ' . URL . "admin/chat-view.php?chat-id=$jobId&&userId=$userId");
                }
            }

            else {
                echo "Message wasn't sent";
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    else {
        header('location: ' . URL . 'account/login.php');
    }