<?php
    include "../database.php";
    
    mysqli_query($connection, "INSERT INTO job_type (job_type) VALUE ('Full-time'), ('Part-time'), ('Freelance'), ('Temporary'), ('Permanent'), ('Remote'), ('Seasonal'), 
    ('Apprenticeship')");
