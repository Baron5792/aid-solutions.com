<?php
    include "../../database.php";

    if (isset($_POST['submit'])) {
        $track = $_POST['track'];
        $userId = $_POST['userId'];
        $resetCode = $_POST['resetCode'];

        $query = mysqli_query($connection, "SELECT * FROM reset WHERE userId= '$userId' ORDER BY date DESC LIMIT 1");
        if ($query) {
            if (mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_assoc($query);
                $savedCode = $data['resetCode'];
                $savedTrack = $data['track'];

                // compare both codes
                if ($savedTrack == $track && $resetCode == $savedCode) {
                    $_SESSION['response-success'] = "<b>Success! </b> The reset password code is correct. You can now proceed to reset your password.";
                    header('location: ' . URL . "account/reset/reset.php?user=$userId&&track=$track&&update=success");
                }

                else {
                    $_SESSION['response-error'] = "<b>Warning: </b>The reset password code you entered does not exist or has expired. Please request a new code.";
                }
            }

            else {
                $_SESSION['response-error'] = "<b>Error: </b> The reset password code you entered is incorrect. Please try again";
            }
        }

        else {
            $_SESSION['response-error'] = "No record(s) found";
        }

        if (isset($_SESSION['response-error'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    else {
        header('location: ' . URL . "account/login.php");
    }


    // check if code exists
    // check if its the last code
    // if successful delete track of user