<?php
    include __DIR__ . "/./partials/header.php";
?>

<div class="title">
    <p>Contact Us</p>
</div>

<div class="container">
    <table>
        <tr>
            <th>User</th>
            <th>Fullname</th>
            <th>email</th>
            <th>message</th>
            <th>image</th>
            <th>date</th>
            <th></th>
        </tr>

        <!-- query contact us messages -->
        <?php
            $query = mysqli_query($connection, "SELECT * FROM contact_us ORDER BY date DESC");
            if (mysqli_num_rows($query) > 0) {
                foreach ($query as $data) {
                    $fullname = $data['firstname'] . " " . $data['lastname'];
                    $email = $data['email'];
                    $message = $data['message'];
                    $image = $data['image'];
                    $date = $data['date'];
                    $user = $data['userId'];
                    $id = $data['id'];
                        if (empty($image)) {
                            $response = "Empty";
                        }
                        else {
                            $response = "File Found";
                        }
        ?>
                    <tr>
                        <td><?= $user ?></td>
                        <td><?= $fullname ?></td>
                        <td><?= $email ?></td>
                        <td><?= $message ?></td>
                        <td><?= $response ?></td>
                        <td><?= $date ?></td>
                        <td>
                            <a href="<?= URL ?>admin/contact-us_view.php?id=<?= $id ?>">
                                <button type="button" class="btn btn-basic">
                                    <i class="fa fa-eye text-primary"></i>
                                </button>
                            </a>
                        </td>
                    </tr>

        <?php
                }
            }
        ?>
    </table>
</div>