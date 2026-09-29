<?php
require 'db/db.php';
$prods = $conn->query("SELECT id, title, main_image FROM products")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($prods, JSON_PRETTY_PRINT);
