<?php
    include "partials/header.php";
?>

<script>
    document.getElementById("title_title").innerHTML = "Emails | aid-solutions";
</script>

<style>
    .emailNotify {
        background-color: silver;
    }
</style>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Emails</p>
    </div>
</div>

    <!-- check if there's an email -->
<div class="container">
    <?php
        $email = mysqli_query($connection, "SELECT * FROM users_email WHERE user_id= '$id' ORDER BY date DESC LIMIT 40");
        if (mysqli_num_rows($email) > 0) {
            foreach ($email as $key) {
                $job_id = $key['job_id']; 
                $message = $key['message'];
                $date = $key['date'];
                $email_title = $key['title']; 
                $title = $key['title'];
                $date = $key['date'];

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
                    $timeAgo = $interval->s . " second" . ($interval->s > 1 ? "(s)" : "") . " ago";
                }
                // query for job details
                $query_job = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id'");
                if (mysqli_num_rows($query_job) == 1) {
                    $details = mysqli_fetch_assoc($query_job);
    ?>
                    <div class="container mt-3" style="border-right: 1px solid silver; border-bottom: 1px solid silver">
                        <div class="row">
                            <div class="col-10 col-md-11">
                                <p style="text-transform:capitalize; font-weight: bold;"><?= $title ?></p>
                                <p style="font-size: small;"><?= $message ?></p>
                                <p style="font-size:small;"><?= $timeAgo ?></p>
                            </div>
                            <p class="col-2 col-md-1">
                                <i class="fa fa-info-circle text-warning mt-3 mb-3 mr-1"></i>
                            </p>
                        </div>
                    </div>

                
    <?php
                }


            }
        }
        else {
    ?>
            <!-- if no alert is found -->
            <div class="container mt-3">
                <p>No record found.</p>
            </div>
    <?php
        }
    ?>

</div>













<?php 
    include "partials/footer.php";
?>