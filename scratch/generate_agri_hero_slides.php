<?php
// Script to generate 4 distinct 1920x1080 HD Agricultural Hero Background Images
$width = 1920;
$height = 1080;

function createSlide1($w, $h) {
    $im = imagecreatetruecolor($w, $h);
    // Dark Emerald & Forest Plantation Gradient
    for ($y = 0; $y < $h; $y++) {
        $r = (int)(4 + ($y / $h) * 15);
        $g = (int)(60 + ($y / $h) * 80);
        $b = (int)(40 + ($y / $h) * 50);
        $color = imagecolorallocate($im, $r, $g, $b);
        imageline($im, 0, $y, $w, $y, $color);
    }
    // Decorative botanical leaf circles & sunrays
    for ($i = 0; $i < 40; $i++) {
        $cx = rand(0, $w);
        $cy = rand(0, $h);
        $radius = rand(100, 400);
        $alpha = rand(90, 120);
        $color = imagecolorallocatealpha($im, 16, rand(140, 220), rand(100, 180), $alpha);
        imagefilledellipse($im, $cx, $cy, $radius, $radius, $color);
    }
    imagejpeg($im, 'assets/images/slider/slide1.jpg', 92);
    imagedestroy($im);
}

function createSlide2($w, $h) {
    $im = imagecreatetruecolor($w, $h);
    // Warm Golden Amber Ceylon Spice & Harvest Gradient
    for ($y = 0; $y < $h; $y++) {
        $r = (int)(70 + ($y / $h) * 110);
        $g = (int)(35 + ($y / $h) * 60);
        $b = (int)(10 + ($y / $h) * 20);
        $color = imagecolorallocate($im, $r, $g, $b);
        imageline($im, 0, $y, $w, $y, $color);
    }
    // Spice grain and cinnamon gold highlights
    for ($i = 0; $i < 50; $i++) {
        $cx = rand(0, $w);
        $cy = rand(0, $h);
        $radius = rand(80, 350);
        $alpha = rand(95, 120);
        $color = imagecolorallocatealpha($im, rand(200, 245), rand(120, 180), rand(20, 60), $alpha);
        imagefilledellipse($im, $cx, $cy, $radius, $radius, $color);
    }
    imagejpeg($im, 'assets/images/slider/slide2.jpg', 92);
    imagedestroy($im);
}

function createSlide3($w, $h) {
    $im = imagecreatetruecolor($w, $h);
    // Tropical Sun-Dried Fruits & Jackfruit Sunset Orange & Deep Slate
    for ($y = 0; $y < $h; $y++) {
        $r = (int)(15 + ($y / $h) * 120);
        $g = (int)(40 + ($y / $h) * 80);
        $b = (int)(30 + ($y / $h) * 40);
        $color = imagecolorallocate($im, $r, $g, $b);
        imageline($im, 0, $y, $w, $y, $color);
    }
    // Fruit sunburst shapes
    for ($i = 0; $i < 45; $i++) {
        $cx = rand(0, $w);
        $cy = rand(0, $h);
        $radius = rand(120, 380);
        $alpha = rand(95, 120);
        $color = imagecolorallocatealpha($im, rand(180, 235), rand(100, 160), rand(30, 80), $alpha);
        imagefilledellipse($im, $cx, $cy, $radius, $radius, $color);
    }
    imagejpeg($im, 'assets/images/slider/slide3.jpg', 92);
    imagedestroy($im);
}

function createSlide4($w, $h) {
    $im = imagecreatetruecolor($w, $h);
    // Fresh Greenhouse & Ornamental Foliage Deep Teal Gradient
    for ($y = 0; $y < $h; $y++) {
        $r = (int)(6 + ($y / $h) * 20);
        $g = (int)(50 + ($y / $h) * 90);
        $b = (int)(60 + ($y / $h) * 100);
        $color = imagecolorallocate($im, $r, $g, $b);
        imageline($im, 0, $y, $w, $y, $color);
    }
    // Foliage teal & mint bubbles
    for ($i = 0; $i < 40; $i++) {
        $cx = rand(0, $w);
        $cy = rand(0, $h);
        $radius = rand(100, 400);
        $alpha = rand(90, 120);
        $color = imagecolorallocatealpha($im, 20, rand(160, 230), rand(160, 220), $alpha);
        imagefilledellipse($im, $cx, $cy, $radius, $radius, $color);
    }
    imagejpeg($im, 'assets/images/slider/slide4.jpg', 92);
    imagedestroy($im);
}

createSlide1($width, $height);
createSlide2($width, $height);
createSlide3($width, $height);
createSlide4($width, $height);

echo "Generated 4 100% unique agricultural HD hero slides successfully!\n";
