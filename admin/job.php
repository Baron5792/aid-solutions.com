<?php
    include __DIR__ . "/./partials/header.php";
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function searchJobs() {
            var jobTitle = document.getElementById("content").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "search-content_logic.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("jobResults").innerHTML = xhr.responseText;
                }
            };
            xhr.send("jobTitle=" + encodeURIComponent(jobTitle));
        }

        document.getElementById("content").addEventListener("keyup", function() {
            searchJobs();
        });

        document.getElementById("searchForm").addEventListener("submit", function(event) {
            event.preventDefault();
            searchJobs();
        });
    });
</script>

<div class="container-fluid">
    <div class="title">
        <p class="">Jobs</p>
    </div>

    <!-- Displaying alerts -->
    <?php if (isset($_SESSION['success'])): ?>
        <p class="alert alert-success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </p>
    <?php endif ?>

    <div class="container">
        <a href="<?= URL ?>admin/add-job.php"><button type="button" class="btn btn-primary">Add Jobs</button></a>

        <form id="searchForm">
            <div class="row w-100 mt-3 mb-5">
                <input type="text" name="search" placeholder="Search title or description" id="content" class="form-control col-md-5">
                <!-- <button type="submit" class="btn btn-primary">GO</button> -->
            </div>
        </form>
    </div>

    <table class="mb-4">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>title</th>
                <th>description</th>
                <th>skills</th>
                <th>experience</th>
                <!--<th>salary start</th>-->
                <th>salary</th>
                <th>location</th>
                <th>applications</th>
                <th>deadline</th>
                <th>job type</th>
                <th>category</th>
                <th>contact name</th>
                <th>contact email</th>
                <th>date</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="jobResults">
            <?php
                $job = mysqli_query($connection, "SELECT * FROM job ORDER BY date DESC");
                if (mysqli_num_rows($job) > 0) {
                    foreach ($job as $job_value) {
                        $id = $job_value['id'];
                        $title = $job_value['title'];
                        $description = $job_value['description'];
                        $skill = $job_value['skills'];
                        $experience = $job_value['experience'];
                        $salary_stop = $job_value['salary_stop'];
                        $location = $job_value['location'];
                        $deadline = $job_value['deadline'];
                        $for = $job_value['schedule'];
                        $category = $job_value['category'];
                        $contact_name = $job_value['contact_name'];
                        $contact_email = $job_value['contact_email'];
                        $date = $job_value['date'];
                        $applications = $job_value['applications'];

                        // shortened description
                        $short = substr($description, 0, 35);
                        $desc_ext = $short . "...";

                        // shortened skills
                        $short_skill = substr($skill, 0, 35);
                        $skill_ex = $short_skill . "...";

                        echo "<tr>
                                <td><a href='edit-job.php?id={$id}'><button type='button' class='btn btn-warning small'>Edit</button></a></td>
                                <td><a href='delete-job.php?id={$id}'><button type='button' class='btn btn-danger small'>Delete</button></a></td>
                                <td>{$title}</td>
                                <td>{$desc_ext}</td>
                                <td>{$skill_ex}</td>
                                <td>{$experience}</td>
                                <td>{$salary_stop}</td>
                                <td>{$location}</td>
                                <td>{$applications}</td>
                                <td>{$deadline}</td>
                                <td>{$for}</td>
                                <td>{$category}</td>
                                <td>{$contact_name}</td>
                                <td>{$contact_email}</td>
                                <td>{$date}</td>
                                <td><a href='edit-job.php?id={$id}'><button type='button' class='btn btn-warning'>Edit</button></a></td>
                                <td><a href='delete-job.php?id={$id}'><button type='button' class='btn btn-danger'>Delete</button></a></td>
                              </tr>";
                    }
                }
            ?>
        </tbody>
    </table>

<?php
include "partials/footer.php";
?>
