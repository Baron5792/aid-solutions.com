<?php
    include __DIR__ . "/./partials/header.php";
?>

<div class="container">
    <form action="<?= URL ?>admin/add-category_logic.php" method="POST">
        <div class="row">
            <div class="form-group">
                <input type="text" placeholder="Add New Category" name="category" class="form-control col-12 col-md-12">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary ml-4">Add Category</button>
            </div>
        </div>
        <!-- success alert -->
        <?php if (isset($_SESSION['success'])): ?>
            <p class="alert alert-success">
                <?=  
                    $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </p>
        <?php endif ?>

        <!-- error alert -->
        <?php if (isset($_SESSION['category'])): ?>
            <p class="alert alert-danger">
                <?=  
                    $_SESSION['category'];
                    unset($_SESSION['category']);
                ?>
            </p>
        <?php endif ?>
    </form>
</div>


