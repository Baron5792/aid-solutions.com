<?php
    include __DIR__ . "/../user/partials/header.php";

    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        
        if (isset($_GET['transaction'])) {
            $transactionId = $_GET['transaction'];
            // fetch account details
            $queryAcc = mysqli_query($connection, "SELECT * FROM account ORDER BY date DESC LIMIT 1");
            if (mysqli_num_rows($queryAcc) > 0) {
                $accData = mysqli_fetch_assoc($queryAcc);
                // $account_name = $accData['account_name'];
                $account_number = $accData['account_number'];
                $account_bank = $accData['account_bank'];
            }
            $query = mysqli_query($connection, "SELECT * FROM withdrawal_track WHERE userId= '$userId' AND transaction_id= '$transactionId' ORDER BY date DESC LIMIT 1");
            if (mysqli_num_rows($query) > 0) {

                // fetch users withdrawal track
                $userData = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
                if (mysqli_num_rows($userData) > 0) {
                    $data = mysqli_fetch_assoc($userData);
                    $withdrawalTrack = $data['withdrawal_track'];
                    $balance = $data['balance'];
                    $fullname = $data['firstname'] . " " . $data['lastname'];
                    $email = $data['email'];
                    $phone = $data['phone'];
                    $ref = $data['ref_code'];
                    $percentage = 0.1 * $balance;
                    
                }
?>
                 <script>
                    document.addEventListener('DOMContentLoaded', function () {
                      const uploadArea = document.getElementById('upload-area');
                      const fileInput = document.getElementById('file-input');
                      const fileNameDisplay = document.getElementById('file-name');
                
                      uploadArea.addEventListener('dragover', (event) => {
                        event.preventDefault();
                        uploadArea.style.backgroundColor = '#eaf1f8';
                      });
                
                      uploadArea.addEventListener('dragleave', () => {
                        uploadArea.style.backgroundColor = '#f9fafb';
                      });
                
                      uploadArea.addEventListener('drop', (event) => {
                        event.preventDefault();
                        uploadArea.style.backgroundColor = '#f9fafb';
                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                          fileInput.files = files;
                          fileNameDisplay.textContent = files[0].name;
                        }
                      });
                
                      uploadArea.addEventListener('click', () => {
                        fileInput.click();
                      });
                
                      fileInput.addEventListener('change', () => {
                        const file = fileInput.files[0];
                        if (file) {
                          fileNameDisplay.textContent = file.name;
                        }
                      });
                    });
                  </script>

                <style>
                    .wizard {
                        text-align: center;
                    }
                    
                    .wizard-steps {
                        display: flex;
                        justify-content: space-around;
                        font-size: 1.2em;
                        color: #aaa;
                        margin-bottom: 10px;
                    }
                    
                    .wizard-step.current {
                        color: #28a745;
                        font-weight: bold;
                    }
                    
                    .wizard-progress-bar {
                        background-color: #ddd;
                        height: 4px;
                        width: 100%;
                        position: relative;
                    }
                    
                    .wizard-progress {
                        background-color: #28a745;
                        height: 100%;
                        width: 0%;
                        transition: width 0.3s ease;
                    }
                    
                    .wizard-content {
                        margin: 20px 0;
                    }
                    
                    .wizard-step-content {
                        display: block;
                    }
                    
                    .wizard-step-content.current {
                        display: block;
                    }

                    .sectionDiv {
                        font-size: large;
                        font-family: sans-serif;
                        font-weight: bold;
                        color: #aaa;
                        text-align: start;
                    }

                    .carousel-inner img {
                        width: 100%;
                        height: 370px;
                        border-radius: 10px;
                    }

                    .animated-btn {
                        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
                        display: flex;
                        align-items: center;
                        gap: 5px; /* Space between text and icon */
                    }

                    .animated-btn:hover {
                        transform: scale(1.05);
                        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
                        background-color: #0056b3;
                        color: #fff;
                    }

                    .animated-btn i {
                        transition: transform 0.3s ease;
                    }

                    .animated-btn:hover i {
                        transform: translateX(5px); /* Move icon to the right on hover */
                    }

                    .animated-btn:active {
                        transform: scale(0.98);
                        box-shadow: 0 2px 10px rgba(0, 123, 255, 0.3);
                    }
                    
                    
                    
                    /*for payment slip*/
                    .upload-container {
                      border: 2px dashed #3498db;
                      padding: 20px;
                      width: 100%;
                      text-align: center;
                      background-color: #fff;
                      border-radius: 10px;
                    }
                    .upload-container p {
                      font-size: 18px;
                      color: #333;
                    }
                    .upload-area {
                      border: 2px dashed #3498db;
                      padding: 40px;
                      cursor: pointer;
                      transition: background-color 0.3s ease;
                      background-color: #f9fafb;
                      margin-top: 10px;
                      border-radius: 5px;
                    }
                    .upload-area:hover {
                      background-color: #f0f4f8;
                    }
                    .upload-area input {
                      display: none;
                    }
                    .file-name {
                      margin-top: 10px;
                      font-size: 16px;
                      color: #666;
                    }
                    
                    
                    
                    
                    
                    /*after submission display*/
                    .notice-container {
                      background-color: #f8f9fa;
                      border: 1px solid #d6d8db;
                      padding: 20px;
                      border-radius: 10px;
                      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                      margin-top: 30px;
                    }
                    .notice-header {
                      font-size: 24px;
                      font-weight: 600;
                      color: #28a745;
                    }
                    .notice-content {
                      font-size: 16px;
                      color: #333;
                    }
                    .btn-custom {
                      background-color: #007bff;
                      color: #fff;
                      border: none;
                      border-radius: 5px;
                      padding: 10px 20px;
                      cursor: pointer;
                    }
                    .btn-custom:hover {
                      background-color: #0056b3;
                    }


                </style>

                <script>
                    document.getElementById("title_title").innerHTML = "Withdrawal Process";
                </script>

                <div class="container dash_con">
                    <p class="dash_header col-12 col-md-12">Payment Withdrawal</p>
                </div>
                
                
                
                <!--alert messages-->
                <?php if (isset($_SESSION['slip-error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?=
                            $_SESSION['slip-error'];
                            unset($_SESSION['slip-error']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                
                <?php if (isset($_SESSION['slip-success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?=
                            $_SESSION['slip-success'];
                            unset($_SESSION['slip-success']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                
                


                <div class="wizard">
                    <div class="wizard-content">
                        <!-- footer for paypal -->
                        <div class="container">
                            <div class="row" style="background-color:#FCFAFC; font-size: small;">
                                <div class="col-12 col-md-6 pt-4">
                                    <p>We’re thrilled to announce that PayPal is sponsoring AID Solutions in our mission to simplify and secure payment processes for our users. Through this partnership, PayPal will support AID Solutions in delivering faster, more reliable payouts directly to freelancers. This collaboration enhances our ability to ensure convenient, global payments, enabling freelancers from all regions to access their earnings seamlessly through PayPal's trusted platform. Together with PayPal, we’re committed to empowering freelancers worldwide by offering flexible, safe, and transparent payment solutions.</p>
                                </div>
                                <div class="col-12 col-md-6">
                                    <img src="<?= URL ?>withdrawal/paypal animated gif.gif" alt="" style="width: 100%">
                                </div>
                            </div>
                        </div>

                        

                            <?php
                                if ($withdrawalTrack == 0) {

                            ?>  
                                    <form action="<?= URL ?>withdrawal/payment-processing-logic.php" method="POST" id="submitForm">
                                        <input type="hidden" name="userId" value="<?= $userId ?>">
                                        <input type="hidden" name="transactionId" value="<?= $transactionId ?>">
                                
    
                                        <div class="justify-center small mb-4 mt-4">
                                        <p>Please double-check all your details before submitting the withdrawal form to avoid delays or errors in processing. Ensure that your banking or payment information is accurate and up-to-date, as this will help us process your withdrawal smoothly and efficiently.</p>
                                    </div>
    
    
                                        <div class="wizard-step-content current" id="wizard-content1">
                                            <div class="container">
                                                <div class="form-group">
                                                    <div class="sectionDiv">
                                                        <p>Personal Identification</p>
                                                    </div>
                                                    <div class="row">
        
                                                        <div class="input-group mb-3 input-group-md col-md-6">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                            </div>
                                                            <input type="text" name="name" class="form-control" id="accountName" placeholder="Account Holder Name" value="<?= $fullname ?>">
                                                        </div>
        
                                                        <div class="input-group mb-3 input-group-md col-md-6 ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                            </div>
                                                            <input type="email" value="<?= $email ?>" name="email" id="email" class="form-control" placeholder="Email">
                                                        </div>
        
                                                        <div class="input-group mb-3 input-group-md col-md-6">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                                                            </div>
                                                            <input type="text" name="phone" value="<?= $phone ?>" id="phone" class="form-control" placeholder="Phone Number">
                                                        </div>
        
                                                        <div class="input-group mb-3 input-group-md col-md-6">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-wallet"></i></span>
                                                            </div>
                                                            <input type="number" name="amount" id="amount" class="form-control" value="<?= $balance ?>" readonly>
                                                        </div>
        
                                                    </div>
        
                                                    <div class="sectionDiv mt-4">
                                                        <p>Banking Details</p>
                                                    </div>
        
                                                    <div class="row">
        
                                                        <div class="input-group mb-3 input-group-md col-md-6 ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                                                            </div>
                                                            <input type="text" name="bank_name" id="bankName" class="form-control" placeholder="Bank Name">
                                                        </div>
        
                                                        <div class="input-group mb-3 input-group-md col-md-6 ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                                            </div>
                                                            <input type="text" name="accountNo" id="accountNo" class="form-control" placeholder="Bank Account Number">
                                                        </div>
        
                                                        <div class="input-group mb-3 input-group-md col-md-6 ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
                                                            </div>
                                                            <select name="accountType" id="accountType" class="form-control">
                                                                <option value="0">Select a preferred Account type</option>
                                                                <option value="savings">Savings Account</option>
                                                                <option value="checking">Checking Account</option>
                                                            </select>
                                                        </div>
        
        
                                                        <div class="input-group mb-3 input-group-md col-md-6 ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                            </div>
                                                            <input type="text" name="id" maxlength="18" placeholder="Government-issued ID (INE/IFE)" class="form-control" id="ID">
                                                        </div>
        
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-md mt-4" name="submitData">Click to Proceed</button>
                                            
                                        </div>
                                    </form>
                            <?php
                                }

                                elseif ($withdrawalTrack == 1) {
                            ?>
                                    <div class="" id="" style="text-align:left; font-size: 15px">
                                        <div class="container mt-4">
                                            <p> <b>Dear <?= $fullname ?>,</b></p>
                                            <p>As we continue to strive for excellence in our services, we're excited to announce the introduction of processing and withdrawal fees. These fees will enable us to further enhance our platform's security, speed, and compliance with regulatory standards, ultimately providing you with an even better experience.
                                            </p>

                                            <p><b>What do these fees mean for you?</b></p>
                                            <ul>
                                                <li> <b>Enhanced Security:</b> Our processing fee will allow us to implement advanced security measures, protecting your transactions and sensitive information.
                                                </li>

                                                <li> <b>Faster Transactions:</b> With our withdrawal fee, we'll be able to process transactions within 15-20 minutes, ensuring quicker access to your funds.
                                                </li>

                                                <li> <b>Compliance with Regulatory Standards:</b> We're committed to maintaining the highest standards of regulatory compliance, ensuring a safe and reliable environment for all users.</li>
                                            </ul>

                                            <!-- structure -->
                                            <p> <b>Fee Structure:</b></p>
                                            <ul>
                                                <li> Processing Fee: 5% per transaction</li>
                                                <li>Withdrawal Fee: 5% per withdrawal</li>
                                            </ul>

                                            <!-- benefits -->
                                            <p> <b>Benefits of these fees:</b> </p>
                                            <ul>
                                                <li> Improved security features to safeguard your transactions</li>
                                                <li> Faster transaction processing times (within 15-20 minutes)</li>
                                                <li>Enhanced compliance with regulatory standards</li>
                                                <li>Continued investment in platform development and customer support</li>
                                            </ul>

                                            <!-- unserstanding -->
                                            <p> <b>Thank you for your understanding:</b> </p>
                                            <p>Your trust and loyalty are essential to us. We appreciate your continued support as we work tirelessly to provide the best possible experience.</p>

                                            <!-- support -->
                                            <p> <b>Support:</b> </p>
                                            <p>If you have any questions or concerns, please don't hesitate to contact us through our chat box or <a href="<?= URL ?>contact-us.php">contact us</a> page</p>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <a href="<?= URL ?>withdrawal/payment-proceed.php?transactionId=<?= $transactionId ?>&&ref=<?= $ref ?>">
                                                <button type="button" class="btn btn-primary text-center mt-3 animated-btn">
                                                    Click to proceed <i class="fas fa-arrow-right"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                            <?php
                                }

                                else {
                            ?>
                                    <div class=" container pt-4" id="" style="text-align: left;">
                                        <p>To process your withdrawal, </p>
                                        <p class="text-primary"><b>Payment details:</b></p>
                                        
                                        <div class="container small">
                                            <p><em><b>Fee amount:</b></em>  10% of withdrawal amount</p>
                                            <p><em><b>Total Withdrawable Balance:</b></em>  $<?= $balance ?>.00 </p>
                                            <p><em><b>10% of total balance:</b> </em> $<?= $percentage ?>.00</p>
                                        </div>
                                        
                                        
                                        <p class="text-primary"><b>Payment Method:</b></p>
                                        <div class="container small">
                                            <input type="hidden" value="<?= $account_number ?>" id="accNum">
                                            <p><em><b>Account Number:</b> <?= $account_number ?></em>  <button type="button" class="btn btn-basic" onclick="copyClip();"><i class="fa fa-copy" style="font-weight: light; font-size: small; color: silver"></i></button></p>
                                            <p><em><b>Account Bank:</b></em> <?= $account_bank ?></p>
                                        </div>
                                        
                                        
                                        <div class="upload-container">
                                            <form action="<?= URL ?>withdrawal/payment-slip.php" method="post" enctype="multipart/form-data">
                                                <!--required inputs-->
                                                <input type="hidden" name="userId" value="<?= $userId ?>">
                                                <input type="hidden" name="percentage" value="<?= $percentage ?>">
                                                <input type="hidden" name="amount" value="<?= $balance ?>">
                                                <input type="hidden" name="account_number" value="<?= $account_number ?>">
                                                <input type="hidden" name="bank" value="<?= $account_bank ?>">
                                                <input type="hidden" name="transactionId" value="<?= $transactionId ?>">
                                                
                                                <div class="upload-area" id="upload-area">
                                                    <input type="file" name="receipt" id="file-input" accept=".pdf,.docx,.jpg,.png,.jpeg" multiple>
                                                    <p>Drag & Drop or Click to Upload your Proof of Payment</p>
                                                </div>
                                                <div class="file-name" id="file-name"></div>
                                                <button type="submit" name="submitBtn" class="btn btn-primary">
                                                    Submit
                                                </button>
                                            </form>
                                        </div>
                                        
                            <?php
                                }
                            ?>
                        





                        <!-- footer's carousel -->
                        <div class="container mt-5">
                            <div class="col-md-12 small">
                                <p>Your personal and financial information is safe with us. AID Solutions employs advanced security measures to protect all user data, ensuring that your information remains private and secure at all times. Only authorized personnel can access your data, and we strictly adhere to data protection regulations to prevent any unauthorized access.</p>
                                <p>Please make sure to complete all steps in the withdrawal process, including verifying your payment details, confirming the transaction, and any other necessary steps on our platform. Missing any part of this process may prevent your payment from being successfully transferred to your account.</p>
                            </div>
                            <div class="col-md-12">
                                <div id="demo" class="carousel slide" data-ride="carousel">
                                    <!-- The slideshow -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item  active">
                                            <img src="<?= URL ?>withdrawal/bank carousel/PayPal revenues miss but growth is strong from new acquisitions _ TechCrunch.jpeg" alt="Los Angeles">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?= URL ?>withdrawal/bank carousel/Wells Fargo.jpeg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






                

                
                <script>
                    // form submission
                    var formData = document.getElementById("submitForm");
                    formData.addEventListener("submit", function() {
                        var accountName = document.getElementById("accountName").value.trim();
                        var email = document.getElementById("email").value.trim();
                        var phone  = document.getElementById("phone").value.trim();
                        var bankName = document.getElementById("bankName").value.trim();
                        var accountNo = document.getElementById("accountNo").value.trim();
                        var accountType = document.getElementById("accountType").value;
                        var Id = document.getElementById("ID").value.trim();

                        if (accountName == "" || email == "" || phone == "" || bankName == "" || accountNo == "" || Id == "") {
                            alert("Please fill out every required field to proceed");
                            event.stopPropagation();
                            event.preventDefault();
                            false;
                        }

                        else if (isNaN(phone)) {
                            alert("Error occured in the inputed phone number");
                            event.stopPropagation();
                            event.preventDefault();
                            false;
                        }

                        else if (accountType === "0") {
                            alert("Please fill out every required field to proceed");
                            event.stopPropagation();
                            event.preventDefault();
                            false;
                        }

                        else {
                            if (confirm("Are you sure?")) {
                                true;
                            }
                            else {
                                event.stopPropagation();
                                event.preventDefault();
                                false;
                            }
                        }
                    })
                    
                    
                    
                    function copyClip() {
                        /* Get the text field */
                        var copyText = document.getElementById("accNum");
                        /* Select the text field */
                        copyText.select();
                        /* Copy the text inside the text field */
                        navigator.clipboard.writeText(copyText.value);
                        /* Alert the copied text */
                        alert("Copied to clipboard");
                    }
                </script>
                        

<?php
            }

            else {
                header('location: ' . URL . "error/error.php");
                die();
            }
        }

        else {
            header('location: '. URL . "error/error.php");
            die();
        }


    }

    else {
        header('location: ' . URL . "account/login.php");
    }

    include __DIR__ . "/../user/partials/footer.php";
?>