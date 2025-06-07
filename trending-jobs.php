<div class="container">
        <p class="header-tag mt-5 mb-4">Trending Available Jobs</p>

        <div class="row footer__jobs__con">
            <!-- fetch info -->
            <?php  
                $query = mysqli_query($connection, "SELECT * FROM job ORDER BY RAND() LIMIT 16");
                if (mysqli_num_rows($query) > 0) {
                    foreach ($query as $data) {
                        $image = $data['avatar'];
                        $category = $data['category'];
                        $jobId = $data['job_id'];
            ?>
                        <div class="col-12 col-sm-3 col-md-2 col-lg-3 footer__sub__div ">
                            <div>
                                <?php if (!empty($image)): ?>
                                    <img src="<?= URL ?>assets/images/job/<?= $image ?>" alt="">
                                <?php else: ?>
                                    <img src="<?= URL ?>assets/images/users_background/Freelancer - Hire & Find Jobs.jpeg">
                                <?php endif ?>
                            </div>
                            <div>
                                <p class="title"><?= $category ?></p>
                                <a href="<?= URL ?>user/job-view.php?job-id=<?= $jobId ?>"><button type="button" class="btn btn-secondary btn-md col-12 col-md-12">Apply now</button></a>
                            </div>
                        </div>
            <?php
                    }
                }
            ?>
                    
        </div>
    </div>