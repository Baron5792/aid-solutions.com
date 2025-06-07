<?php
    include __DIR__ . "/../user/emails/email_constant.php";


    if (isset($_POST['register'])) {
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // test for null value
        $date_of_birth = filter_var($_POST['date_of_birth'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $country_name = filter_var($_POST['country_display'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // test for null value
        $country_code = filter_var($_POST['country_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $schedule = filter_var($_POST['schedule'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // test select inputs
        $experience = filter_var($_POST['experience'], FILTER_SANITIZE_FULL_SPECIAL_CHARS); // test selected input values
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sector = filter_var($_POST['sector'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ref_code = filter_var($_POST['ref_code'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $phone_number = $country_code . $phone;
        $country_display = filter_var($_POST['country_display'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ip = htmlspecialchars($_POST['ip']);
        $ip_region = htmlspecialchars($_POST['ip_region']);
        $ip_country = htmlspecialchars($_POST['ip_country']);
        $referral_code = htmlspecialchars($_POST['referral_code']);


        if (!preg_match('`[a-z]`', $password)) {
            $_SESSION['register'] = "Password must have at least one lowercase!";
        }
        
        elseif (empty($email)) {
            $_SESSION['register'] = "An email address is required to proceed";
        }
        
        elseif ($sector == 0) {
            $_SESSION['register'] = "A job sector is required to proceed";
        }

        elseif (!preg_match('`[0-9]`', $password)) {
            $_SESSION['register'] = "Password must have one number!";
        }


        else {
            // check for username
            // check for email
            // hash password
            $query = mysqli_query($connection, "SELECT * FROM users WHERE email= '$email'");
            if (mysqli_num_rows($query) > 0) {
                $_SESSION['register'] = "This email address already exists, please try again";
            }

            else {
                $check_username = mysqli_query($connection, "SELECT * FROM users WHERE username= '$username'");
                if (mysqli_num_rows($check_username) > 0) {
                    $_SESSION['register'] = "Username already exists, please try again";
                }

                else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // check if referral code is valid
                    $check_refCode = mysqli_query($connection, "SELECT * FROM users WHERE ref_code= '$referral_code' LIMIT 1");
                    if (mysqli_num_rows($check_refCode) == 1) {
                        $refData = mysqli_fetch_assoc($check_refCode);
                        $refererEmail = $refData['email'];
                        $refererName = $refData['firstname'] . " " . $refData['lastname'];
                        
                        $insert = mysqli_query($connection, "INSERT INTO users (firstname, lastname, username, email, gender, date_of_birth, country, phone, sector, address, zipcode, schedule, years_of_experience, password, balance, ref_code, referer, ip, ip_country, ip_region) VALUE ('$firstname', '$lastname', '$username', '$email', '$gender', '$date_of_birth', '$country_display', '$phone_number', '$sector', '$address', '$zipcode', '$schedule', '$experience', '$hashed_password', '0.00', '$ref_code', '$referral_code', '$ip', '$ip_country', '$ip_region')");

                        if ($insert) {
                            // $mail->addAddress($email);
                            // $mail->isHTML(true);
                            // $mail->Subject = "Welcome to AID – Start Your Freelance Journey Today!";
                            // $mail->Body = "
                            //     <html>
                            //         <body>
                            //             <div style='width: 80%; margin: auto; margin-botton: 30px;'>
                            //                 <img src='$logo' alt='Logo' style='width: 100%'>
                            //             </div>
                                    
                            //             <p>Hello $username,</p>
                                        
                            //             <p>Welcome to <b>AID Solutions!</b></p>
                                        
                            //             <p>Thank you for joining our community of talented freelancers. At AID, we’re committed to providing you with a platform where you can find rewarding work, grow your skills, and connect with clients globally.</p>
                                        
                            //             <b>Here’s How to Get Started:</b>
                                        
                            //             <p>1. <b>Complete Your Profile</b> - Add skills and experience to stand out.</p>
                            //             <p>2. <b>Explore Job Categories</b> - Find work suited to your expertise.</p>
                            //             <p>3. <b>Apply with Confidence</b> - Submit quality proposals to match with clients.</p> <br>
                                        
                            //             <p>Best Regards,</p>
                            //             <b>The AID Solutions Team</b>
                            //         </body>
                            //     </html>
                            // ";
                            // $mail->send();
                            // if ($mail->send()) {
                                $_SESSION['register-success'] = "Congratulation, you can now log in!!!";
                                header("location: " . URL . "account/login");
                            // }

                            // else {
                            //     header('location: ' . URL . 'error/error');
                            // }

                        }

                        else {
                            $_SESSION['register'] = "Error during INSERTION, please try again";
                        }
                    }

                    else {
                        $_SESSION['register'] = "<strong>Error:</strong> The referral code you entered is incorrect. Please check the code and try again.";
                    }

                }
            }
        }

        if (isset($_SESSION['register'])) {
            $_SESSION['register_data'] = $_POST;
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
        
    }




    else {
        header("location: " . URL . "account/login.php");
    }



