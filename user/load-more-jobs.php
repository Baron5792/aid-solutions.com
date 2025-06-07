<?php
    include __DIR__ . "/../database.php"; // Replace with your actual DB connection

echo 
    "<script>alert('hey mama');
    </script>";

$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 25;

$fetch_jobs = mysqli_query($connection, "SELECT * FROM job ORDER BY RAND() LIMIT $offset, $limit");
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

<div class="row w-100 mt-0 mb-4 mt-5">
    <a href="<?= URL ?>user/job-view.php?job-id=<?= $job_id ?>" class="col-12 col-md-12 w-100" style="text-decoration: none; border-right: 1px solid silver">
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
