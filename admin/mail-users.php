<?php
    include __DIR__ . "/./partials/header.php";
?>


<div class="title">
    <p>Email Registered Users</p>
</div>


<form action="<?= URL ?>admin/mail-user_logic.php" method="POST">
    <div class="container">
        <div class="row">
            <input type="text" name="subject" class="form-control col-md-6" placeholder="Enter subject">
            <textarea name="body" id="" placeholder="Message" class="form-control col-md-12 mt-2"></textarea>
            <button type="submit" name="btn" class="btn btn-primary mt-3">Send Mail</button>
        </div>
    </div>
</form>

