<?php
    include __DIR__ . "/./partials/header.php";

    if (isset($_GET['id']) && isset($_GET['userId'])) {
        $jobId = $_GET['id'];
        $userId = $_GET['userId'];

        $query = mysqli_query($connection, "SELECT * FROM submitted WHERE userId= '$userId' AND jobId= '$jobId' ORDER BY date DESC LIMIT 1");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $file = $data['file'];
            $status = $data['status'];

            // fetch related job's data
            $queryJob = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
            if (mysqli_num_rows($queryJob) > 0) {
                $jobData = mysqli_fetch_assoc($queryJob);
                $title = $jobData['title'];
                $description = $jobData['description'];
                $skills = $jobData['skills'];
                $date = $jobData['date'];
                $salary = $jobData['salary_stop'];
            }

            else {
                echo "Job doesn't exist anymore";
            }
        }

        else {
            echo "Error 404, please contact collins";
        }
    }

    else {
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
?>

<style>
    .title {
        font-size: x-large;
        font-family: sans-serif;
    }

    .title_sub {
        font-weight: bold;
        margin-bottom: 4px;
    }

    iframe {
        width: 100%;
        height: 100%;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p class="title">Job Details</p>
            <!-- job details view -->
            <div>
                <p class="title_sub">Title:</p> <?= $title ?>
                <p class="title_sub">Description:</p> <?= $description ?>
                <p class="title_sub">Required Skill:</p> <?= $skills ?>
                <p class="title_sub">Salary Range: </p> <?= $salary ?>
                <p class="title_sub">Status: </p> <?= $status ?>
            </div>


            <!-- user's details -->
            <p class="title mt-5 mb-5">User Details</p>
            <div>
                <!-- fetch related users data -->
                <?php
                    $queryUser = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
                    if (mysqli_num_rows($queryUser) > 0) {
                        $userData = mysqli_fetch_assoc($queryUser);
                        $fullname = $userData['firstname'] . " " . $userData['lastname'];
                        $email = $userData['email'];
                        $country = $userData['country'];
                        $IP = $userData['ip'];
                        $phone = $userData['phone'];
                ?>
                        <p class="title_sub">Name:</p> <?= $fullname ?>
                        <p class="title_sub">Email:</p> <?= $email ?>
                        <p class="title_sub">Phone Number: </p> <?= $phone ?>
                        <p class="title_sub">Country:</p> <?= $country ?>
                        <p class="title_sub">IP Address:</p> <?= $IP ?>
                <?php
                    }

                    else {
                        echo "User doesn't exist";
                    }
                ?>

                
            </div>


            <!-- accept or decline btns -->
            <div class="mt-4">
                <?php if ($status == "pending"): ?>
                    <a href="<?= URL ?>admin/accept-job_file.php?userId=<?= $userId ?>&&jobId=<?= $jobId ?>"><button type="button" onclick="checkConfirm();" class="btn btn-success btn-sm">Accept</button></a>
                    <a href="<?= URL ?>admin/decline-job_file.php?userId=<?= $userId ?>&&jobId=<?= $jobId ?>"><button type="button" onclick="checkConfirm();" class="btn btn-danger btn-sm">Decline</button></a>
                <?php endif ?>
            </div>

        </div>


        <!-- users submitted content -->
        <div class="col-md-6">
            <p class="title">Submitted File</p>
            <iframe src="<?= URL ?>submited/<?= $file ?>" frameborder="0"></iframe>
        </div>
    </div>
</div>


<script>
    function checkConfirm() {
        if (confirm("Are you sure?")) {
            true;
        }

        else {
            event.stopPropagation();
            event.preventDefault();
        }
    }
</script>