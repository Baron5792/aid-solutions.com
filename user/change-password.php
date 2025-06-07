<?php
    include "partials/header.php";

    // if (isset($_SESSION['password-data'])) {    
        // $new_password = $_SESSION['password-error']['old_password'] ?? null;
        // unset($_SESSION['password-error']);
    // }

?>

<style>
    .chnageNotify {
        background-color: silver;
    }
</style>

<script>
    document.getElementById("title_title").innerHTML = "Change Password | aid-solutions";
</script>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Change Password</p>
    </div>

    <?php if (isset($_SESSION['password-error'])): ?>
        <p class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=
                $_SESSION['password-error'];
                unset($_SESSION['password-error']);
            ?>
        </p>
    <?php endif ?>

    <?php if (isset($_SESSION['password-success'])): ?>
        <p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?=
                $_SESSION['password-success'];
                unset($_SESSION['password-success']);
            ?>
        </p>
    <?php endif ?>


    <form action="<?= URL ?>user/change-password_logic.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $id ?>">
        <div class="row mt-5">
            <div class="form-group col-12 col-md-6">
                <input type="password" placeholder="Old Password" name="old_password" value="" class=form-control>
            </div>
            <div class="form-group col-12 col-md-6">
                <input type="password" placeholder="New Password" name="new_password" class=form-control>
            </div>
            <div class="form-group col-12 col-md-6">
                <input type="text" name="confirm_password" placeholder="Confirm New Password" id="" class="form-control">
            </div>
        </div>
        <div>
            <button type="submit" name="submit" class="btn btn-primary">Update Password</button>
        </div>
    </form>
</div>


















<?php 
    include "partials/footer.php";
?>