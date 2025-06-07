<?php
    include "partials/header.php";
?>

<script>
    document.getElementById("title_title").innerHTML = "Survey Test Score";
</script>



<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Survey Test Score</p>
    </div>
</div>

<?php
    if (isset($_GET['survey'])) {
        $score = $_GET['survey'];
        if ($score == "failed") {
?>
            <div class="col-12 col-md-12 dash_heaer_con mt-5">
                <div class="col-12 col-md-12" style="width: 40%; margin:auto">
                    <img src="<?= URL ?>assets/images/survey/survey-error.jpeg" alt="" style="width: 100%; height: 250px;">
                </div>
                <div style="text-align: center;">
                    <p><b>Oops!</b> You Didn’t Pass the Survey Test This Time</p>
                </div>
                <div style="text-align: center;" class="mt-3">
                    <a href="<?= URL ?>user/survey-test.php"><button type="button" class="btn btn-primary">Try Again</button></a>
                    <a href="<?= URL ?>user/dashboard.php"><button type="button" class="btn btn-danger">Exit</button></a>
                </div>
            </div>
<?php
        }

        elseif ($score == "success") {
?>
            <div class="col-12 col-md-12 dash_heaer_con mt-5">
                <div class="col-12 col-md-12" style="width: 40%; margin:auto">
                    <img src="<?= URL ?>assets/images/survey/survey-success.jpeg" alt="" style="width: 100%; height: 250px;">
                </div>
                <div style="text-align: center;">
                    <p><b>Congratulations!</b> You've Passed the Survey Test</p>
                </div>
                <div style="text-align: center;" class="mt-3">
                    <form action="<?= URL ?>user/survey-score-success.php" method="POST">
                        <input type="text" value="<?= $id ?>" name="users_id" style="display: none;">
                        <button type="submit" class="btn btn-primary" name="proceed">Click to proceed</button>
                    </form>
                </div>
            </div>
<?php
        }

        else {
            header('location: ' . URL . 'user/dashnoard.php');
        }
    }

    else {
        header('location: ' . URL . 'user/dashnoard.php');
    }
    
?>







<?php
    include "partials/footer.php";
?>