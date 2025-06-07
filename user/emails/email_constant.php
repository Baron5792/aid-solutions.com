<?php
    include __DIR__ . "/../../database.php";


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__ . "/../../phpmailer/src/Exception.php";
    require __DIR__ . "/../../phpmailer/src/PHPMailer.php";
    require __DIR__ . "/../../phpmailer/src/SMTP.php";

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'das107.truehost.cloud';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@aid-solutions.com'; // my gmail
    $mail->Password = 'Baron001@gmail.com'; //my password
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';
    $mail->setFrom('info@aid-solutions.com', 'Aid-Solutions'); // my gmail
    $logo = "https://aid-solutions.com/assets/images/logo/logo.png";

    // $mail->addAddress($_POST['email']);
    // $mail->isHTML(true);
    // $mail->Subject = "Welcome to AID! Get Started with Your Freelance Opportunities";
    // $mail->Body = "";