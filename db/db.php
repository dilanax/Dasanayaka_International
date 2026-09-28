<?php
// Database Configuration
$host = "localhost";
$db_name = "loopzglo_dasagl_dasanayake";
$username = "loopzglo_templatesloopzgl_dasanayake";
$password = "loopzglo_templatesloopzgl_dasa";

try {
    // PDO Connection String
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    
    // Set Error Mode to Exception (Meka errors thibunoth pennanna udaw wenawa)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Default Fetch Mode eka Object/Associative Array ekak widiyata set kirima
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Connection eka check karaganna ona nam meka uncomment karala balන්න
    // echo "Connected Successfully!"; 

} catch(PDOException $e) {
    // Connection eka fail unoth error message eka meke pennanwa
    die("Connection Failed: " . $e->getMessage());
}
?>