<?php
require 'db/db.php';

// Update categories table images
$catUpdates = [
    1 => 'cat_dehydrated_leaves.svg',
    2 => 'cat_fresh_dried_fruits.svg',
    3 => 'cat_ceylon_spices.svg',
    4 => 'cat_dehydrated_veg.svg',
    5 => 'cat_ornamental_plants.svg',
];

foreach ($catUpdates as $id => $img) {
    $stmt = $conn->prepare("UPDATE categories SET image = ? WHERE id = ?");
    $stmt->execute([$img, $id]);
}

// Update products table images
$prodUpdates = [
    1 => 'prod_dehydrated_gotukola.svg',
    2 => 'prod_ceylon_cinnamon.svg',
    3 => 'prod_dehydrated_jackfruit.svg',
    4 => 'prod_curry_leaves.svg',
    5 => 'prod_moringa_powder.svg',
    6 => 'prod_ornamental_plants.svg',
];

foreach ($prodUpdates as $id => $img) {
    $stmt = $conn->prepare("UPDATE products SET main_image = ? WHERE id = ?");
    $stmt->execute([$img, $id]);
}

// Clean up old socks images from disk to prevent accidental usage
$socksFiles = [
    'assets/images/products/3d_athletic_socks.jpg',
    'assets/images/products/3d_executive_dress_socks.jpg',
    'assets/images/products/3d_school_monogram_socks.jpg',
    'assets/images/categories/cat_dehydrated_leaves.jpg',
    'assets/images/categories/cat_ceylon_spices.jpg',
    'assets/images/categories/cat_fresh_dried_fruits.jpg',
    'assets/images/categories/cat_dehydrated_veg.jpg',
    'assets/images/categories/cat_ornamental_plants.jpg',
];

foreach ($socksFiles as $file) {
    if (file_exists($file)) {
        @unlink($file);
    }
}

echo "Successfully updated database categories and products images to 100% clean SVG agricultural graphics and removed all legacy socks files!\n";
