<?php
    require __DIR__ . "/../database.php";
    
    if (isset($_POST['loginBtn'])) {
        $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($username_email)) {
            $_SESSION['login'] = "Username or Email is required to proceed";
        }
        elseif (empty($password)) {
            $_SESSION['login'] = "A password is required";
        }
        else {
            $query = mysqli_query($connection, "SELECT * FROM users WHERE username= '$username_email' OR email= '$username_email'");
            if (mysqli_num_rows($query) == 1) {
                $details = mysqli_fetch_assoc($query);
                $dbpassword = $details['password'];
                // check for password
                if (password_verify($password, $dbpassword)) {
                    $_SESSION['user'] = $details;
                    header('location: ' . URL . 'user/dashboard');
                }
                else {
                    $_SESSION['login'] = "Incorrect Passord, please try again";
                }
            }
            else {  
                $_SESSION['login'] = "Incorrect email or username, try again";
            }
        }
        
        if (isset($_SESSION['login'])) {
            $_SESSION['login-data'] = $_POST;
            header('location: ' . URL . "account/login.php");
        }
        
    }

    else {
        header('location: ' . URL . "account/login.php");
    }
?>
