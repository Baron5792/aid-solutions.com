<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "phpmailer/src/Exception.php";
    require "phpmailer/src/PHPMailer.php";
    require "phpmailer/src/SMTP.php";

    if (isset($_POST['Send'])) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'egboudochukwu2003@gmail.com'; // my gmail
        $mail->Password = 'emsuwuzlalhnjuzx'; //my password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = '465';

        $mail->setFrom('egboudochukwu2003@gmail.com', 'AID Solutions'); // my gmail
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->Subject = "Welcome to AID! Get Started with Your Freelance Opportunities";
        $mail->Body = 
        "
            <b>Dear " . " " . $firstname . " " . ",
            Welcome to AID-Solutions! </b><br><br>

            We're thrilled to have you as part of our freelancing community. Whether you're here to find your next big project or to enhance your freelance career, AID is here to support you every step of the way. <br> <br>

            <b>What's Next?</b> <br>
            <b>1. Complete Your Profile:</b> A complete profile helps you stand out to potential clients. <br>
            <b>2. Explore Opportunities:</b> Browse through a wide range of job listings tailored to your skills.<br>
            <b>3. Start Applying:</b> Apply for jobs that match your expertise and get hired faster. <br>

            We recommend taking a quick tour of the platform to familiarize yourself with all the features designed to make your freelancing experience smooth and successful. <br>

            If you have any questions or need assistance, our support team is here to help. Feel free to reach out at any time. <br>

            Once again, welcome to AID! We're excited to see you achieve great things. <br> <br>

            Best Regards, <br>
            The AID Team <br>

            [Company Contact Information]
            [Unsubscribe or Manage Email Preferences Link]


        ";
        $mail->Send();


        echo 
            "
                <script>
                    alert('Sent successfully');
                    document.location.href = 'send.php';
                </script>   
            "
        ;

    }