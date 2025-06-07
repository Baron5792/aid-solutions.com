<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>send email</title>
</head>
<body>
    <form action="./send_logic.php" method="POST">
        Email <input type="email" name="email" id=""> <br>
        Subject <input type="text" name="subject" id=""> <br>
        Message <input type="text" name="message" id=""> <br>
        <input type="submit" name="Send" value="Send">
    </form>
</body>
</html>