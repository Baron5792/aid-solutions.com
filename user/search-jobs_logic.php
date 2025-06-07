<?php
include __DIR__ . '/../database.php'; // Include your database connection

if (isset($_POST['jobTitle']) && isset($_POST['location'])) {
    $jobTitle = $_POST['jobTitle'];
    $location = $_POST['location'];
    
    // Sanitize input
    $jobTitle = mysqli_real_escape_string($connection, $jobTitle);
    $location = mysqli_real_escape_string($connection, $location);

    $query = "SELECT * FROM job WHERE title LIKE '%$jobTitle%' AND location LIKE '%$location%'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($job = mysqli_fetch_assoc($result)) {
            $title = $job['title'];
            $description = $job['description'];
            $location = $job['location'];
            $job_type = $job['schedule'];
            $category = $job['category'];
            $avatar = $job['avatar'];
            $job_id = $job['job_id'];
            $contact_name = $job['contact_name'];
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
    } else {
        echo "<p>No jobs found</p>";
    }
}
?>
