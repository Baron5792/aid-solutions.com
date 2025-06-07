<?php
    include __DIR__ . "/./partials/header.php";

    if (isset($_SESSION['resume-data'])) {
        $cover_letter = $_SESSION['resume-data']['cover_letter'] ?? null;
        unset($_SESSION['resume-data']);
    }


    // check for user's education history in DB
    $educationCheck = mysqli_query($connection, "SELECT * FROM education WHERE userId= '$id'");
    if (mysqli_num_rows($educationCheck) > 0) {
        $eduData = mysqli_fetch_assoc($educationCheck);
        $title = $eduData['title'];
        $institute = $eduData['institute'];
        $startDate = $eduData['startDate'];
        $endDate = $eduData['endDate'];
        $description = $eduData['description'];
    } else {
        $title = "";
        $institute = "";
        $startDate = "";
        $endDate = "";
        $description = "";
    }


    // check for experience
    $experienceCheck = mysqli_query($connection, "SELECT * FROM experience WHERE userId= '$id'");
    if (mysqli_num_rows($experienceCheck) > 0) {
        $expData = mysqli_fetch_assoc($experienceCheck);
        $exptitle = $expData['title'];
        $expcompany = $expData['company'];
    } else {
        $exptitle = "";
        $expcompany = "";
    }

    // check for language
    $language  = mysqli_query($connection, "SELECT * FROM language WHERE userId= '$id'");
    if (mysqli_num_rows($language) > 0) {
        $langData = mysqli_fetch_assoc($language);
        $Langlabel = $langData['label'];
        $Langlevel = $langData['level'];
    } else {
        $Langlevel = "";
        $Langlabel = "";
    }



    // check for award
    $award = mysqli_query($connection, "SELECT * FROM award WHERE userId= '$id'");
    if (mysqli_num_rows($award)) {
        $awardData = mysqli_fetch_assoc($award);
        $awardTitle = $awardData['award'];
        $awardYear = $awardData['year'];
        $awardMessage = $awardData['message'];
    } else {
        $awardTitle = "";
        $awardYear = "";
        $awardMessage = "   ";
    }




?>

<style>
    .education_modal {
        display: none;
    }

    .resumeNotify {
        background-color: silver;
    }

    small {
        display: none;
        color: red;
    }
</style>

<script>
    document.getElementById("title_title").innerHTML = "My Resume | aid-solutions";
</script>


<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">My Resume</p>
    </div>

    <!-- education upload success -->
    <?php if (isset($_SESSION['education-success'])): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=
                $_SESSION['education-success'];
                unset($_SESSION['education-success']);
            ?>
        </div>
    <?php endif ?>

    <!-- experience upload success -->
    <?php if (isset($_SESSION['experience-success'])): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=
                $_SESSION['experience-success'];
                unset($_SESSION['experience-success']);
            ?>
        </div>
    <?php endif ?>
</div>



<form action="<?= URL ?>user/my-resume_logic.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="<?= $id ?>" name="users_id">
    <!-- alert success message -->
    <?php if (isset($_SESSION['resume-success'])): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=
                $_SESSION['resume-success'];
                unset($_SESSION['resume-success']);
            ?>
        </div>
    <?php endif ?>

    <!-- alert error message -->
    <?php if (isset($_SESSION['resume-error'])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=
                $_SESSION['resume-error'];
                unset($_SESSION['resume-error']);
            ?>
        </div>
    <?php endif ?>

    <div class="mt-5 mb-4 container">
        <p style="font-size: 20px"> <span class="fas fa-file"></span> <span>COVER LETTER</span></p>
    </div>

    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <div class="form-group">
            <textarea id="" class="form-control" style="height: 200px;" placeholder="Enter Letter" name="cover_letter"><?= $cover_letter ?></textarea>
        </div>
        <div class="form-group col-12 col-md-4">
            <input type="file" name="resume" id="cover_letter" style="display: none;" value="<?= htmlspecialchars($resume) ?>">
        </div>
    </div>

    <!-- skills and others -->
    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <!-- for education -->
        <div class="row mb-4">
            <div class="education col-12 col-md-9">
                <p style="font-size: 23px;"> <span class="text-info fas fa-graduation-cap"></span> Education</p>
            </div>
            <div class="dropdown col-12 col-md-3">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: small;" data-toggle="modal" data-target="#edu"> <span class="fa fa-plus"></span> Add Education</button>
            </div>
        </div>

        <!-- for experience -->
        <div class="row mb-4">
            <div class="education col-12 col-md-9">
                <p style="font-size: 23px;"> <span class="text-info fas fa-briefcase"></span> Experience</p>
            </div>
            
            <div class="col-12 col-md-3">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: small;" data-toggle="modal" data-target="#expy"> <span class="fa fa-plus"></span> Add Experience</button>
            </div>
        </div>


        <!-- for languages -->
        <div class="row mb-4">
            <div class="education col-12 col-md-9">
                <p style="font-size: 23px;"> <span class="text-info fas fa-language"></span> Languages</p>
            </div>
            <div class="col-12 col-md-3">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: small;" data-target="#lang" data-toggle="modal"> <span class="fa fa-plus"></span> Add Languages</button>
            </div>
        </div>

        <!-- for honors -->
        <div class="row mb-4">
            <div class="education col-12 col-md-9">
                <p style="font-size: 23px;"> <span class="text-info fas fa-trophy"></span> Honors and Awards</p>
            </div>
            <div class="col-12 col-md-3">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: small;" data-target="#trophy" data-toggle="modal"> <span class="fa fa-plus"></span> Add Award</button>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 mt-4">
        <label class="form-check-label col-12 col-md-12 mb-4">
            <input type="checkbox" class="form-check-input" value="" required>By clicking checkbox, you agree to our Terms and Conditions
        </label>
        <button type="submit" name="submit" class="btn btn-primary col-md-4 btn-sm">Update</button>
    </div>
</form>












    <!-- MODALS -->

    <!-- modal for education -->
    <div class="modal fade" id="edu">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container pt-4">
                    <form action="<?= URL ?>user/education-logic.php" method="POST" id="educationsForm">
                        <div class="row">
                            <input type="hidden" name="userId" value="<?= $id ?>">
                            <div class="form-group col-md-12 col-12">
                                <label for="title">Title *</label>
                                <input type="text" id="title" placeholder="Master's of Business Administrestion (MBA)" class="form-control" name="title" value="<?= $title ?>">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label for="title">Institute *</label>
                                <input type="text" id="institute" placeholder="University of London, UK" class="form-control" name="institute" value="<?= $institute ?>">
                            </div>  
                            <div class="form-group col-md-4 col-12">
                                <label for="title">Start Date *</label>
                                <input type="date" id="start_date" data-date="" data-date-format="DD MMMM YYYY" class="col-md-12 form-control" name="startDate" value="<?= $startDate ?>">
                            </div>
                            <div class="form-group col-md-4 col-12">
                                <label for="title">End Date *</label>
                                <input type="date" id="endDate" data-date="" data-date-format="DD MMMM YYYY" class="col-md-12 form-control" name="endDate" value="<?= $endDate ?>">
                            </div>
                            <!-- <div class="form-group col-md-4 col-12">
                                <label for="title" class="col-12 col-md-12">Present </label>
                                <input type="checkbox" name="" id="" class="ml-3">
                            </div> -->
                            <div class="form-group col-md-12 col-12">
                                <label for="title" class="">Description *</label>
                                <textarea id="description" style="height: 200px;" class="form-control" name="description"><?= $description ?></textarea>
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <button type="submit" name="education" class="btn btn-primary form-control">Add Education</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for experience -->
    <div class="modal fade" id="expy">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container pt-4">
                    <form action="<?= URL ?>user/experience-logic.php" method="POST" id="experienceForm">
                        <input type="hidden" name="userId" value="<?= $id ?>">
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label for="title">Title *</label>
                                <input type="text" placeholder="Senior Developer" class="form-control" id="insTitle" name="title" value="<?= $exptitle ?>">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label for="company">Company *</label>
                                <input type="text" placeholder="Tech Corps" class="form-control" id="insCompany" name="company" value="<?= $expcompany ?>">
                            </div>
                            
                            <div class="form-group col-12 col-md-3">
                                <button type="submit" class="btn btn-primary form-control" name="experience">Add Experience</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal for languages -->
    <div class="modal fade" id="lang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container pt-4">
                    <form action="<?= URL ?>user/language-logic.php" method="POST" id="languageForm">
                        <input type="hidden" name="userId" value="<?= $id ?>">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="title">Label *</label>
                                <input type="text" placeholder="English" class="form-control" id="language_label" name="language_label" value="<?= $Langlabel ?>">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="title">Level *</label>
                                <?php if ($Langlevel == "Beginner"): ?>
                                    <select name="language_level" id="" class="form-control">
                                        <option value="Beginner" selected>Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Proficient">Proficient</option> 
                                    </select>
                                <?php elseif ($Langlevel == "Intermediate"): ?>

                                    <select name="language_level" id="" class="form-control">
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate" selected>Intermediate</option>
                                        <option value="Proficient">Proficient</option> 
                                    </select>
                                <?php elseif ($Langlevel == "Proficient"): ?>
                                    <select name="language_level" id="" class="form-control">
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Proficient" selected>Proficient</option> 
                                    </select>
                                <?php else: ?>
                                    <select name="language_level" id="" class="form-control">
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Proficient">Proficient</option> 
                                    </select>
                                <?php endif ?>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <button type="submit" class="btn btn-primary form-control" name="language">Add Language</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for trophy and honors -->
    <div class="modal fade" id="trophy">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container pt-4">
                    <form action="<?= URL ?>user/award-logic.php" method="POST" id="awardForm">
                        <div class="row">
                            <input type="hidden" name="userId" value="<?= $id ?>">
                            <div class="form-group col-md-6 col-12">
                                <label for="title">Award Title *</label>
                                <input type="text" placeholder="English" class="form-control" name="award" id="award" value="<?= $awardTitle ?>">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="title">Year *</label>
                                <input type="text" placeholder="2020" class="form-control" name="year" id="year" value="<?= $awardYear ?>">
                            </div>
                            <div class="form-group col-12 col-md-12">
                                <textarea name="awardMessage" id="awardMessage" class="form-control" style="height: 200px;" placeholder="I got this award because of my remarkable perfomance"><?= $awardMessage ?></textarea>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <button type="submit" class="btn btn-primary form-control" name="award">Add Award</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>












    <!-- script code for modals -->

    <script>
        $(document).ready(function() {

            // education's sector
            $("#educationsForm").submit(function() {
                var title = document.getElementById('title').value;
                var institute = document.getElementById('institute').value;
                var startDate = document.getElementById('start_date').value;
                var endDate = document.getElementById('endDate').value;
                var description = document.getElementById('description').value;

                if (title.trim() == "" || institute.trim() == "" || startDate == "" || endDate == "" || description.trim() == "") {
                    alert("Please fill every required field to proceed");
                    event.stopPropagation();
                    event.preventDefault();
                    false;
                } else {
                    true;
                }
            })


            // experience sector
            $("#experienceForm").submit(function() {
                var insTitle = document.getElementById("insTitle").value;
                var insCompany = document.getElementById("insCompany").value;

                if (insTitle.trim() == "" || insCompany.trim() == "") {
                    alert("Please fill every required field to proceed");
                    event.preventDefault();
                    event.stopPropagation();
                }

                else {
                    true;
                }
            })

            // language sector
            document.getElementById("languageForm").addEventListener('submit', function(event) {
                var label = document.getElementById('language_label').value.trim();
                if (label == "") {
                    alert("A label is required to proceed on this");
                    event.stopPropagation();
                    event.preventDefault();
                }
                else {
                    true;
                }
            })

            // award sector
            document.getElementById("awardForm").addEventListener('submit', function(event) {
                var award = document.getElementById("award").value.trim();
                var year = document.getElementById('year').value.trim();
                var awardMessage = document.getElementById("awardMessage").value.trim();

                if (award == "" || year == "" || awardMessage == "") {
                    alert("Please fill up every input field to proceed");
                    event.stopPropagation();
                    event.preventDefault();
                }

                else {
                    true;
                }
            })



        })
    </script>













<?php 
    include "partials/footer.php";
?>