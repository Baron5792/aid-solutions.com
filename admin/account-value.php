<?php
    include __DIR__ . "/./partials/header.php";
    
    $query = mysqli_query($connection, "SELECT * FROM account ORDER BY date DESC LIMIT 1");
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $account_no = $data['account_number'];
        $account_name = $data['account_name'];
        $account_bank = $data['account_bank'];
    }
?>



<?php if (isset($_SESSION['success'])): ?>
    <marquee class="bg-success text-white pt-2 pb-2">
        <?=  
            $_SESSION['success'];
            unset($_SESSION['success']);
        ?>
    </marquee>
<?php elseif (isset($_SESSION['error'])): ?>
    <marquee class="bg-danger text-white pt-2 pb-2">
        <?=  
            $_SESSION['error'];
            unset($_SESSION['error']);
        ?>
    </marquee>
<?php endif ?>




<div class="container text-center align-center">
    <form action="<?= URL ?>admin/account-logic.php" method="POST">
        <div class="row">
            <div class="col-12 col-md-6 mb-2">
                <label for="name">Account Name: <i class="text-danger">*</i></label>
                <input type="text" class="form-control" name="name" value="<?= $account_name ?>">
            </div>
            
            <div class="col-12 col-md-6 mb-2">
                <label for="number">Account Number: <i class="text-danger">*</i></label>
                <input type="text" class="form-control" name="number" value="<?= $account_no ?>">
            </div>
            
            <div class="col-12 col-md-6 mb-2">
                <label for="bank">Bank Name: <i class="text-danger">*</i></label>
                <input type="text" class="form-control" name="bank" value="<?= $account_bank ?>" readonly>
            </div>
            
            <div class="col-12 col-md-6 mt-3">
                <button type="submit" class="btn btn-primary col-md-6 col-12" name="update">Update Account</button>
            </div>
        </div>
    </form>
</div>



