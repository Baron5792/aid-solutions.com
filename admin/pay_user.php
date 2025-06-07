<?php
    include __DIR__ . "/./partials/header.php";
    
    $query = mysqli_query($connection, "SELECT * FROM users WHERE balance> 0");
    if (mysqli_num_rows($query) > 0) {
        foreach ($query as $row) {
            $id = $row['id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $balance = $row['balance'];
            $email = $row['email'];
            $gender = $row['gender'];
            $date_of_birth = $row['date_of_birth'];
            $ip_country = $row['ip_country'];
?>
            <style>
                table {
                    width: 100%;
                }
            </style>
            <table>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Date of birth</th>
                    <th>IP</th>
                    <th>Pay</th>
                </tr>
                <tr>
                    <td><?= $firstname ?></td>
                    <td><?= $lastname ?></td>
                    <td><?= $email ?></td>
                    <td><?= $gender ?></td>
                    <td><?= $date_of_birth ?></td>
                    <td><?= $ip_country ?></td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm">
                            <a href="<?= URL ?>admin/pay-user.php?id=<?= $id ?>" class="text-white text-decoration-none">Pay</a>
                        </button>
                    </td>
                </tr>
            </table>

<?php
        }
    }
?>

