<?php
    include __DIR__ . "/../user/emails/email_constant.php";


    if (isset($_GET['userId']) && isset($_GET['jobId'])) {
        $userId = $_GET['userId'];
        $jobId = $_GET['jobId'];

        // insert into submitted track table
        $insertTrack = mysqli_query($connection, "INSERT INTO submitted_track (userId, jobId) VALUE ('$userId', '$jobId')");
        if ($insertTrack) {
            // fetch the job's salary
            $queryBal = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
            if (mysqli_num_rows($queryBal) > 0) {
                $jobDetails = mysqli_fetch_assoc($queryBal);
                $jobSalary = $jobDetails['salary_stop'];
                $jobTitle = $jobDetails['title'];

                
                $check = mysqli_query($connection, "SELECT * FROM submitted WHERE jobId= '$jobId' AND userId= '$userId' ORDER BY date DESC LIMIT 1"); 
                if (mysqli_num_rows($check) > 0) {
                    $update = mysqli_query($connection, "UPDATE submitted SET status= 'Accepted' WHERE userId= '$userId' AND jobId= '$jobId'");
                    if ($update) {
                        // fetch user and increment balance
                        $usersDet = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
                        if (mysqli_num_rows($usersDet) > 0) {
                            $details = mysqli_fetch_assoc($usersDet);
                            $balance = $details['balance'];
                            $email = $details['email']; 
                            $fullname = $details['firstname'] . " " . $details['lastname'];
                            $balance += $jobSalary;

                            $updateBal = mysqli_query($connection, "UPDATE users SET balance= '$balance' WHERE id= '$userId'");
                            if ($updateBal) {
                                // send email to the user 
                                $mail->addAddress($email);
                                $mail->isHTML(true);
                                $mail->Subject = "Congratulations! Your Submitted Work Has Been Accepted!";
                                $mail->Body = 
                                    "
                                        Dear " . " " . $fullname . ",<br>

                                        We are pleased to inform you that your submitted work for the" . " " . $jobTitle . " " . "job has been successfully reviewed and accepted by the client. Your dedication and efforts have paid off! <br>

                                        To claim your payment, please follow the steps below: <br>

                                        1. Log in to your account on AID-Solutions. , <br>
                                        2. Go to My profile page to withdraw your money <br>
                                        3. Follow the required procedures to initiate your payment request. <br> <br>

                                        It's important to complete the payment process as soon as possible. If you encounter any issues, our support team is here to assist you. <br>

                                        We appreciate your dedication and look forward to more great work from you! <br> <br>

                                        Best regards, <br>
                                        AID Solutions Team
                                    "
                                    ;
                                $mail->send();

                                if ($mail->send()) {
                                    header('location: ' . URL . "admin/submitted.php");
                                }
                                else {
                                    echo "An error occurerd please try again";
                                }
                            }

                            else {
                                echo "users balance wasn't incremented";
                            }
                        }

                    }

                    else {
                        echo "Status wanst accepted";
                    }
                }

                else {
                    echo "Users application not found";
                }
                
            }

            else {
                echo "Job wasn't found";
            }
        }
        else {
            echo "Couldn't insert into submitted track";
        }

        
    }
    else {
        header('location: ' . URL . 'admin/manage-users.php');
    }

