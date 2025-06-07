<?php
    include __DIR__ . "/./partials/header.php";
?>

<div class="container">
    <table>
        <tr>
            <th>Name</th>
            <th></th>
            <th></th>
        </tr>
            <?php  
                $query = mysqli_query($connection, "SELECT * FROM category");
                if (mysqli_num_rows($query) > 0) {
                    foreach ($query as $row) {
                        $id = $row['id'];
                        $name = $row['name'];
            ?>
                        <tr>
                            <td><?= $name ?></td>
                            <td><a href="<?= URL ?>admin/edit-category.php?edit=<?= $id ?>"><button type="button" class="btn btn-warning">Edit</button></a></td>
                            <td><a href="<?= URL ?>delete-category.php?delete=<?= $id ?>"><button type="button" class="btn btn-danger" onclick="deleteCategory();">Delete</button></a></td>
                        </tr>
                        
            <?php
                    }
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