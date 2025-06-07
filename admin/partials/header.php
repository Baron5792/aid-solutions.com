<?php
    include __DIR__ . "/../../database.php";

    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user']['id'];
        $query = mysqli_query($connection, "SELECT * FROM users");
        if (mysqli_num_rows($query) > 0) {
            $usersCount = mysqli_num_rows($query);
        }
        else {
            $usersCount = "null";
        }

        // fetch online users
        $status = mysqli_query($connection, "SELECT * FROM users WHERE online_status= '1'");
        if (mysqli_num_rows($status) > 0) {
            $online_status = mysqli_num_rows($status);
        }
        else {
            $online_status = "null";
        }

        // available jobs
        $jobs = mysqli_query($connection, "SELECT * FROM job");
        if (mysqli_num_rows($jobs) > 0) {
            $job = mysqli_num_rows($jobs);
        }
        else {
            $job = "0";
        }

        $appliedJob = mysqli_query($connection, "SELECT * FROM applied WHERE status= 'Pending'");
            if (mysqli_num_rows($appliedJob)) {
            $applied = mysqli_num_rows($appliedJob);
        }
        else {
            $applied = "0";
        }
        
        // paid status
        $paids = mysqli_query($connection, "SELECT * FROM transactions");
        if (mysqli_num_rows($paids) > 0) {
            $paid = mysqli_num_rows($paids);
        }
        else {
            $paid = "0";
        }
        
        $chat = mysqli_query($connection, "SELECT * FROM users WHERE message_track= '1'");
        if (mysqli_num_rows($chat) > 0) {
            $chats = mysqli_num_rows($chat);
        }   
        
        else {
            $chats = "None";
        }


        $submittedCheck = mysqli_query($connection, "SELECT * FROM submitted WHERE status= 'pending'");
        if (mysqli_num_rows($submittedCheck) > 0) {
            $submitted = mysqli_num_rows($submittedCheck);
        }
        
        else {
            $submitted = "0";
        }

    }

    else {
        header('location: ' . URL . 'account/login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= URL ?>assets/bootstrap-4.6.1-dist/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="icon" type="image/png" href="../assets/images/logo/favicon.png" sizes="16x16"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= URL ?>assets/fontawesome-free-6.1.1-web/css/all.css">
    <script src="<?= URL ?>assets/jQuery link/jquery-3.6.1.js"></script>
</head>
<body>

<script>
    $(document).ready(function() {
        $("#more").click(function() {
            $(".dropdown-menu").toggle();
        })
    })
</script>

<?php
    include __DIR__ . "/../../assets/css/preloader.php";
?>

<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: auto;
    }
    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: black;
      color: white;
      text-align: center;
      padding: 20px 0;
      z-index: 1200;
      height: 80px;
    }

    .header a {
        text-decoration: none;
    }

    .header_icon a  {
        font-size: x-large;
        color: lightgreen;
    }
    .header_list {
        text-decoration: none;
        font-size: large;
        color: white;
    }
    .header_list a {
        color: white;
    }
    
    table {
        position: relative;
        margin-top: 60px;
    }
 
    table tr td {
        font-size: small;
        border-collapse: collapse;
        border: 1px solid #ddd;
        padding: 0px 10px;
        text-align: center;
    }

    table tr th {
      padding: 8px 0px;
      background-color: darkcyan;
      text-align: center;
      font-size: small;
      position: -webkit-sticky;
      position: sticky;
      top: 70px;
      z-index: 1001;
      transition: background-color 0.5s ease-in-out;
    }
    
    table tr th.stuck {
      background-color: #00698f; /* darker shade of darkcyan */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .title {
        text-align: center;
        /* font-weight: bold; */
        font-size: xx-large;
    }
    .stats {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
    }
    .stats-head p:first-child {
        font-weight: bold;
    }

    .dropdown-menu {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        animation: fadeIn 0.5s;
        width: 300px;
        transition: opacity 0.5s, transform 0.5s;
        opacity: 0;
        transform: scale(0.9);
    }
    
    .dropdown-menu.show {
      opacity: 1;
      transform: scale(1);
    }

    
    .dropdown-item {
        padding: 7px 14px;
    }



</style>

    <!-- header -->
    <div class="container-fluid header">
        <div class="header">        
            <div class="row">
                <div class="col-md-3 header_icon">
                    <a href="<?= URL ?>user/dashboard.php"> PANEL </a>
                    <div class="spinner-grow text-success" style="font-size: x-small"></div>
                </div>
                <div class="d-flex col-md-9 header_list">
                    <a href="<?= URL ?>admin/manage-users.php" class="col-md-2 mt-2">manage users</a>
                    <a href="<?= URL ?>admin/job.php" class="col-md-2 mt-2">jobs</a>
                    <!-- <a href="" class="col-md-2">Message Request</a> -->

                    <div class="dropdown col-md-2">
                        <button type="button" class="btn text-white dropdown-toggle" id="more" data-toggle="dropdown">more</button>
                        <div class="dropdown-menu" style="border-top: 7px solid lightgreen;">
                            <a class="dropdown-item text-muted" href="<?= URL ?>admin/chats.php">Chats</a>
                            <?php
                                $countApplied = mysqli_query($connection, "SELECT * FROM applied WHERE status= 'Pending'");
                                if (mysqli_num_rows($countApplied) > 0) {
                                    $counted = mysqli_num_rows($countApplied);
                            ?>
                                    <a class="dropdown-item text-muted" href="<?= URL ?>admin/applied-job.php">Applied Jobs <span class="text-success p-1" style="border-radius: 50%">+<?= $counted ?></span></a>
                            <?php
                                }
                                else {
                            ?>
                                    <a class="dropdown-item text-muted" href="<?= URL ?>admin/applied-job.php">Applied Jobs</a>
                            <?php
                                }
                            ?>

                            <a class="dropdown-item text-muted" href="<?= URL ?>admin/add-category.php">Add Category</a>
                            <a class="dropdown-item text-muted" href="<?= URL ?>admin/submitted.php">Submitted</a>
                            <a class="dropdown-item text-muted" href="<?= URL ?>admin/job-categories.php">Categories</a>
                            <a class="dropdown-item text-muted" href="<?= URL ?>admin/email.php">Email</a>
                            <a class="dropdown-item text-muted" href="<?= URL ?>admin/contact_us.php">Contact Us</a>
                            <a class="dropdown-item text-muted" href="<?= URL ?>admin/comment.php">Comments</a>
                            <a href="<?= URL ?>admin/mail-users.php" class="dropdown-item text-muted">Mail Users</a>
                            <!--<a href="<?= URL ?>admin/account-value.php" class="dropdown-item text-muted">Edit Account Number</a>-->
                            <!--<a href="<?= URL ?>admin/transactions.php" class="dropdown-item text-muted">Withdrawal Transactions</a>-->
                            <a href="<?= URL ?>admin/pay_user.php" class="dropdown-item text-muted">Pay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 70px;">

        <div class="container stats-div">
            <div class="row">
                <!-- users statiscs -->
                <div class="col-12 col-md-3 mt-4 mb-1 stats pt-3 pb-3">
                    <div class="stats-head">
                        <p class="text-secondary">Available Job</p>
                        <p class="text-secondary"><?= $job ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-4 mb-1 stats pt-3 pb-3">
                    <div class="stats-head">
                        <p class="text-warning">Applied Job</p>
                        <p class="text-warning"><?= $applied ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-4 mb-1 stats pt-3 pb-3">
                    <div class="stats-head">
                        <p class="text-primary">Registered Users</p>
                        <p class="text-primary"><?= $usersCount ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-4 mb-1 stats pt-3 pb-3">
                    <div class="stats-head">
                        <p class="text-success">Paid</p>
                        <p class="text-success"><?= $paid ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-1 mb-4 stats pt-3 pb-3">
                    <div class="stats-head">
                        <p class="text-success">Online status</p>
                        <p class="text-success"><?= $online_status ?></p>
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-1 mb-4 stats pt-3 pb-3">
                    <div class="stats-head">
                        <p class="text-danger">Unreplied chat</p>
                        <p class="text-success">
                            <?php if ($chats == "None"): ?>
                                <p class="text-secondary">None</p>
                            <?php else: ?>
                                <p class="small text-danger"><?= $chats ?></p>
                            <?php endif ?>
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-3 mt-1 mb-4 stats pt-3 pb-3">
                    <div class="stats-head">
                        <p class="text-info">Submitted Job</p>
                        <p class="text-success">
                            <p class="text-info"><?= $submitted ?></p>
                        </p>
                    </div>
                </div>
            </div>
        </div>





