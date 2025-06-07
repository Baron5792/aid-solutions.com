// cookie consent pop-ups
document.addEventListener('DOMContentLoaded', function () {
    const cookieBanner = document.getElementById('cookie-banner');
    const acceptCookiesButton = document.getElementById('accept-cookies');
    const declineCookiesButton = document.getElementById('decline-cookies');

    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function checkCookie() {
        const userConsent = getCookie("userConsent");
        if (userConsent) {
            cookieBanner.style.display = 'none';
        } else {
            cookieBanner.style.display = 'flex';
        }
    }

    acceptCookiesButton.addEventListener('click', function () {
        setCookie("userConsent", "accepted", 365);
        cookieBanner.style.display = 'none';
    });

    declineCookiesButton.addEventListener('click', function () {
        setCookie("userConsent", "declined", 365);
        cookieBanner.style.display = 'none';
    });

    checkCookie();
});
