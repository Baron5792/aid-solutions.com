<?php
    include __DIR__ . "/./partials/header.php";
    $query = mysqli_query($connection, "SELECT * FROM transactions ORDER BY date DESC");
?>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Amount</th>
        <th>Bank Name</th>
        <th>Account NO</th>
        <th>Account Type</th>
        <th>Gov ID</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    
    <?php
        if (mysqli_num_rows($query) > 0) {
            foreach ($query as $row) {
                $id = $row['id'];
                $fullname = $row['fullname'];
                $email = $row['email'];
                $amount = $row['amount'];
                $bankname = $row['bankName'];
                $accountNo = $row['accountNo'];
                $accountType = $row['accountType'];
                $gov_id = $row['gov_id'];
                $status = $row['status'];
                $date = $row['date'];
                
    ?>
                <tr>
                    <td><?= $fullname ?></td>
                    <td><?= $email ?></td>
                    <td><?= $amount ?></td>
                    <td><?= $bankname ?></td>
                    <td><?= $accountNo ?></td>
                    <td><?= $accountType ?></td>
                    <td><?= $gov_id ?></td>
                    <td>    
                        <?php if ($status == "Pending"): ?>
                            <a href="<?= URL ?>admin/view-payment.php?id=<?= $id ?>"><i class="fa fa-eye"></i></a>
                        <?php elseif ($status == "null"): ?>
                            <p>No receipt uploaded!</p>
                        <?php endif ?>
                    </td>
                    <td><?= $date ?></td>
                </tr>
    <?php
            }
        }
        else {
            echo "No data found";
        }
    ?>
</table>