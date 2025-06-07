<?php
    include "partials/header.php";
?>


<style>
    .question {
        margin-bottom: 20px;
    }
</style>

<script>
    document.getElementById("title_title").innerHTML = "Survey Test | aid-solutions";
</script>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Survey Test</p>
    </div>

    
    
        <form action="" id="surveyForm" method="POST">
            <div class="col-12 col-md-12 dash_heaer_con mt-5">
                <div id="questionsContainer"></div>
                <button type="submit" class="btn btn-primary" data-target="#survey_result" data-toggle="modal">Submit</button>
            </div>
            
        </form>

</div>
    



<!-- do you wish to submit? -->
<div class="modal fade" id="survey_result">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <p style="text-align: center;padding: 20px 0px">Would you like to submit?</p>
            <!-- Modal footer -->
            <form action="<?= URL ?>user/survey-test_logic.php" method="POST">
                <input type="text" value="<?= $id ?>" name="users_id" style="display: none;">
                <input type="text" id="result" value="" style="display: none;" name="score">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="survey_check" data-target="#survey_failed" data-toggle="modal">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>


















<?php
    include "partials/footer.php";
?>