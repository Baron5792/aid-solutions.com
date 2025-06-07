<?php
    include "./partials/header.php";
?>

<script>
    var title =document.getElementById("title_title");
    title.innerHTML = "Apply | aid-solutions";
</script>

<div class="container-fluid why-to-register_image mb-3">
    <img src="<?= URL ?>assets/images/index2 (1).jpg" alt="">
</div>

<div class="container mt-5 mb-5">

    <div class="apply-img-div">
        <img src="<?= URL ?>assets/images/apply/apply-header-img.webp" alt="">
    </div>

    <p class="WTR_header">Application Process</p>

    <div class="row mt-5 pb-5">
        <div class="col-12 col-md-6 apply-con">
            <div>
                <img src="<?= URL ?>assets/images/apply/registration.jpeg" alt="">
            </div>
            <div>
                <p>Registration and Verification</p>
                <p>Begin your journey by creating an account with us. It's quick and easy - just enter your email address and choose a password. Once you've signed up, we'll send a verification link to your email. Click on it to verify your account and start exploring what our platform has to offer.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 apply-con">
            <div>
                <img src="<?= URL ?>assets/images/apply/profile-creation.jpeg" alt="">
            </div>
            <div>
                <p>Complete Profile</p>
                <p>Your profile is your digital identity on our platform. Enhance it by providing essential personal details, outlining your skills, and detailing your relevant experience. Don't forget to upload a professional profile picture and any certifications or portfolios that showcase your expertise. A complete profile not only helps you stand out but also gives potential clients a clear view of your capabilities.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 apply-con">
            <div>
                <img src="<?= URL ?>assets/images/apply/survey.jpeg" alt="">
            </div>
            <div>
                <p>Take the Survey Test</p>
                <p>To ensure that you're well-prepared for the diverse range of freelancing opportunities available, we've designed a short survey test. This test assesses your knowledge of freelancing practices and helps us understand your strengths. Upon completion, you'll receive immediate feedback on your performance, guiding you on areas where you excel and areas where you might want to focus on improvement.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 apply-con">
            <div>
                <img src="<?= URL ?>assets/images/apply/submission.jpeg" alt="">
            </div>
            <div>
                <p>Start Exploring</p>
                <p>Once your profile is set up and you've completed the survey test, it's time to dive into our platform! Take a guided tour to familiarize yourself with our features – from browsing job listings to communicating with potential clients. Start applying for jobs that align with your skills and interests, and begin your journey towards success in the freelancing world.</p>
            </div>
        </div>
    </div>


    <?php if (!isset($_SESSION['user'])): ?>
        <div style="text-align: center;" class="mb-5 mt-5">
            <a href="<?= URL ?>account/login"><button type="button" class="btn btn-primary btn-md">Register Now</button></a>
        </div>
    <?php endif ?>

    <p>Our survey consists of a set of multiple-choice questions designed to assess various aspects of freelancing knowledge. Each question typically offers four options, providing a comprehensive evaluation of users' understanding and readiness for freelancing opportunities on our platform. To qualify for accessing job opportunities, users are required to achieve a minimum score of at least 50% on the survey.</p>

    <p>This statement outlines the structure of the survey, the assessment criteria, and the threshold users need to meet to qualify for freelancing opportunities on your platform.</p>






</div>

<?php 
    if (!isset($_SESSION['user'])) {
        include __DIR__ . "/./trending-jobs.php";
    }
    include "./partials/footer.php";
?>