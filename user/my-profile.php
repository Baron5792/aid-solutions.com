<?php
    include "partials/header.php";

    if (isset($_SESSION['profile_data'])) {
        $firstname = $_SESSION['profile_data']['firstname'] ?? null;
        $lastname = $_SESSION['profile_data']['lastname'] ?? null;
        $email = $_SESSION['profile_data']['email'] ?? null;
        $date_of_birth = $_SESSION['profile_data']['date_of_birth'] ?? null;
        $phone = $_SESSION['profile_data']['phone'] ?? null;
        $sector = $_SESSION['profile_data']['sector'] ?? null;
        $salary = $_SESSION['profile_data']['salary'] ?? null;
        $twitter = $_SESSION['profile_data']['twitter'] ?? null;
        $dribble = $_SESSION['profile_data']['dribble'] ?? null;
        $facebook = $_SESSION['profile_data']['facebook'] ?? null;
        $linkedin = $_SESSION['profile_data']['linkedin'] ?? null;
        $state = $_SESSION['profile_data']['state'] ?? null;
        $zipcode = $_SESSION['profile_data']['zipcode'] ?? null;
        // $salary_mode = $_SESSION['profile_data']['$salary_mode'] ?? null;
    }

    unset($_SESSION['profile_data']);

    $usersCode = "https://www.aid-solutions.com/account/login?id=" . $ref_code;
?>

<style>
    .profileNotify {
        background-color: silver;
    }

    .withdraw-btn {
        background: linear-gradient(45deg, #28a745, #218838); /* Gradient background */
        color: #fff;
        padding: 4px 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        border-radius: 50px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .withdraw-btn:hover {
        background: linear-gradient(45deg, #218838, #28a745); /* Hover effect with color reversal */
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
    }

    .withdraw-btn i {
        margin-right: 10px; /* Add space between icon and text */
        animation: bounce 1.5s infinite; /* Subtle bounce animation for the icon */
    }

    /* Icon bounce animation */
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }

    .withdraw-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 300%;
        height: 300%;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.6s ease;
        transform: rotate(45deg);
    }

    .withdraw-btn:hover::before {
        left: 100%;
    }
    
    /*for the spinner */
    .spinner {
      display: none;
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      border: 4px solid #f3f3f3;
      border-top: 4px solid #3498db;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      animation: spin 2s linear infinite;
    }
    
    .input-group {
      position: relative;
    }
    
    @keyframes spin {
      0% {
        transform: translateY(-50%) rotate(0deg);
      }
      100% {
        transform: translateY(-50%) rotate(360deg);
      }
    }

</style>

<script>
    document.getElementById("title_title").innerHTML = "My Profile | aid-solutions";
</script>

<div class="col-12 col-md-12 dash_heaer_con ">
    <div class="container dash_con">
        <p class="dash_header col-12 col-md-12">Profile Information</p>
    </div>

    <!-- update error message -->
    <?php if (isset($_SESSION['profile'])): ?>
        <div class="alert alert-danger">
            <?= 
                $_SESSION['profile'];
                unset($_SESSION['profile'])    
            ?>
        </div>
    <?php endif; ?>


     <!--update success message -->
    <?php if (isset($_SESSION['profile-success'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['profile-success']; ?>
            <?php unset($_SESSION['profile-success']); ?>
        </div>
    <?php endif; ?>

</div>


<form action="<?= URL ?>user/my-profile_logic.php" method="POST">
    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <input type="text" value="<?= $id ?>" style="display: none" name="users_id">
        <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="firstname">First Name *</label>
                <input type="text" id="firstname" class="form-control" placeholder="First tname" name="firstname" value="<?= $firstanme ?>">
                <div class="spinner" id="firstname-spinner"></div>

            </div>
            <div class="form-group col-12 col-md-6">
                <label for="lastname">Last Name *</label>
                <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" value="<?= $lastname ?>">
                <div class="spinner" id="lastname-spinner"></div>

            </div>

            <div class="form-group col-12 col-md-6">
                <label for="email">Email *</label>
                <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $email ?>" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="balance">Available Balance</label>
                <div class="input-group mb-3 input-group-md">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="text" class="form-control" value="<?= $balance ?>" placeholder="Current Balance">
                </div>
            </div>

            <div class="form-group col-md-6 col-12">
                <button class="withdraw-btn" onclick="window.open('<?= URL ?>withdrawal/payment-withdraw-process')">
                    <i class="fas fa-dollar-sign"></i> Withdraw Funds
                </button>
            </div>

            <div class="form-group col-12 col-md-12">
                <label for="profile url">Profile's URL</label>
                <p>https://www.aid-solutions.com/account/login?id=<?= $ref_code ?> <button type="button" class="btn btn-basic" onclick="copyClip();"><i class="fa fa-copy" style="font-weight: light; font-size: small; color: grey"></i></button></p>
                <input type="hidden" name="" id="refHold" value="<?= $usersCode ?>">
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="date-of-birth">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= $date_of_birth ?>">
                <div class="spinner" id="date_of_birth-spinner"></div>
            </div>

            <div class="form-group col-12 col-md-6">
                <label for="phone number">Phone Number *</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $phone ?>">
                <div class="spinner" id="phone-spinner"></div>
            </div>

            <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <select name="sector" id="sector" class="form-control">
                    <option value="<?= $sector ?>"><?= $sector ?></option>
                    <option value="Designing Jobs">Designing Jobs</option>
                    <option value="Writing Jobs">Writing Jobs</option>
                    <option value="Photography Jobs">Photography Jobs</option>
                    <option value="Developer Jobs">Developer Jobs</option>
                    <option value="Micro Jobs">Micro Jobs</option>
                    <option value="Marketing Jobs">Marketing Jobs</option>
                    <option value="Research Jobs">Research Jobs</option>
                    <option value="Finance Jobs">Finance Jobs</option>
                </select>
                <div class="spinner" id="sector-spinner"></div>
                    <!-- Add more checkboxes as needed -->
            </div>

            <div class="form-group col-12 col-md-12">
                <label for="phone number">Salary</label>
                <div class="container row">
                    <?php
                        if (empty($salary_mode)) {
                    ?>
                            <select name="salary_mode" id="salary_mode" class="form-control col-6 col-md-6">
                                <option value="">Select a mode of payment</option>
                                <option value="Monthly">Monthly</option>
                                <option value="Weekly">Weekly</option>  
                                <option value="Hourly">Hourly</option>
                            </select>
                            <div class="spinner" id="salary_mode-spinner"></div>
                    <?php
                        }
                        else {
                            if ($salary_mode == "Weekly") {
                    ?>
                                <select name="salary_mode" id="salary_mode" class="form-control col-6 col-md-6">
                                    <option value="Monthly">Monthly</option>
                                    <option value="Weekly" selected>Weekly</option>
                                    <option value="Hourly">Hourly</option>
                                </select>
                                <div class="spinner" id="salary_mode-spinner"></div>
                    <?php
                            }

                            elseif ($salary_mode == "Monthly") {
                    ?>
                                <select name="salary_mode" id="salary_mode" class="form-control col-6 col-md-6">
                                    <option value="Monthly" selected>Monthly</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Hourly">Hourly</option>
                                </select>
                                <div class="spinner" id="salary_mode-spinner"></div>
                    <?php
                            }
                            else {
                    ?>
                                <select name="salary_mode" id="salary_mode" class="form-control col-6 col-md-6">
                                    <option value="Monthly">Monthly</option>
                                    <option value="Weekly">Weekly</option>
                                    <option value="Hourly" selected>Hourly</option>
                                </select>
                                <div class="spinner" id="salary_mode-spinner"></div>
                    <?php
                            }
                        }
                    ?>
                    <div class="form-group col-6 col-md-6">
                        <div class="input-group mb-3 input-group-md">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" class="form-control" name="salary" id="salary" value="<?= $salary ?>" placeholder="Minimum Salary Amount">
                            <div class="spinner" id="salary-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <div class="container dash_con">
            <p class="dash_header col-12 col-md-12">Social Links</p>
        </div>
    </div>
    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="facebook">Facebook</label>
                <input type="text" class="form-control" placeholder="Facebook" name="facebook" id="facebook" value="<?= $facebook ?>">
                <div class="spinner" id="facebook-spinner"></div>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="twitter">Twitter</label>
                <input type="text" class="form-control" placeholder="Twitter" name="twitter" id="twitter" value="<?= $twitter ?>">
                <div class="spinner" id="twitter-spinner"></div>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="dribble">Dribble</label>
                <input type="text" class="form-control" placeholder="Dribble" name="dribble" id="dribble" value="<?= $dribble ?>">
                <div class="spinner" id="dribble-spinner"></div>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="linkedin">Linkedin</label>
                <input type="text" class="form-control" placeholder="Linkedin" name="linkedin" id="linkedin" value="<?= $linkedin ?>">
                <div class="spinner" id="linkedin-spinner"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <div class="container dash_con">
            <p class="dash_header col-12 col-md-12">Address / Location</p>
        </div>
    </div>

    <div class="col-12 col-md-12 dash_heaer_con mt-5">
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="country">Country *</label>
                <input type="text" class="form-control" placeholder="Country" value="<?= $country ?>" id="country" name="country" disabled>
                <div class="spinner" id="country-spinner"></div>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="state">State *</label>
                <input type="text" class="form-control" placeholder="state *" name="state" id="state" value="<?= $state ?>">
                <div class="spinner" id="state-spinner"></div>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="postal-code">Postal Code *</label>
                <input type="text" class="form-control" placeholder="Postal Code" value="<?= $zipcode ?>" id="zipcode" name="zipcode">
                <div class="spinner" id="zipcode-spinner"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 mt-4">
        <label class="form-check-label col-12 col-md-12 mb-4">
            <input type="checkbox" class="form-check-input" value="" required checked>By clicking checkbox, you agree to our Terms and Conditions
        </label>
        <button type="submit" class="btn btn-primary col-md-4 btn-small" name="profile">Update</button>
    </div>
</form>





<script>
    function copyClip() {
        /* Get the text field */
        var copyText = document.getElementById("refHold");
        /* Select the text field */
        copyText.select();
        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
        /* Alert the copied text */
        alert("Copied to clipboard");
    }

</script>










<?php 
    include "partials/footer.php";
?>