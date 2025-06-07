<?php
    include "./partials/header.php";
?>

<style>
    
    
    .free-img img {
        width: 100%;
        height: 340px;
    }
    
    .invite {
        font-size: 16px;
        color: black;
        font-family: sans-serif;
    }
    
    .recent img {
        width: 100%;
        height: 100px;
    }
    
    .register {
      transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    
    .register:hover {
      background-color: #17a2b8; /* darker blue color */
      text-decoration: none;
    }
    
    .register i {
      transition: transform 0.3s ease-in-out;
    }
    
    .register:hover i {
      transform: scale(1.2) rotate(360deg); /* scale up and rotate the icon */
      animation: pulse 1s infinite;
    }
    
    @keyframes pulse {
      0% {
        transform: scale(1.2) rotate(360deg);
      }
      50% {
        transform: scale(1.5) rotate(360deg);
      }
      100% {
        transform: scale(1.2) rotate(360deg);
      }
    }
  


    @media screen and (min-width: 0px) and (max-width: 767px) {
        .index-carousel img {
            height: 480px;
        }
        
        .invite {
            margin-top: 20px;
        }
        
        .free-img img {
            height: 480px;
            width: 100%;
        }
    }

</style>

<script>
    document.getElementById('title_title').innerHTML = "Work, Grow, and Thrive in the Global Freelance Market";
</script>

<div class="container-fluid">
    <!-- beginning of carousel -->
    <div id="" class="carousel slide index-carousel" data-ride="carousel">
        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= URL ?>assets/images/index/Ford-Keast-Sept-5-2024-Freelancers.webp" alt="" width="100%" height="550px">
            </div>
            <div class="carousel-item">
                <img src="<?= URL ?>assets/images/index/shutterstock_790043194-scaled.jpg" alt=""  width="100%" height="550px">
            </div>
            
            
            <div class="carousel-item">
                <img src="<?= URL ?>assets/images/index/business-8319519_1280.jpg" alt=""  width="100%" height="550px">
            </div>
            
        </div>
    </div>
    <!-- end of carousel -->




    <!-- notification of scam  -->
    <div class="container bg-danger mt-5">
        <div class="container text-white pt-3 pb-3">
            <h3 style="font-weight: lighter;">Prospective Contractors: Please be Aware of Scams</h3>
            <p>We want to alert you to a rise in fraudulent activities targeting individuals seeking transcription services. Scammers are posing as legitimate transcription providers to solicit payments or sensitive information from unsuspecting clients. Reports of new scams are welcome at <a href="mailto:fraud@aid-solutions.com">fraud@aid-solutions.com</a>, but please be aware there is little we can do, as these criminals are not based in any jurisdiction where we operate. Please also report them to the site where you first saw the scam.</p>

            <p>Please be aware that all legitimate transcribing services are <b>only</b> available through our official website, AID Solutions. If you are contacted outside our platform by anyone claiming to represent us or offering transcription services, it is a scam.</p>
        </div>
    </div>
    
    
    <!---->
    <div class="container-fluid">
        <p class="header-tag mt-5">We Invite Job Applications</p>
        <div class="container">
            <div class="row ">
                <div class="col-12 col-md-3 col-lg-3 col-sm-12 free-img">
                    <img src="<?= URL ?>assets/images/index/Premium Photo _ Smiling young female student isolated.jpg">
                </div>
                <div class="col-12 col-md-9 col-lg-9 col-xl-9 invite">
                    <p>Our company is in the process of hiring <b>remote freelancers</b>, part time and full time, for our diverse <b>online work-from-home</b> projects. These are global job openings with payouts starting at $2 per assignment and going up to $200 a week. With a job guarantee, comprehensive training and ongoing support to ensure maximum earnings you cannot ask for more.</p>
                    
                    <p>We offer <b>freelance jobs</b> for students, women, young, and retired folks, as well as those working people willing to take up a side hustle in their part time worldwide.</p>
                    <p>Launch your career with our platform, offering virtual micro-tasks perfect for interns and freshers seeking experience and challenging projects for professionals. <b>Join us and secure your job today!</b></p>
                </div>
            </div>
        </div>
        
        <!--register button-->
        <a href="<?= URL ?>account/login" class="register"><button type="button" class="btn btn-info btn-lg mx-auto d-block mt-4"><i class="fa fa-arrow-right small"></i> Get Hired Now!!</button></a>
    </div>



    <div class="container pt-5" id="">
        <p class="header-tag">Job Categories</p>
        <div class="">
            <p>Remote freelancing online jobs are becoming increasingly popular, as they offer the flexibility and freedom to work from anywhere in the world. There are a wide variety of remote freelancing jobs available, covering a wide range of skills and experience levels.</p>

            <p>Our mission has always been to empower freelancers by providing a reliable platform that connects them directly with clients. By extending our reach to every country, we are taking a significant step towards creating a truly inclusive and diverse freelancing community.</p>

            <p>Remote freelancing can be a great way to earn a living and have a flexible work schedule. Whether you are skilled or unskilled, there are many different remote freelancing online job opportunities available.</p>

            <p>We offer freelance jobs for students, women, young, and retired folks, as well as those working people willing to take up a side hustle in their part time.</p>

            <p>Join us today and be a part of a global network of talented freelancers. Experience the ease and efficiency of AID, and take your freelancing career to new heights, no matter where you are.</p>
        </div>

    </div>



    <!-- listed offered jobs -->
    <div class="container pb-5 recent">
        <p class="header-tag">Trending Remote Freelancing Job Categories</p>
        <div class="mb-3">
            <div class="row job-lists">
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="./assets/images/Coding icons for free download _ Freepik.jpg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Developer Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Find expert developers for web, mobile, software, and game development projects ... </p>
                                <!-- <p style="text-align: center; font-weight: bold">1209 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-primary w-100 btn-md">Browse Developer Jobs</button></a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/Download Hand writing with pen black glyph icon for free.jpg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Writing Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Discover talented writers for content creation, copywriting, technical writing, and more ...</p>
                                <!-- <p style="text-align: center;font-weight: bold">2349 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-success w-100 btn-md">Browse Writing Jobs</button></a>
                            </div>
                        </div>
                
                    </div>
                </div>
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/Investment Success Clipart Vector, Graph Graphics Illustration Finance And Investment Success Will Occur  Icons   Vector, Finance Icons, Icons Icons, Success Icons PNG Image For Free Download.jpg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Finance Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Hire experts in accounting, financial analysis, bookkeeping, and tax preparation ...</p>
                                <!-- <p style="text-align: center;font-weight: bold">1059 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-warning w-100 btn-md">Browse Finance Jobs</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/photography.jpg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Photography and Videography Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Find skilled photographers and videographers for events, product shoots, and video production ...</p>
                                <!-- <p style="text-align: center;font-weight: bold">959 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-dark w-100 btn-md">Browse Photography Jobs</button></a>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>

        <!-- second row -->
        <div class="pb-0">
            <div class="row job-lists">
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/Paint Palette free icons designed by Darius Dan.jpg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Designing Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Hire creative designers for graphic design, UI/UX, branding, and illustration projects ...</p>
                                <!-- <p style="text-align: center;font-weight: bold">1853 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-danger w-100 btn-md">Browse Designing Jobs</button></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/micro (2).jpg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Micro Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Internet Researching, Typing, Data Entry, Surveys, Form Filling ...</p>
                                <!-- <p style="text-align: center;font-weight: bold">2034 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-secondary w-100 btn-md">Browse Micro Jobs</button></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/micro (1).jpg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Music and Audio Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Find professionals for audio production, voice-over, music composition, and podcast editing ...</p>
                                <!-- <p style="text-align: center;font-weight: bold">1229 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-dark w-100 btn-md">Browse Audio Jobs</button></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-12 col-md-3 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/research/growth.jpeg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Research and Development Jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Hire experts for scientific research, product development, market analysis, and innovation projects ...</p>
                                <!-- <p style="text-align: center;font-weight: bold">2739 opening</p> -->
                                <a href="<?= URL ?>user/search-jobs"><button type="button" class="btn btn-light w-100 btn-md">Browse Research Jobs</button></a>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <p>Select a job category based on your interest and expertise and add your profile to our remote and freelance jobs database! If you are not interested in any of the job categories above, you can still add your profile to our database. We will match you with the most relevant jobs as they become available.</p>
    </div>


    <section class="videoFact01 pb-5">
        <div class="container largeContainer">
            <div class="row">
                <div class="col-xl-6">
                    <div class="video_banner">
                        <img src="<?= URL ?>assets/images/Premium Photo _ The backside of business muslim woman working  blank laptop display _.jpg" alt="">
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="fact_02">
                        <h5>Customers With 100% Satisfaction</h5>
                        <h2><span class="counter" data-count="808">250</span><i>k</i></h2>
                        <p>Our commitment to excellence and customer satisfaction drives everything we do.</p>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="fact_02">
                        <h5>Numerous Jobs Available</h5>
                        <h2><span class="counter" data-count="90"></span>K</h2>
                        <p>Explore opportunities that match your expertise and aspirations, and take the next step towards a fulfilling career journey.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Free Membership & Job Guarantee -->
    <div class="mb-5">
        <p class="header-tag">Free Membership & Job Guarantee</p>

        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/free membership and job guarantee/Free Lifetime Membership.jpeg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Global Job Opportunities</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>AID Solutions offers freelancers access to a wide range of global job opportunities, enabling them to connect with international clients and work on projects from anywhere in the world.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/free membership and job guarantee/Guaranteed Freelancing jobs.jpeg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Guaranteed Freelancing jobs</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>AID Solutions provides freelancers with guaranteed job opportunities by directly connecting them with clients, ensuring steady work without the need for bidding or competing for projects.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 job-container">
                    <div class="job-container_img pt-3">
                        <img src="<?= URL ?>assets/images/free membership and job guarantee/Global Job Opportunities.jpeg" alt="">
                    </div>
                    <div class="container mt-3">
                        <p class="trending-header">Free Lifetime Membership</p>
                        <div class="trending-content">
                            <div class="container">
                                <p>Join AID Solutions today and enjoy Free Lifetime Membership with access to job opportunities, platform features, and client connections—without any membership fees, ever.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (!isset($_SESSION['user'])): ?>
        <div class="container mb-5" style="text-align: center">
            <a href="<?= URL ?>account/login"><button type="button" class="btn btn-primary btn-lg">Register With Us Now!</button></a>
        </div>
    <?php endif ?>


    <!-- what our freelancers say about our jobs -->
    <div class="container-fluid carousel mb-5">
        <div class="carousel-bg">
            <img src="<?= URL ?>assets/images/world.jpg" alt="img">
        </div>
        <div class="carousel-contents">
            <p class="header-tag">What Our Freelancers Say About Us</p>
            <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- The slideshow -->
                <div class="carousel-inner carousel-main">
                    <?php
                        $featured = mysqli_query($connection, "SELECT * FROM comment WHERE featured= '1'");
                        if (mysqli_num_rows($featured) == 1) {
                            $featuredData = mysqli_fetch_assoc($featured);
                            $featuredImage = $featuredData['avatar'];
                            $name = $featuredData['firstname'] . " " . $featuredData['lastname'];
                            $message = $featuredData['message'];
                            $country = $featuredData['country'];
                            $star = $featuredData['star'];

                            if ($star == '1') {
                                $star = "&#9733;";
                            } elseif ($star == '2') {
                                $star = "&#9733;&#9733;";
                            } elseif ($star == '3') {
                                $star = "&#9733;&#9733;&#9733;";
                            } elseif ($star == '4') {
                                $star = "&#9733;&#9733;&#9733;&#9733;";
                            } else {
                                $star = "&#9733;&#9733;&#9733;&#9733;&#9733;";
                            }

                    ?>
                            <div class="carousel-item active">
                                <div class="carousel-img">
                                    <img src="<?= URL ?>comment/<?= $featuredImage ?>" alt="">
                                </div>
                                <div class="carousel-comment mt-3">
                                    <p class="commetors-name"><?= $name ?> <i><?= $star ?></i></p>
                                    <p><?= $message ?></p>
                                    <p><?= $country ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                        
                    <?php
                        $normal = mysqli_query($connection, "SELECT * FROM comment WHERE NOT featured= '1'");
                        if (mysqli_num_rows($normal) > 0) {
                            foreach ($normal as $data) {
                                $normalImage = $data['avatar'];
                                $fullname = $data['firstname'] . " " . $data['lastname'];
                                $message = $data['message'];
                                $country = $data['country'];
                                $star = $data['star'];
                                
                                if ($star == '1') {
                                    $star = "&#9733;";
                                } elseif ($star == '2') {
                                    $star = "&#9733;&#9733;";
                                } elseif ($star == '3') {
                                    $star = "&#9733;&#9733;&#9733;";
                                } elseif ($star == '4') {
                                    $star = "&#9733;&#9733;&#9733;&#9733;";
                                } else {
                                    $star = "&#9733;&#9733;&#9733;&#9733;&#9733;";
                                }

                    ?>
                                <div class="carousel-item">
                                    <div class="carousel-img">
                                        <img src="<?= URL ?>comment/<?= $normalImage ?>" alt="">
                                    </div>
                                    <div class="carousel-comment mt-3">
                                        <p style="color: gold;"><i><?= $star ?></i></p>

                                        <p class="commetors-name"><?= $fullname ?> <i></i></p>
                                        <p><?= $message ?></p>
                                        <p><?= $country ?></p>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    ?>
                            
                </div>
            </div>
        </div>
    </div>



    <!-- sponsors -->
    <div class="mb-5">
        <p class="header-tag">Our Sponsorship Family</p>
        <div class="container">
            <div class="row">
                <img src="<?= URL ?>assets/images/sponsors/1-qpxrutqtwwj5f3cex46av7eqw9sbwjvxi0f9uhc3to.webp" alt="sponsors" class="col-6 col-md-2 mb-2">
                <img src="<?= URL ?>assets/images/sponsors/4-qpxs1bsn6nfjpzwfyfcem2cit7qq56p3e6v6cdp2sc.webp" alt="sponsors" class="col-6 col-md-2 mb-2">
                <img src="<?= URL ?>assets/images/sponsors/8-qpxrdbyypwl1ccr72jy9gmbww40encfrrfbyb39vmk.webp" alt="sponsors" class="col-6 col-md-2 mb-2">
                <img src="<?= URL ?>assets/images/sponsors/5-qpxs3joxbkgx4uodzvvp006paysxbgia16bg4wem3g.webp" alt="sponsors" class="col-6 col-md-2 mb-2">
                <img src="<?= URL ?>assets/images/sponsors/6-qpxrs163lmpgwtei8ep7yesfc1k20xsng6mbhvh8bg.webp" alt="sponsors" class="col-6 col-md-2 mb-2">
                <img src="<?= URL ?>assets/images/sponsors/7-qpxrnq2q9yt5p5nse1ns0zxdbgshqvoxuuz7b7v6u4.webp" alt="sponsors" class="col-6 col-md-2 mb-2">
            </div>
        </div>
    </div>



<?php
    include __DIR__ . "/./user/partials/footer.php";
?>