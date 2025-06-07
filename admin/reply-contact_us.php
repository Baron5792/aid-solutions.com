<?php
    include __DIR__ . "/../user/emails/email_constant.php";

    if (isset($_POST['submit'])) {
        $userId = $_POST['userId'];
        $title = htmlspecialchars($_POST['title']);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $track = "1"; 
        $contactId = $_POST['contactId'];

        if (empty($title) || empty($message)) {
            $_SESSION['reply-error'] = "Title or messege field can't be empty";
        }

        else {
            $insert = mysqli_query($connection, "INSERT INTO users_email (user_id, title, message, track, comment_track) VALUE ('$userId', '$title', '$message', '$track', '$contactId')");
            if ($insert) {
                $mail->addAddress($_POST['email']);
                $mail->isHTML(true);
                $mail->Subject = $_POST['title'];
                $mail->Body = $_POST['message'];
                $mail->send();

                if ($mail->send()) {
                    $_SESSION['reply-success'] = "Reply has been sent successfully";
                    header('location: ' . URL . "admin/contact-us_view.php?id=$contactId");
                }
            }

            else {
                $_SESSION['reply-error'] = "Reply wasnt sent";
            }
        }

        if (isset($_SESSION['reply-error'])) {
            header('location: ' . URL . "admin/contact-us_view.php?id=$contactId");
            die;
        }
    }

    else {
        header('location: ' . URL . 'admin/contact_us.php');
    }