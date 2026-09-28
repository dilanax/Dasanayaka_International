<?php
session_start();

// Cart එකක් දැනට නැත්නම් අලුතින් එකක් සාදන්න
if (!isset($_SESSION['inquiry_cart'])) {
    $_SESSION['inquiry_cart'] = array();
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // දැනටමත් Cart එකේ නැත්නම් පමණක් එකතු කරන්න
    if (!in_array($product_id, $_SESSION['inquiry_cart'])) {
        array_push($_SESSION['inquiry_cart'], $product_id);
        echo json_encode(['status' => 'success', 'count' => count($_SESSION['inquiry_cart'])]);
    } else {
        echo json_encode(['status' => 'exists', 'count' => count($_SESSION['inquiry_cart'])]);
    }
}
?>