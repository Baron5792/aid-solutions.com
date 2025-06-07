<?php
    include "./partials/header.php";
?>

<div class="title">
    <p>User's list of Jobs</p>
</div>


<?php
    if (isset($_GET['id'])) {
        $userId = $_GET['id'];
        $fetch = mysqli_query($connection, "SELECT * FROM job_alert WHERE user_id= '$userId'");
        if (mysqli_num_rows($fetch) > 0) {
            foreach ($fetch as $data) {
                $jobId = $data['job_id'];
                // query job details
                $jobDetails = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
                if (mysqli_num_rows($jobDetails) == 1) {
                    $jobData = mysqli_fetch_assoc($jobDetails);
                    $title = $jobData['title'];
                    $location = $jobData['location'];
                }

                // query message track value
                $queryChat = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
                if (mysqli_num_rows($queryChat) == 1) {
                    $chatData = mysqli_fetch_assoc($queryChat);
                    $message_track = $chatData['message_track'];
                }

                // query chat details
                $chats = mysqli_query($connection, "SELECT * FROM chat WHERE job_id= '$jobId' AND user_id= '$userId'");
                if (mysqli_num_rows($chats) > 0) {
                    $row = mysqli_fetch_assoc($chats);
                    $message = $row['message'];
                    $message_track = $row['track'];
                } 
?>
                    <div class="row d-flex">
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $title ?></h5>
                                    <p class="card-text"><i class="fas fa-building"></i> @aid-solutions.com</p>
                                    <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?= $location ?></p>
                                    <?php if ($message_track == 1): ?>
                                        <a href="<?= URL ?>admin/chat-view.php?chat-id=<?= $jobId ?>&&userId=<?= $userId ?>" class="btn btn-danger btn-block">View Chats</a>
                                    <?php elseif ($message_track == 2): ?>
                                        <a href="<?= URL ?>admin/chat-view.php?chat-id=<?= $jobId ?>&&userId=<?= $userId ?>" class="btn btn-primary btn-block">View Chats</a>
                                    <?php else: ?>
                                        <a href="<?= URL ?>admin/chat-view.php?chat-id=<?= $jobId ?>&&userId=<?= $userId ?>" class="btn btn-primary btn-block">View Chats</a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
            }
        }  else {
            echo "No job record(s) found";
        }

    } else {
        header('location: ' . URL . 'account/login.php');
    }
?>

