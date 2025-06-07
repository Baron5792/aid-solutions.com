<?php
    include __DIR__ . "/./emails/email_constant.php";

    if (isset($_POST['send'])) {
        $userId = $_POST['userId'];
        $jobId = $_POST['jobId'];
        $file = $_FILES['file'];

        if (empty($file['name'])) {
            $_SESSION['file_error'] = "A file should be selected to proceed";
        }

        else {
            $time = time();
            $file_name = $time . $file['name'];
            $location = "../submited/" . $file_name;
            $tmp_name = $file['tmp_name'];

            // allowed files format
            $allowed_files = ['pdf', 'doc', 'docx', 'odt', 'txt', 'rtf', 'ppt', 'pptx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'mp4', 'avi', 'mov', 'wmv', 'mp3', 'wav', 'ogg', 'aac', 'zip', 'rar', '7z', 'html', 'htm', 'css', 'js', 'php', 'json', 'xml', 'psd', 'ai', 'indd', 'sketch', 'csv', 'sql', 'md'];
            $extension = explode('.', $file_name);
            $extension = end($extension);

            if (in_array($extension, $allowed_files)) {
                move_uploaded_file($tmp_name, $location);
                $insert = mysqli_query($connection, "INSERT INTO submitted (userId, jobId, file, status) VALUE ('$userId', '$jobId', '$file_name', 'pending')");
                if ($insert) {
                    $file_message = "Sent: " . $file_name;
                    // add up in chat with user
                    $insertChat = mysqli_query($connection, "INSERT INTO chat (user_id, job_id, message, track) VALUE ('$userId', '$jobId', '$file_message', '1')");
                    if ($insertChat) {
                        // insert into email
                        // query for users email address
                        $emailQuery = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
                        if (mysqli_num_rows($emailQuery) > 0) {
                            $emailData = mysqli_fetch_assoc($emailQuery);
                            $userEmail = $emailData['email']; 
                            $userName = $emailData['username'];

                            // query the job title
                            $titleQuery = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
                            if (mysqli_num_rows($titleQuery) > 0) {
                                $titleData = mysqli_fetch_assoc($titleQuery);
                                $jobTitle = $titleData['title'];
                            }
                        }
                        
                        $mail->addAddress($userEmail);
                        $mail->isHTML(true);
                        $mail->Subject = "File Submission Confirmation for Job: " . $jobTitle;
                        $mail->Body = "
                            <h2>Hi " . $userName . ",</h2>
                            <p>Thank you for submitting your file for the job <b>" . $jobTitle . "</b>.</p>
                            <p>We have received your submission and will review it shortly. You can check the status of your submission by logging into your account.</p>
                            <p>If you have any questions, feel free to contact our support team.</p>
                            <p>Best Regards,<br>
                            The AID Team</p>    
                        ";        
                        
                        $mail->send();

                        if ($mail->send()) {
                            $_SESSION['file_success'] = "<b>Success!</b> Your job has been submitted successfully. Our team at AID Solutions will review it shortly, and you'll be notified once it's approved. Thank you for using AID Solutions!";
                            header('location: ' . $_SERVER['HTTP_REFERER']);
                        }

                    }

                    else {
                        $_SESSION['file_error'] = "Oops! Something went wrong, and we couldn't submit your job. Please try again, or contact AID Solutions support if the issue persists";
                    }
                }

                else {
                    $_SESSION['file_error'] = "Oops! Something went wrong, and we couldn't submit your job. Please try again, or contact AID Solutions support if the issue persists";
                }
            }

            else {
                $_SESSION['file_error'] = "The file you uploaded isn't in a supported format. Please ensure your file has one of the following extensions: [<b>'.pdf', '.doc', '.docx', '.odt', '.txt', '.rtf', '.ppt', '.pptx', '.xls', '.xlsx', '.jpg', '.jpeg', '.png', '.gif', '.bmp', '.svg', '.mp4', '.avi', '.mov', '.wmv', '.mp3', '.wav', '.ogg', '.aac', '.zip', '.rar', '.7z', '.html', '.htm', '.css', '.js', '.php', '.json', '.xml', '.psd', '.ai', '.indd', '.sketch', '.csv', '.sql', '.md'</b>]";
            }
        }

        if (isset($_SESSION['file_error'])) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }