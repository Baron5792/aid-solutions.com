<?php
    include __DIR__ . "/./partials/header.php";
?>

<div class="container">
    <div class="row bg-secondary text-white pt-3 pb-2 mb-3">
        <p class="col">Users Chat Box</p>
        <!-- <p class="col">Email</p> -->
        <!-- <p class="col">Country</p> -->
        <p></p>
    </div>
    <?php

        // query for the users data
        $userData = mysqli_query($connection, "SELECT * FROM users");
        if (mysqli_num_rows($userData) > 0) {
            foreach ($userData as $details) {
                $fullname = $details['firstname'] . " " . $details['lastname'];
                $email = $details['email'];
                $country = $details['country'];
                $userId = $details['id'];
                $message_track = $details['message_track'];
                $userId = $details['id'];
        ?>
                    <div class="row pt-1 pb-1">
                        <p class="col"><?= $fullname ?></p>
                        <p class="col"><?= $email ?></p>
                        <p class="col"><?= $country ?></p>
                        <div class="">
                            <?php if ($message_track == 0): ?>
                                <a href="<?= URL ?>admin/all-applied-jobs.php?id=<?= $userId ?>"><button type="button" class="btn btn-secondary">No new messages</button></a>
                            <?php elseif ($message_track == 1): ?>
                                <a href="<?= URL ?>admin/all-applied-jobs.php?id=<?= $userId ?>"><button type="button" class="btn btn-danger">Unread Messages</button></a>
                            <?php else: ?>
                                <a href="<?= URL ?>admin/all-applied-jobs.php?id=<?= $userId ?>"><button type="button" class="btn btn-success">Replied</button></a>
                            <?php endif ?>
                        </div>
                    </div>
        <?php
                // }
            }
        }
    ?>
            
</div>