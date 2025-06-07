<?php
    include __DIR__ . "/./partials/header.php";

    if (isset($_GET['edit'])) {
        $category_id = $_GET['edit'];
        $query = mysqli_query($connection, "SELECT * FROM category WHERE id= '$category_id'");
        $details = mysqli_fetch_assoc($query);
        $category_name = $details['name'];
    }
    else {
        header('location: ' . URL . 'admin/job-categories.php');
    }
?>

<div class="container">

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?=
                $_SESSION['error'];
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?=
                $_SESSION['success'];
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif ?>


    <form action="<?= URL ?>admin/edit-category_logic.php" method="POST">
        <div class="row">
            <div class="form-group">
                <input type="hidden" name="category_id" value="<?= $category_id ?>">
                <input type="text" value="<?= $category_name ?>" name="category_name" class="form-control col-md-12">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary ml-3" name="submit">Edit Category</button>
            </div>
        </div>
    </form>
</div>