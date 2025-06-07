<?php
    include __DIR__ . "/../database.php";

    if (isset($_GET['userId']) && isset($_GET['jobId'])) {
        $userId = $_GET['userId'];
        $jobId = $_GET['jobId'];

        // delete job from DB
        $delete = mysqli_query($connection, "DELETE FROM applied WHERE users_id= '$userId' AND job_id= '$jobId'");
        if ($delete) {
            header('location: ' . URL . "user/job-view.php?job-id=$jobId");
        }

        else {
            header('location: ' . URL . "user/job-view.php?job-id=$jobId");
        }
    }

    else {
        header('location: ' . URL . 'account/login.php');
    }



