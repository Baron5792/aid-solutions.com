<?php
    include __DIR__ . "/../../partials/header.php";

    if (isset($_GET['user']) && isset($_GET['track'])) {
        $userId = $_GET['user'];
        $track = $_GET['track'];
        $query = mysqli_query($connection, "SELECT * FROM reset WHERE userId= '$userId' AND track= '$track' LIMIT 1");
        if (mysqli_num_rows($query) == 1) {
            // fetch users email
            $fetch = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
            if (mysqli_num_rows($fetch) > 0) {
                $data = mysqli_fetch_assoc($fetch);
                $email = $data['email'];

                // fetch extension
                $extension = explode('@', $email);
                $extension = end($extension);
                // fetch first and last two digits of the email address
                $email_first = substr($email, 0, 2);
                function fetchDigitsFromEmail($email) {
                    // Find the first digit in the email address
                    preg_match('/\d/', $email, $firstDigitMatch);
                    $firstDigit = $firstDigitMatch[0] ?? null;  // Get the first digit or null if not found
                
                    // Extract the part before the '@' symbol
                    $username = strstr($email, '@', true);
                
                    // Find the last two digits before the '@' symbol
                    preg_match('/\d{2}$/', $username, $lastTwoDigitsMatch);
                    $lastTwoDigits = $lastTwoDigitsMatch[0] ?? null;  // Get the last two digits or null if not found
                
                    return [
                        'first_digit' => $firstDigit,
                        'last_two_digits' => $lastTwoDigits
                    ];
                }
                $result = fetchDigitsFromEmail($email);
            }

        }

        else {
            header('location: ' . URL . 'account/login.php');
        }
    }

    else {
        header('location: ' . URL . "account/login.php?request=true");
    }
?>

<style>
    .title {
        text-align: center;
        font-size: 17px;
        font-weight: bold;
    }

    .layout {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .email {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 13px;
    }

    label {
        font-size: 13px;
    }

    label span {
        color: red;
    }

</style>


<?php if (isset($_GET['reset'])): ?>


    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <img src="<?= URL ?>assets/images/users_background/forgot-password.jpeg" alt="" style="width: 100%;">
            </div>

            <div class="col-12 col-md-4 layout">
                <form action="<?= URL ?>account/reset/reset-response.php" method="POST">
                    <p class="title pt-4">Account Reset</p>
                    <p class="pt-1 email" style="text-align:center">A reset code has been sent to <?= $email_first . "*********" . $result['last_two_digits'] ?>@<?= $extension ?></p>

                    <div class="form-group">
                        <label for="resetCode">Enter Reset Code <span>*</span></label>
                        <input type="hidden" name="userId" value="<?= $userId ?>">
                        <input type="hidden" name="track" value="<?= $track ?>">
                        <input type="number" name="resetCode" required class="form-control" id="">
                    </div>

                    <!-- alerts -->
                    <?php if (isset($_SESSION['response-error'])): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            <?=
                                $_SESSION['response-error'];
                                unset($_SESSION['response-error']);
                            ?>
                        </div>
                    <?php endif ?>

                    <div class="form-group">    
                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                        <a href="<?= URL ?>account/login.php"><button type="button" class="btn btn-danger btn-sm">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php elseif ($_GET['update']): ?>


    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 col-md-8">
                <img src="<?= URL ?>assets/images/users_background/forgot-password.jpeg" alt="" style="width: 100%;">
            </div>

            <div class="col-12 col-md-4 layout">
                <form action="<?= URL ?>account/reset/reset-success.php" method="POST">
                    <p class="title pt-4">Account Reset</p>
                    <p class="pt-1 email" style="text-align:center">You're account has been recovered</p>

                    <div class="form-group">
                        <label for="resetCode">Enter New Password <span>*</span></label>
                        <input type="hidden" name="userId" value="<?= $userId ?>">
                        <input type="text" name="password" required class="form-control" id="">
                    </div>

                    <!-- alerts -->
                    <?php if (isset($_SESSION['response-success'])): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?=
                                $_SESSION['response-success'];
                                unset($_SESSION['response-success']);
                            ?>
                        </div>
                    <?php endif ?>

                    <div class="form-group">    
                        <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                        <a href="<?= URL ?>account/login.php"><button type="button" class="btn btn-danger btn-sm">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif ?>





<?php
    include __DIR__ . "/../../partials/footer.php";
?>