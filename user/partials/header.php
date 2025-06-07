<?php
    require __DIR__ . "/../../database.php";    
    // cookie consent

    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user']['id'];
        $online = mysqli_query($connection, "UPDATE users SET online_status= '1' WHERE id= '$id'");
        if ($online) {
            $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
            if (mysqli_num_rows($query) == 1) {
                $details = mysqli_fetch_assoc($query);
                $firstanme = $details['firstname'];
                $lastname = $details['lastname'];
                $username = $details['username'];
                $email = $details['email'];
                $date_of_birth = $details['date_of_birth'];
                $phone = $details['phone'];
                $country = $details['country'];
                $ref_code = $details['ref_code'];
                $zipcode = $details['zipcode'];
                $sector = $details['sector'];
                $salary = $details['salary'];
                $state = $details['state'];
                $facebook = $details['facebook'];
                $twitter = $details['twitter'];
                $dribble = $details['dribble'];
                $linkedin = $details['linkedin'];
                $eligibility = $details['eligibility'];
                $resume = $details['resume'];
                $cover_letter = $details['cover_letter'];
                $avatar = $details['avatar'];
                $admin = $details['admin'];
                $salary_mode = $details['salary_mode'];
                $balance = $details['balance'];
            }

            else {
                // update offline status
                $offline = mysqli_query($connection, "UPDATE users SET online_status= '0' WHERE id= '$id'");
                header('location: ' . URL . 'account/login');
            }
        }


        else {
            // update offline status
            $offline = mysqli_query($connection, "UPDATE users SET online_status= '0' WHERE id= '$id'");
            if ($offline) {
                header('location: ' . URL . 'account/login');
            }
        }
    }

    else {
        header('location:' . URL . 'account/login');
    }


    // for IP address and location
    // function getRealIpAddr() {
    //     $ip = "";
    //     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    //         $ip = $_SERVER['HTTP_CLIENT_IP'];
    //     }
    //     elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    //         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //     }
    //     else {
    //         $ip = $_SERVER['REMOTE_ADDR'];
    //     }
    //     return $ip;
    // }

    // get location for a visitor
    // function getLocation($ip) {
    //     $url = "http://ip-api.com/json/{$ip}";
    //     $response = file_get_contents($url);
    //     $details = json_decode($response, true);
    //     return $details;
    // }
    // $ip = getRealIpAddr();
    // $locationDetails = getLocation($ip);


    if (isset($_GET['signup'])) {
        $signup = $_GET['signup'];
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title_title">AID - Global Freelance Platform</title>
    <meta name="description" content="Aid-solutions is a global freelance platform offering direct hiring for various job categories including writing, photography, videography, and more. Join us to access job opportunities tailored to your skills and expertise.">
    <meta name="keywords" content="freelance, jobs, direct hiring, writing jobs, photography jobs, videography jobs, global freelance platform">
    <meta name="author" content="aid-solutions.com">
    <meta name="google-adsense-account" content="ca-pub-6204097522219862">
    <!-- favicon image -->
    <link rel="stylesheet" href="<?= URL ?>assets/bootstrap-4.6.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= URL ?>assets/fontawesome-free-6.1.1-web/css/all.css">
    <script src="<?= URL ?>assets/javascript/uploadcv.js"></script>
    <script src="<?= URL ?>assets/javascript/code.js"></script>
    <link rel="icon" href="<?= URL ?>assets/images/logo/favicon.png" type="image/png">
    <script src="<?= URL ?>assets/jQuery link/jquery-3.6.1.js"></script>
    <link rel="stylesheet" href="<?= URL ?>assets/css/style.css">
    <script src="<?= URL ?>assets/javascript/connection.js"></script>
    <link rel="stylesheet" href="<?= URL ?>assets/css/why-to-register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="<?= URL ?>assets/javascript/survey.js"></script>
    <?php
        include __DIR__ . "/../chatbox.php";
    ?>

    

    <script>
        $(document).ready(function() {
            $(".dropbtn").click(function() {
                $("#myDropdown").toggle() && $("#myForm").hide();
            })

            $(".user").click(function() {
                $(".dropdown-content").toggle();
            }) 

            $(".body").click(function() {
                $(".dropdown-content").hide(0) && $("#myForm").hide(30);
            })

            $(".search-bar").click(function() {
                $(".body").toggle() && $(".mobile-search").toggle();
            })

            $("#footer").click(function() {
                $("#myForm").hide();
            })

            setTimeout(function() {
                $('.preloader').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 3000);

            // for the counting number
            function animateCounter(element, start, end, duration) {
                let startTime = null;

                function updateCounter(currentTime) {
                    if (!startTime) startTime = currentTime;
                    const elapsedTime = currentTime - startTime;
                    const progress = Math.min(elapsedTime / duration, 1);
                    element.innerText = Math.floor(progress * (end - start) + start);

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        element.innerText = end; // Ensure it ends exactly at the end value
                    }
                }

                requestAnimationFrame(updateCounter);
            }

            function startCounting() {
                document.querySelectorAll('.counter').forEach(counter => {
                    const endValue = parseInt(counter.getAttribute('data-count'), 10);
                    animateCounter(counter, 0, endValue, 2000); // 2000ms for the counting duration
                });
            }

            // Start the counting animation every 10 seconds
            startCounting();
            setInterval(startCounting, 10000);

            // end of count code

            
            // for FAQ accordion
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("accordions");
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });
            }
            // end of accordions code 


            // for drop sidenav contents in mobile 
            $(".job-right").click(function() {
                $(".job-down").toggle(100) && $(".job-content").toggle(100) && $(".job-right").toggle(100);
            })

            $(".job-down").click(function() {
                $(".job-down").toggle(100) && $(".job-right").toggle(100) && $(".job-content").toggle(100);
            })

            $(".how-right").click(function() {
                $(".how-down").toggle(100) && $(".how-right").toggle(100) && $(".how-to-content").toggle(100);
            })

            $(".how-down").click(function() {
                $(".how-down").toggle(100) && $(".how-right").toggle(100) && $(".how-to-content").toggle(100);
            })

            // display selected image name
                document.querySelector('.click-msg-btn').addEventListener('click', function() {
                document.getElementById('contact').click();
            });

            document.getElementById('contact').addEventListener('change', function() {
                var fileName = this.files[0].name;
                document.getElementById('file-name').textContent = fileName;
            });      
            
            
        })
    </script>
    <script src="https://accounts.google.com/gsi/client" async></script>
</head>
<body>

<?php
    include __DIR__ . "/../../partials/cookie.php";
?>


<script>
    document.getElementById("title_title").innerHTML = "Dashboard";
</script>


    <!-- comment popup -->
    <style>
        #popup-container {
            position: fixed;
            bottom: 10px;
            left: 10px;
            width: 250px;
            z-index: 1000;
        }
        
        .popup {
            width: 250px;
            background-color: silver;
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-size: 13px;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        
        .popup.show {
            opacity: 1;
        }
        
        @media screen and (min-width: 0px) and (max-width: 767px) {
            #header {
                position: unset;
            }
        }

    </style>

    <!-- pop up comments -->
    <div id="popup-container"></div>

    <?php
        include __DIR__ . "/../../assets/css/preloader.php";
    ?>

    <!-- scroll to the top icon -->
    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" title="Go to top">
        <i class="fa fa-arrow-up"></i>
    </button>


    
    <div class="container-fluid mt-0" style="padding-top: 30px;" id="header">
        <div class="container">
            <div class="row w-12">
                
                <div class="col-9 col-sm-3 col-md-3" id="logo-con">
                    <a href="<?= URL ?>index">
                        <img src="<?= URL ?>assets/images/logo/logo.png" alt="">
                    </a> 
                </div>
                <!-- users icon      -->
                <!-- <div class="col-3 text-dark users-div">
                    <a href="" class="user mt-3 text-muted" style="text-decoration: none; font-size: small">Sign In</a>
                </div> -->

                <div class="col-3 bar">
                    <p class="fa fa-bars mt-3 ml-0" onclick="openNav()"></p>
                </div>
                
                <div class="col-sm-7 col-md-7">
                    <form class="form-horizontal">
                        <div class="form-group search">
                            <div class="col-md-12 header_dropdown">
                                <div class="row mt-4">
                                    <a href="<?= URL ?>index" class="col-md-3 mt-2 text-muted header_dropdown_home" style="text-decoration: none; font-size: 15px">Home</a>
                                    <div class="mt-2 job-categories">
                                        <a href="<?= URL ?>job-categories" class="col-md-3 mt-2 text-muted how" style="text-decoration: none; font-size: 15px">Job Categories <i class="fa fa-angle-down ml-1"></i></a>
                                        <div class="job-categories-drop">
                                            <a href="<?= URL ?>writing">Writing Jobs</a>
                                            <a href="<?= URL ?>photography&videography">Photography and Videography Jobs</a>
                                            <a href="<?= URL ?>designing">Designing Jobs</a>
                                            <a href="<?= URL ?>marketing">Marketing Jobs</a>
                                            <a href="<?= URL ?>developer">Developer Jobs</a>
                                            <a href="<?= URL ?>micro">Micro Jobs</a>
                                            <a href="<?= URL ?>research&development">Research and Development Jobs</a>
                                            <a href="<?= URL ?>music&audio">Music and Audio Jobs</a>
                                            <a href="<?= URL ?>finance">Finance Jobs</a>
                                        </div>
                                    </div>
                                    <div class="how-it-works mt-2">
                                        <a href="<?= URL ?>how-it-works" class="col-md-3 text-muted how" style="text-decoration: none; font-size: 15px">How It Works <i class="fa fa-angle-down ml-1"></i></a>
                                        <!-- dropdown for the headers -->

                                        <!-- for how it works -->
                                        <div class="how-it-works-drop">
                                            <a href="<?= URL ?>why-to-register" class="col-md-12">why to register</a>
                                            <a href="<?= URL ?>who-should-register" class="col-md-12">who should register</a>
                                            <a href="<?= URL ?>apply" class="col-md-12">Apply</a>
                                            <a href="<?= URL ?>faq" class="col-md-12">FAQ</a>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- mobile side navbar -->
                <div id="mySidenav" class="sidenav pb-5" style="background-color: #212728">
                    <a href="javascript:void(0)" class="closebtn text-white" onclick="closeNav()" style="text-decoration: none;">&times;</a>
                    <div class="container mt-4">
                        <div class="" style="font-size: 19px; font-weight: lighter">
                            <div class="row">
                                <a href="<?= URL ?>index" class="col-12 mb-3" style="text-decoration: none; color: white;"><i class="fa-solid fa-home mr-1"></i> Home</a>
                            </div>
                            <div class="row">
                                <a href="<?= URL ?>job-categories" class="col-10" style="text-decoration: none; color: white; border-right: 1px solid silver; margin-bottom: 10px"><i class="fa-solid fa-briefcase mr-1"></i> Job Categories</a>
                                <span class="col-2 pt-1 pb-2" style="text-decoration: none; color: white"><i class="fa fa-angle-down job-down" id="job-down"></i><i class="fa fa-angle-right job-right"></i></span>
                            </div>
                            <!-- job categories dropdown content for mobile -->
                            <div class="job-content mb-4">
                                <div class="container">
                                    <div class="row">
                                        <a href="<?= URL ?>writing" class="col-12">Writing Jobs</a>
                                        <a href="<?= URL ?>photography&videography" class="col-12">Photography and Videography Jobs</a>
                                        <a href="<?= URL ?>designing" class="col-12">Designing Jobs</a>
                                        <a href="<?= URL ?>marketing" class="col-12">Marketing Jobs</a>
                                        <a href="<?= URL ?>developer" class="col-12">Developer Jobs</a>
                                        <a href="<?= URL ?>micro" class="col-12">Micro Jobs</a>
                                        <a href="<?= URL ?>research&development" class="col-12">Research and Development Jobs</a>
                                        <a href="<?= URL ?>music&audio" class="col-12">Music and Audio Jobs</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <a href="<?= URL ?>how-it-works" class="col-10" style="text-decoration: none; color: white; border-right: 1px solid silver; margin-bottom: 10px"><i class="fa-solid fa-question-circle mr-1"></i> How it Works</a>
                                <span class="col-2 pt-1 pb-2" style="text-decoration: none; color: white"><i class="fa fa-angle-down how-down" id="how-down"></i><i class="fa fa-angle-right how-right"></i></span>
                            </div>
                            <!-- how it works content for mobile view -->
                            <div class="how-to-content mb-4">
                                <div class="container">
                                    <div class="row">
                                        <a href="<?= URL ?>why-to-register" class="col-12">Why to Register</a>
                                        <a href="<?= URL ?>who-should-register" class="col-12">Who should Register</a>
                                        <a href="<?= URL ?>faq" class="col-12">FAQ</a>
                                        <a href="<?= URL ?>apply" class="col-12">Apply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php   
                                    if (isset($_SESSION['user'])) {
                                        $id = $_SESSION['user']['id'];
                                ?>
                                        <a href="<?= URL ?>user/dashboard" class="col-12 mb-3" style="text-decoration: none; color: white;"><i class="fa-solid fa-house-user mr-1"></i> Dashboard</a>
                                        <a href="<?= URL ?>account/login?logout=<?= $id ?>" onclick="logoutUser();" class="col-12 mb-3" style="text-decoration: none; color: white;"><i class="fa-solid fa-sign-out-alt mr-1"></i> Log Out</a>
                                <?php
                                    }
                                    else {
                                ?>
                                        <a href="<?= URL ?>account/login" class="col-12" style="text-decoration: none; color: white;"><i class="fas fa-sign-in-alt mr-1"></i> Log In</a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                

                <!-- dropdown contents for PC -->
                <div class="col-sm-2 col-md-2 w-100">
                    <div class="dropdown dropright w-100" id="dropdown">
                            <?php   
                                if (isset($_SESSION['user'])) {
                            ?>
                                    <?php if (strlen($avatar) == 0): ?>
                                        <a href="<?= URL ?>user/dashboard">
                                            <img src="<?= URL ?>assets/images/gender/avatar3.png" alt="" onclick="openDash();" style="width: 40px; border-radius: 50%; border: 5px solid silver; height: 40px;">  
                                        </a>    
                                    <?php endif ?>
                                    <?php if (strlen($avatar) > 0): ?>
                                        <a href="<?= URL ?>user/dashboard"><img src="<?= URL ?>assets/images/avatar/<?= $avatar ?>" alt="" style="width: 40px; border-radius: 50%; border: 5px solid silver; height: 40px;"></a>
                                    <?php endif ?>
                            <?php
                                }
                                else {
                            ?>
                                    <a href="<?= URL ?>account/login" class="dropbtn text-muted" style="font-size: 13px">
                                        <button type="button" class="btn btn-info text-white  btn-md mt-1"><i class="fa fa-user"></i></button>
                            <?php
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="body">

        <!-- carousel -->
        <div id="demo" class="carousel slide users_header" data-ride="carousel">
            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= URL ?>assets/images/users_background/Microeconomics.jpeg" alt="">
                </div>
                <div class="carousel-item">
                    <img src="<?= URL ?>assets/images/users_background/Men of bussines containing business, businessman, and card.jpeg" alt="">
                </div>
            </div>
        </div>
        <!-- end of carousel -->


        <!-- contents -->
        <div class="container mb-5 mt-5">
            <div class="row">
                <!-- left nav -->
                <div class="col-12 col-md-3 left_user_nav pt-5">
                    <!-- constant header -->
                    <div class="users_avatar">
                        <?php 
                            if (strlen($avatar) == 0) {
                        ?>
                            <img src="<?= URL ?>assets/images/gender/avatar3.png" alt="" class="w-100">
                        <?php
                            }
                            else {
                        ?>
                                <img src="<?= URL ?>assets/images/avatar/<?= $avatar ?>" alt="" class="w-100">
                        <?php
                            }
                        ?>
                    </div>
                    <div class="avatar_upload">
                        <form action="">
                            <input type="file" name="avatar" id="avatar">
                            <button type="button" class="btn-muted mt-4 text-muted" style="border: none;" data-toggle="modal" data-target="#upload_profile"><span class="fas fa-cloud-upload-alt"></span> Upload Photo</button>

                            <!-- profile pics alert -->
                            <!-- success message -->
                            <div class="container mt-2">
                                <?php if (isset($_SESSION['profile-success'])): ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?=
                                            $_SESSION['profile-success'];
                                            unset($_SESSION['profile-success']);
                                        ?>
                                    </div>
                                <?php endif ?>

                                <!-- error message -->
                                <div class="container">
                                    <?php if (isset($_SESSION['upload_error'])): ?>
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <?=
                                                $_SESSION['upload_error'];
                                                unset($_SESSION['upload_error']);
                                            ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            

                            <?php
                                $hour = date('H');
                                if ($hour < 12) {
                                    $greeting = 'Good Morning';
                                } elseif ($hour < 18) {
                                    $greeting = 'Good Afternoon';
                                } else {
                                    $greeting = 'Good Evening';
                                }
                            ?>
                            <!-- amount -->
                            <p class="mt-2 mb-5" style="font-weight: lighter;"><?= $greeting,  ", " . $firstanme ?></p>
                            <!-- <p class="text-muted mt-2">$ 0.00</p> -->


                            <!-- menu bar for devices -->
                            <div class="text-secondary device-bars mb-3" style="text-align: center;">
                                <span class="fa fa-bars" id="navBar_icon" onclick="openNavbar();"></span>
                            </div>
                        </form>
                    </div>

                    <!-- constants contents -->
                    <div class="constant-contents" id="usersNav">
                        <div class="row nav-list">
                            <p class="btnclose" onclick="closeNavbar();"><span class="fa fa-times"></span></p>
                            <a href="<?= URL ?>user/dashboard" class="pl-3 dashNotify"><span class="fas fa-users"></span>Dashboard</a>
                            <a href="<?= URL ?>user/my-profile" class="pl-3 profileNotify"><span class="fas fa-user-tie"></span>My Profile</a>
                            <a href="<?= URL ?>user/search-jobs" class="pl-3 searchNotify"><span class="fas fa-search-plus"></span>Search Jobs</a>
                            <?php if ($admin == 1): ?>
                                <a href="<?= URL ?>admin/manage-users" class="pl-3"><span class="fas fa-cogs"></span> Admin Panel</a>
                            <?php endif ?>
                            <a href="<?= URL ?>user/my-resume" class="pl-3 resumeNotify"><span class="fas fa-file-pdf"></span>My Resume</a>
                            <?php  
                                $queryAlert = mysqli_query($connection, "SELECT * FROM applied WHERE users_id= '$id' AND status= 'Accepted'");
                                if (mysqli_num_rows($queryAlert) > 0) {
                                    $alertBtn = "+" . mysqli_num_rows($queryAlert);
                                }
                                else {
                                    $alertBtn = " ";
                                }
                            ?>
                                <a href="<?= URL ?>user/accepted-jobs" class="pl-3 acceptedNotify"><span class="fas fa-check-circle"></span>Accepted Jobs <span class="text-success" style="font-weight: bold; font-size: small;"><?= $alertBtn ?></span></a>
                            <a href="<?= URL ?>user/favorite" class="pl-3 favoriteNotify"><span class="far fa-heart"></span>Favorite</a>
                            <a href="<?= URL ?>user/cv-manager" class="pl-3 cvNotify"><span class="fas fa-file-alt"></span>CV Manager</a>
                            <a href="<?= URL ?>withdrawal/payment-withdraw-process" class="pl-3 cvNotify"><span class="fa fa-piggy-bank"></span>Payouts</a>
                            <a href="<?= URL ?>user/applied-jobs" class="pl-3 appliedNotify"><span class="fas fa-clipboard-check"></span>Applied Jobs</a>
                            <a href="<?= URL ?>user/emails.php" class="pl-3 emailNotify"><span class="fas fa-paper-plane"></span>My Email</a>
                            <a href="<?= URL ?>user/following" class="pl-3 followingNotify"><span class="fas fa-user-check"></span>Following</a>
                            <a href="<?= URL ?>user/change-password" class="pl-3 chnageNotify"><span class="fas fa-lock"></span>Change Password</a>
                            <a href="<?= URL ?>user/review" class="pl-3 reviewNotify"><span class="fas fa-star-half-alt"></span>Review</a>
                            <a href="<?= URL ?>account/login?logout=<?= $id ?>" onclick="logoutUser();" class="pl-3 bg-danger text-white"><span class="fas fa-sign-out-alt"></span>Log Out</a>
                        </div>
                    </div>
                </div>

                <!-- right nav -->
                <div class="col-12 col-sm-12 col-md-9 right_users_nav pb-5" id="right_users_nav">
                                
                    <!-- profile pics modal -->
                    <div class="modal fade" id="upload_profile">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="container pt-4 pb-4">
                                    <form action="<?= URL ?>user/profile-upload" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" name="users_id" value="<?= $id ?>">
                                        <div class="row mr-2 ml-2">
                                            <div class="col-sm-12 col-md-12" style="width: 100%; margin: auto;">
                                                <img id="preview" src="#" name="img"  alt="Profile Picture Preview" style="display: none; width: 100%; height: 200px" class="mb-3">
                                            </div>
                                            <input type="file" id="profilePicture" name="profilePicture" accept="image/*" onchange="showPreview(event)" style="border: none; text-align: center; display: none;">
                                            <label for="profilePicture" style="text-align: center; border: 1px solid silver;" class="col-12 col-md-12 pt-3 pb-3">Click to Select Photo</label>
                                            <button type="submit" class="btn btn-primary" name="profile">Upload Photo</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>












