<?php
    include __DIR__ . "/../user/emails/email_constant.php";
    
    if (isset($_GET['userId']) && $_GET['jobId']) {
        $userId = $_GET['userId'];
        $jobId = $_GET['jobId'];
        
        // query users data
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($query) > 0) {
            $userDetails = mysqli_fetch_assoc($query);
            $username = $userDetails['username'];
            $email = $userDetails['email'];
        }
        
        // fetch job's title
        $jobData = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
        if (mysqli_num_rows($jobData) > 0) {
            $jobDetails = mysqli_fetch_assoc($jobData);
            $jobTitle = $jobDetails['title'];
        }
        
        // $remove from submitted table
        $fetch = mysqli_query($connection, "SELECT * FROM submitted WHERE userId= '$userId' AND jobId= '$jobId'");
        if (mysqli_num_rows($fetch) > 0) {
            $data = mysqli_fetch_assoc($fetch);
            $file = $data['file'];
            $path = "../submited/" . $file;
            
            if ($path) {
                unlink($path);
            }
            
            $remove = mysqli_query($connection, "DELETE FROM submitted WHERE jobId= '$jobId' AND userId= '$userId'");
            if ($remove) {
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = "Update on Your Job Submission" . " -" . $jobTitle;
                $mail->Body = 
                    "
                        <html>
                            <body style='font-family: Arial, sans-serif; color: #333;'>
                                <div style='width: 80%; margin: auto;'>
                                    <img src='$logo' style='width: 100%' alt='aid-solution.com'>
                                </div>
                                <p style='margin-top: 30px'>Hello, $username,</p>
                                <p>Thank you for submitting your job file for review. Unfortunately, after careful consideration, we were unable to accept your file.</p>
                                <p>Please review the requirements and resubmit with any necessary adjustments. Should you need further clarification, feel free to reach out to our support team.</p>
                                <p style='margin-top: 15px'>Best regards,</p>
                                <b>The AID Solutions Team</b>
                            </body>
                        </html>
                ";
                $mail->send();
                if ($mail->send()) {
                    header('location: ' . URL . "admin/submitted.php");
                }
                
                else {
                    echo "mail wasnt sent successfully";
                }
            }
        }
    }
    
    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }