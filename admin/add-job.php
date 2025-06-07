<?php
    include __DIR__ . "/./partials/header.php";
    $query = mysqli_query($connection, "SELECT * FROM category");

    $title = $_SESSION['add-error']['title'] ?? null;
    $description = $_SESSION['add-error']['description'] ?? null;
    $skill = $_SESSION['add-error']['skill'] ?? null;
    $contact_name = $_SESSION['add-error']['contact_name'] ?? null;
    $contact_email = $_SESSION['add-error']['contact_email'] ?? null;
    // $salary_start = $_SESSION['add-error']['salary_start'] ?? null;
    $salary_stop = $_SESSION['add-error']['salary_stop'] ?? null;
    $location = $_SESSION['add-error']['location'] ?? null;
    $deadline = $_SESSION['add-error']['deadline'] ?? null;

    unset($_SESSION['add-error']);

    $fixed = '21';
    $rand_num = $fixed.mt_rand(10000000, 99999999);
?>

<div class="container pb-4">
    <form action="<?= URL ?>admin/add-job_logic.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?= $rand_num ?>">
        <?php if (isset($_SESSION['add'])): ?>
            <p class="alert alert-danger">
                <?=
                    $_SESSION['add'];
                    unset($_SESSION['add']);
                ?>
            </p>
        <?php endif ?>


        <div class="title">
            <p>Add Job</p>
        </div>
        <div class="row">
            <input type="text" class="form-control col-md-6 col-12" placeholder="Job Title" name="title" value="<?= $title ?>">
            <textarea name="description" placeholder="Job Description" id="" class="form-control col-6 col-md-12 mt-2"><?= $description ?></textarea>
            <textarea name="skill" id="" height="400px" placeholder="Enter Required Skill" class="form-control col-12 col-md-12 mt-2" name="skill"><?= $skill ?></textarea>
              
            <select name="experience" id="" class="form-control col-12 col-md-12 mt-2">
                <option value="null">Expeirence Level</option>
                <option value="Entry Level">Entry Level</option>
                <option value="Mid Level">Mid Level</option>
                <option value="Senior Level">Senior Level</option>
            </select>
            
                <input type="text" name="contact_name" id="" placeholder="Contact Name" class="w-100 form-control col-12 col-md-12 mt-2" value="<?= $contact_name ?>">
            
            <select name="contact_email" id="" class="form-control col-md-12 mt-2" value="<?= $contact_email ?>">
                <?php 
                    $check_email = mysqli_query($connection, "SELECT * FROM email");
                    if (mysqli_num_rows($check_email) > 0) {
                        foreach ($check_email as $key) {
                            $email_name = $key['email'];
                ?>
                            <option value="<?= $email_name ?>"><?= $email_name ?></option>
                <?php
                        }
                    } 
                ?>
            </select>
            
            <div class="input-group-append col-6 col-md-6 mt-2">
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

            <input type="file" name="avatar" id="" class="form-control mt-3" style="border: none;">

            <div class="mt-4 col-md-5">
                <button type="submit" class="col-12 col-md-6 btn btn-primary" name="submit">POST</button>
            </div>
        </div>
    </form>
</div>









<?php
    include __DIR__ . "/./partials/footer.php";
?>