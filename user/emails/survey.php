<?php
    // include __DIR__ . "/../../database.php";
    include __DIR__ . "/./email_constant.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail</title>
    <link rel="stylesheet" href="<?= URL ?>assets/bootstrap-4.6.1-dist/css/bootstrap.css">

    <style>
        .container {
            font-size: 14px;
        }

        .container a {
            text-align: center;
        }

        .img {
            width: 50%;
            margin: auto;
        }

        .img img {
            width: 100%;
        }
    </style>
</head>
<body>
    

    <div class="container">
        <div class="img">
            <img src="../../assets/images/logo/logo.jpg" alt="">
        </div>

        <b>Dear {{firstname}},</b> <br>
        <b>Congratulations!</b> 🎉 <br><br>

        We're excited to inform you that you've successfully passed the survey test and are now eligible to access and apply for job opportunities on AID Solutions. This is a significant milestone in your freelancing journey, and we're thrilled to support you as you take the next steps. <br> <br>

        <b>What's Next?</b> <br>

        <b>1. Explore Job Listings:</b> Start browsing through our wide range of job listings tailored to your skills and interests. With thousands of opportunities available, you're sure to find projects that match your expertise. <br>

        <b>2. Complete Your Profile:</b> If you haven't already, make sure your profile is fully completed. A detailed profile helps you stand out to potential clients and increases your chances of being hired. <br>

        <b>3. Start Applying:</b> Begin applying for jobs that catch your eye. Don't hesitate to reach out to clients through our platform to express your interest and discuss potential collaborations. <br>

        <b>Need Assistance?</b> <br>

        If you have any questions or need support, our team is here to help. Feel free to reach out to us at <a href="mailto:support@aid-solutions.com">support@aid-solutions.com</a>, and we'll be happy to assist you. <br>

        Once again, congratulations on passing the test! We look forward to seeing you achieve great success on AID Solutions. <br>

        Best Regards, <br>  
        The AID Solutions Team <br>

        <a href="https://www.aid-solutions.com/subscription/Manage_Preferences.php">[Unsubscribe or Manage Preferences]</a>
    </div>


    <link rel="stylesheet" href="<?= URL ?>assets/bootstrap-4.6.1-dist/jQuery-3.3.1.min.js">
    <link rel="stylesheet" href="<?= URL ?>assets/bootstrap-4.6.1-dist/popper.min.js">

</body>
</html>