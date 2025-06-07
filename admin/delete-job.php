<?php
    include __DIR__ . "/../database.php";

    if (isset($_GET['id']))  {
        $job_id = $_GET['id'];

        // check if it exist in job table
        $check = mysqli_query($connection, "SELECT * FROM job WHERE id= '$job_id'");
        if (mysqli_num_rows($check) == 1) {
            // delete from job
            $job = mysqli_query($connection, "DELETE FROM job WHERE id= '$job_id'");
            if ($job) {
                // check if it exist in applied jobs table 
                $applied = mysqli_query($connection, "SELECT * FROM applied WHERE job_id= '$job_id'");
                if (mysqli_num_rows($applied) == 1) {
                    // delete from applied jobs
                    $applied_delete = mysqli_query($connection, "DELETE FROM applied WHERE job_id= '$job_id'");
                    if ($applied_delete) {
                        // delete from favorite jobs
                        $favorite = mysqli_query($connection, "SELECT * FROM favorite WHERE job_id= '$job_id'");
                        if (mysqli_num_rows($favorite) == 1) {
                            $favorite_delete = mysqli_query($connection, "DELETE FROM favorite WHERE job_id= '$job_id'");
                            
                            if ($favorite) {
                                $_SESSION['job-success'] = "Job has been successfully deleted from the three table";
                                header('location: ' . URL . 'admin/job.php');
                            }

                            else {
                                $_SESSION['applied-delete'] = "Wasn't deleted from favorite column";
                            }
                        }

                        else {
                            $_SESSION['applied-delete'] = "Job wasn't found in the favorite table";
                        }
                    }

                    else {
                        $_SESSION['applied-delete'] = "Couldn't delete from applied table";
                    }
                }

                else {
                    $_SESSION['applied-delete'] = "Job wasn't found in the appplied table";
                }
            }

            else {
                $_SESSION['job-delete'] = "Job wasn't deleted";
            }
        }

        else {
            echo "Job not found in job categories";
        }

        if (isset($_SESSION['job-delete'])) {
            $_SESSION['job-data'] = $_POST;
            header('location: ' . URL . 'admin/job.php');
        }

        elseif (isset($_SESSION['applied-delete'])) {
            $_SESSION['applied-delete'] = $_POST;
            header('location: ' . URL . 'admin/job.php');
        }

        elseif (isset($_SESSION['job-success'])) {
            header('location: ' . URL . 'admin/job.php');
        }


    }

    else {
        header('location: ' . URL . 'admin/job.php');
    }