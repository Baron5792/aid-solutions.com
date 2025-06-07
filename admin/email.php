<?php
    include __DIR__ . "/./partials/header.php";
?>

<div class="container">
    <table>
        <a href="<?= URL ?>admin/add-email.php"><button type="button" class="btn btn-primary mb-4">Add Email</button></a>
        <tr>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
            <?php  
                $query = mysqli_query($connection, "SELECT * FROM email");
                if (mysqli_num_rows($query) > 0) {
                    foreach ($query as $row) {
                        $id = $row['id'];
                        $email = $row['email'];
            ?>
                        <tr>
                            <td><?= $email ?></td>
                            <td><a href="<?= URL ?>admin/edit-email.php?edit=<?= $id ?>"><button type="button" class="btn btn-warning">Edit</button></a></td>
                            <!-- <td><a href="<?= URL ?>delete-email.php?delete=<?= $id ?>"><button type="button" class="btn btn-danger" onclick="deleteCategory();">Delete</button></a></td> -->
                        </tr>
                        
            <?php
                    }
                }

                else {
                    echo "No email found";
                }
            ?>
    </table>
</div>

<script>
        function deleteCategory() {
            if (confirm("Are you sure?")) {
                true;
            }

            else {
                event.preventDefault();
                event.stopPropagation();
            }
        }
    </script>