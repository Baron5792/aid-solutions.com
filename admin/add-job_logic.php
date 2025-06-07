<?php
    include __DIR__ . "/../database.php";

    if (isset($_POST['submit'])) {
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
        $image = $_FILES['avatar'];
        $job_id = $_POST['job_id'];



        if (empty($title) || empty($description) || empty($skill) || empty($contact_name) || empty($contact_email) || empty($salary_stop) || empty($location) || empty($deadline)) {
            $_SESSION['add'] = "Check empty input's and try again";
        }

        elseif ($experience == "null") {
            $_SESSION['add'] = "An experience level wasn't selected";
        }

        else {
            if (strlen($image['name']) > 0) {
                $time = time();
                $image_name = $time . $image['name'];
                $tmp_name = $image['tmp_name'];
                $destination = "../assets/images/job/" . $image_name;
                // check if its in array
                $allowed_files = ['jpg', 'jpeg', 'png'];
                $extension = explode('.', $image_name);
                $extension = end($extension);

                if (in_array($extension, $allowed_files)) {
                    move_uploaded_file($tmp_name, $destination);

                    // check if job id already exists in the database
                    $checkId = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id'");
                    if (mysqli_num_rows($checkId) > 0) {
                        $_SESSION['add'] = "Job ID exists in the database, reload the page and try again";
                    }

                    else {
                        $insert = mysqli_query($connection, "INSERT INTO job (job_id, title, description, skills, experience, salary_stop, location, deadline, schedule, category, contact_name, contact_email, avatar) VALUE ('$job_id', '$title', '$description', '$skill', '$experience', '$salary_stop', '$location', '$deadline', '$job_type', '$category', '$contact_name', '$contact_email', '$image_name')");

                        if ($insert) {
                            $_SESSION['success'] = "Job has been posted successfully";
                            header('location: ' . URL . 'admin/job.php');
                        }

                        else {
                            $_SESSION['add'] = "Error during posting, try again";
                        }
                    }
                }
            }

            else {
                // check if job id already exists in the database
                $checkId = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id'");
                if (mysqli_num_rows($checkId) > 0) {
                    $_SESSION['add'] = "Job ID exists in the database, reload the page and try again";
                }

                else {
                    $insert = mysqli_query($connection, "INSERT INTO job (job_id, title, description, skills, experience, salary_stop, location, deadline, schedule, category, contact_name, contact_email) VALUE ('$job_id', '$title', '$description', '$skill', '$experience', '$salary_stop', '$location', '$deadline', '$job_type', '$category', '$contact_name', '$contact_email')");

                    if ($insert) {
                        $_SESSION['success'] = "Job has been posted successfully";
                        header('location: ' . URL . 'admin/job.php');
                    }

                    else {
                        $_SESSION['add'] = "Error during posting, try again";
                    }
                }
            }
        }

        if (isset($_SESSION['add'])) {
            $_SESSION['add-error'] = $_POST;
            header('location: ' . URL . 'admin/add-job.php');
            die;
        }
    }

    else {
        header('location: ' . URL . 'admin/add-job.php');
    }