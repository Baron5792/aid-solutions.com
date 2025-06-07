<?php
    include __DIR__ . '/../database.php';


    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $salary = $_POST['salary'];
        $userId = $_POST['userId'];
        $jobId = $_POST['jobsId'];
        $message = htmlspecialchars($_POST['message']);

        if (empty($title) || empty($salary) || empty($message)) {
            $_SESSION['request_error'] = "All input fields are required to proceed";
        }

        else {
            $query_user  = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
            if (mysqli_num_rows($query_user) > 0) {
                $details = mysqli_fetch_assoc($query_user);
                $resume = $details['resume'];
                $cover_letter = $details['cover_letter'];

                if (empty($resume) || empty($cover_letter)) {
                    $_SESSION['request_error'] = "A resume and cover letter is required to submit this form";
                } 
                
                else {
                    // fetch the title of the job
                    $checkJob = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
                    $info = mysqli_fetch_assoc($checkJob);
                    $applyingJob_title = $info['title'];
                    $PreviousApplication = $info['applications'];
                    $currentApplication = $PreviousApplication + 1;
                    $job_title = "Application Confirmation: " . $applyingJob_title;
                    $email_message = "Thank you for applying for the" . " " . $title . " " . "Job. We have received your application and our team is reviewing it; if your profile matches our requirements, we will contact you for the next steps.";

                    // Insert into their email
                    $insertEmail = mysqli_query($connection, "INSERT INTO users_email (user_id, job_id, title, message) VALUES ('$userId', '$jobId', '$job_title', '$email_message')");

                    if ($insertEmail) {
                        // Insert the application into the database
                        $insertApplication = mysqli_query($connection, "INSERT INTO applied (users_id, job_id, title, salary, message, status) VALUES ('$userId', '$jobId', '$title', '$salary', '$message', 'Pending')");
                        if ($insertApplication) {
                            // insert into the applications column
                            $app = mysqli_query($connection, "UPDATE job SET applications= '$currentApplication' WHERE job_id= '$jobId'");
                            if ($app) {
                                $_SESSION['request_success'] = "<b>Success! </b> Your application has been submitted. We will notify you of any updates. Good luck!";
                                header('location: ' . $_SERVER['HTTP_REFERER']);
                            }
                        } else {
                            $_SESSION['request_error'] = "Error occured during update, please try again";
                        }
                    } else {
                        $_SESSION['request_error'] = "Error during insertion, please try again";
                    }
                }
            }

            else {
                $_SESSION['request_error'] = "No user found with this ID";
            }
        }

        if (isset($_SESSION['request_error'])) {
            $_SESSION['request_data'] = $_POST;
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }

    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    