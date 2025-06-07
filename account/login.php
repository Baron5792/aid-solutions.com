<?php
    include __DIR__ . "/../partials/header.php";

    // for IP address and location
    function getRealIpAddr() {
        $ip = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    // Function to get location details based on IP address
    function getLocation($ip) {
        $url = "http://ip-api.com/json/{$ip}";
        
        // Make sure file_get_contents doesn't fail silently
        $response = @file_get_contents($url);
        
        // Check if the request was successful
        if ($response === false) {
            return ['error' => 'Unable to fetch location data'];
        }
    
        // Decode the JSON response
        $details = json_decode($response, true);
    
        // Check if decoding was successful and the status is OK
        if (json_last_error() === JSON_ERROR_NONE && $details['status'] === 'success') {
            return $details;
        } else {
            return ['error' => 'Invalid or unavailable location data'];
        }
    }
    

    // Example usage
    $ip = getRealIpAddr(); 
    $locationDetails = getLocation($ip);

    // Assign the specific location details to variables
    $city = $locationDetails['city'] ?? 'Unknown';
    $region = $locationDetails['regionName'] ?? 'Unknown';
    $country = $locationDetails['country'] ?? 'Unknown';
    $latitude = $locationDetails['lat'] ?? 'Unknown';
    $longitude = $locationDetails['lon'] ?? 'Unknown';




    function generate_random_string($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $ref_code = generate_random_string(10);

    $firstname = $_SESSION['register_data']['firstname'] ?? null;
    $lastname = $_SESSION['register_data']['lastname'] ?? null;
    $username  = $_SESSION['register_data']['username'] ?? null;
    $email = $_SESSION['register_data']['email'] ?? null;
    $date_of_birth = $_SESSION['register_data']['date_of_birth'] ?? null;
    $country_code = $_SESSION['register_data']['country_code'] ?? null;
    $phone = $_SESSION['register_data']['phone'] ?? null;
    $password = $_SESSION['']['password'] ?? null;
    $address = $_SESSION['register_data']['address'] ?? null;
    $zipcode = $_SESSION['register_code']['zipcode'] ?? null;
    unset($_SESSION['register_data']);


    $username = $_SESSION['login-data']['username_email'] ?? null;
    unset($_SESSION['login-data']);

    if (isset($_GET['id'])) {
        $referral_code = $_GET['id'];
    }

    else {
        $referral_code = "";
    }

?>




<script>
    var title =document.getElementById("title_title");
    title.innerHTML = "Log in to Aid Solutions";
</script>



<style>
    /* Spinner styling */
        .error {
            color: red;
            font-size: 0.9rem;
        }

        .success {
            color: green;
            font-size: 0.9rem;
        }

        .invalid {
            border-color: red;
        }

        .valid {
            border-color: green;
            background-color: #e9ffe9; /* Light green background for success */
        }


    .spinner {
        display: none;
        width: 16px;
        height: 16px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #555;
        color: red;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 10px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .registerSpin {
        display: none;
        width: 16px;
        height: 16px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #555;
        color: red;
        border-radius: 50%;
        animation: reg 1s linear infinite;
        margin-left: 10px;
    }
    
    @keyframes reg {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="container-fluid why-to-register_image mb-3">
    <img src="<?= URL ?>assets/images/index2 (1).jpg" alt="">
</div>

<div class="container mt-5 ">
    <div class="row">


        <!-- if forgot password -->
        <?php 
            if (isset($_GET['request'])) {
                $request = $_GET['request'];

                if ($request = "true") {

        ?>
                    <!-- forgotten password -->
                    <div class="login-con col-12 col-md-6 mb-4" id="forgotten-password">
                        <div class="container">
                            <form action="<?= URL ?>account/reset/reset-logic" method="POST">
                                <?php
                                    // to track reset ID's
                                    function Random_reset_Code($length = 10) {
                                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $randomString = '';
                                        for ($i = 0; $i < $length; $i++) {
                                            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
                                        }
                                        return $randomString;
                                    }
                                    $track = generate_random_string(10);

                                    // random reset code
                                    function generate7DigitNumber() {
                                        $number = '';
                                        // Loop 7 times to generate each digit
                                        for ($i = 0; $i < 7; $i++) {
                                            $number .= mt_rand(0, 9);
                                        }
                                        return $number;
                                    }
                                    
                                    // Example usage
                                    $resetCode = generate7DigitNumber();
                                ?>
                                <div class="container">
                                    <div class="login-header">
                                        <p>Reset Password</p>
                                        
                                        <!-- display alert -->
                                        <?php if (isset($_SESSION['reset-error'])): ?>
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <?=
                                                    $_SESSION['reset-error'];
                                                    unset($_SESSION['reset-error']);
                                                ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="row">
                                        <input type="hidden" name="resetCode" value="<?= $resetCode ?>"> <!-- Reset code -->
                                        <input type="hidden" name="track" value="<?= $track ?>">
                                        <div class="form-group col-12 col-md-12">
                                            <input type="text" name="username-email" placeholder="Username or Email Address" class="form-control" required>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <button type="submit" name="reset" class="form-control bg-secondary text-white">Get a New Password</button>
                                        </div>

                                        <div class="form-group col-12 col-md-6">
                                            <p class="mt-2">Already have an account?<a href="<?= URL ?>account/login">Login</a></p>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
        
        <?php
                }

                else {
                    header('location: ' . URL . 'account/login');
                }
            }
            

            else {
        ?>

                <!-- sigin -->
                <div class="login-con col-12 col-md-6 mb-4">
                    <div class="container">
                        <form action="<?= URL ?>account/login-logic" method="POST" id="loginForm">
                            <div class="container">
                                <div class="login-header">
                                    <p>Login to your Account</p>
                                    <p>Enter your username or email and password to proceed:</p>
                                </div>

                                

                                <!-- successsful login message -->
                                <?php if (isset($_SESSION['register-success'])): ?>
                                    <div class="col-12 col-md-12 alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?=
                                            $_SESSION['register-success'];
                                            unset($_SESSION['register-success']);
                                        ?>
                                    </div>
                                <?php endif ?>

                                <!-- login error -->
                                <?php if (isset($_SESSION['login'])): ?>
                                    <div class="col-12 col-md-12 alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <?=
                                            $_SESSION['login'];
                                            unset($_SESSION['login']);
                                        ?>
                                    </div>
                                <?php endif ?>


                                <div class="row" id="forgotten-password">
                                    <!-- details -->
                                    <div class="form-group col-12 col-md-12">
                                        <input type="text" class="form-control" name="username_email" placeholder="Username or Email Address" value="<?= $username ?>">
                                    </div>

                                    <div class="form-group col-12 col-md-12">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                        <button type="submit" class="form-control btn btn-secondary" name="loginBtn" id="signinBtn">LOGIN</button>
                                        <!-- Add the spinner here -->
                                        <div class="spinner text-danger"></div>
                                    </div>

                                    <div class="form-group col-12 col-md-6 pt-2">
                                        <p onclick="window.location.href = ('<?= URL ?>account/login?request=true')">Forgot your password?</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        <?php
            }
        
        ?>



        <!-- signup -->
        <div class="login-con col-12 col-md-6 mb-4">
            <div class="container">
                <form action="<?= URL ?>account/register-logic" method="POST" id="registerForm">
                    <div class="login-header">
                        <p>Create an Account</p>
                        <p>Fill the form below to get instant access:</p>
                    </div>
                    <!-- Alert error -->
                    <?php if (isset($_SESSION['register'])): ?>
                        <div class="form-group col-12 col-md-12 alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?=
                                $_SESSION['register'];
                                unset($_SESSION['register']);
                            ?>
                        </div>
                    <?php endif ?>
                    <div class="row">

                        <!-- IP ADRRESS -->
                        <input type="hidden" name="ip" value="<?= $ip ?>">
                        <input type="hidden" name="ip_country" value="<?= $country ?>">
                        <input type="hidden" name="ip_region" value="<?= $region ?>">


                        <div class="form-group col-12 col-md-12">
                            <input type="text" class="form-control" placeholder="Firstname *" id="firstname" value="<?= $firstname ?>" name="firstname">
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <input type="text" placeholder="Lastname *" id="lastname" class="form-control" value="<?= $lastname ?>" name="lastname">
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <input type="text" placeholder="Username *" class="form-control" value="<?= $username ?>" name="username" id="username">
                        </div>

                        <div class="form-group col-12 col-md-12">
                            <input type="email" placeholder="Email Address *" class="form-control" value="<?= $email ?>" name="email" id="email">
                        </div>

                        <!-- ref unseen code -->
                        <input type="text" value="<?= $ref_code ?>" style="display: none" name="ref_code">

                        <!-- gender -->
                        <div class="form-group col-12 col-md-6">
                            <select name="gender" id="gender" class="form-control">
                                <option value="0">Select Gender *</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- date of birth -->
                        <div class="form-group col-12 col-md-12">
                            <div class="form-group-label">
                                <label for="">Date of Birth * : </label>
                            </div>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="<?= $date_of_birth ?>" class="form-control">
                        </div>

                        <!-- countries -->
                        <div class="form-group col-12 col-md-12">                        
                            <select id="country-code" name="country_code" class="form-control" id="country">
                                <option value="0">Select Country *</option>
                                <option value="+93">Afghanistan (+93)</option>
                                <option value="+355">Albania (+355)</option>
                                <option value="+213">Algeria (+213)</option>
                                <option value="+1-684">American Samoa (+1-684)</option>
                                <option value="+376">Andorra (+376)</option>
                                <option value="+244">Angola (+244)</option>
                                <option value="+1-264">Anguilla (+1-264)</option>
                                <option value="+672">Antarctica (+672)</option>
                                <option value="+1-268">Antigua and Barbuda (+1-268)</option>
                                <option value="+54">Argentina (+54)</option>
                                <option value="+374">Armenia (+374)</option>
                                <option value="+297">Aruba (+297)</option>
                                <option value="+61">Australia (+61)</option>
                                <option value="+43">Austria (+43)</option>
                                <option value="+994">Azerbaijan (+994)</option>
                                <option value="+1-242">Bahamas (+1-242)</option>
                                <option value="+973">Bahrain (+973)</option>
                                <option value="+880">Bangladesh (+880)</option>
                                <option value="+1-246">Barbados (+1-246)</option>
                                <option value="+375">Belarus (+375)</option>
                                <option value="+32">Belgium (+32)</option>
                                <option value="+501">Belize (+501)</option>
                                <option value="+229">Benin (+229)</option>
                                <option value="+1-441">Bermuda (+1-441)</option>
                                <option value="+975">Bhutan (+975)</option>
                                <option value="+591">Bolivia (+591)</option>
                                <option value="+387">Bosnia and Herzegovina (+387)</option>
                                <option value="+267">Botswana (+267)</option>
                                <option value="+55">Brazil (+55)</option>
                                <option value="+246">British Indian Ocean Territory (+246)</option>
                                <option value="+673">Brunei Darussalam (+673)</option>
                                <option value="+359">Bulgaria (+359)</option>
                                <option value="+226">Burkina Faso (+226)</option>
                                <option value="+257">Burundi (+257)</option>
                                <option value="+238">Cabo Verde (+238)</option>
                                <option value="+855">Cambodia (+855)</option>
                                <option value="+237">Cameroon (+237)</option>
                                <option value="+1">Canada (+1)</option>
                                <option value="+1-345">Cayman Islands (+1-345)</option>
                                <option value="+236">Central African Republic (+236)</option>
                                <option value="+235">Chad (+235)</option>
                                <option value="+56">Chile (+56)</option>
                                <option value="+86">China (+86)</option>
                                <option value="+61">Christmas Island (+61)</option>
                                <option value="+61">Cocos (Keeling) Islands (+61)</option>
                                <option value="+57">Colombia (+57)</option>
                                <option value="+269">Comoros (+269)</option>
                                <option value="+242">Congo (+242)</option>
                                <option value="+243">Congo, Democratic Republic of the (+243)</option>
                                <option value="+682">Cook Islands (+682)</option>
                                <option value="+506">Costa Rica (+506)</option>
                                <option value="+225">Côte d'Ivoire (+225)</option>
                                <option value="+385">Croatia (+385)</option>
                                <option value="+53">Cuba (+53)</option>
                                <option value="+599">Curaçao (+599)</option>
                                <option value="+357">Cyprus (+357)</option>
                                <option value="+420">Czechia (+420)</option>
                                <option value="+45">Denmark (+45)</option>
                                <option value="+253">Djibouti (+253)</option>
                                <option value="+1-767">Dominica (+1-767)</option>
                                <option value="+1-809">Dominican Republic (+1-809)</option>
                                <option value="+593">Ecuador (+593)</option>
                                <option value="+20">Egypt (+20)</option>
                                <option value="+503">El Salvador (+503)</option>
                                <option value="+240">Equatorial Guinea (+240)</option>
                                <option value="+291">Eritrea (+291)</option>
                                <option value="+372">Estonia (+372)</option>
                                <option value="+268">Eswatini (+268)</option>
                                <option value="+251">Ethiopia (+251)</option>
                                <option value="+500">Falkland Islands (Malvinas) (+500)</option>
                                <option value="+298">Faroe Islands (+298)</option>
                                <option value="+679">Fiji (+679)</option>
                                <option value="+358">Finland (+358)</option>
                                <option value="+33">France (+33)</option>
                                <option value="+594">French Guiana (+594)</option>
                                <option value="+689">French Polynesia (+689)</option>
                                <option value="+262">French Southern Territories (+262)</option>
                                <option value="+241">Gabon (+241)</option>
                                <option value="+220">Gambia (+220)</option>
                                <option value="+995">Georgia (+995)</option>
                                <option value="+49">Germany (+49)</option>
                                <option value="+233">Ghana (+233)</option>
                                <option value="+350">Gibraltar (+350)</option>
                                <option value="+30">Greece (+30)</option>
                                <option value="+299">Greenland (+299)</option>
                                <option value="+1-473">Grenada (+1-473)</option>
                                <option value="+590">Guadeloupe (+590)</option>
                                <option value="+1-671">Guam (+1-671)</option>
                                <option value="+502">Guatemala (+502)</option>
                                <option value="+44-1481">Guernsey (+44-1481)</option>
                                <option value="+224">Guinea (+224)</option>
                                <option value="+245">Guinea-Bissau (+245)</option>
                                <option value="+592">Guyana (+592)</option>
                                <option value="+509">Haiti (+509)</option>
                                <option value="+672">Heard Island and McDonald Islands (+672)</option>
                                <option value="+379">Holy See (+379)</option>
                                <option value="+504">Honduras (+504)</option>
                                <option value="+852">Hong Kong (+852)</option>
                                <option value="+36">Hungary (+36)</option>
                                <option value="+354">Iceland (+354)</option>
                                <option value="+91">India (+91)</option>
                                <option value="+62">Indonesia (+62)</option>
                                <option value="+98">Iran (+98)</option>
                                <option value="+964">Iraq (+964)</option>
                                <option value="+353">Ireland (+353)</option>
                                <option value="+44-1624">Isle of Man (+44-1624)</option>
                                <option value="+972">Israel (+972)</option>
                                <option value="+39">Italy (+39)</option>
                                <option value="+1-876">Jamaica (+1-876)</option>
                                <option value="+81">Japan (+81)</option>
                                <option value="+44-1534">Jersey (+44-1534)</option>
                                <option value="+962">Jordan (+962)</option>
                                <option value="+7">Kazakhstan (+7)</option>
                                <option value="+254">Kenya (+254)</option>
                                <option value="+686">Kiribati (+686)</option>
                                <option value="+850">Korea (North) (+850)</option>
                                <option value="+82">Korea (South) (+82)</option>
                                <option value="+965">Kuwait (+965)</option>
                                <option value="+996">Kyrgyzstan (+996)</option>
                                <option value="+856">Laos (+856)</option>
                                <option value="+371">Latvia (+371)</option>
                                <option value="+961">Lebanon (+961)</option>
                                <option value="+266">Lesotho (+266)</option>
                                <option value="+231">Liberia (+231)</option>
                                <option value="+218">Libya (+218)</option>
                                <option value="+423">Liechtenstein (+423)</option>
                                <option value="+370">Lithuania (+370)</option>
                                <option value="+352">Luxembourg (+352)</option>
                                <option value="+853">Macau (+853)</option>
                                <option value="+389">Macedonia (+389)</option>
                                <option value="+261">Madagascar (+261)</option>
                                <option value="+265">Malawi (+265)</option>
                                <option value="+60">Malaysia (+

                            60)</option>
                                <option value="+960">Maldives (+960)</option>
                                <option value="+223">Mali (+223)</option>
                                <option value="+356">Malta (+356)</option>
                                <option value="+692">Marshall Islands (+692)</option>
                                <option value="+596">Martinique (+596)</option>
                                <option value="+222">Mauritania (+222)</option>
                                <option value="+230">Mauritius (+230)</option>
                                <option value="+262">Mayotte (+262)</option>
                                <option value="+52">Mexico (+52)</option>
                                <option value="+691">Micronesia (+691)</option>
                                <option value="+373">Moldova (+373)</option>
                                <option value="+377">Monaco (+377)</option>
                                <option value="+976">Mongolia (+976)</option>
                                <option value="+382">Montenegro (+382)</option>
                                <option value="+1-664">Montserrat (+1-664)</option>
                                <option value="+212">Morocco (+212)</option>
                                <option value="+258">Mozambique (+258)</option>
                                <option value="+95">Myanmar (+95)</option>
                                <option value="+264">Namibia (+264)</option>
                                <option value="+674">Nauru (+674)</option>
                                <option value="+977">Nepal (+977)</option>
                                <option value="+31">Netherlands (+31)</option>
                                <option value="+687">New Caledonia (+687)</option>
                                <option value="+64">New Zealand (+64)</option>
                                <option value="+505">Nicaragua (+505)</option>
                                <option value="+227">Niger (+227)</option>
                                <option value="+234">Nigeria (+234)</option>
                                <option value="+683">Niue (+683)</option>
                                <option value="+672">Norfolk Island (+672)</option>
                                <option value="+47">Norway (+47)</option>
                                <option value="+968">Oman (+968)</option>
                                <option value="+92">Pakistan (+92)</option>
                                <option value="+680">Palau (+680)</option>
                                <option value="+970">Palestine (+970)</option>
                                <option value="+507">Panama (+507)</option>
                                <option value="+675">Papua New Guinea (+675)</option>
                                <option value="+595">Paraguay (+595)</option>
                                <option value="+51">Peru (+51)</option>
                                <option value="+63">Philippines (+63)</option>
                                <option value="+64">Pitcairn (+64)</option>
                                <option value="+48">Poland (+48)</option>
                                <option value="+351">Portugal (+351)</option>
                                <option value="+1-787">Puerto Rico (+1-787)</option>
                                <option value="+974">Qatar (+974)</option>
                                <option value="+262">Réunion (+262)</option>
                                <option value="+40">Romania (+40)</option>
                                <option value="+7">Russia (+7)</option>
                                <option value="+250">Rwanda (+250)</option>
                                <option value="+590">Saint Barthélemy (+590)</option>
                                <option value="+290">Saint Helena (+290)</option>
                                <option value="+1-869">Saint Kitts and Nevis (+1-869)</option>
                                <option value="+1-758">Saint Lucia (+1-758)</option>
                                <option value="+590">Saint Martin (+590)</option>
                                <option value="+508">Saint Pierre and Miquelon (+508)</option>
                                <option value="+1-784">Saint Vincent and the Grenadines (+1-784)</option>
                                <option value="+685">Samoa (+685)</option>
                                <option value="+378">San Marino (+378)</option>
                                <option value="+239">Sao Tome and Principe (+239)</option>
                                <option value="+966">Saudi Arabia (+966)</option>
                                <option value="+221">Senegal (+221)</option>
                                <option value="+381">Serbia (+381)</option>
                                <option value="+248">Seychelles (+248)</option>
                                <option value="+232">Sierra Leone (+232)</option>
                                <option value="+65">Singapore (+65)</option>
                                <option value="+421">Slovakia (+421)</option>
                                <option value="+386">Slovenia (+386)</option>
                                <option value="+677">Solomon Islands (+677)</option>
                                <option value="+252">Somalia (+252)</option>
                                <option value="+27">South Africa (+27)</option>
                                <option value="+500">South Georgia and the South Sandwich Islands (+500)</option>
                                <option value="+211">South Sudan (+211)</option>
                                <option value="+34">Spain (+34)</option>
                                <option value="+94">Sri Lanka (+94)</option>
                                <option value="+249">Sudan (+249)</option>
                                <option value="+597">Suriname (+597)</option>
                                <option value="+47">Svalbard and Jan Mayen (+47)</option>
                                <option value="+268">Sweden (+268)</option>
                                <option value="+46">Switzerland (+46)</option>
                                <option value="+963">Syrian Arab Republic (+963)</option>
                                <option value="+886">Taiwan (+886)</option>
                                <option value="+992">Tajikistan (+992)</option>
                                <option value="+255">Tanzania (+255)</option>
                                <option value="+66">Thailand (+66)</option>
                                <option value="+670">Timor-Leste (+670)</option>
                                <option value="+228">Togo (+228)</option>
                                <option value="+690">Tokelau (+690)</option>
                                <option value="+676">Tonga (+676)</option>
                                <option value="+1-868">Trinidad and Tobago (+1-868)</option>
                                <option value="+216">Tunisia (+216)</option>
                                <option value="+90">Turkey (+90)</option>
                                <option value="+993">Turkmenistan (+993)</option>
                                <option value="+1-649">Turks and Caicos Islands (+1-649)</option>
                                <option value="+688">Tuvalu (+688)</option>
                                <option value="+256">Uganda (+256)</option>
                                <option value="+380">Ukraine (+380)</option>
                                <option value="+971">United Arab Emirates (+971)</option>
                                <option value="+44">United Kingdom (+44)</option>
                                <option value="+1">United States of America (+1)</option>
                                <option value="+598">Uruguay (+598)</option>
                                <option value="+998">Uzbekistan (+998)</option>
                                <option value="+678">Vanuatu (+678)</option>
                                <option value="+58">Venezuela (+58)</option>
                                <option value="+84">Vietnam (+84)</option>
                                <option value="+681">Wallis and Futuna (+681)</option>
                                <option value="+967">Yemen (+967)</option>
                                <option value="+260">Zambia (+260)</option>
                                <option value="+263">Zimbabwe (+263)</option>
                            </select>
                        </div>

                        <!-- country name display for php -->
                        <input type="text" name="country_display" id="country_display" style="display: none;">

                        <!-- country code -->
                        <div class="input-group mb-3 col-12 col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="phone_code" name="country_code"><?= $country_code ?></span>
                            </div>
                            <input type="number" class="form-control" value="<?= $phone ?>" placeholder="Phone Number *" name="phone" id="phone_number">
                        </div>

                        <!-- sectors -->
                        <div class="form-group col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <select name="sector" id="sector" class="form-control">
                                <option value="0">Select a sector *</option>
                                <option value="Designing Jobs">Designing Jobs</option>
                                <option value="Writing Jobs">Writing Jobs</option>
                                <option value="Photography Jobs">Photography Jobs</option>
                                <option value="Developer Jobs">Developer Jobs</option>
                                <option value="Micro Jobs">Micro Jobs</option>
                                <option value="Marketing Jobs">Marketing Jobs</option>
                                <option value="Research Jobs">Research Jobs</option>
                                <option value="Finance Jobs">Finance Jobs</option>
                            </select>
                        </div>


                        <!-- address -->
                        <div class="form-group col-12 col-md-6">
                            <input type="text" placeholder="Address *" name="address" class="form-control" value="<?= $address ?>" id="address">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <input type="text" name="zipcode" placeholder="Zipcode *" value="<?= $zipcode ?>" class="form-control" id="zipcode">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <select name="schedule" id="schedule" class="form-control">
                                <option value="0">Preferred Working Schedule *</option>
                                <option value="Full-time">Full-time</option>
                                <option value="Part-time">Part-time</option>
                                <option value="Freelance">Freelance</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <select name="experience" id="experience" class="form-control">
                                <option value="0">Years of experience *</option>
                                <option value="0-1 year">0-1 year</option>
                                <option value="1-3 years">1-3 years</option>
                                <option value="3-5 years">3-5 years</option>
                                <option value="Above 5 years">Above 5 years</option>
                            </select>
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <input type="text" name="referral_code" id="ref_code" class="form-control" value="<?= $referral_code ?>" placeholder="Referral Code *">
                        </div>

                        <div class="form-group col-12 col-md-6">
                            <input type="password" name="password" placeholder="Password *" value="<?= $password ?>" class="form-control" id="password">
                            <small id="passwordError" class="error"></small>
                            <small id="passwordSuccess" class="success"></small>

                        </div>

                        <div class="form-group col-12 col-md-6">
                            <input type="password" name="confirm_password" placeholder="Confirm Password *" class="form-control" id="confirm_password">
                        </div>

                        <label class="col-10 col-md-8 ml-3">
                            <input class="form-check-input text-primary" type="checkbox" required> I agree to the terms and conditions
                        </label>

                        <div class="form-group col-12 col-md-12">
                            <button type="submit" class="form-control bg-secondary text-white" id="registerBtn" name="register">REGISTER</button>
                              <!-- Add the spinner here -->
                            <div class="registerSpin text-danger" style="display: none;">
                                <!--<i class="fas fa-spinner fa-spin"></i>-->
                            </div>
                        </div>


                    </div>

                </form>
            </div>
        </div>

    </div>

</div>



<script>
    document.getElementById('password').addEventListener('input', function () {
        const passwordInput = this;
        const errorElement = document.getElementById('passwordError');
        const successElement = document.getElementById('passwordSuccess');
        const password = passwordInput.value;

        // Validation
        const hasUppercase = /[A-Z]/.test(password);
        const hasNumber = /\d/.test(password); // Checks for at least one number
        const isLongEnough = password.length > 6;

        if (!hasUppercase || !hasNumber || !isLongEnough) {
            passwordInput.classList.add('invalid');
            passwordInput.classList.remove('valid');
            errorElement.textContent = 'Password must contain at least one uppercase letter, one number, and be more than 6 characters.';
            successElement.textContent = '';
        } else {
            passwordInput.classList.add('valid');
            passwordInput.classList.remove('invalid');
            errorElement.textContent = '';
            successElement.textContent = 'Password looks good!';
        }
    });
</script>



<script>
    $(document).ready(function() {
        $("#registerForm").submit(function() {
            var firstname = document.getElementById("firstname").value.trim();
            var lastname = document.getElementById("lastname").value.trim();
            var username = document.getElementById("username").value.trim();
            var email = document.getElementById("email").value.trim();
            var gender = document.getElementById("gender").value;
            var date_of_birth = document.getElementById("date_of_birth").value;
            var country = document.getElementById("country");
            var phone_number = document.getElementById("phone_number").value;
            var sector = document.getElementById("sector").value;
            var address = document.getElementById("address").value.trim();
            var zipcode = document.getElementById("zipcode").value.trim();
            var schedule = document.getElementById("schedule").value.trim();
            var experience = document.getElementById("experience").value;
            var ref_code = document.getElementById("ref_code").value.trim();
            var password = document.getElementById("password").value.trim();
            var confirm_password = document.getElementById("confirm_password").value.trim();
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);

            if (firstname == "" || lastname == "" || username == "" || email == "" || gender == "0" || date_of_birth == "" || phone_number == "" || sector == "0" || address == "" || zipcode == "" || schedule == "0" || experience == "0" || ref_code == "" || password == "" || confirm_password == "" || country == "0") {
                alert("Please fill out all required fields before submitting the form");
                event.preventDefault();
                event.stopPropagation();
            }

            else if (password !== confirm_password) {
                alert("Passwords do not match, please try again.");
                event.stopPropagation();
                event.preventDefault();
            }

            else if (phone.length < 5) {
                alert("Invalid phone number, please try again");
                event.stopPropagation();
                event.preventDefault();
            }

            else if (!hasLowercase || !hasUppercase) {
                alert("Password must contain at least one lowercase and uppercase letter.");
                event.preventDefault();
                event.stopPropagation();
            }

            else if (password.length <= 5) {
                alert("Password length must exceed 5 characters, please try again.");
                event.stopPropagation();
                event.preventDefault();
            }

            else {
                true;                    
            }


        })
    })
</script>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const deviceName = navigator.userAgent;
    
    // Send device name to PHP using AJAX or a form
    console.log("Device Info: ", deviceName);
  });
</script>


























<?php
    include "../partials/footer.php";
?>