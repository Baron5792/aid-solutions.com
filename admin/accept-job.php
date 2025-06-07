<?php
    // include __DIR__ . "/../database.php";
    include __DIR__ . "/../user/emails/email_constant.php";

    if (isset($_GET['id']) && isset($_GET['user'])) {
        $id = $_GET['id'];  // ID in the applied table
        $userId = $_GET['user'];  // user's ID

        // send an email to the user
        // update "accepted" in the DB

        // fetch users name
        $queryUser = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($queryUser) == 1)  {
            $userData = mysqli_fetch_assoc($queryUser);
            $fullname = $userData['firstname'] . " " . $userData['lastname'];
            $email = $userData['email'];

            $queryId = mysqli_query($connection ,"SELECT * FROM applied WHERE id= '$id'");
            if (mysqli_num_rows($queryId) == 1) {
                $appliedData = mysqli_fetch_assoc($queryId);
                $jobId = $appliedData['job_id'];

                // query for the job's title
                $queryJob = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
                if (mysqli_num_rows($queryJob) == 1) {
                    $jobData = mysqli_fetch_assoc($queryJob);
                    $jobTitle = $jobData['title'];

                    $title = "Congratulations! Your Job Application Has Been Accepted";
                    $message = "Dear" . " " . $fullname . ",<br><br>" . "We are thrilled to inform you that your application for the" . " <b>" . $jobTitle . "</b> " . "position has been accepted! 🎉 <br><br>" . "Your skills and experience stood out to our team, and we believe you will be a great fit for the role. We are excited to welcome you on board and look forward to working with you.<br><br>" . "To get started with the next steps, please visit the Job Alert Page where you can chat directly with the job owner for more information about the role and any further instructions.<br><br>" . "We wish you the best of luck in your new role!<br><br>" . "Best regards,<br>" . "The aid-solutions.com Team";


                    $sendMail = mysqli_query($connection, "INSERT INTO users_email (user_id, job_id, title, message) VALUE ('$userId', '$jobId', '$title', '$message')");
                    if ($sendMail) {
                        // updatre the applied column tabel
                        $updateApplied = mysqli_query($connection, "UPDATE applied SET status= 'Accepted' WHERE id= '$id'");
                        if ($updateApplied) {
                            // insert into job_alert table
                            $jobAlert = mysqli_query($connection, "INSERT INTO job_alert (user_id, job_id) VALUE ('$userId', '$jobId')");
                            if ($jobAlert) {
                                $mail->addAddress($email);
                                $mail->isHTML(true);
                                $mail->Subject = "Congratulations! Your Job Application Has Been Accepted";
                                $mail->Body = 
                                    "
                                        <b>Dear " . " " . $fullname . ",</b> <br><br>

                                        We are thrilled to inform you that your application for the job position of" . " <b>" . $jobTitle . "</b> " . "has been accepted! <br><br>

                                        <b>What's Next?</b> <br>

                                        To help you get started, please visit the Accepted Job's Page where you can chat with the job owner for more information and discuss the next steps. <br>

                                        If you have any questions or need further assistance, feel free to reach out to our support team at support@aid-solutions.com or visit our Help Center. <br>

                                        Congratulations again on this achievement! We look forward to seeing your success on AID. <br><br>

                                        Best regards, <br>

                                        The AID Team <br>
                                        aid-solutions.com <br>
                                        support@aid-solutions.com
                                    ";
                                    $mail->send();
                                    $_SESSION['success'] = "Job application has been accepted successfully";
                                    header('location: ' . URL . "admin/applied-view.php?id=$id");
                            }
                        }

                        else {
                            echo "Error during update try again";
                            exit();
                        }


                    }

                    else {
                        echo "Error during insertion in the users_email table report to collins asap";
                    }
                }
            }

        }
    }

    else {
        header('location: ' . URL . "admin/applied-view?id=$id");
    }