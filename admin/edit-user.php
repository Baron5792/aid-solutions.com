<?php
    include __DIR__ . "/./partials/header.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$id'");
        if (mysqli_num_rows($query) == 1) {
            $details = mysqli_fetch_assoc($query);
            $id = $details['id'];
            $firstname = $details['firstname'];
            $lastname = $details['lastname'];
            $username = $details['username'];
            $email = $details['email'];
            $admin = $details['admin'];
        }

        else {
            header('location: ' . URL . 'admin/manage-users.php');
        }
    }
?>


<div class="container">
    <form action="<?= URL ?>admin/edit-user_logic.php" method="POST">
        <div style="font-size: x-large; font-weight: bold;">
            <p>Edit User</p>
        </div> 

        <?php if (isset($_SESSION['edit'])): ?>
                <div class="alert alert-danger">
                    <?=
                        $_SESSION['edit'];
                        unset($_SESSION['edit']);
                    ?>
                </div>
            <?php endif ?>

        <div class="row">
            <div class="form-group">
                <label for="">Firstname: </label>
                <input type="text" name="firstname" value="<?= $firstname ?>" class="form-control col-md-12 col-12 col-lg-12">
            </div>
            <div class="form-group">
                <label for="">Lastname:</label>
                <input type="text" name="lastname" value="<?= $lastname ?>" class="form-control col-md-12 col-md-12">
            </div>
            <div class="form-group">
                <label for="">Username:</label>
                <input type="text" name="username" value="<?= $username ?>" class="form-control col-12 col-md-12">
            </div>
            <div class="form-group">
                <label for="">Email:</label>
                <input type="text" name="email" value="<?= $email ?>" class="form-control col-12 col-md-12">
            </div>
            <div class="form-group">
                <label for="">Status:</label>
                <?php if ($admin == 0): ?>
                    <select name="admin" id="" class="form-control col-12 col-md-12">
                        <option value="0" selected>User</option>
                        <option value="1">Admin</option>
                    </select>
                <?php endif ?>
                <?php if ($admin == 1): ?>
                    <select name="admin" id="" class="form-control col-12 col-md-12">
                        <option value="0">User</option>
                        <option value="1" selected>Admin</option>
                    </select>
                <?php endif ?>
                <input type="hidden" name="id" value="<?= $id ?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-4 ml-4" name="edit">Edit User</button>
            </div>
        </div>
    </form>
</div>