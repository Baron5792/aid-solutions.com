<?php
    include "../user/emails/email_constant.php";
    
    
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $email = $data['email'];
            $username = $data['username'];
            
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Welcome to Aid-Solutions!";
            $mail->Body = 
                "
                    <html>
                        <body>
                            <div style='width: 80%; margin: auto;'>
                                <img src='https://aid-solutions.com/assets/images/logo/logo.png' alt='aid solutions' style='width: 100%;'>
                            </div>
                            <div style='margin-top: 20px;'>
                                <b>Dear $username,</b> <br>
                                <p>A warm welcome to Aid-Solutions! We're thrilled to have you on board.</p>
                                <p>At Aid-Solutions, we're committed to providing you with an exceptional experience. Our platform is designed to connect you with exciting job opportunities, and we're excited to help you achieve your career goals.
</p> <br>
                                <p>To get started, you can:</p> <br>
                                <p>1. Take a survey test</p>
                                <p>2. Explore our job listings and apply to positions that match your skills and interests.</p>
                                <p>3. Complete your profile to increase your visibility to potential employers.</p>
                                <p>4. Stay up-to-date with the latest job postings and industry news.</p> <br>
                                <p>If you have any questions or need assistance, our support team is always here to help. Simply reply to this email or contact us through our website.</p> <br>
                                <p>Thank you for choosing Aid-Solutions. We're looking forward to helping you succeed!</p> <br>
                                <p>Best regards,</p>
                                <p>The Aid-Solutions Team</p>
                                <small style='text-align: center; color: silver; margin-top: 20px;'>aid-solutions.com</small>
                            </div>
                        </body>
                    </html>
                ";
                
                $mail->send();
                if ($mail->send()) {
                    $update  = mysqli_query($connection, "UPDATE users SET mail_track= '1' WHERE id= '$userId'");
                    header("location: " . $_SERVER['HTTP_REFERER']);
                }
        }
        
        else {
            echo "This user doesnt exist anymore";
        }
        
    }
    
    else {
        header("location: " . URL . "account/login");
    }
    