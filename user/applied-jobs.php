<?php
    include "partials/header.php";
    $userId = $_SESSION['user']['id'];
?>

<script>
    document.getElementById("title_title").innerHTML = "Applied Jobs | aid-solutions";
</script>

<style>
    .appliedNotify {
        background-color: silver;
    }

    .menu-container {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
    }

    .menu {
        width: 100%;
    }

    .button-container {
        flex-shrink: 0;
    }
    
</style>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Applied Jobs</p>
    </div>
    <div class="menu-container">
        <div class="menu">
            <!-- Menu content here -->
        </div>
        <div class="button-container">
            <!-- display recent emails -->
            <div class="dropdown mt-3">
                <a href="<?= URL ?>user/delete-all-applied.php?id=<?= $userId ?>">
                    <button type="button" class="btn btn-danger w-100"> <span class="fa fa-trash-alt"></span> Delete All</button>
                </a>
            </div>
            
        </div
    </div>
</div>


<div class="container mt-3">
    <?php
        $fetch_jobs = mysqli_query($connection, "SELECT * FROM applied WHERE users_id= '$userId' AND status= 'Pending' ORDER BY date DESC LIMIT 15");
        if (mysqli_num_rows($fetch_jobs) > 0) {
            foreach ($fetch_jobs as $jobs) {
                $job_id = $jobs['job_id'];
                // fetch job details using job_id
                $queryJob = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id'");
                if (mysqli_num_rows($queryJob) == 1) {
                    $jobDetails = mysqli_fetch_assoc($queryJob);
                    $title = $jobDetails['title'];
                    $location = $jobDetails['location'];
                    $category = $jobDetails['category'];
                    $job_type = $jobDetails['schedule'];
                    $avatar = $jobDetails['avatar'];
                    $date = $jobDetails['date'];
                    $contact_name = $jobDetails['contact_name'];

                    // Convert the date to a DateTime object
                    $eventDateTime = new DateTime($date);
                    $currentDateTime = new DateTime();
        
                    // Calculate the difference
                    $interval = $currentDateTime->diff($eventDateTime);

                    // Determine the relative time
                    if ($interval->y > 0) {
                        $timeAgo = $interval->y . " year" . ($interval->y > 1 ? "(s)" : "") . " ago";
                    } 
                    
                    elseif ($interval->m > 0) {
                        $timeAgo = $interval->m . " month" . ($interval->m > 1 ? "(s)" : "") . " ago";
                    } 
                    
                    elseif ($interval->d > 7) {
                        $weeks = floor($interval->d / 7);
                        $timeAgo = $weeks . " week" . ($weeks > 1 ? "(s)" : "") . " ago";
                    } 
                    
                    elseif ($interval->d > 0) {
                        $timeAgo = $interval->d . " day" . ($interval->d > 1 ? "(s)" : "") . " ago";
                    } 
                    
                    elseif ($interval->h > 0) {
                        $timeAgo = $interval->h . " hour" . ($interval->h > 1 ? "(s)" : "") . " ago";
                    } 
                    
                    elseif ($interval->i > 0) {
                        $timeAgo = $interval->i . " minute" . ($interval->i > 1 ? "(s)" : "") . " ago";
                    } 
                    
                    else {
                        $timeAgo = $interval->s . " s" . ($interval->s > 1 ? "(s)" : "") . " ago";
                    }
                }
                
    ?>
                    <!-- jobs would be displayed here -->
                    <div class="row w-100 mt-0 mb-4">
                        <a href="<?= URL ?>user/job-view.php?job-id=<?= $job_id ?>" class="col-12 col-md-12 w-100 pt-2" style="text-decoration: none; border-right: 1px solid silver; border-top: 1px solid silver;">
                            <div class="d-flex">
                                <div class="col-md-3 col-5" class="job_image">
                                    <?php if (strlen($avatar) > 0): ?>
                                        <img src="<?= URL ?>assets/images/job/<?= $avatar ?>" alt="" style="width: 50%; height: 80px; border-radius: 50%;">
                                    <?php endif ?>
                                    <?php if (strlen($avatar) == 0): ?>
                                        <img src="<?= URL ?>assets/images/users_background/Freelancer - Hire & Find Jobs.jpeg" alt="" style="width: 50%; height: 80px; border-radius: 50%;">
                                    <?php endif ?>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12" style="font-weight: bold; font-family: sans-serif">
                                        <p class="text-dark"><?= $title ?></p>
                                    </div>
                                    <div class="job-infos col-md-9 row text-muted">
                                        <p class="text-info">@ <?= $contact_name ?> | </p>
                                        <p> <span class="fas fa-briefcase"></span> <?= $category ?> | </p>
                                        <p class=""> <span class="fas fa-map-marker-alt"></span> <?= $location ?> | </p>
                                        <p><span class="fas fa-clock"></span> <?= $timeAgo ?></p>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <button type="button" class="btn btn-info btn-sm col-md-12 col-12 mb-1"><?= $job_type ?></button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
    <?php
            }
        }  

        else {
    ?>
            <p>No record(s) found.</p>
    <?php
        }
    ?>
            
    
</div>

















<?php 
    include "partials/footer.php";
?>