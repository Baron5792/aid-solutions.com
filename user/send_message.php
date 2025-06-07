<?php
    include __DIR__ . '/./emails/email_constant.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $userId = $input['user_id'];
        $jobId = $input['job_id'];
        $message = $input['message'];
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $fullname = $data['firstname'] . " " . $data['lastname'];
            $email = $data['email'];
            $country = $data['country'];
        }

        // Validate inputs
        if (!empty($userId) && !empty($jobId) && !empty($message)) {
            // send an email
        
            $message = mysqli_real_escape_string($connection, $message);
            $insert = "UPDATE users SET message_track= '1' WHERE id= '$userId'";
            if (mysqli_query($connection, $insert)) {
                $query = "INSERT INTO chat (user_id, job_id, message, track, date) VALUES ('$userId', '$jobId', '$message', '1', NOW())";
                if (mysqli_query($connection, $query)) {
                    echo json_encode([
                        'success' => true,
                        'time' => date('h:i A') // Return the current time to display with the message
                    ]);
                    }  else{
                        echo json_encode(['success' => false]);
                    }
                } else {
                    echo json_encode(['success' => false]);
                }
            } else {
                echo json_encode(['success' => false]);
            }
           
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
