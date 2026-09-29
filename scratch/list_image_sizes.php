<?php
$dirs = ['assets/images', 'assets/images/products', 'assets/images/categories', 'assets/images/slider'];
foreach ($dirs as $d) {
    if (is_dir($d)) {
        foreach (scandir($d) as $f) {
            $path = "$d/$f";
            if (is_file($path)) {
                echo "$path => " . filesize($path) . " bytes\n";
            }
        }
    }
}
