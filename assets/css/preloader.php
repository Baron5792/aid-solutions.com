
<style>

    /* Preloader container */
    .preloader {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #fff;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 9999;
    }

    /* Spinner styling */
    .spinner {
        border: 8px solid #f3f3f3; /* Light grey */
        border-top: 8px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
        margin-bottom: 20px;
    }

    /* Spin keyframes */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Text animation */
    .fade-text {
        font-size: 3em;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        letter-spacing: 3px;
        color: lightslategray;
        opacity: 0;
        transform: translateX(-100%);
        animation: slideIn 1s forwards;
    }

    /* Delay for each word */
    .fade-text:nth-child(2) { animation-delay: 1s; }
    .fade-text:nth-child(3) { animation-delay: 2s; }

    /* Sliding animation */
    @keyframes slideIn {
        0% { opacity: 0; transform: translateX(-100%); }
        100% { opacity: 1; transform: translateX(0); }
    }

    /* Content hidden until preloader is finished */
    .content {
        display: none;
        text-align: center;
        font-size: 2em;
    }
</style>

<!-- Preloader -->
<div class="preloader">
    <div class="spinner"></div>
    <div class="fade-text">AID Solutions</div>
</div>


<script>
    // Hide the preloader and show the content after 4 seconds
    setTimeout(function () {
        document.querySelector('.preloader').style.display = 'none';
    }, 1000); // 4000ms = 4 seconds
</script>

