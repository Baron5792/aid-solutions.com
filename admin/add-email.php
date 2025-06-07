<?php
    include "./partials/header.php";
?>

<div class="container">
    <form action="<?= URL ?>admin/add-email_logic.php" method="POST">
        <div class="title">
            <p>New Email</p>
        </div>
        <div class="row">
            <input type="text" class="form-control col-md-6 col-12" name="email" placeholder="Enter New Email">
            <button type="submit" class="btn btn-primary ml-2" name="add_email">Add Email</button>
        </div>
    </form>
</div>