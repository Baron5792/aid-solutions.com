<?php
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $usersQuery = mysqli_query($connection, "SELECT * FROM users WHERE id= '$userId'");
        if (mysqli_num_rows($usersQuery) > 0) {
            $data = mysqli_fetch_assoc($usersQuery);
            $ref_code = $data['ref_code'];
            
            $usersCode = "https://www.aid-solutions.com/account/login?id=" . $ref_code;
        }
        
        else {
            $ref_code = "";
            $usersCode = "https://aid-solutions.com";
        }
    }
    
    else {
        $ref_code = "";
        $usersCode = "https://aid-solutions.com";
    }
?>

<style>
    .footerAlert {
        /* color: red; */
        display: none;
    }
    #footerSuccess {
        display: none;
    } 

    .your-style {
        /* Styles from the original <span> */
        background-color: #3498db; /* Example color */
        color: white;
        padding: 7px 20px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        text-align: center;
        /* Add these to remove default button styles */
        outline: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    /* Optional: Add a hover effect if desired */
    .your-style:hover {
        background-color: #2980b9; /* Darker color on hover */
    }

</style>

</div>

<div class="container-fluid bg-dark " id="footer">
    
    <div class="container">
        <div class="row pt-5 pb-5">
            <div class="col-12 col-md-4">
                <div class="container-fluid">
                    <p style="font-size: small" class="text-muted mb-0 mt-3">Receive Free Online Job Offers By Email!</p>
                    <form action="" method="POST">
                        <div class="input-group mb-0 mt-3">
                            <input type="email" class="form-control" id="footer_input" placeholder="Enter a valid email">
                            <div class="input-group-append">
                                <button type="button" title="Subscribe" class="your-style" id="footer_btn">Subscribe</button>
                            </div>
                        </div>
                        <small class="footerAlert text-danger" id="footerAlert">please provide an email to proceed</small>
                        <p id="footerSuccess" class="text-success">Thanks for subscribing! Stay tuned for updates and opportunities.</p>
                    </form>
                </div>
            </div>
            <div class="row mt-4 footer-list col-12 col-md-8">
                <div class="row col-12 col-md-12 mb-2">
                    <a href="<?= URL ?>contact-us" class="col-md-3 col-6 mb-2 pt-2 pb-2">Contact Us</a>
                    <a href="<?= URL ?>privacy-policy" class="col-md-3 col-6 mb-2 pt-2 pb-2">Privacy Policy</a>
                    <a href="<?= URL ?>terms&conditions" class="col-md-3 col-6 mb-2 pt-2 pb-2">Terms & Conditions</a>
                    <a href="<?= URL ?>apply" class="col-md-3 col-6 mb-2 pt-2 pb-2">Apply</a>
                    <a href="<?= URL ?>about" class="col-md-3 col-6 mb-2 pt-2 pb-2">About Us</a>
                    <a href="<?= URL ?>job-categories" class="col-md-3 col-6 mb-2 pt-2 pb-2">Job categories</a>  
                    <!--<a href="<?= URL ?>cookie" class="col-md-3 col-6 mb-2 pt-2 pb-2">Cookie</a>-->
                    <a href="<?= URL ?>faq" class="col-md-3 col-6 mb-2 pt-2 pb-2">FAQ</a>   
                    <a href="<?= URL ?>why-to-register" class="col-md-3 col-6 mb-2 pt-2 pb-2">Why to Register</a>
                </div>
                <div class="row col-12 col-md-12 mb-2">
                    <a href="<?= URL ?>who-should-register" class="col-md-3 col-6 mb-2 pt-2 pb-2">Who Should Register</a>
                    <div class="col-md-3 col-6 mb-2 pt-2 pb-2" id="google_translate_element" class="ml-1 container"></div>
                </div>      
            </div>
        </div>
    </div>
    <div class="container pb-5">
        <div class="row">
            <div class="mb-4 col-4 col-md-4">
                <div class="mb-0">
                    <p style="color: white" class="pl-2">Follow us on:</p>
                </div>
                <div class="container">
                    <div class="row">
                        <a href="javascript:void(0)" title="Facebook" onclick="shareOnFacebook()" class="col-3 col-md-1" style="color: white"><i class="fab fa-facebook"></i></a>
                        <a href="javascript:void(0)" title="YouTube" onclick="shareOnYouTube()" class="col-3 col-md-1" style="color: white"><i class="fab fa-youtube"></i></a>
                        <a href="javascript:void(0)" title="Twitter" onclick="shareOnTwitter()" class="col-3 col-md-1" style="color: white"><i class="fab fa-twitter"></i></a>
                        <a href="javascript:void(0)" title="Linkedin" onclick="shareOnLinkedIn()" class="col-3 col-md-1" style="color: white"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 mt-3">
                <p class="text-secondary" style="font-size: small;">© 2011 WFH. all rights reserved built by Pixel Union</p>
            </div>
        </div>
    </div>
</div>  

<!-- jQuery library -->
<script src="<?= URL ?>assets/bootstrap-4.6.1-dist/js/bootstrap.js"></script>
<script src="<?= URL ?>assets/bootstrap-4.6.1-dist/popper.min.js"></script>
<script src="<?= URL ?>assets/javascript/cookie.js"></script>


<script>
    // Function to share on Facebook
    function shareOnFacebook() {
        const url = encodeURIComponent("<?= $usersCode ?>");
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
    }
    
    function shareOnYouTube() {
        const url = encodeURIComponent("<?= $usersCode ?>");
        const youtubeURL = `https://www.youtube.com/upload`;
    
        // Redirect users to the YouTube upload page and suggest sharing the link
        window.open(youtubeURL, '_blank', 'width=600,height=400');
    
        // Optional: Notify the user to use the link in their video description
        alert(`Copy this link to include in your YouTube video description: ${decodeURIComponent(url)}`);
    }

    
    // Function to share on Twitter
    function shareOnTwitter() {
        const text = encodeURIComponent("Check out this amazing content!");
        const url = encodeURIComponent("<?= $usersCode ?>");
        window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank', 'width=600,height=400');
    }
    
    // Function to share on LinkedIn
    function shareOnLinkedIn() {
        const url = encodeURIComponent("<?= $usersCode ?>");
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank', 'width=600,height=400');
    }

</script>

<!--google translator-->
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,es,tl',  // English, Spanish, Filipino (Tagalog)
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



<script>
  const animateTextElements = document.querySelectorAll('.animate-text');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('slide-in');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5,
    rootMargin: '0px 0px -50px 0px'
  });

  animateTextElements.forEach((element) => {
    observer.observe(element);
  });
</script>


<script>
       // pop up comments js
       document.getElementById('footer_btn').addEventListener('click', function() {
            var emailInput = document.getElementById('footer_input').value;
            var footerAlert = document.getElementById('footerAlert');
            var footerSuccess = document.getElementById('footerSuccess');

            // Reset messages
            footerAlert.style.display = 'none';
            footerSuccess.style.display = 'none';

            // Check if the input is empty
            if (emailInput.trim() === '') {
                // Show error message
                footerAlert.style.display = 'block';
            } else {
                // Hide the error display and show success message
                footerSuccess.style.display = 'block';
            }
        });


       async function fetchRandomName() {
            try {
                const response = await fetch('https://randomuser.me/api/');
                const data = await response.json();
                const name = `${data.results[0].name.first} ${data.results[0].name.last}`;
                return name;
            } catch (error) {
                console.error('Error fetching random name:', error);
                return 'Anonymous user';
            }
        }

        function createPopup(name) {
            const container = document.getElementById('popup-container');
            const popup = document.createElement('div');
            popup.className = 'popup';
            popup.innerText = `${name} just joined`;

            container.appendChild(popup);

            setTimeout(() => {
                popup.classList.add('show');
            }, 100);

            setTimeout(() => {
                popup.classList.remove('show');
                setTimeout(() => {
                    container.removeChild(popup);
                }, 500);
            }, 10000);
        }

        async function startPopups() {
            while (true) {
                const name = await fetchRandomName();
                createPopup(name);
                await new Promise(resolve => setTimeout(resolve, 12000)); // Wait 12 seconds before the next popup
            }
        }
        startPopups();



    $(document).ready(function() {
        $("#openCon").click(function() {
            $("#mySidenav").show(100);
        })
    })
    // function openDashboard() {
    //     document.getElementById('mySidenav').style.display = "block";
    // }   

    // When the user clicks on the button, scroll to the top of the document
    window.onscroll = function() {scrollFunction()};

      function scrollFunction() {
          var scrollToTopBtn = document.getElementById("scrollToTopBtn");
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
              scrollToTopBtn.style.display = "block";
          } else {
              scrollToTopBtn.style.display = "none";
          }
      }

      // When the user clicks on the button, scroll to the top of the document
      document.getElementById('scrollToTopBtn').addEventListener('click', function() {
          window.scrollTo({top: 0, behavior: 'smooth'});
      });

    

    function openNav() {
        document.getElementById("mySidenav").style.width = "97%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("modal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }



    // customer support
    function openForm() {
        document.getElementById("myForm").style.display = "block";
        document.getElementById("myDropdown").style.display = "none";
    }

    var body = document.getElementById('body');
    body.onclick = function() {
        document.getElementById("myForm").style.display = "none";
    }



    // for forgotten password display
    function forgotPassword() {
        document.getElementById("signin-container").style.display = "none";
        document.getElementById("forgotten-password").style.display = "block";
        window.location.href = "<?= URL ?>account/login?request=true";
    }
    
                
    // mobile users nav bar display
    function openNavbar() {
        document.getElementById("usersNav").style.display = "block";
        document.getElementById("usersNav").style.width = "95%";
    }

    function closeNavbar() {
        document.getElementById("usersNav").style.display = "none";
    }




    
         
    



    






    












    



    









    


    




    


    



    
</script>
</body>
</html>