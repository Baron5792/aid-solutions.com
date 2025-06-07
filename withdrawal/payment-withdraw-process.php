<?php
    include __DIR__ . "/../user/partials/header.php";

    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $fullname = $data['firstname'] . " " . $data['lastname'];
            $balance = $data['balance'];
            $ref_code = $data['ref_code'];
            
            function generateRandomString($length = 40) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                
                return $randomString;
            }
            
            // fetch pending balance
            $pending = 0;
            $fetchPending = mysqli_query($connection, "SELECT * FROM transactions WHERE userId= '$userId' AND status= 'Pending'");
            if (mysqli_num_rows($fetchPending) > 0) {
                $details = mysqli_fetch_assoc($fetchPending);
                $amount = $details['amount'];
                $pending += $amount;
            }
            
            else {
                $pending = 0;
            }
            
        }
    }

    else {
        header('location: ' . URL . 'account/login.php');
    }
?>

<style>
    .payment-table {
        text-align: center;
        font-size: small;
        width: 100%;
        margin: 20px 0px;
    }

    .payment-table tr:first-child td {
        padding-bottom: 10px;
    }

    table tr:nth-child(2) td {
        margin-top: 40px;
        padding: 10px 0px;
    }

    @media screen and (max-width: 768px) {
        .dash_header {
            font-size: medium;
        }

        .payment-table tr:first-child th:nth-child(2), .payment-table tr:nth-child(2) td:nth-child(2), .payment-table tr:first-child th:nth-child(1), .payment-table tr:nth-child(2) td:nth-child(1) {
            display: none;
        }

        .payment-table tr:nth-child(2) {
            border-bottom: 1px solid silver;
        }
    }
    
    .transaction-header {
      font-weight: bold;
      color: #007bff;
    }
    .transaction-details {
      font-size: 16px;
      color: #333;
    }
    .detail-label {
      font-weight: bold;
      color: #555;
    }
    
    .proceed:hover i {
        margin-left: 10px;
        transition: 1s ease-out;
    }
</style>

<script>
    document.getElementById("title_title").innerHTML = "Payment withdrawal process";
</script>

<div class="container">    
    <div class="dash_con col-md-12 col-12">
        <p class="dash_header col-12 col-md-12">My Balance</p>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-9 col-12">
                <p>Available Balance <abbr title="Availbale balance is displayed below"><span class="fas fa-question-circle text-secondary" style="font-size: small;"></span></abbr></p>

                <!-- display balance -->
                <div class="d-flex" style="font-size: 28px;">
                    <p><span class="fa fa-dollar mt-2"></span> </p>
                    <p class="ml-2 mr-2"> <?= $balance ?>.00</p>
                    <p>USD</p>
                </div>

                <div class="row mt-4">
                    <div class="col-12 col-md-6">
                        <p>Total Balance <abbr title="Total balance"><span class="fas fa-question-circle text-secondary" style="font-size: small;"></span></abbr></p>
                        <div class="d-flex" style="font-size: 14px;">
                            <p><span class="fa fa-dollar mt-1"></span> </p>
                            <p class="ml-2 mr-2"> <?= $balance ?>.00</p>
                            <p>USD</p>
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <p>Withdrawal Pending <abbr title="Pending Withdrawal"><span class="fas fa-question-circle text-secondary" style="font-size: small;"></span></abbr></p>
                        <div class="d-flex" style="font-size: 14px;">
                            <p><span class="fa fa-dollar mt-1`` "></span> </p>
                            <p class="ml-2 mr-2"> <?= $pending ?>.00</p>
                            <p>USD</p>
                        </div>
                    </div>


                    <!-- fetch the users referral code into the link as a track -->
                    <?php
                        if ($balance > 100) {
                    ?>  
                            <div class="submit mb-4">
                                <a href="<?= URL ?>withdrawal/proceed-logic.php?id=<?= generateRandomString() ?>&&ref=<?= $ref_code ?>">
                                    <button type="button" class="btn btn-success btn-md mt-4 proceed">Proceed to withdraw <i class="fas fa-arrow-right"></i></button>
                                </a>
                            </div>
                    <?php
                        }
                        else {
                            echo "<small><i class='fa fa-exclamation-circle text-danger'></i> It looks like your balance is currently too low for a withdrawal. Please ensure you have the minimum balance required, or check back after receiving additional payments.</small>";
                        }
                    ?>
                </div>
            </div>



            <div class="col-md-3 col-12">
                <!-- privacy -->
                <div class="mt-4">
                    <img src="<?= URL ?>assets/images/withdrawal/Shield security icon_ vector.jpeg" style="width: 100%;" alt="">
                    <small class="text-secondary">Never share your withdrawal information with anyone. Protect your account and financial details.</small>
                </div>

                

            </div>


        </div>

        


    </div>


    <!-- transaction history -->
    <div class="container pt-3 pb-3" style="box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); margin-top: 40px">
        <div>
            <div class="dash_con col-md-12 col-12 mb-3">
                <p class="dash_header col-12 col-md-12">Withdrawal History</p>
            </div>
            <table class="payment-table">
                <tr class="" style="border-bottom: 1px solid silver;">
                    <th>Time</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <!--<th>Actions</th>-->
                </tr>

                <?php
                    $fetchHistory = mysqli_query($connection, "SELECT * FROM transactions WHERE userId= '$userId' AND status= 'Pending' ORDER BY date DESC");
                    if (mysqli_num_rows($fetchHistory) > 0) {
                        foreach ($fetchHistory as $data) {
                            $time = $data['date'];
                            $amount = $data['amount'];
                            $status = $data['status'];
                            $fee = 0.1 * $amount;
                            $id = $data['id'];
                            $transactionId = $data['transactionId'];
                            
                            $date = $data['date'];
                            
                            // function cutFirstTenLetters($transactionId) {
                            //     // Use substr to get the string starting from the 11th character (index 10)
                            //     return substr($transactionId, 10);
                            // }
                            
                            // $modifiedId = cutFirstTenLetters($transactionId);
                            
                            // Create a DateTime object
                            $dateTime = new DateTime($date);
                            
                            // Fetching the month, day, and year
                            $month = $dateTime->format('m'); // Month in numeric format (01 to 12)
                            $day = $dateTime->format('d');   // Day of the month (01 to 31)
                            $year = $dateTime->format('Y');  // Year in 4 digits (e.g., 2023)
                            
                            // Convert the numeric month to a month name
                            switch ($month) {
                                case 1:
                                    $monthName = "January";
                                    break;
                                case 2:
                                    $monthName = "February";
                                    break;
                                case 3:
                                    $monthName = "March";
                                    break;
                                case 4:
                                    $monthName = "April";
                                    break;
                                case 5:
                                    $monthName = "May";
                                    break;
                                case 6:
                                    $monthName = "June";
                                    break;
                                case 7:
                                    $monthName = "July";
                                    break;
                                case 8:
                                    $monthName = "August";
                                    break;
                                case 9:
                                    $monthName = "September";
                                    break;
                                case 10:
                                    $monthName = "October";
                                    break;
                                case 11:
                                    $monthName = "November";
                                    break;
                                case 12:
                                    $monthName = "December";
                                    break;
                                default:
                                    $monthName = "Unknown";
                                    break;
                            }

                            
                            
                ?>
                            <tr class="text-secondary">
                                <td><?= $time ?></td>
                                <td>Withdrawal</td>
                                <td>-<?= $amount ?>.00</td>
                                <td class="text-warning"><?= $status ?></td>
                                <!--<td>-->
                                <!--    <button type="button" class="btn btn-normal btn-sm text-primary" data-toggle="modal" data-target="#myModal"> <small style="text-decoration: underline;">View Details</small></button>-->
                                <!--</td>-->
                            </tr>
                <?php
                        }
                    }

                    else {
                ?>
                        <tr>
                            <td>No record found</td>
                        </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>


    

</div>

<script>
    function copyClip() {
        /* Get the text field */
        var copyText = document.getElementById("transactionID");
        /* Select the text field */
        copyText.select();
        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
        /* Alert the copied text */
        alert("Copied to clipboard");
    }
</script>





<?php
    include __DIR__ . "/../user/partials/footer.php";
?>