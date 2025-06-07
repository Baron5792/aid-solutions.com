<?php
    include "./partials/header.php";
    include 'isFavorite.php';


    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $userCheck = mysqli_query($connection, "SELECT * FROM users WHERE id= '$user_id'");
        if (mysqli_num_rows($userCheck) > 0) {
            $usersData = mysqli_fetch_assoc($userCheck);
            $eligibility = $usersData['eligibility'];
            
            // check if test has been takes
            if ($eligibility > 0) {
                if (isset($_GET['job-id'])) {
                    $job_id = $_GET['job-id'];
        
                    if (empty($job_id) || $job_id == 0) {
                        echo "No Job(s) Found";
                        exit();
                    } 
                    
                    else {
                        // query if ID exists
                        $check = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id' ORDER BY date DESC LIMIT 1");
                        if (mysqli_num_rows($check) > 0) {
                            
                            $info = mysqli_fetch_assoc($check);
                            $jobViewId = $info['id']; 
                            $title = $info['title'];
                            $description = $info['description'];
                            $skill = $info['skills'];
                            $experience = $info['experience'];
                            $location = $info['location'];
                            $job_type = $info['schedule'];
                            $applications = $info['applications'];
                            $date = $info['date'];
                            $avatar = $info['avatar'];
                            $salary_stop = $info['salary_stop'];
                            $contact_name = $info['contact_name'];
                            $deadline = $info['deadline'];
        
        
                            
        
                            // to display the actaul date it was posted
                            // Convert the date to a DateTime object
                            $eventDateTime = new DateTime($date);
                            $currentDateTime = new DateTime();
                
                            // Calculate the difference
                            $interval = $currentDateTime->diff($eventDateTime);
        
                            // Determine the relative time
                            if ($interval->y > 0) {
                                $timeAgo = $interval->y . " year" . ($interval->y > 1 ? "(s)" : "") . " ago";
                            } 
                            
                            elseif ($interval->m > 0) {
                                $timeAgo = $interval->m . " month" . ($interval->m > 1 ? "(s)" : "") . " ago";
                            } 
                            
                            elseif ($interval->d > 7) {
                                $weeks = floor($interval->d / 7);
                                $timeAgo = $weeks . " week" . ($weeks > 1 ? "(s)" : "") . " ago";
                            } 
                            
                            elseif ($interval->d > 0) {
                                $timeAgo = $interval->d . " day" . ($interval->d > 1 ? "(s)" : "") . " ago";
                            } 
                            
                            elseif ($interval->h > 0) {
                                $timeAgo = $interval->h . " hour" . ($interval->h > 1 ? "(s)" : "") . " ago";
                            } 
                            
                            elseif ($interval->i > 0) {
                                $timeAgo = $interval->i . " minute" . ($interval->i > 1 ? "(s)" : "") . " ago";
                            } 
                            
                            else {
                                $timeAgo = $interval->s . " second" . ($interval->s > 1 ? "(s)" : "") . " ago";
                            }
        
        
        
                            // Convert the date to a DateTime object
                            $eventDateTime = new DateTime($date);
        
                            // Extract the year, month, and day
                            $year = $eventDateTime->format('Y');
                            $month = $eventDateTime->format('m');
                            $day = $eventDateTime->format('d');
        
                            // Convert the numeric month to a month name
                            switch ($month) {
                                case 1:
                                    $monthName = "January";
                                    break;
                                case 2:
                                    $monthName = "February";
                                    break;
                                case 3:
                                    $monthName = "March";
                                    break;
                                case 4:
                                    $monthName = "April";
                                    break;
                                case 5:
                                    $monthName = "May";
                                    break;
                                case 6:
                                    $monthName = "June";
                                    break;
                                case 7:
                                    $monthName = "July";
                                    break;
                                case 8:
                                    $monthName = "August";
                                    break;
                                case 9:
                                    $monthName = "September";
                                    break;
                                case 10:
                                    $monthName = "October";
                                    break;
                                case 11:
                                    $monthName = "November";
                                    break;
                                case 12:
                                    $monthName = "December";
                                    break;
                                default:
                                    $monthName = "Unknown";
                                    break;
                            }
                        }
        
                        else {
                            header('location: ' . URL . 'error/error.php');
                            die();
                        }
                    }
                }
        
                else {
                    header('location: ' . URL . 'error/error.php');
                    // exit();
                }
            }
            
            else {
?>
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="text-center">Welcome to Aid-Solutions</h2>
                                    <p class="text-center">To access job listings, please complete our survey test.</p>
                                    <div class="text-center">
                                        <a href="<?= URL ?>user/survey-test" class="btn btn-primary">Take the Survey Test</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php
                die();
            }
        }
        
        else {
            header('location: ' . URL . "account/login");
        }
    }

    else {
        header('location: ' . URL . 'account/login');
    }
    
    // create new job random id   done
    // set a track for jobs when a user visits them in $_GET
    // fetch submitted applications on that job
?>

<script>
    document.getElementById('title_title').innerHTML = "Job Info | aid-solutions";

    $(document).ready(function() {
        $(".submit_btn").click(function() {
            $('.submit_drop').toggle(100);
        })
    })
</script>


<style>
    .submit_drop {
        display: none;
    }

    #submit_file {
        display: none;
    }

    .submit_drop label {
        width: 100%;
        padding: 30px 0px;
        text-align: center;
        border: 1px dotted lightblue;
        color: lightblue;
        font-size: 13px;
    }
</style>




<div class="container">
    <!-- image div -->
    <div class="row">
        <div class="col-12 col-md-3">
            <?php
                if (!empty($avatar)) {
            ?>
                    <img src="<?= URL ?>assets/images/job/<?= $avatar ?>" alt="" style="width: 100%; height: 140px;">
            <?php
                }

                else {
            ?>
                    <img src="<?= URL ?>assets/images/users_background/Freelancer - Hire & Find Jobs.jpeg" style="width: 100%; height: 140px;">
            <?php
                }
            ?>
        </div>

        <div class="col-12 col-md-9">
            <div class="row">
                <!-- title -->
                <p class="details-title col-12 col-md-12 mt-2"><?= $title ?></p>
                <!-- job type and date posted -->
                <div class="row ml-2 us">
                    <p class="col-12 col-md-12 mb-0">@<?= $contact_name ?></p>
                    <p class="col-12 col-md-12 mt-0">Posted <?= $timeAgo ?></p>
                </div>
                <!-- company text -->
                <p>Engaging with clients and driving sales through excellent customer service and product knowledge</p>

            </div>
        </div>
    </div>

    <div class="row mt-3 all-view-details">
        <!-- post date -->
        <p class="col-12 col-md"><i class="text-info fa fa-map-marker-alt"></i> <b>Location:</b> <?= $location ?></p>
        <p class="col-12 col-md"><i class="text-info fas fa-calendar-alt"></i> <b>Post Date:</b> <?= $monthName . " " . $day . " ," . $year ?></p>
        <p class="col-12 col-md"><i class="text-info fas fa-credit-card"></i> <b>Salary:</b> $<?= $salary_stop ?>.00</p>
        <p class="col-12 col-md"><i class="text-info fas fa-check-square"></i> <b>Application(s):</b> <?= $applications ?></p>
        <p class="col-12 col-md"><i class="text-info fa fa-hourglass-half"></i> <b>Deadline:</b> <?= $deadline ?> </p>
    </div>
    <div class="row ml-0">
        <button type="button" id="favorite-button" class="btn btn-primary btn-sm mt-2" onclick="toggleFavorite(<?= $job_id ?>, <?= $user_id ?>)">
            <i id="favorite-icon" class="fa fa-heart<?= isFavorite($job_id, $user_id) ? '' : '-o' ?>"></i> Add to favorite
        </button>
    <button type="button" class="btn btn-danger btn-sm ml-2 mt-2"><?= $job_type ?></button>
    <button type="button" class="btn btn-info btn-sm ml-2 mt-2"><?= $experience ?></button>

</div>

</div>

<div class="container mt-4">
    <div class="col-12 col-md-12 dash_heaer_con ">
        <div class="container dash_con">
            <p class="dash_header col-12 col-md-12"><i></i>Job Detail</p>
            <p class="ml-2">ID: <?= $job_id ?></p>
        </div>
        <!-- alert for application -->
        <?php if (isset($_SESSION['request_error'])): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=
                    $_SESSION['request_error'];
                    unset($_SESSION['request_error']);
                ?>
            </div>
        <?php elseif (isset($_SESSION['request_success'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=
                    $_SESSION['request_success'];
                    unset($_SESSION['request_success']);
                ?>
            </div>
        <?php endif ?>

        <!-- alert for job work-submission -->
        <?php if (isset($_SESSION['file_success'])): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=
                    $_SESSION['file_success'];
                    unset($_SESSION['file_success']);
                ?>
            </div>
        <?php elseif (isset($_SESSION['file_error'])): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?=
                    $_SESSION['file_error'];
                    unset($_SESSION['file_error']);
                ?>
            </div>
        <?php endif ?>
    </div>

 

           
    

    <!-- apply documents -->
    <!-- check if user has applied for this job -->
    <?php
        $JobSearch = mysqli_query($connection, "SELECT * FROM applied WHERE job_id= '$job_id' AND users_id= '$user_id' ORDER BY date DESC LIMIT 1");
        if (mysqli_num_rows($JobSearch) > 0) {
            $appliedStatus = mysqli_fetch_assoc($JobSearch);
            $status = $appliedStatus['status'];
            $jobId = $appliedStatus['job_id'];
    ?>
            <?php  if ($status != "Accepted"): ?>
               <!-- job description -->
                <div class="mt-3">
                    <em>Description: </em>
                </div>
                <!-- description goes here -->
                <div>
                    <p class="description-note"><?= $description ?></p>
                </div>
                <em>Skill: </em>
                <p><?= $skill ?></p>
            <?php endif ?>

    <?php

            // fetch jobs title
            $queryTitle = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$jobId'");
            if (mysqli_num_rows($queryTitle) == 1) {
                $Data = mysqli_fetch_assoc($queryTitle);
                $jobTitle = $Data['title'];
                $jobEmail = $Data['contact_email'];
            }
    ?>
            <?php if ($status == "Pending"):  ?>
                <div>
                    <p style="font-weight: bold; font-size: large;" class="mt-5">Application Submitted!</p>
                    <p>Thank you for applying for the <?= $title ?> position. Your application has been successfully submitted, and you will receive an email confirmation shortly.</p>
                    <strong>Next Steps:</strong>
                    <ol>
                        <li>Keep an eye on your inbox for any updates or additional instructions from the employer.</li>
                        <li>Ensure your profile is complete and up to date to increase your chances of being noticed.</li>
                        <li>Continue browsing and applying for other jobs that match your skills and interests.</li>
                    </ol>

                    <!-- delete application -->
                    <a href="<?= URL ?>user/delete-application?userId=<?= $user_id ?>&&jobId=<?= $jobId ?>" onclick="deleteApplication();"><button type="button" class="btn btn-danger btn-sm">Delete Appplication</button></a>
                </div>
            <?php elseif ($status == "Accepted") : ?>
                <p class="mt-5">We are pleased to inform you that you have been granted the position of <?= " " . $jobTitle . " "  ?>. To proceed with your next steps, please click on the Chat button below to communicate directly with the job owner. They will provide you with all the necessary details and instructions.</p>

                <div class="row">
                    <a href="<?= URL ?>user/chat.php?job-id=<?= $jobId ?>&id=<?= $user_id ?>" class="col-12 col-md-3">
                        <button type="button" class="btn btn-success text-white btn-sm mb-2"> <span class="fas fa-comment"></span> Chat with job owner </button>
                    </a>

                    <a href="mailto:<?= $jobEmail ?>" class="col-12 col-md-3">
                        <button type="button" class="btn btn-primary text-white btn-sm mb-2"> <span class="fas fa-envelope"></span> Email the job owner </button>
                    </a>

                    <?php  
                        // check if user have submitted the job's track
                        $checkTrack = mysqli_query($connection, "SELECT * FROM submitted WHERE userId= '$user_id' AND jobId= '$job_id' LIMIT 1");
                        if (mysqli_num_rows($checkTrack) < 1) {
                    ?>
                            <div class="col-12 col-md-3">
                                <button type="button" class="btn btn-warning text-white btn-sm mb-2 submit_btn"><span class="fas fa-cloud-upload-alt"></span> Submit the Job file </button>
                            </div>

                            <!-- submit dropdown content -->
                            <div class="container submit_drop">
                                <form action="<?= URL ?>user/work-submission.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="userId" id="" value="<?= $user_id ?>">
                                    <input type="hidden" name="jobId" id="" value="<?= $job_id ?>">
                                    <input type="file" name="file" id="submit_file">
                                    <label for="submit_file" class="mt-3">Click here</label>
                                    <button type="submit" class="btn btn-info" name="send">Send File</button>
                                </form> 
                            </div>

                            <!-- write the code to track the submitted table -->
                            
                    <?php  
                        }
                        else {
                    ?>
                            <div class="col-12 col-md-12">

                            </div>
                    <?php
                        }
                    ?>
                </div>

                

            <?php  else: ?>
                <!-- apply for job -->
                <div class="mt-4">
                    <!-- <p style="font-weight: bold; font-size: large;">*Important Note for Job Application</p> -->
                    <em>Your resume and cover letter, which are already updated on your profile and CV manager page, will be used for this job application. If you wish to make any changes to your resume or cover letter, please update them on your profile before applying.</em>
                    
                    <p><em>Please note that to proceed with your application, you must upload a CV and provide a cover letter. Ensure that both documents are up-to-date and tailored for the job you are applying for.</em></p>

                    <p><em>Thank you!</em></p>
                </div>



                <?php  
                    $checkStatus = mysqli_query($connection, "SELECT * FROM job_alert WHERE user_id= '$user_id'");
                    if (mysqli_num_rows($checkStatus) <= 2) {        
                ?>
                        <form action="<?= URL ?>user/job-view_logic.php" method="POST">
                            <input type="hidden" name="userId" value="<?= $user_id ?>">
                            <input type="hidden" name="jobId" value="<?= $job_id ?>">
                            <div class="container">
                                <div id="alert-container"></div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <input type="text" name="title" placeholder="Current Job Title" class="form-control col-12 mt-2" required>
                                    </div>
                                    <div class="col-12 col-md-6 input-group-append">
                                        <span class="input-group-text" id="">$</span>
                                        <input type="number" name="salary" placeholder="Current Salary" class="form-control col-12 mt-2" required>
                                    </div>
                                    <div class="col-12 col-md-12">curr
                                        <textarea name="message" placeholder="Type your message" class="form-control col-12 mt-2" required></textarea>
                                    </div>
                                    <div class="form-check ml-3 mt-4">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" value="" required> By clicking checkbox, you agree to our Terms and Conditions and Privacy Policy
                                        </label>
                                    </div>
                                    <div class="form-check ml-0 col-12 col-md-12 mt-4">
                                        <button type="submit" id="submit-btn" name="submit" class="btn btn-success mb-3">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                <?php
                    }
            endif ?>
            
    <?php
        }

        else {
    ?>

            <!-- description goes here -->
            <div class="mt-3">
                <em>Description: </em>
                <p><?= $description ?></p>
                <em>Required Skill:</em> 
                <p style="word-wrap: break-word;"><?= $skill ?></p>
            </div>

            <div class="mt-4">
                <!-- <p style="font-weight: bold; font-size: large;">*Important Note for Job Application</p> -->
                <em>Your resume and cover letter, which are already updated on your profile and CV manager page, will be used for this job application. If you wish to make any changes to your resume or cover letter, please update them on your profile before applying.</em>
                
                <p><em>Please note that to proceed with your application, you must upload a CV and provide a cover letter. Ensure that both documents are up-to-date and tailored for the job you are applying for.</em></p>

                <p><em>Thank you!</em></p>
            </div>


            <?php  
                $checkStatus = mysqli_query($connection, "SELECT * FROM job_alert WHERE user_id= '$user_id'");
                if (mysqli_num_rows($checkStatus) <= 2) {      
            ?>
                    <!-- check if users submitted file has been accepted -->
                    <form action="<?= URL ?>user/job-view_logic.php" method="POST">
                        <input type="hidden" name="userId" value="<?= $user_id ?>">
                        <input type="hidden" name="jobsId" value="<?= $job_id ?>">
                        <div class="container mt-3">
                            <div id="alert-container"></div>
                            <div class="row">
                                <div class="col-12 col-md-6 mt-2">
                                    <input type="text" name="title" placeholder="Current Job Title" class="form-control col-12" required>
                                </div>
                                
                                <div class="input-group mb-3 input-group-md col-12 col-md-6 mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="number" name="salary" placeholder="Current Salary" class="form-control" required>
                                </div>
                                
                                <div class="col-12 col-md-12">
                                    <textarea name="message" placeholder="Type your message" class="form-control col-12 col-md-12 mt-2" required></textarea>
                                </div>
                                <div class="form-check ml-3 mt-4">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" value="" required> By clicking checkbox, you agree to our Terms and Conditions and Privacy Policy
                                    </label>
                                </div>
                                <div class="form-check ml-0 col-12 col-md-12 mt-4">
                                    <button type="submit" id="submit-btn" name="submit" class="btn btn-success mb-3">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
            <?php
                }
                
                else {
            ?>
                    <div class="container mt-5">
                        <div class="alert alert-warning d-flex align-items-center justify-content-between" role="alert">
                            <div>
                                <h5 class="alert-heading">You've reached your maximum active jobs!</h5>
                                <p class="mb-0">
                                    To maintain quality and ensure timely completion, we limit the number of jobs you can work on at one time. 
                                    Please complete or deliver an existing job before starting a new one. If you need any assistance, feel free to reach out to our support team.
                                </p>
                            </div>
                            <div>
                                <a href="mailto:support@aid-solutions.com" class="btn btn-primary ml-3">Contact Support</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
        }
    ?>
</div>






<!-- Display a messge to the current user when the job has been successfully done -->
<?php  
    $checkSubmitted = mysqli_query($connection, "SELECT * FROM submitted_track WHERE userId= '$user_id' AND jobId= '$job_id'");
    if (mysqli_num_rows($checkSubmitted) > 0) {      
?>
        <!-- check if users submitted file has been accepted -->
        <div style="
            background-color: #f8d7da; 
            color: #721c24; 
            padding: 15px; 
            border: 1px solid #f5c6cb; 
            border-radius: 5px; 
            max-width: 400px; 
            margin: 20px auto; 
            font-family: Arial, sans-serif;">
            
            <strong>Notice:</strong> This job has been successfully completed and is now unavailable. Thank you for your hard work and commitment!
        </div>
    <?php
        }
    ?>




<!-- other jobs -->
<div class="col-12 col-md-12 dash_heaer_con mt-5">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Other jobs you may like</p>
    </div>
</div>

<?php
    if ($eligibility == 1) {
?>
        <div class="pt-5">
            <div class="container">

                <?php
                    $fetch_jobs = mysqli_query($connection, "SELECT * FROM job WHERE NOT job_id= '$job_id' ORDER BY RAND() LIMIT 3");
                    if (mysqli_num_rows($fetch_jobs) > 0) {
                        foreach ($fetch_jobs as $jobs) {
                            $job_id = $jobs['job_id'];
                            $title = $jobs['title'];
                            $location = $jobs['location'];
                            $category = $jobs['category'];
                            $job_type = $jobs['schedule'];
                            $avatar = $jobs['avatar'];
                            $contact_name = $jobs['contact_name'];
                ?>

                            <!-- jobs would be displayed here -->
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
                            
                ?>
                        
                <?php
                        
                    }  
                ?>
                        
                
            </div>
        </div>
<?php
    }
?>


<script>
    document.getElementById('submit_file').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.querySelector('label[for="submit_file"]');
        label.innerHTML = fileName;
    });

    function toggleFavorite(jobId, userId) {
        const icon = document.getElementById('favorite-icon');
        
        fetch(`toggle_favorite.php?job-id=${jobId}&user-id=${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'added') {
                icon.classList.remove('fa-heart-o');
                icon.classList.add('fa-heart');
                icon.style.color = 'red'; // Change color to indicate favorite
            } else if (data.status === 'removed') {
                icon.classList.remove('fa-heart');
                icon.classList.add('fa-heart-o');
                icon.style.color = ''; // Reset color
            }
        })

        .catch(error => console.error('Error:', error));
    }


    function deleteApplication() {
        if (confirm("Are you sure?")) {
            true;
        }

        else {
            event.preventDefault();
            event.stopPropagation();
        }
    }

  


</script>

<?php
    include "./partials/footer.php";
?>