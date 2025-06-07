<?php
    include "./partials/header.php";

?>

<style>
    table {
        width: 100%;
    }


</style>




<?php
    $query = mysqli_query($connection, "SELECT * FROM submitted ORDER BY date DESC");
    if (mysqli_num_rows($query) > 0) {
?>
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Job ID</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                <?php
                    foreach ($query as $data) {
                        $userId = $data['userId'];
                        $jobId = $data['jobId'];
                        $status = $data['status'];
                        $date = $data['date'];

                        // fetch users name
                        $fetchUser = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
                        if (mysqli_num_rows($fetchUser) > 0) {
                            $request = mysqli_fetch_assoc($fetchUser);
                            $fullname = $request['firstname'] . " " . $request['lastname'];
                        }

                        else {
                            $fullname = "user doesn't exist anymore";
                        }
                ?>
                        <tr>
                            <td><?= $fullname ?></td>
                            <td><?= $jobId ?></td>
                            <td><?= $status ?></td>
                            <td><?= $date ?></td>
                            <td>
                                <a href="<?= URL ?>admin/view-submitted-job.php?id=<?= $jobId ?>&&userId=<?= $userId ?>"><span class="fa fa-eye"></span></a>
                            </td>
                        </tr>
                <?php
                    }
                ?>
                    
            </table>
<?php
    }

    else {
        echo "No record(s) found";
    }
?>
    