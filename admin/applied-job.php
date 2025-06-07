<?php
    include __DIR__ . "/./partials/header.php";
?>

<style>
    .content:hover {
        background-color: silver;
    }
    
    table tr:first-child th {
        padding: 17px 0px;
        text-align: center;
        font-weight: lighter; 
        font-size: 18px;
    }
</style>

<div class="container-fluid">
    <table style="width: 100%" class="mb-4">
        <tr style="">
            <th>Name</th>
            <th>Category</th>
            <th>Country</th>
            <th>Date</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
        
        
            <?php
                $query = mysqli_query($connection, "SELECT * FROM applied ORDER BY date DESC");
                if (mysqli_num_rows($query) > 0) {
                    foreach ($query as $key) {
                        $id = $key['id'] ?? null;
                        $job_id = $key['job_id'] ?? null;
                        $users_id = $key['users_id'] ?? null;
                        $date = $key['date'] ?? null;
                        $status = $key['status'] ?? null;
        
                        // fetch users_details
                        $user = mysqli_query($connection, "SELECT * FROM users WHERE id= '$users_id'");
                        if (mysqli_num_rows($user) > 0) {
                            $users_details = mysqli_fetch_assoc($user);
                            $country = $users_details['country'];
                            $fullname = $users_details['firstname'] . " " . $users_details['lastname'];
        
                            // query for category
                            $job = mysqli_query($connection, "SELECT * FROM job WHERE job_id= '$job_id'");
                            if (mysqli_num_rows($job) == 1) {
                                $job_details = mysqli_fetch_assoc($job);
                                $category = $job_details['category'];
                            }
                            else {
                                echo "job not found";
                            }
                        }
        
                        else {
                            echo "user not found";
                        }
                        
                        
        
            ?>
                        <tr>
                            <td><?= $fullname ?></td>
                            <td><?= $category ?></td>
                            <td><?= $country ?></td>
                            <td><?= $date ?></td>
                            <td>
                                <?php if ($status == "Accepted"): ?>
                                    <p class="text-success">Accepted</p>
                                <?php elseif ($status == "Pending"): ?>
                                    <p class="text-warning text-small">Pending</p>
                                <?php else: ?>
                                    <p class="text-danger">Declined</p>
                                <?php endif ?>
                                
                            </td>
                            <td>
                                <a href="<?= URL ?>admin/applied-view.php?id=<?= $id ?>"><button type="button" class="btn btn-warning text-white btn-sm">View</button></a>
                            </td>
                            <td></td>
                        </tr>
            <?php
                    }
                }
            ?>
    </div>
    </table>
              
  

                        