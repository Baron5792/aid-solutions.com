<?php
    session_start();
    define("URL", "https://aid-solutions.com/");
    
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "howbqlpi_aid-solutions");
    define("DB_PASSWORD", "Baron001@gmail.com");
    define("DB_NAME", "howbqlpi_aid-solutions");
    
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error($connection));
    } 
    
    if (isset($_GET['logout'])) {
        $id = $_GET['logout'];
        $offline = mysqli_query($connection, "UPDATE users SET online_status= '0' WHERE id= '$id'");
        if ($offline) {
            session_destroy();
            unset($_SESSION['user']);
            header('location: ' . URL . 'account/login');
        }
    }
    
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);