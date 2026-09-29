<?php
require 'db/db.php';
$cats = $conn->query("SELECT id, title, image FROM categories")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($cats, JSON_PRETTY_PRINT);
