<?php
    include "./partials/header.php";
    
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $query = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($query) == 1) {
            $data = mysqli_fetch_assoc($query);
            $name = $data['firstname'] . " " . $lastname = $data['lastname'];
            $email = $data['email'];
        }
    }

    else {
        $name = "";
        $email = "";
        $userId = "Unregistered";
    }
?>

<style>
    .underline {
      position: relative;
      display: inline-block;
      transition: all 0.5s ease-in-out;
      font-size: 27px;
    }
    
    .underline:after {
      content: '';
      position: absolute;
      left: 0;
      bottom: -2px;
      width: 0;
      height: 2px;
      background-color: darkcyan;
      transition: width 2s ease-in-out;
    }
    
    .main-con:hover .underline:after {
      width: 100%;
    }
    
    .header-item:nth-child(2), .header-item:nth-child(3), .header-item:nth-child(4) {
        border-left: 1px solid red;
        display: none;
    }
    
    .header-item p:first-child {
        color: darkcyan;   
    }
    
    .header-item p:nth-child(2) {
        font-weight: bold;
        font-family: sans-serif;
        font-size: 14px;
    }
    
    .header-item p:nth-child(3) {
        font-size: 14px;
    }
    
    .form-div {
        width: 50%;
    }
    
    @media screen and (max-width: 767px) {
        .form-div {
            width: 100%;
        }
    }

</style>

<div class="container-fluid main-con pb-5" style="background-color: #FAFEFD;">
    <div class="container pt-5">
        <div class="header">
            <p class="underline">CONTACT US</p>
        </div>
        
        <div class="mt-5">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3">
                    <div class="text-center header-item">
                        <p><i class="fas fa-thumbtack"></i></p>
                        <p>ADDRESS</p>
                        <p>456 Spadina Ave, Toronto<br>  ON M5S 2G8</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3">
                    <div class="text-center header-item">
                        <p><i class="fas fa-mobile-alt"></i></p>
                        <p>PHONE</p>
                        <p>+1 (219) 727-2594</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3">
                    <div class="text-center header-item">
                        <p><i class="fas fa-clock"></i></p>
                        <p>HOURS</p>
                        <p>MONDAY - FRIDAY <br> 8am - 8pm</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-lg-3 col-xl-3">
                    <div class="text-center header-item">
                        <p><i class="fas fa-envelope"></i></p>
                        <p>SUPPORT</p>
                        <p style="font-weight: bold;">support@aid-solutions.com</p>
                    </div>
                </div>
            </div>
            
            <!--form-->
            <div class="mx-auto form-div mt-5 pb-5">
                <form action="<?= URL ?>contact-us_logic.php" id="form" method="POST">
                    <input type="hidden" value="<?= $userId ?>" name="userId">
                    
                    <!--alerts-->
                    <?php if (isset($_SESSION['contact-success'])): ?>
                        <div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= 
                                $_SESSION['contact-success'];
                                unset($_SESSION['contact-success']);
                            ?>
                        </div>
                    <?php elseif (isset($_SESSION['contact'])): ?>
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?= 
                                $_SESSION['contact'];
                                unset($_SESSION['contact']);
                            ?>
                        </div>
                    <?php endif ?>
                    
                    
                    
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                            <label>FULL NAME <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="firstname" id="name" value="<?= $name ?>">
                        </div>
                        <div class="form-group col-sm-12 col-md-12">
                            <label>EMAIL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= $email ?>">
                        </div>
                        <div class="form-group col-sm-12 col-md-12">
                            <label>MESSAGE <span class="text-danger">*</span></label>
                            <textarea id="message" name="message" class="form-control"></textarea>
                        </div>
                        
                        <div class="form-group col-sm-12 col-md-12">
                            <button type="submit" name="send" class="btn btn-info btn-md">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    var form = document.getElementById("form");
    
    form.addEventListener('submit', (e) => {
      var name = document.getElementById("name").value.trim();
      var email = document.getElementById("email").value.trim();
      var message = document.getElementById("message").value.trim();
      var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
      if (name === "") {
        document.getElementById("name").style.border = "1px solid red";
      } else {
        document.getElementById("name").style.border = "";
      }
    
      if (email === "") {
        document.getElementById("email").style.border = "1px solid red";
      } else if (!emailRegex.test(email)) {
        document.getElementById("email").style.border = "1px solid red";
        alert("Invalid email address");
      } else {
        document.getElementById("email").style.border = "";
      }
    
      if (message === "") {
        document.getElementById("message").style.border = "1px solid red";
      } else {
        document.getElementById("message").style.border = "";
      }
      
       if (name !== "" && email !== "" && emailRegex.test(email) && message !== "") {
            form.submit();
        } else {
            e.preventDefault();
        }

    });


    
</script>




<?php
    include "./user/partials/footer.php";
?>