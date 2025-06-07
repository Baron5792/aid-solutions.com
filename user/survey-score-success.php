<?php
    include __DIR__ . "/./emails/email_constant.php";


    if (isset($_POST['proceed'])) {
        $id = $_POST['users_id'];

        // insert into users eligibitlity table
        $update = mysqli_query($connection, "UPDATE users SET eligibility= '1' WHERE id= '$id'");
        if ($update) {
            $request = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
            if (mysqli_num_rows($request) > 0) {
                $data = mysqli_fetch_assoc($request);
                $email = $data['email'];
                $firstname = $data['firstname'];

                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Congratulations! You're Now Ready to Access Job Opportunities on AID Solutions";
                $htmlContent = file_get_contents('./emails/survey.php');
                // Replace the {{firstname}} placeholder with the actual first name
                $htmlContent = str_replace('{{firstname}}', $firstname, $htmlContent);
                $mail->Body = $htmlContent;

                $mail->send();

                if ($mail->send()) {
                    header('location: ' . URL . 'user/dashboard.php');
                }
            }

        }

        else {
            header('location: ' . URL . 'user/survey-test.php');
        }
    }

    else {
        header('location: ' . URL .  'user/dashboard.php');
    }