

    <style>
        .cookie-consent-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: silver;
            color: white;
            padding: 20px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            z-index: 9999;
            opacity: 0.98;
        }

        .cookie-content {
            max-width: 70%;
        }

        .cookie-content a {
            color: #ffc107;
            text-decoration: none;
        }

        .cookie-content a:hover {
            text-decoration: underline;
        }

        .cookie-buttons {
            display: flex;
            align-items: center;
        }

        .cookie-buttons button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .cookie-buttons button.decline {
            background-color: #dc3545;
        }

        .cookie-buttons button:hover {
            background-color: #218838;
        }

        .cookie-buttons button.decline:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            .cookie-consent-banner {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .cookie-content {
                max-width: 100%;
                margin-bottom: 10px;
            }

            .cookie-buttons {
                flex-direction: column;
                width: 100%;
            }

            .cookie-buttons button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>

    <div id="cookie-banner" class="cookie-consent-banner" style="display:none;">
        <p>This website uses cookies to ensure you get the best experience. By continuing, you agree to our <a href="<?= URL ?>privacy-policy.php" style="color: #f0ad4e;">Privacy Policy</a>.</p>
        <div class="cookie-buttons">
            <button onclick="acceptCookies()">Accept</button>
            <button onclick="declineCookies()">Decline</button>
        </div>
    </div>

    <script>
        // Function to check if the cookie has already been set
        function checkCookie() {
            var cookieAccepted = getCookie("cookieConsent");
            if (cookieAccepted === "") {
                document.getElementById('cookie-banner').style.display = "flex";
            }
        }

        // Function to set cookies
        function setCookie(name, value, days) {
            var d = new Date();
            d.setTime(d.getTime() + (days*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

        // Function to get the cookie
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i< ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(nameEQ) === 0) {
                    return c.substring(nameEQ.length, c.length);
                }
            }
            return "";
        }

        // Function to accept cookies
        function acceptCookies() {
            setCookie("cookieConsent", "accepted", 365);
            document.getElementById('cookie-banner').style.display = "none";
        }

        // Function to decline cookies
        function declineCookies() {
            setCookie("cookieConsent", "declined", 365);
            document.getElementById('cookie-banner').style.display = "none";
        }

        // Check cookie on page load
        window.onload = function() {
            checkCookie();
        };
    </script>


