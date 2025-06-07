<?php
    include __DIR__ . "/../database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>404 Error - Page Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2c3e50, #8e44ad);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 10rem;
            margin: 0;
            font-weight: bold;
            color: #ff6347;
        }
        h2 {
            font-size: 2rem;
            margin: 10px 0;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .robot {
            width: 200px;
            margin: 0 auto 30px auto;
            animation: float 3s ease-in-out infinite;
        }
        a {
            display: inline-block;
            padding: 15px 30px;
            background-color: #ff6347;
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #e94e1b;
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="https://i.imgur.com/qIufhof.png" alt="Broken Robot" class="robot">
        <h1>404</h1>
        <h2>Oops! Something went wrong.</h2>
        <p>The page you're looking for can't be found. It's probably on vacation!</p>
        <a href="<?= URL ?>user/dashboard">Go Back Home</a>
    </div>

</body>
</html>
