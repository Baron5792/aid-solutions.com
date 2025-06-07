<?php
    include __DIR__ . "/../user/emails/email_constant.php";

    if (isset($_GET['id']) && isset($_GET['user'])) {
        $id = $_GET['id'];  // ID in the applied table
        $userId = $_GET['user'];  // user's ID

        // send an email to the user
        // update "rejected" in the DB of the applied job row

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

                    $title = "Update on Your Application for" . " " . $jobTitle;
                    $message = "Dear" . " " . $fullname . ",<br><br>" . "Thank you for your interest in the" . " <b>" . $jobTitle . "</b> " . "position at aid-solutions.com. After reviewing your application, we regret to inform you that it does not meet the specific qualifications we are looking for at this time. <br><br>" . "We appreciate the time and effort you put into your application and encourage you to apply for future opportunities that match your skills and experience. <br><br>" . "We wish you the best of luck in your job search and future endeavors.<br><br>". "Best regards,<br>" . "The aid-solutions.com Team";


                    $sendMail = mysqli_query($connection, "INSERT INTO users_email (user_id, job_id, title, message) VALUE ('$userId', '$jobId', '$title', '$message')");
                    if ($sendMail) {
                        // updatre the applied column tabel
                        $updateApplied = mysqli_query($connection, "UPDATE applied SET status= 'Rejected' WHERE id= '$id'");
                        if ($updateApplied) {

                            // delete from apllied table inorder not to apply for a job twice
                            $declineApplied = mysqli_query($connection, "DELETE FROM applied WHERE users_id= '$userId' AND job_id= '$jobId'");
                            if ($declineApplied) {
                                $mail->addAddress($email);
                                $mail->isHTML(true);
                                $mail->Subject = "Your Job Application Status";
                                $mail->Body = "<b>Dear " . " " . $fullname . "</b>," . "<br><br>
                                        Thank you for your interest in the" . " " . $jobTitle . " " .  "position at aid-solutions.com. We appreciate the time and effort you put into your application and the opportunity to learn more about your qualifications." . "<br>" . "
                                        After careful consideration, we regret to inform you that we will not be progressing with your application at this time. This decision was a difficult one given the number of qualified candidates we had for this position." . "<br>" . "
                                        We encourage you to apply for future openings that match your skills and interests, as we were impressed with your application and believe you could be a fit for other roles within aid-solutions.com." . "<br>" . "
                                        Thank you once again for your interest in joining our team. We wish you the best of luck in your job search and future endeavors." . "<br><br>" . "
                                        Best regards," . "<br>" . "

                                        aid-solutions.com" . "<br>" . "
                                        info@aid-solutions.com
                                    ";
                                $mail->send();
                                if ($mail->send()) {
                                    $_SESSION['success'] = "Job application has been rejected successfully";
                                    header('location: ' . URL . "admin/applied-job.php");
                                }
                                
                                else {
                                    echo "error 400.";
                                }
                            }

                            else {
                                echo "Error during update try again";
                            }
                        }

                        else {
                            echo "Error during update try again";
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