<?php
    include __DIR__ . "/./partials/header.php";
    $userId = $_SESSION['user']['id'];
?>
<style>
    .dashNotify {
        background-color: silver;
    }

    .contents {
        display: none;
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>

    $(document).ready(function() {
        $(".dropdown-toggle").click(function() {
            $(".contents").toggle(100);
        })
    })

    document.getElementById("title_title").innerHTML = "Dashboard | aid-solutions";


  </script>


<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Dashboard</p>
    </div>

    <!-- display recent emails -->
    <div class="menu-container">
        <div class="menu">
            <!-- Menu content here -->
        </div>
        <div class="button-container">
            <!-- display recent emails -->
            <div class="dropdown mt-3">
                <button type="button" class="btn btn-info dropdown-toggle w-100" data-toggle="dropdown">
                    View Recent Email
                </button>
            </div>
            
        </div>
    </div>
</div>

<div class="container dash_con" style="border-bottom: none;">
    <!-- dropdown content -->
    <div class="contents">
        <div class="container">
            <?php
                $email = mysqli_query($connection, "SELECT * FROM users_email WHERE user_id= '$id' ORDER BY date DESC LIMIT 1");
                if (mysqli_num_rows($email) > 0) {
                    foreach ($email as $key) {
                        $job_id = $key['job_id'];
                        $message = $key['message'];
                        $date = $key['date'];
                        $title = $key['title']; 
                        // query for job details
                        $query_job = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id'");
                        if (mysqli_num_rows($query_job) == 1) {
                            $details = mysqli_fetch_assoc($query_job);
                            // $title = $details['title'];
            ?>
                            <div class="w-100 mt-3" style="border-right: 1px solid silver; border-bottom: 1px solid silver;">
                                <div class="row">
                                    <div class="col-10 col-md-11">
                                        <p style="text-transform:capitalize; font-weight: bold;"><?= $title ?></p>
                                        <p style="font-size: small;"><?= $message ?></p>
                                    </div>
                                    <p class="col-2 col-md-1">
                                        <i class="fa fa-info-circle mt-3 mb-3 mr-1 text-warning"></i>
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
                        <p>No email found.</p>
                    </div>
            <?php
                }
            ?>

        </div>
    </div>
</div>



<div class="col-12 col-md-12 dash_heaer_con mt-5">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Statistics</p>
    </div>
    
        <div class="col-12 col-md-12 pt-4">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 col-md-4" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding-top: 30px; text-align:center;">
                    <p class="stats_header text-warning">Applied Jobs</p>
                    <?php
                        $queryApplied = mysqli_query($connection, "SELECT * FROM applied WHERE users_id= '$userId'");
                        if (mysqli_num_rows($queryApplied) > 0) {
                            $applied = mysqli_num_rows($queryApplied);
                        }
                        else {
                            $applied = "0";
                        }
                    ?>
                    <p class="stats_score text-warning"><?= $applied ?></p>
                    <p class="stats_text">to get a career</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-md-4" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding-top: 30px; text-align:center;">
                    <p class="stats_header text-primary">Favorite Jobs</p>
                    <?php 
                        $queryFav = mysqli_query($connection, "SELECT * FROM favorites WHERE user_id= '$userId'"); 
                        if (mysqli_num_rows($queryFav) > 0) {
                            $favorite = mysqli_num_rows($queryFav);
                        }
                        else {
                            $favorite = "0";
                        }
                    ?>  
                    <p class="stats_score text-primary"><?= $favorite ?></p>
                    <p class="stats_text">among others</p>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-md-4" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding-top: 30px; text-align:center;">
                    <p class="stats_header text-success">Job Alerts</p>
                    <?php
                        $queryAlert = mysqli_query($connection, "SELECT * FROM job_alert WHERE user_id= '$userId'");
                        if (mysqli_num_rows($queryAlert) > 0) {
                            $alert = mysqli_num_rows($queryAlert);
                        } else {
                            $alert = "0";
                        }
                    ?>
                        <p class="stats_score text-success"><?= $alert ?></p>
                    <p class="stats_text">for an update</p>
                </div>
            </div>
        </div>
</div>




<!-- Statistics graph -->
<?php
    include __DIR__ . "/./statistics.php";
?>





<!-- survey test -->
<div class="col-12 col-md-12 dash_heaer_con mt-5">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Avaialbale Jobs</p>
    </div>


    <?php
        if ($eligibility == 0) {
    ?>
            <!-- if profile is'nt complete -->
            <div class="row">
                <button class="btn  col-12 col-md-3" disabled>
                    <span class="spinner-grow spinner-grow-sm text-danger"></span>
                </button>
                <p class="col-12 col-md-9 pt-3" style="font-size: 15px">To ensure you have the best chance of accessing available jobs on our platform, please make sure your profile is 100% complete. Additionally, you must take and pass the survey test. These steps are mandatory to access any job opportunities. Completing your profile and taking the survey test helps us match you with the most suitable jobs and increases your chances of success.</p>

                <div class="col-12 col-md-12 w-100" style="text-align:center">
                    <a href="<?= URL ?>user/survey-test" class="col-12 col-md-12 text-primary">Take Survey Test <span class="fa fa-question-circle"></span></a>
                </div>
            </div>
    <?php
        }
    ?>


    
</div>
<!-- else if not empty --> 
<?php
    if ($eligibility == 1) {
?>
        <div class="pt-5">
            <div class="container-fluid">

                <?php
                    $fetch_jobs = mysqli_query($connection, "SELECT * FROM job ORDER BY RAND() LIMIT 40");
                    if (mysqli_num_rows($fetch_jobs) > 0) {
                        foreach ($fetch_jobs as $jobs) {
                            $job_id = $jobs['job_id'];
                            $title = $jobs['title'];
                            $location = $jobs['location'];
                            $category = $jobs['category'];
                            $job_type = $jobs['schedule'];
                            $avatar = $jobs['avatar'];
                            $contact_name = $jobs['contact_name'];
                ?>
                            <!-- jobs would be displayed here -->
                            <div class="row w-100 mt-0 mb-4">
                                <a href="<?= URL ?>user/job-view?job-id=<?= $job_id ?>" class="col-12 col-md-12 w-100" style="text-decoration: none; border-right: 1px solid silver">
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
                                                <p class=""> <span class="fas fa-map-marker-alt"></span> <?= $location ?></p>
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
                ?>
                        
                
            </div>
        </div>
<?php
    }
?>

<div class="col-12 col-md-12 dash_heaer_con mt-5">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Recently Applied Jobs</p>
    </div>
</div>

<div class="pt-5">
    <div class="container">

        <?php
            $fetch_jobs = mysqli_query($connection, "SELECT * FROM applied WHERE users_id= '$userId' ORDER BY date DESC LIMIT 15");
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
                        $contact_name = $jobDetails['contact_name'];
                    }
                    
        ?>
                    <!-- jobs would be displayed here -->
                    <div class="row w-100 mt-0 mb-4">
                        <a href="<?= URL ?>user/job-view?job-id=<?= $job_id ?>" class="col-12 col-md-12 w-100" style="text-decoration: none; border-right: 1px solid silver">
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
                                        <p class=""> <span class="fas fa-map-marker-alt"></span> <?= $location ?></p>
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




        <!-- include VIP stars -->
        <?php
            include __DIR__ . "/./vip-stars.php";
        ?>
                
        
    </div>
</div>












<script>
    function toggleFavorite(event, jobId, userId) {
        event.preventDefault(); // Prevent default anchor click behavior
        $.ajax({
            url: 'toggle_favorite.php', // Server-side script to handle the favorite action
            type: 'POST',
            data: { job_id: jobId, user_id: userId },
            success: function(response) {
                console.log(response); // Log server response for debugging
                if (response.status == 'added') {
                    $('#favorite-icon-' + jobId).removeClass('far').addClass('fas');
                } else if (response.status == 'removed') {
                    $('#favorite-icon-' + jobId).removeClass('fas').addClass('far');
                } else {
                    alert('Failed to toggle favorite status.');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Log error details for debugging
                alert('Failed to toggle favorite status.');
            }
        });
    }


    
</script>


















<?php 
    include "partials/footer.php";
?>