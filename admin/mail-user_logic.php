<?php
    include __DIR__ . "/../user/emails/email_constant.php";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $subject = $_POST['subject'];
        $message = $_POST['body'];
    
        $query = mysqli_query($connection, "SELECT email FROM users");
    
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $email = $row['email'];
                
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;
                
                
                
            }
        }
    } else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
?>
