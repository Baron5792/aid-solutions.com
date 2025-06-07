<?php
    include __DIR__ . "/./partials/header.php";

    if (isset($_GET['id'])) {
        $job_id = $_GET['id'];
        $query = mysqli_query($connection, "SELECT * FROM category");
        $job_query = mysqli_query($connection, "SELECT * FROM job WHERE id= '$job_id'");
        $job_details = mysqli_fetch_assoc($job_query);
        $title = $job_details['title'];
        $description = $job_details['description'];
        $skill = $job_details['skills'];
        $experience = $job_details['experience'];
        $contact_name = $job_details['contact_name'];
        // $salary_start = $job_details['salary_start'];
        $salary_stop = $job_details['salary_stop'];
        $location = $job_details['location'];
        $deadline = $job_details['deadline'];
        $contact_email = $job_details['contact_email'];
        $category_value = $job_details['category'];
        $job_type = $job_details['schedule'];
        $applications = $job_details['applications'];
?>
        <div class="container">
            <form action="<?= URL ?>admin/edit-job_logic.php" method="POST">
                <div class="title">
                    <p>Edit Job</p>
                </div>
                <div class="row">
                    <input type="hidden" name="job_id" value="<?= $job_id ?>">
                    <input type="text" class="form-control col-md-6 col-12" placeholder="Job Title" name="title" value="<?= $title ?>">
                    <textarea name="description" id="" class="form-control col-md-12 mt-2" placeholder="Job Description"><?= $description ?></textarea>
                    <textarea name="skill" id="" height="400px" placeholder="Enter Required Skill" class="form-control col-12 col-md-12 mt-2" name="skill"><?= $skill ?></textarea>
                    <select name="experience" id="" class="form-control col-12 col-md-6 mt-2">
                        <option value="<?= $experience ?>">Selected is: <?= $experience ?></option>
                        <option value="Entry Level">Entry Level</option>
                        <option value="Mid Level">Mid Level</option>
                        <option value="Senior Level">Senior Level</option>
                    </select>
                    <input type="text" name="contact_name" id="" placeholder="Contact Name" class="form-control col-md-6 col-6 mt-2" value="<?= $contact_name ?>">
                    <select name="contact_email" id="" class="form-control col-md-6 mt-2">
                        <?php 
                            $check_email = mysqli_query($connection, "SELECT * FROM email");
                            if (mysqli_num_rows($check_email) > 0) {
                                foreach ($check_email as $key) {
                                    $email_name = $key['email'];
                        ?>
                                    <option value="<?= $contact_email ?>">Selected is: <?= $contact_email ?></option>
                                    <option value="<?= $email_name ?>"><?= $email_name ?></option>
                        <?php
                                }
                            } 
                        ?>
                    </select>
                    <div class="input-group-append col-6 col-md-3 mt-2">
                        <span class="input-group-text" id="">$</span>
                        <input type="number" class="form-control" placeholder="Salary" name="salary_stop" value="<?= $salary_stop ?>">
                    </div>
                    <div class="input-group-append col-6 col-md-6 mt-2">
                        <span class="input-group-text" id=""><i class="fa fa-location"></i></span>  
                        <input type="text" class="form-control" placeholder="Job Location" name="location" value="<?= $location ?>">
                    </div>
                    <input type="text" name="deadline" id="" class="form-control col-12 col-md-6 mt-2" placeholder="Application Deadline Date" value="<?= $deadline ?>">
                    <!-- fetching related jobs category -->
                    <select name="category" id="" class="form-control col-6 col-md-6 mt-2">
                        <option value="<?= $category_value ?>">Selected is: <?= $category_value ?></option>
                        <?php
                            if (mysqli_num_rows($query) > 0) {
                                foreach ($query as $key) {
                                    $category = $key['name'];
                        ?>
                                    <option value="<?= $category ?>" class="text-muted"><?= $category ?></option>
                        <?php
                                }
                            }  
                        ?>
                    </select>

                    <select name="job_type" id="" class="form-control col-md-6 mt-2">
                        <option value="<?= $job_type ?>">Selected is: <?= $job_type ?></option>
                        <?php
                            $check_job = mysqli_query($connection, "SELECT * FROM job_type");
                            if (mysqli_num_rows($check_job) > 0) {
                                foreach ($check_job as $row) {
                                    $job_type = $row['job_type'];
                        ?>
                                    <option value="<?= $job_type ?>"><?= $job_type ?></option>
                        <?php
                                } 
                            }
                        ?>
                                
                    </select>
                    
                    <div class="col-12 col-md-4 mt-4" style="display: block;">
                        <label for="applications">Applications: </label>
                        <input type="text" value="<?= $applications ?>" class="form-control" name="applications">
                    </div>
                        
                    <div class="mt-4 col-md-12">
                        <button type="submit" class="col-12 col-md-6 btn btn-primary" name="submit">POST</button>
                    </div>
                </div>
            </form>
        </div>
<?php

    }














    
    include __DIR__ . "/./partials/footer.php";
?>