<?php
    include __DIR__ . "/./partials/header.php";
    
    if (isset($_GET['user-details'])) {
        $userId = $_GET['user-details'];
        
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $avatar = $data['avatar'];
            $fullname = $data['firstname'] . " " . $data['lastname'] . " " . $data['username'];
            $email = $data['email'];
            $phone = $data['phone'];
            $gender = $data['gender'];
            $date_of_birth = $data['date_of_birth'];
            $country = $data['country'];
            $state = $data['state'];
            $sector = $data['sector'];
            $address = $data['address'];
            $zipcode = $data['zipcode'];
            $schedule = $data['schedule'];
            $years_of_experience = $data['years_of_experience'];
            $balance = $data['balance'];
            $referer = $data['referer'];
            $facebook = $data['facebook'];
            $twitter = $data['twitter'];
            $dribble = $data['dribble'];
            $linkedin = $data['linkedin'];
            $eligibility = $data['eligibility'];
            $cover_letter = $data['cover_letter'];
            $resume = $data['resume'];
            $ip_country = $data['ip_country'];
            $region = $data['ip_region'];
            
            
            // query the referer
            $ref = mysqli_query($connection, "SELECT * FROM users WHERE ref_code= '$referer'");
            if (mysqli_num_rows($ref) > 0) {
                $row = mysqli_fetch_assoc($ref);
                $ref_fullname = $row['firstname'] . " " . $row['lastname'];
            }
            else {
                $ref_fullname = "User doesn't exist";
            }
        }
        
        else {
            echo "User doesn't exist";
        }
    }
    
    else {
        header('location: ' . URL . "admin/manage-users.php");
    }
    
?>

<style>
    .title {
        font-size: large;
        font-family: cursive;
    }
    
    small {
        display: block;
    }
</style>

<div class="container pb-4">
    <div class="row">
        <div class="col-md-5">
            <?php if (strlen($avatar) > 0): ?>
                <div style="width: 100%; margin: auto;">
                    <img src="<?= URL ?>assets/images/avatar/<?= $avatar ?>" class="w-100" style="height: 480px;">
                </div>
            <?php else: ?>
                <p class="small text-secondary">No profile photo found</p>
            <?php endif ?>
        </div>
        <div class="col-md-7">
            <p class="title">Personal Details</p>
            <small>Name:  <?= $fullname ?></small>
            <small>Email: <?= $email ?></small>
            <small>Phone: <?= $phone ?></small>
            <small>Country: <?= $country ?></small>
            <small>State: <?= $state ?></small>
            <small>Gender: <?= $gender ?></small>
            <small>Date of birth: <?= $date_of_birth ?></small>
            <small>Address: <?= $address ?></small>
            <small>Zipcode: <?= $zipcode ?></small>
            <small>IP country: <?= $ip_country ?></small>
            <small>Region: <?= $region ?></small>
            
            <p class="title">Others</p>
            <small>Sector: <?= $sector ?></small>
            <small>Years of experience: <?= $years_of_experience ?></small>
            <small>Schedule: <?= $schedule ?></small>
            <small>Facebook: <?= $dribble ?></small>
            <small>Twitter: <?= $twitter ?></small>
            <small>Dribble: <?= $dribble ?></small>
            <small>Linkedin: <?= $linkedin ?></small>
            
            <p class="title">Status</p>
            <small>Balance: <?= $balance ?></small>
            <small> Survey Test:
                <?php if ($eligibility == 0): ?>
                    Not taken
                <?php else: ?>
                    Taken
                <?php endif ?>
            </small>
            <small>Referer: <?= $ref_fullname ?></small>
            <small> Cover letter:
                <p class="bg-light text-black w-100 pt-4 pb-4">
                    <?php if (strlen($cover_letter) > 0): ?>
                        <?= $cover_letter ?>
                    <?php else: ?>
                        No cover letter found!
                    <?php endif ?>
                </p>
            </small>
            <small></small>
            <small></small>
        </div>
    </div>
</div>
    
    
    
    
    
    
    
    
    
    
    
    
    