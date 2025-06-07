<?php
    include __DIR__ . "/./partials/header.php";


    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // query comment ID
        $query = mysqli_query($connection, "SELECT * FROM contact_us WHERE id= '$id'");
        if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_assoc($query);
            $user = $data['userId'];
            $fullname = $data['firstname'] . " " . $data['lastname'];
            $email = $data['email'];
            $message = $data['message'];
            $image = $data['image'];
            $date = $data['date'];
            $email = $data['email'];
        }
    }
?>


<div class="title">
    <p>Contact Us View</p>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <ul>
                <li>User Id: <?= $user ?></li>
                <li>Name: <?= $fullname ?></li>
                <li>Email: <?= $email ?></li>
                <p>Message: <?= $message ?></p>
                <iframe src="<?= URL ?>contact_us/<?= $image ?>" frameborder="0" style="width: 100vh;height: 100vh; overflow: hidden; border: none;"></iframe>
            </ul>
        </div>
        <?php if ($user !== "Unregistered"): ?>
            <div class="col-md-4">
                <!-- alert for error -->
                <?php if (isset($_SESSION['reply-error'])): ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-target="alert"></button>
                        <?=
                            $_SESSION['reply-error'];
                            unset($_SESSION['reply-error']);
                        ?>
                    </div>
                <?php elseif (isset($_SESSION['reply-success'])): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-target="alert"></button>
                        <?=
                            $_SESSION['reply-success'];
                            unset($_SESSION['reply-success']);
                        ?>
                    </div>
                <?php endif ?>


                <p><i class="fa fa-info-circle"></i> Reply <?= $fullname ?> <i class="fa fa-angle-down"></i></p>
                <form action="<?= URL ?>admin/reply-contact_us.php" method="POST">
                    <input type="hidden" name="contactId" value="<?= $id ?>">
                    <input type="hidden" name="email" value="<?= $email ?>">
                    <input type="hidden" name="userId" value="<?= $user ?>">
                    <input type="text" name="title" value="" id="" class="form-control mb-2" placeholder="Title">
                    <textarea name="message" id="" class="form-control" placeholder="Message"></textarea>
                    <button type="submit" name="submit" class="btn btn-primary btn-sm mt-3">Reply <?= $data['firstname'] ?></button>
                </form>

                <!-- view sent messages -->
                <div class="mt-5">
                    <p class="text-success">View past replies <i class="fa fa-angle-down"></i></p>
                    <?php
                        $fetch = mysqli_query($connection, "SELECT * FROM users_email WHERE user_id= '$user' AND comment_track= '$id'");
                        if (mysqli_num_rows($fetch) > 0) {
                            foreach ($fetch as $key) {
                                $text = $key['message'];
                    ?>  
                                <p> <em><?= $text ?></em> </p>
                    <?php          
                            }
                        }

                        else {
                            echo "No record(s) found";
                        }
                    ?>
                </div>
            </div>
        <?php endif ?>
    </div>

</div>