<?php
    include __DIR__ . "/../database.php"; // Include your database connection here

if (isset($_GET['job-id']) && isset($_GET['user-id'])) {
    $job_id = intval($_GET['job-id']);
    $user_id = intval($_GET['user-id']);
    
    if ($job_id > 0 && $user_id > 0) {
        // Check if the job is already favorited by the user
        $checkFavorite = mysqli_query($connection, "SELECT * FROM favorites WHERE job_id = $job_id AND user_id = $user_id");
        
        if (mysqli_num_rows($checkFavorite) > 0) {
            // Remove from favorites
            $deleteFavorite = mysqli_query($connection, "DELETE FROM favorites WHERE job_id = $job_id AND user_id = $user_id");
            echo json_encode(['status' => 'removed']);
        } else {
            // Add to favorites
            $addFavorite = mysqli_query($connection, "INSERT INTO favorites (job_id, user_id) VALUES ($job_id, $user_id)");
            echo json_encode(['status' => 'added']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
    }
} 

else {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
}

