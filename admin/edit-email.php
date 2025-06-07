<?php
    include __DIR__ . "/./partials/header.php";


    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];

        $query = mysqli_query($connection, "SELECT * FROM email WHERE id= '$id'");
        if (mysqli_num_rows($query) == 1) {
            $details = mysqli_fetch_assoc($query);
            $email = $details['email'];
            $email_id = $details['id'];
        }
    }

    else {
        header('location: ' . URL . 'admin/email.php');
    }
?>
    

    <div class="container">
        <form action="<?= URL ?>admin/edit-email_logic.php" method="POST">
            <input type="hidden" name="email_id" value="<?= $email_id ?>" class="form-control col-md-4 mb-3">
            <input type="text" value="<?= $email ?>" class="form-control col-md-6" name="email">
            <button type="submit" class="btn btn-primary mt-2" name="edit">Edit Email</button>
        </form>
    </div>


