<?php
// Database Configuration
$host = "127.0.0.1";
$db_name = "loopzglo_dasagl_dasanayake";
$username = "loopzglo_templatesloopzgl_dasanayake";
$password = "loopzglo_templatesloopzgl_dasa";

try {
    // Attempt primary connection
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
} catch(PDOException $e) {
    try {
        // Fallback to localhost
        $conn = new PDO("mysql:host=localhost;dbname=$db_name;charset=utf8", $username, $password);
    } catch(PDOException $e2) {
        try {
            // Fallback for default local XAMPP root user
            $conn = new PDO("mysql:host=127.0.0.1;dbname=$db_name;charset=utf8", "root", "");
        } catch(PDOException $e3) {
            die("Connection Failed: " . $e3->getMessage());
        }
    }
}

// Set Error Mode & Default Fetch Mode
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>