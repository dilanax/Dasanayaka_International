<?php
$userDir = 'C:/Users/Dilan/.gemini/antigravity-ide/brain/a2998e60-f2bf-4f42-b7b5-6a82ea7c4415/.user_uploaded';

copy("$userDir/media_1790668916428.jpg", 'assets/images/slider/slide1.jpg');
copy("$userDir/media_1790668916481.jpg", 'assets/images/slider/slide2.jpg');
copy("$userDir/media_1790668916491.jpg", 'assets/images/slider/slide3.jpg');

// Clean up any extra unused slide files
@unlink('assets/images/slider/slide4.jpg');
@unlink('assets/images/slider/slide5.jpg');
@unlink('assets/images/slider/slide6.jpg');
@unlink('assets/images/slider/slide1.svg');
@unlink('assets/images/slider/slide2.svg');
@unlink('assets/images/slider/slide3.svg');
@unlink('assets/images/slider/slide4.svg');

echo "Slide 1 size: " . filesize('assets/images/slider/slide1.jpg') . " bytes\n";
echo "Slide 2 size: " . filesize('assets/images/slider/slide2.jpg') . " bytes\n";
echo "Slide 3 size: " . filesize('assets/images/slider/slide3.jpg') . " bytes\n";
