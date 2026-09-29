<?php
$brainDir = 'C:/Users/Dilan/.gemini/antigravity-ide/brain/a2998e60-f2bf-4f42-b7b5-6a82ea7c4415';

copy('assets/images/products/prod_dehydrated_gotukola.jpg', 'assets/images/slider/slide1.jpg');
copy("$brainDir/ayurvedic_hero_2_1790659057667.jpg", 'assets/images/slider/slide2.jpg');
copy('assets/images/products/prod_dehydrated_jackfruit.jpg', 'assets/images/slider/slide3.jpg');
copy('assets/images/products/prod_curry_leaves.jpg', 'assets/images/slider/slide4.jpg');

// Clean up extra slides 5 and 6 if present so we have 4 clean unique slides
@unlink('assets/images/slider/slide5.jpg');
@unlink('assets/images/slider/slide6.jpg');

echo "Slide 1 size: " . filesize('assets/images/slider/slide1.jpg') . " bytes\n";
echo "Slide 2 size: " . filesize('assets/images/slider/slide2.jpg') . " bytes\n";
echo "Slide 3 size: " . filesize('assets/images/slider/slide3.jpg') . " bytes\n";
echo "Slide 4 size: " . filesize('assets/images/slider/slide4.jpg') . " bytes\n";
