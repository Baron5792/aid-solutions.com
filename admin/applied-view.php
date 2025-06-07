<?php
    include __DIR__ . "/./partials/header.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // fetch all from applied table
        $queryApplied = mysqli_query($connection, "SELECT * FROM applied WHERE id= '$id'");
        if (mysqli_num_rows($queryApplied) == 1) {
            $details = mysqli_fetch_assoc($queryApplied);
            $userId = $details['users_id'];
            $title = $details['title'];
            $salary = $details['salary'];
            $message = $details['message'];
            $status = $details['status'];
            $jobId = $details['job_id'];

            // fetch users data
            $queryUser = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
            if (mysqli_num_rows($queryUser) == 1) {
                $userData = mysqli_fetch_assoc($queryUser);
                $fullname = $userData['firstname'] . " " . $userData['lastname'];
                $country = $userData['country'];
                $gender = $userData['gender'];
                $email = $userData['email'];
                $phone = $userData['phone'];
                $avatar = $userData['avatar'];
                $sector = $userData['sector'];
                $years_of_experience = $userData['years_of_experience'];
                $cover_letter = $userData['cover_letter'];
                $resume = $userData['resume'];
            }

            // fetch job data
            $queryJob = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
            if (mysqli_num_rows($queryJob) == 1) {
                $jobData = mysqli_fetch_assoc($queryJob);
                $jobTitle = $jobData['title'];
                $jobDescription = $jobData['description'];
                $jobSkills = $jobData['skills'];
            }

            else {
                echo "User is not found in the database report to collins asap";
            }
        }

        else { 
            header('location: ' . URL . 'applied-job.php');
        }
    }

    else {
        header('location: ' . URL . 'admin/applied-job.php');
    }
?>

<style>
    .data {
        font-size: x-large;
        text-decoration: underline;
    }
</style>

<!-- display user's details -->
<div class="container pb-5">

    <!-- alert -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <p>
                <?=
                    $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </p>
        </div>
    <?php endif ?>

    <div class="title">
        <p>Applied User's Data</p>
    </div>

    <div class="data">
        <p>Personal Info:</p>
    </div>

    <div class="row">
        <div class="col">
            <ul style="text-transform: capitalize; font-size:medium;">
                <li>Name: <?= $fullname ?></li>
                <li>Email: <?= $email ?></li>
                <li>Gender: <?= $gender ?></li>
                <li>Phone Number: <?= $phone ?></li>
                <li>Sector: <?= $sector ?></li>
                <li>Country: <?= $country ?></li>
                <li>Years of experience: <?= $years_of_experience ?></li>
                <li>Status: <?= $status ?></li>
            </ul>
        </div>
        <div class="col">
            <?php if (!empty($avatar)): ?>
                <img src="<?= URL ?>assets/images/avatar/<?= $avatar ?>" style="height: 280px; width: 70%; border-radius: 50%;" alt="">
            <?php else: ?>
                <p>No profile photo</p>
            <?php endif ?>
        </div>
    </div>

    <div class="data">
        <p>Job Details: </p>
    </div>

    <ul>
        <li><?= $jobTitle ?></li>
        <li><?= $jobDescription ?></li>
        <li><?= $jobSkills ?></li>
    </ul>


    <div class="data">
        <p><?= $fullname . "'s" . " "  ?>Application Info</p>
    </div>
    <ul>
        <li>Title: <?= $title ?></li>
        <li>Message: <?= $message ?></li>
        <li>Salary: <?= $salary ?></li>
    </ul>


    <div class="data">
        <p><?= $fullname . "'s". " " ?>Resume Info: </p>
    </div>
    <?php if (!empty($resume)): ?>
        <iframe src="<?= URL ?>documents/resume/<?= $resume ?>" width="100%" height="400px"></iframe>
    <?php else: ?>
        <p>No resume found</p>
    <?php endif ?>

    <div class="data mt-5">
        <p><?= $fullname . "'s" . " " ?>Cover Letter: </p>
    </div>
    <div>
        <p><?= $cover_letter ?></p>
    </div>

    <div class="footer mt-5">
        <?php if ($status == "Pending"): ?>
            <a href="<?= URL ?>admin/accept-job.php?id=<?= $id ?>&user=<?= $userId ?>"><button type="button" class="btn btn-success">Accept</button></a>
            <a href="<?= URL ?>admin/decline-job.php?id=<?= $id ?>&user=<?= $userId ?>"><button type="button" class="btn btn-danger">Decline</button></a>
        <?php endif ?>
    </div>
</div>

