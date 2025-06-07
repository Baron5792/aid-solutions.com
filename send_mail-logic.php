<?php
    include __DIR__ . "/./database.php";
    
    if (isset($_POST['btn'])) {
        
        $to = $_POST['email'];      // Recipient's email address
        $subject = "Test Email";            // Email subject
        $message = "Hello, this is a test email.";  // Email message
        $headers = "From: sender@example.com"; 
        
        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully.";
        } else {
            echo "Failed to send email.";
        }
    }
    
    
?>