<?php
    include __DIR__ . "/../database.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $date_of_birth = filter_var($_POST['date_of_birth'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sector = filter_var($_POST['sector'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $salary = filter_var($_POST['salary'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $facebook = filter_var($_POST['facebook'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $twitter = filter_var($_POST['twitter'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $dribble = filter_var($_POST['dribble'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $linkedin = filter_var($_POST['linkedin'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $state = filter_var($_POST['state'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $users_id = $_POST['users_id'];
        $salary_mode = $_POST['salary_mode'];


        if (empty($firstname)) {
            $_SESSION['profile'] = "First Name shouldn't be empty";
        }

        elseif (empty($lastname)) {
            $_SESSION['profile'] = "Last Name shouldn't be empty";
        }

        elseif (empty($email)) {
            $_SESSION['profile'] = "An email address is required to proceed";
        }

        elseif (empty($phone)) {
            $_SESSION['profile'] = "A valid phone number is required";
        }

        elseif (empty($state)) {
            $_SESSION['profile'] = "A state is required";
        }

        elseif (empty($zipcode)) {
            $_SESSION['profile'] = "Postal code shouldn't be empty";
        }

        else {
            // check if email already exists
            $query = mysqli_query($connection, "SELECT * FROM users WHERE email= '$email'");
            if (mysqli_num_rows($query) > 1) {
                $_SESSION['profile'] = "Email already exist, please try again";
            }

            else {
                // update the user
                $update = mysqli_query($connection, "UPDATE users SET firstname= '$firstname', lastname= '$lastname', email= '$email', phone= '$phone', sector= '$sector', salary= '$salary', salary_mode= '$salary_mode', facebook= '$facebook', twitter= '$twitter', dribble= '$dribble', linkedin= '$linkedin', state= '$state', zipcode= '$zipcode', date_of_birth= '$date_of_birth' WHERE id= '$users_id'");

                if ($update) {
                    $_SESSION['profile-success'] = "Your profile has been updated successfully";
                    header('location: ' . URL . 'user/my-profile.php');
                }

                else {
                    $_SESSION['profile'] = "Profile wasn't updated successfully";
                }
            }
        }

        if (isset($_SESSION['profile'])) {
            $_SESSION['profile_data'] = $_POST;
            header('location: ' . URL . 'user/my-profile.php');
        } 



    }

    else {
        header('location: ' . URL . 'user/my-profile.php');
    }