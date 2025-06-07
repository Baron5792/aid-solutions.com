<?php
    function isFavorite($job_id, $user_id) {
        global $connection;
        $result = mysqli_query($connection, "SELECT * FROM favorites WHERE job_id = $job_id AND user_id = $user_id");
        return mysqli_num_rows($result) > 0;
    }

