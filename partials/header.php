<?php
    include __DIR__ . '/../database.php';

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
    <link rel="icon" href="<?= URL ?>assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?= URL ?>assets/bootstrap-4.6.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= URL ?>assets/fontawesome-free-6.1.1-web/css/all.css">
    <script src="<?= URL ?>assets/javascript/uploadcv.js"></script>
    <script src="<?= URL ?>assets/javascript/code.js"></script>
    <script src="<?= URL ?>assets/jQuery link/jquery-3.6.1.js"></script>
    <link rel="stylesheet" href="<?= URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= URL ?>assets/css/why-to-register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="<?= URL ?>assets/javascript/survey.js"></script>
    <script src="<?= URL ?>assets/javascript/connection.js"></script>
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons"-->
      <!--rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    

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
            }, 9000);

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

            // When the user clicks on the button, scroll to the top of the document
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                var scrollToTopBtn = document.getElementById("scrollToTopBtn");
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    scrollToTopBtn.style.display = "block";
                } else {
                    scrollToTopBtn.style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            document.getElementById('scrollToTopBtn').addEventListener('click', function() {
                window.scrollTo({top: 0, behavior: 'smooth'});
            });

            // Hide the preloader and show the content after 4 seconds
            setTimeout(function () {
                document.querySelector('.preloader').style.display = 'none';
            }, 3000); // 4000ms = 4 seconds




        })
    </script>
    <script src="https://accounts.google.com/gsi/client" async></script>

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
        
        .animate-text {
            opacity: 0;
            transform: translateX(100px);
            transition: all 1s ease-in-out;
        }
        
        .animate-text.slide-in {
            opacity: 1;
            transform: translateX(0);
        }
    </style>

    
</head>
<body>


 

    <!-- pop up comments -->
    <div id="popup-container"></div>

    <?php
        include __DIR__ . "/../assets/css/preloader.php";
    ?>  

    <?php
        include __DIR__ . "/./cookie.php";
    ?>

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" title="Go to top">
        <i class="fa fa-arrow-up"></i>
    </button>

    
    <div class="container-fluid mt-0" style="padding-top: 0px;" id="header">
        <div class="container">
            <div class="row w-12">
                <div class="col-9 col-sm-3 col-md-3 mt-0" id="logo-con">
                    <a href="<?= URL ?>index">
                        <img src="<?= URL ?>assets/images/logo/logo.png" alt="">
                    </a> 
                </div>
                <!-- users icon      -->
                <!-- <div class="col-3 text-dark users-div">
                    <a href="" class="user mt-3 text-muted" style="text-decoration: none; font-size: small">Sign In</a>
                </div> -->

                <div class="col-3 bar">
                    <p class="bi bi-menu ml-0" onclick="openNav()"></p>
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
                                        <a href="<?= URL ?>how-it-works" class="col-md-3 text-muted how" style="text-decoration: none; font-size: 13px">How It Works <i class="fa fa-angle-down ml-1"></i></a>
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
                                    $id = $_SESSION['user']['id'];
                                    $fetch_avatar = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
                                    if (mysqli_num_rows($fetch_avatar) == 1) {
                                        $details = mysqli_fetch_assoc($fetch_avatar);
                                        $avatar = $details['avatar'];

                                        if (strlen($avatar) == 0): ?>
                                            <a href="<?= URL ?>user/dashboard">
                                                <img src="<?= URL ?>assets/images/gender/avatar3.png" alt="" style="width: 40px; border-radius: 50%; height: 40px; border: 5px solid silver">    
                                            </a>      
                                        <?php endif ?>
                                        <?php if (strlen($avatar) > 0): ?>
                                            <a href="<?= URL ?>user/dashboard"><img src="<?= URL ?>assets/images/avatar/<?= $avatar ?>" alt="" onclick="<?= URL ?>user/dashboard" style="width: 40px; border-radius: 50%; height: 40px; border: 5px solid silver">
                                            </a>
                                        <?php endif ?>

                            <?php

                                    }
                                }

                                else {
                            ?>
                                    <a href="<?= URL ?>account/login" class="dropbtn text-muted" style="font-size: 13px">
                                        <button type="button" title="Login | Register" class="btn btn-info text-white  btn-md mt-1"><i class="fa fa-user"></i></button>
                            <?php
                                }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="body">