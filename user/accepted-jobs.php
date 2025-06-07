<?php
    include "partials/header.php";
    $userId = $_SESSION['user']['id'];
?>

<script>
    document.getElementById("title_title").innerHTML = "Accepted Job's | aid-solutions";
</script>

<style>
    .acceptedNotify {
        background-color: silver;
    }

    .container {
        max-width: 1200px;
        margin: auto;
    }

    .card {
        border: none;
        border-radius: 8px;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
    }

    .card-text {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

</style>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Accepted Jobs</p>
    </div>
</div>


<div class="container mt-5">
    <div class="row">

    <?php
        $queryAccepted = mysqli_query($connection, "SELECT * FROM job_alert WHERE user_id= '$userId'");
        if (mysqli_num_rows($queryAccepted) > 0) {
            foreach ($queryAccepted as $key) {
                $jobId = $key['job_id'];
                // fetch related job's data
                $queryJob = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
                if (mysqli_num_rows($queryJob) > 0) {
                    $jobData = mysqli_fetch_assoc($queryJob);
                    $jobTitle = $jobData['title'];
                    $jobLocation = $jobData['location'];
                    $salary = $jobData['salary_stop'];
                    $contact_name = $jobData['contact_name'];
                }
                else {
                    echo "job not found";
                }
    ?>
                <!-- Job Card Start -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= $jobTitle ?></h5>
                            <p class="card-text"><i class="fas fa-building"></i> @<?= $contact_name ?></p>
                            <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?= $jobLocation ?></p>
                            <p class="card-text"><i class="fas fa-dollar-sign"></i> <?= $salary ?></p>
                            <a href="<?= URL ?>user/job-view.php?job-id=<?= $jobId ?>" class="btn btn-primary btn-block">View Details</a>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    ?>

        

    </div>
</div>















<?php 
    include "partials/footer.php";
?>