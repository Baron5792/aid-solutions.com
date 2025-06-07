<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['survey_check'])) {
        $score = $_POST['score'];
        $users_id = $_POST['users_id'];


        if ($score < 5) {
            header('location: ' . URL . "user/survey-score-display.php?survey=failed");
        } 

        else {
            header('location: ' . URL . "user/survey-score-display.php?survey=success");
        }
    }

    else {
        header('location: ' . URL . 'user/dashboard.php');
    }