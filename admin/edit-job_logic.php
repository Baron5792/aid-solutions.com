<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['submit'])) {
        $job_id = $_POST['job_id'];
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $skill = filter_var($_POST['skill'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $experience = filter_var($_POST['experience'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $contact_name = filter_var($_POST['contact_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $contact_email = filter_var($_POST['contact_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $salary_start = filter_var($_POST['salary_start'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $salary_stop = filter_var($_POST['salary_stop'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $location = filter_var($_POST['location'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $deadline = filter_var($_POST['deadline'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $job_type = filter_var($_POST['job_type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $applications = $_POST['applications'];

        $update = mysqli_query($connection, "UPDATE job SET title= '$title', description= '$description', skills= '$skill', experience= '$experience', salary_stop= '$salary_stop', location= '$location', deadline= '$deadline', schedule= '$job_type', category= '$category', contact_name= '$contact_name', contact_email= '$contact_email', applications= '$applications' WHERE id= '$job_id'");

        if ($update) {
            $_SESSION['edit-success'] = "Job no." . $job_id . " " . "has been updated successfully";
            header('location: ' . URL . 'admin/job.php');
        }

        else {
            echo "error has occured during update, try again";
        }

    }

    else {
        header('location: ' . URL . 'admin/edit-job.php');
    }