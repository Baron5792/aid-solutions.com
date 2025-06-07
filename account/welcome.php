<?php
    include __DIR__ . "/../database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            background-color: white;
            padding: 30px;
            border-radius: 8px 8px 0 0;
        }
        .header img {
            width: 40%;
        }
        .header h1 {
            font-size: 26px;
            color: #333;
            margin: 20px 0 10px;
        }
        .header p {
            color: #777;
            font-size: 18px;
        }
        .button {
            display: inline-block;
            padding: 15px 25px;
            font-size: 16px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .content {
            padding: 20px;
            text-align: left;
            font-size: 16px;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
        }
        .content p {
            margin-bottom: 20px;
        }
        .feature {
            display: flex;
            margin-bottom: 20px;
        }
        .feature img {
            width: 50px;
            height: 50px;
            margin-right: 20px;
        }
        .feature h3 {
            margin: 0;
            font-size: 15px;
            color: #333;
        }
        .feature p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            padding: 30px;
            background-color: #f8f8f8;
            border-radius: 0 0 8px 8px;
        }
        .footer p {
            color: #999;
            font-size: 12px;
        }
        .footer a {
            color: #28a745;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://aid-solutions.com/assets/images/logo/logo.png" alt="Welcome">
            <h1>Welcome to AID Solutions!</h1>
            <p>Your journey to freelancing success starts here.</p>
        </div>

        <div class="content">
            <h2>Hello {{firstname}},</h2>
            <p>
                We're thrilled to have you on board! AID Solutions is designed to connect you with amazing job opportunities tailored to your skills and expertise. Whether you're a seasoned freelancer or just getting started, we're here to support your journey.
            </p>

            <h2>What’s Next?</h2>
            <p>To help you get the most out of our platform, we recommend starting with these steps:</p>

            <div class="feature">
                <!-- <img src="path_to_icon1.png" alt="Profile"> -->
                <div>
                    <h3>Complete Your Profile</h3>
                    <p>Build a compelling profile to attract clients by showcasing your skills and experiences.</p>
                </div>
            </div>

            <div class="feature">
                <!-- <img src="path_to_icon2.png" alt="Explore"> -->
                <div>
                    <h3>Explore Opportunities</h3>
                    <p>Browse through thousands of job listings across various industries and find the perfect match for your skills.</p>
                </div>
            </div>

            <div class="feature">
                <!-- <img src="path_to_icon3.png" alt="Apply"> -->
                <div>
                    <h3>Start Applying</h3>
                    <p>Apply for jobs that interest you, communicate with potential clients, and land your next big gig!</p>
                </div>
            </div>

            <p>To make your experience even smoother, we encourage you to take a quick tour of the platform. Click the button below to get started:</p>
            <p style="text-align: center;">
                <a href="https://aid-solutions.com/login" class="button">Take a Platform Tour</a>
            </p>

            <h2>Need Assistance?</h2>
            <p>
                Our support team is available to assist you with any questions or concerns you may have. Feel free to reach out to us anytime at <a href="mailto:support@aid-solutions.com">support@aid-solutions.com</a>.
            </p>
        </div>

        <div class="footer">
            <p>
                © 2024 AID Solutions. All rights reserved.<br>
                <!-- [Company Contact Information] | <a href="#">Unsubscribe</a> or <a href="#">Manage Preferences</a> -->
            </p>
        </div>
    </div>
</body>
</html>
