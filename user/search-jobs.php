<?php 
    include __DIR__ . "/./partials/header.php"; 

    // Define how many jobs per page
    $jobsPerPage = 4;

    // Get the current page or set a default value
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = (int) $_GET['page'];
    } else {
        $currentPage = 1;
    }

    // Calculate the offset for SQL query
    $offset = ($currentPage - 1) * $jobsPerPage;

    // Fetch total number of jobs for pagination
    $totalJobsQuery = mysqli_query($connection, "SELECT COUNT(*) as total FROM job");
    $totalJobsResult = mysqli_fetch_assoc($totalJobsQuery);
    $totalJobs = $totalJobsResult['total'];

    // Calculate total pages needed
    $totalPages = ceil($totalJobs / $jobsPerPage);

    // Check eligibility
    $allowance = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
    if (mysqli_num_rows($allowance) == 1) {
        $userDet = mysqli_fetch_assoc($allowance);
        $eligibility = $userDet['eligibility'];
    }

    // check eligibility 
    $allowance = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
    if (mysqli_num_rows($allowance) == 1) {
        $userDet = mysqli_fetch_assoc($allowance);
        $eligibility = $userDet['eligibility'];
    }
?>



<style>
    .searchNotify {
        background-color: silver;
    }

    .pagination {
        text-align: center;
    }
      

</style>

<script>
    document.getElementById("title_title").innerHTML = "Search Jobs | aid-solutions";

    function searchJobs() {
        var jobTitle = document.getElementById("jobTitle").value;
        var location = document.getElementById("location").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "search-jobs_logic.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("jobResults").innerHTML = xhr.responseText;
            }
        };
        xhr.send("jobTitle=" + jobTitle + "&location=" + location);
    }
</script>

<div class="col-12 col-md-12 dash_heaer_con">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Search Jobs</p>
    </div>
</div>

<?php if ($eligibility == 1): ?>
    <form onsubmit="event.preventDefault(); searchJobs();">
        <div class="col-12 col-md-12 dash_heaer_con mt-5">
            <div class="form-row">
                <div class="col-12 col-md-4">
                    <input type="text" id="jobTitle" name="jobTitle" placeholder="Job Title" class="form-control" onkeyup="searchJobs()">
                </div>
                <div class="col-12 col-md-4 mb-2">
                    <input type="text" id="location" name="location" placeholder="State or City" class="form-control" onkeyup="searchJobs()">
                </div>
                <!-- <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div> -->
            </div>
        </div>
    </form>

    <div id="jobResults" class="container mt-5 mb-3">
        <!-- <div><b>3456</b> Job's Available</div> -->
        <small>Currently displaying <b><?= $jobsPerPage ?></b> Jobs here</small>
        <!-- Jobs will be displayed here -->
        <?php
            $fetch_jobs = mysqli_query($connection, "SELECT * FROM job ORDER BY RAND() LIMIT $jobsPerPage OFFSET $offset");
            if (mysqli_num_rows($fetch_jobs) > 0) {
                while ($job = mysqli_fetch_assoc($fetch_jobs)) {
                    $title = $job['title'];
                    $description = $job['description'];
                    $location = $job['location'];
                    $job_type = $job['schedule'];
                    $category = $job['category'];
                    $avatar = $job['avatar'];
                    $job_id = $job['job_id'];
                    $contact_name = $job['contact_name'];
            ?>
                    <!-- Jobs displayed here -->
                    <div class="row w-100 mt-0 mb-4 mt-5">
                        <a href="<?= URL ?>user/job-view?job-id=<?= $job_id ?>" class="col-12 col-md-12 w-100" style="text-decoration: none; border-right: 1px solid silver">
                            <div class="d-flex">
                                <div class="col-md-3 col-5" class="job_image">
                                    <?php if (strlen($avatar) > 0): ?>
                                        <img src="<?= URL ?>assets/images/job/<?= $avatar ?>" alt="" style="width: 50%; height: 80px; border-radius: 50%;">
                                    <?php else: ?>
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
            } else {
                echo "<p>No jobs found</p>";
            }
            ?>

            <div class="pagination container col-12 col-md-12" style="margin-top: 40px">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>" class="btn btn-secondary small"><i class="fa fa-caret-left"></i></a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="btn <?= ($i == $currentPage) ? 'btn-primary' : 'btn-light' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="btn btn-secondary small"><i class="fa fa-caret-right"></i></a>
                <?php endif; ?>
            </div>


    </div>

<?php endif ?>

<?php if ($eligibility == 0): ?>
    <p class="mt-3"><i class="fa fa-info-circle"></i> To access job listings, please complete the mandatory survey test. This helps us better match you with suitable opportunities. Thank you for your understanding.</p>
<?php endif ?>

<script>
    
</script>

<?php 
    include "partials/footer.php"; 
?>
