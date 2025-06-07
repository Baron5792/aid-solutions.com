<?php
    include __DIR__ . "/./partials/header.php";
    
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user']['id'];
        $query = mysqli_query($connection, "SELECT * FROM users WHERE NOT id= '$id'");
    }
    
    else {
        header('location: ' . URL . "account/login.php");
        exit();
    }
?>


<style>
    .cog-button {
      position: relative;
    }
    
    .eye-icon {
      transition: opacity 0.5s;
    }
    
    .cog {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 10px;
      height: 10px;
      border-radius: 50%;
      border: 1px solid #333;
      border-top-color: #337ab7;
      animation: rotate 2s linear infinite;
      display: none;
    }
    
    @keyframes rotate {
      0% {
        transform: translate(-50%, -50%) rotate(0deg);
      }
      100% {
        transform: translate(-50%, -50%) rotate(360deg);
      }
    }
</style>


    
    <!-- edit users alert message -->
    <?php if (isset($_SESSION['edit-success'])): ?>
        <div class="alert alert-success">
            <?=
                $_SESSION['edit-success'];
                unset($_SESSION['edit-success']);
            ?>
        </div>
    <?php endif ?>

    <!-- delete alert error message -->
    <?php if (isset($_SESSION['delete'])): ?>
        <div class="alert alert-success">
            <?=
                $_SESSION['delete'];
                unset($_SESSION['delete']);
            ?>
        </div>
    <?php endif ?>

    <!-- delete success message -->
    <?php if (isset($_SESSION['delete-success'])): ?>
        <div class="alert alert-success">
            <?=
                $_SESSION['delete-success'];
                unset($_SESSION['delete-success']);
            ?>
        </div>
    <?php endif ?>

<div>
    <table>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Username</th>
            <th>Email</th>
            <!--<th>Country</th>-->
            <th>Zipcode</th>
            <!--<th>Balance</th>-->
            <th>Gender</th>
            <th>Phone</th>
            <th>Date of birth</th>
            <!--<th>Admin status</th>-->
            <!--<th>Sector</th>-->
            <!--<th>Years of experience</th>-->
            <!--<th>Address</th>-->
            <th>IP country</th>
            <th>IP region</th>
            <!--<th>Referer</th>-->
            <!--<th>Referer's status</th>-->
            <!--<th>IP address</th>-->
            <!--<th>Survey test</th>-->
            <!--<th>Date</th>-->
            <th></th>
            <th></th>
        </tr>
        <?php
            
            if (mysqli_num_rows($query) > 0) {
                foreach ($query as $row) { 
                    $userId = $row['id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $country = $row['country'];
                    $zipcode = $row['zipcode'];
                    $gender = $row['gender'];
                    $phone = $row['phone'];
                    $admin = $row['admin'];
                    $ip_country = $row['ip_country'];
                    $ip_region = $row['ip_region'];
                    $ip = $row['ip'];
                    $sector = $row['sector'];
                    $years_of_experience = $row['years_of_experience'];
                    $address = $row['address'];
                    $referer = $row['referer'];
                    $eligibility = $row['eligibility'];
                    $date_of_birth = $row['date_of_birth'];
                    $salary = $row['balance'];
                    $mailTrack = $row['mail_track'];
                    $avatar = $row['avatar'];
                    $date = $row['date'];
                    $schedule = $row['schedule'];
                    
                    if ($eligibility == 0) {
                        $eligibility = "not taken";
                    }
                    
                    else {
                        $eligibility = "taken";
                    }
                    
                    
                    // fetch referer's details
                    $refData = mysqli_query($connection, "SELECT * FROM users WHERE ref_code= '$referer'");
                    if (mysqli_num_rows($refData) > 0) {
                        $refDetails = mysqli_fetch_assoc($refData);
                        $refName = $refDetails['firstname'] . " " . $refDetails['lastname'];
                        $refStatus = $refDetails['admin'];
                        
                        if ($refStatus == 0) {
                            $refStatus = "user";
                        }
                        elseif ($refStatus = 1) {
                            $refStatus = "admin";
                        }
                        else {
                            $refStatus = "not found";
                        }
                    }
                    
                    else {
                        $refStatus = "user not found";
                        $refName = "user not found";
                    }


                    if ($admin == 0) {
                        $admin = "user";
                    } else {
                        $admin = "admin";
                    }



                    
        ?>
                    <tr>
                        <td>
                            <a href="<?= URL ?>admin/edit-user.php?id=<?= $userId ?>"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="<?= URL ?>admin/delete-user.php?id=<?= $userId ?>" onclick="deleteUser();"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td>
                            <?php if ($mailTrack == 0): ?>
                                <button type="button" class="btn btn-normal"> <a href="<?= URL ?>admin/welcome-mail.php?id=<?= $userId ?>" class="text-danger"><i class="fa fa-person-circle-xmark"></i></a> </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-normal"><p class="fa fa-user-check text-success"></p></button>
                            <?php endif ?>
                                
                        </td>
                        <td>
                          <a href="<?= URL ?>admin/users-details.php?user-details=<?= $userId ?>">
                            <button type="button" class="btn btn-normal text-info cog-button" data-toggle="modal" data-target="#myModal">
                              <i class="fa fa-eye eye-icon"></i>
                              <div class="cog"></div>
                            </button>
                          </a>
                        </td>


                        <td><?= $firstname ?></td>
                        <td><?= $lastname ?></td>
                        <td><?= $username ?></td>
                        <td><?= $email ?></td>
                        <!--<td><?= $country ?></td>-->
                        <td><?= $zipcode ?></td>
                        <!--<td><?= $salary ?></td>-->
                        <td><?= $gender ?></td>
                        <td><?= $phone ?></td>
                        <td><?= $date_of_birth ?></td>
                        <!--<td><?= $admin ?></td>-->
                        <!--<td><?= $sector ?></td>-->
                        <!--<td><?= $years_of_experience ?></td>-->
                        <!--<td><?= $address ?></td>-->
                        <td><?= $ip_country ?></td>
                        <td><?= $ip_region ?></td>
                        <!--<td><?= $refName ?></td>-->
                        <!--<td><?= $refStatus ?></td>-->
                        <!--<td><?= $ip ?></td>-->
                        <!--<td><?= $eligibility ?></td>-->
                        <!--<td><?= $date ?></td>-->
                        <td>
                            <a href="<?= URL ?>admin/edit-user.php?id=<?= $userId ?>"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="<?= URL ?>admin/delete-user.php?id=<?= $userId ?>" onclick="deleteUser();"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        
                    </tr>
        <?php
                }
                
                
            }
            
            else {
                echo "No other users found";
            }

        ?>
            
    </table>
    
    

    <script>
        function deleteUser() {
            if (confirm("Are you sure?")) {
                true;
            }

            else {
                event.preventDefault();
                event.stopPropagation();
            }
        }
        
        
        $(document).ready(function() {
          $('.cog-button').on('click', function(e) {
            e.preventDefault();
            var href = $(this).closest('a').attr('href');
            $(this).find('.eye-icon').css('opacity', 0);
            $(this).find('.cog').show();
            setTimeout(function() {
              $(this).find('.cog').hide();
              window.location.href = href;
            }.bind(this), 2000);
          });
        });

    </script>

</div>


<?php
    include "./partials/footer.php";
?>