<?php
    include "./partials/header.php";
    $user_id = $_SESSION['user']['id'];
?>

<style>
    .favoriteNotify {
        background-color: silver;
    }

    tr:first-child {
        padding: 10px 0px;
        background-color: silver;
    }

    tr th {
        font-family: sans-serif;
        padding: 15px 10px;
        text-align: center;
    }

    tr td {
        font-family: sans-serif;
        font-size: small;
        padding: 10px 0px;
        text-align: center;
    }

    @media screen and (min-width: 0px) and (max-width: 374px) {
        tr:first-child th:nth-child(3), #time {
            display: none;
        }

        #title {
            margin-top: 0px;
        }

        .avatar {
            display: none;
        }
    }

    @media screen and (min-width: 0px) and (max-width: 767px) {
        .avatar {
            display: none;
        }

        .title {
            word-break: break-all;
        }
    }
</style>

<script>
    document.getElementById("title_title").innerHTML = "Favorite Jobs | aid-solutions";
</script>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Favorite Jobs</p>
    </div>

    <!-- alert disply here -->
    <?php if (isset($_SESSION['favorite-error'])): ?>
        <p class="alert alert-danger">
            <?=
                $_SESSION['favorite-error'];
                unset($_SESSION['favorite-error']);
            ?>
        </p>
    <?php endif ?>
</div>

    <div class="container">
        
        <?php
            $favorite = mysqli_query($connection, "SELECT * FROM favorites WHERE user_id= '$user_id' ORDER BY date DESC");
            // var_dump(mysqli_num_rows($favorite));
            // die;
        ?>
            
        <?php
            if (mysqli_num_rows($favorite) > 0) {
        ?>
                <table class="mt-5" style="width: 100%;">
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th></th>
                        <th></th>
                    </tr>
        <?php
                    foreach ($favorite as $key) {
                        $job_id = $key['job_id'];
                        $date = $key['date'];

                        $eventDateTime = new DateTime($date);
                        $currentDateTime = new DateTime();
            
                        // Calculate the difference
                        $interval = $currentDateTime->diff($eventDateTime);

                        // Determine the relative time
                        if ($interval->y > 0) {
                            $timeAgo = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
                        } 
                        
                        elseif ($interval->m > 0) {
                            $timeAgo = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                        } 
                        
                        elseif ($interval->d > 7) {
                            $weeks = floor($interval->d / 7);
                            $timeAgo = $weeks . " week" . ($weeks > 1 ? "s" : "") . " ago";
                        } 
                        
                        elseif ($interval->d > 0) {
                            $timeAgo = $interval->d . " day" . ($interval->d > 1 ? "(s)" : "") . " ago";
                        } 
                        
                        elseif ($interval->h > 0) {
                            $timeAgo = $interval->h . " hour" . ($interval->h > 1 ? "(s)" : "") . " ago";
                        } 
                        
                        elseif ($interval->i > 0) {
                            $timeAgo = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                        } 
                        
                        else {
                            $timeAgo = $interval->s . " second" . ($interval->s > 1 ? "s" : "") . " ago";
                        }


                        // fetch jobs title and category
                        $jobInfo = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id'");
                        if (mysqli_num_rows($jobInfo) > 0) {
                            $list = mysqli_fetch_assoc($jobInfo);
                            $title = $list['title'];
                            $category = $list['category'];
                            $avatar = $list['avatar'];
            ?>    
                            
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-0 col-md-3 avatar">
                                                <?php if (empty($avatar)): ?>
                                                    <img src="<?= URL ?>assets/images/users_background/Freelancer - Hire & Find Jobs.jpeg" alt="" style="width: 100%; height: 40px">
                                                <?php endif ?>
                                                <?php if (!empty($avatar)): ?>
                                                    <img src="<?= URL ?>assets/images/job/<?= $avatar ?>" alt="" style="width: 100%; height: 40px">
                                                <?php endif ?>
                                            </div>
                                            <div class="col-12 col-md-9 mt-2">
                                                <p style="font-weight: bold;text-transform: capitalize;" id="title"><?= $title ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $category ?></td>
                                    <td id="time"><?= $timeAgo ?></td>
                                    <td>
                                        <button type="button" class="btn btn-basic">
                                            <a href="<?= URL ?>user/job-view.php?job-id=<?= $job_id ?>"><i class="fa fa-eye"></i></a>
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-basic">
                                            <a href="<?= URL ?>user/delete-favorite.php?job-id=<?= $job_id ?>&id=<?= $user_id ?>"><i class="fa fa-trash-alt text-danger"></i></a>
                                        </button>
                                    </td>
                                </tr>
        <?php
                        }

                        else {
        ?>                  
                            <p class="text-muted mt-3"><i class="fas fa-info-circle"></i> You haven't added any jobs to your favorites yet. Start exploring and add jobs you like to your favorites for quick access!</p>
        <?php
                        }
                    }

        ?>
                </table>   
    <?php

            }

            else {
    ?>
                <p class="mt-3 text-muted"><i class="fas fa-info-circle"></i> You haven't added any jobs to your favorites yet. Start exploring and add jobs you like to your favorites for quick access!</p>        
    <?php
            }
    ?>
            
</div>

<?php
    include "./partials/footer.php";
?>