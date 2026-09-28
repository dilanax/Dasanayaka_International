<?php 
/**
 * Red Runner - Central Controller & Routing Logic
 * Path: /index.php
 */

// 1. Start Session & Database Connection
session_start();
require_once('db/db.php');

// 2. Include Global Header
include('includes/header.php'); 

// 3. Determine the Page to Load
$page = isset($_GET['page']) ? preg_replace('/[^a-z0-9_-]/', '', $_GET['page']) : 'home';

// 4. Define Views Path
$file = "views/" . $page . ".php"; 

// 5. Routing Logic
if (file_exists($file)) {
    include($file);
} else {
    // Modular 404 Handler
    if (file_exists('includes/404.php')) {
        include('includes/404.php');
    } else {
        echo "<section class='py-32 bg-black text-center text-white min-h-[60vh] flex items-center justify-center'><h2 class='text-4xl font-black text-red-600 uppercase'>404 Not Found</h2></section>";
    }
}

// 6. Include Global Footer
include('includes/footer.php'); 
?>