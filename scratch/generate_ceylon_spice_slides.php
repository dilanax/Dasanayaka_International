<?php
// Script to generate detailed Ceylon Spices, Tea, Pepper & Coconut Hero SVG Slides

$slide1 = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="100%" height="100%">
  <defs>
    <linearGradient id="bgCinna" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#2d1202"/>
      <stop offset="50%" stop-color="#4a1e05"/>
      <stop offset="100%" stop-color="#873c0c"/>
    </linearGradient>

    <linearGradient id="cinnaStickGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#b45309"/>
      <stop offset="30%" stop-color="#d97706"/>
      <stop offset="70%" stop-color="#78350f"/>
      <stop offset="100%" stop-color="#451a03"/>
    </linearGradient>

    <filter id="cinnaShadow" x="-20%" y="-20%" width="140%" height="140%">
      <feDropShadow dx="0" dy="16" stdDeviation="20" flood-color="#000000" flood-opacity="0.6"/>
    </filter>
    
    <radialGradient id="goldGlow" cx="75%" cy="50%" r="50%">
      <stop offset="0%" stop-color="#fbbf24" stop-opacity="0.4"/>
      <stop offset="100%" stop-color="#2d1202" stop-opacity="0"/>
    </radialGradient>
  </defs>

  <!-- Background -->
  <rect width="1920" height="1080" fill="url(#bgCinna)"/>
  <rect width="1920" height="1080" fill="url(#goldGlow)"/>

  <!-- Right Visual Illustration: Ceylon Cinnamon Quills Bundle & Jar -->
  <g filter="url(#cinnaShadow)" transform="translate(1050, 180)">
    <!-- Spice Bowl / Mortar -->
    <ellipse cx="400" cy="650" rx="320" ry="100" fill="#1c1917" opacity="0.4"/>
    
    <!-- Cinnamon Quills Bundle -->
    <!-- Quill 1 -->
    <rect x="200" y="250" width="70" height="380" rx="35" fill="url(#cinnaStickGrad)" transform="rotate(-25 235 440)"/>
    <ellipse cx="235" cy="250" rx="35" ry="18" fill="#451a03" transform="rotate(-25 235 250)"/>
    <ellipse cx="235" cy="250" rx="20" ry="10" fill="#d97706" transform="rotate(-25 235 250)"/>

    <!-- Quill 2 -->
    <rect x="310" y="210" width="75" height="420" rx="37" fill="url(#cinnaStickGrad)" transform="rotate(-5 347 420)"/>
    <ellipse cx="347" cy="210" rx="37" ry="20" fill="#451a03" transform="rotate(-5 347 210)"/>
    <ellipse cx="347" cy="210" rx="22" ry="11" fill="#d97706" transform="rotate(-5 347 210)"/>

    <!-- Quill 3 -->
    <rect x="420" y="240" width="70" height="390" rx="35" fill="url(#cinnaStickGrad)" transform="rotate(20 455 435)"/>
    <ellipse cx="455" cy="240" rx="35" ry="18" fill="#451a03" transform="rotate(20 455 240)"/>
    <ellipse cx="455" cy="240" rx="20" ry="10" fill="#d97706" transform="rotate(20 455 240)"/>

    <!-- Cinnamon Stick Tie Rope -->
    <rect x="180" y="420" width="340" height="30" rx="15" fill="#f59e0b" stroke="#78350f" stroke-width="4"/>
    
    <!-- Cinnamon Powder Bowl -->
    <path d="M 220 540 C 220 680 540 680 540 540 Z" fill="#b45309" stroke="#f59e0b" stroke-width="6"/>
    <ellipse cx="380" cy="540" rx="160" ry="40" fill="#d97706"/>
    <ellipse cx="380" cy="535" rx="130" ry="30" fill="#f59e0b"/>

    <!-- Ceylon Cinnamon Quality Seal -->
    <g transform="translate(480, 160)">
      <circle cx="90" cy="90" r="80" fill="#d97706" stroke="#fbbf24" stroke-width="6"/>
      <circle cx="90" cy="90" r="70" fill="#78350f"/>
      <text x="90" y="75" font-family="'Outfit', sans-serif" font-size="16" font-weight="900" fill="#fbbf24" text-anchor="middle" letter-spacing="2">PURE CEYLON</text>
      <text x="90" y="105" font-family="'Outfit', sans-serif" font-size="20" font-weight="900" fill="#ffffff" text-anchor="middle" letter-spacing="1">CINNAMON</text>
      <text x="90" y="125" font-family="'Outfit', sans-serif" font-size="12" font-weight="900" fill="#fbbf24" text-anchor="middle">ALBA GRADE</text>
    </g>
  </g>
</svg>
SVG;

$slide2 = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="100%" height="100%">
  <defs>
    <linearGradient id="bgTea" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#022c22"/>
      <stop offset="50%" stop-color="#064e3b"/>
      <stop offset="100%" stop-color="#047857"/>
    </linearGradient>

    <linearGradient id="teaLeafGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#34d399"/>
      <stop offset="50%" stop-color="#10b981"/>
      <stop offset="100%" stop-color="#065f46"/>
    </linearGradient>

    <filter id="teaShadow" x="-20%" y="-20%" width="140%" height="140%">
      <feDropShadow dx="0" dy="16" stdDeviation="20" flood-color="#000000" flood-opacity="0.5"/>
    </filter>

    <radialGradient id="emeraldGlow" cx="75%" cy="50%" r="50%">
      <stop offset="0%" stop-color="#34d399" stop-opacity="0.35"/>
      <stop offset="100%" stop-color="#022c22" stop-opacity="0"/>
    </radialGradient>
  </defs>

  <!-- Background -->
  <rect width="1920" height="1080" fill="url(#bgTea)"/>
  <rect width="1920" height="1080" fill="url(#emeraldGlow)"/>

  <!-- Right Visual Illustration: Ceylon Tea Leaves & Teapot -->
  <g filter="url(#teaShadow)" transform="translate(1080, 200)">
    <!-- Traditional Teapot Silhouette -->
    <path d="M 280 340 C 200 340 180 480 280 540 L 520 540 C 620 480 600 340 520 340 Z" fill="#065f46" stroke="#34d399" stroke-width="6"/>
    <!-- Teapot Lid -->
    <path d="M 330 340 C 330 280 470 280 470 340 Z" fill="#047857" stroke="#34d399" stroke-width="4"/>
    <circle cx="400" cy="270" r="22" fill="#fbbf24"/>
    <!-- Spout & Handle -->
    <path d="M 200 400 C 120 360 120 480 200 480" fill="none" stroke="#34d399" stroke-width="12" stroke-linecap="round"/>
    <path d="M 600 380 Q 680 340 660 460" fill="none" stroke="#34d399" stroke-width="14" stroke-linecap="round"/>

    <!-- Two Leaves & A Bud Ceylon Tea Emblem -->
    <!-- Leaf 1 (Left) -->
    <path d="M 400 240 C 260 120 180 260 340 340 Z" fill="url(#teaLeafGrad)" transform="rotate(-30 340 240)"/>
    <!-- Leaf 2 (Right) -->
    <path d="M 400 240 C 540 120 620 260 460 340 Z" fill="url(#teaLeafGrad)" transform="rotate(30 460 240)"/>
    <!-- Center Bud -->
    <path d="M 400 240 C 380 150 420 150 400 240 Z" fill="#6ee7b7" stroke="#047857" stroke-width="3"/>

    <!-- Ceylon Tea Quality Seal -->
    <g transform="translate(450, 440)">
      <circle cx="90" cy="90" r="75" fill="#047857" stroke="#fbbf24" stroke-width="6"/>
      <text x="90" y="75" font-family="'Outfit', sans-serif" font-size="16" font-weight="900" fill="#fbbf24" text-anchor="middle" letter-spacing="2">CEYLON TEA</text>
      <text x="90" y="105" font-family="'Outfit', sans-serif" font-size="18" font-weight="900" fill="#ffffff" text-anchor="middle" letter-spacing="1">LION LOGO</text>
      <text x="90" y="125" font-family="'Outfit', sans-serif" font-size="12" font-weight="900" fill="#34d399" text-anchor="middle">100% PURE</text>
    </g>
  </g>
</svg>
SVG;

$slide3 = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="100%" height="100%">
  <defs>
    <linearGradient id="bgPepper" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#1c1917"/>
      <stop offset="50%" stop-color="#292524"/>
      <stop offset="100%" stop-color="#44403c"/>
    </linearGradient>

    <radialGradient id="pepperGlow" cx="75%" cy="50%" r="50%">
      <stop offset="0%" stop-color="#f59e0b" stop-opacity="0.3"/>
      <stop offset="100%" stop-color="#1c1917" stop-opacity="0"/>
    </radialGradient>
    
    <filter id="pepperShadow" x="-20%" y="-20%" width="140%" height="140%">
      <feDropShadow dx="0" dy="16" stdDeviation="20" flood-color="#000000" flood-opacity="0.7"/>
    </filter>
  </defs>

  <!-- Background -->
  <rect width="1920" height="1080" fill="url(#bgPepper)"/>
  <rect width="1920" height="1080" fill="url(#pepperGlow)"/>

  <!-- Right Visual Illustration: Ceylon Black Pepper & Cardamom Mortar -->
  <g filter="url(#pepperShadow)" transform="translate(1080, 220)">
    <!-- Wooden Mortar -->
    <path d="M 240 380 L 560 380 L 500 620 L 300 620 Z" fill="#78350f" stroke="#f59e0b" stroke-width="6"/>
    <ellipse cx="400" cy="380" rx="160" ry="45" fill="#451a03" stroke="#f59e0b" stroke-width="4"/>
    <ellipse cx="400" cy="380" rx="130" ry="30" fill="#1c1917"/>

    <!-- Pestle -->
    <rect x="360" y="200" width="80" height="300" rx="40" fill="#b45309" stroke="#fbbf24" stroke-width="4" transform="rotate(-25 400 350)"/>

    <!-- Black Pepper Corns Clusters -->
    <g fill="#09090b" stroke="#44403c" stroke-width="2">
      <circle cx="360" cy="360" r="18"/>
      <circle cx="390" cy="370" r="16"/>
      <circle cx="420" cy="365" r="17"/>
      <circle cx="380" cy="390" r="19"/>
      <circle cx="430" cy="390" r="15"/>
      <circle cx="410" cy="410" r="18"/>
      
      <!-- Scattered Pepper Corns outside -->
      <circle cx="210" cy="560" r="16"/>
      <circle cx="240" cy="580" r="14"/>
      <circle cx="180" cy="600" r="18"/>
      <circle cx="580" cy="550" r="17"/>
      <circle cx="610" cy="580" r="15"/>
    </g>

    <!-- Green Cardamom Pods -->
    <g fill="#15803d" stroke="#86efac" stroke-width="2">
      <ellipse cx="260" cy="520" rx="22" ry="36" transform="rotate(-30 260 520)"/>
      <ellipse cx="540" cy="500" rx="22" ry="36" transform="rotate(30 540 500)"/>
      <ellipse cx="480" cy="580" rx="20" ry="34" transform="rotate(60 480 580)"/>
    </g>

    <!-- Quality Badge -->
    <g transform="translate(460, 180)">
      <circle cx="90" cy="90" r="75" fill="#f59e0b" stroke="#ffffff" stroke-width="6"/>
      <text x="90" y="75" font-family="'Outfit', sans-serif" font-size="16" font-weight="900" fill="#1c1917" text-anchor="middle" letter-spacing="2">BLACK PEPPER</text>
      <text x="90" y="105" font-family="'Outfit', sans-serif" font-size="18" font-weight="900" fill="#ffffff" text-anchor="middle" letter-spacing="1">& CARDAMOM</text>
      <text x="90" y="125" font-family="'Outfit', sans-serif" font-size="12" font-weight="900" fill="#1c1917" text-anchor="middle">CEYLON GRADE 1</text>
    </g>
  </g>
</svg>
SVG;

$slide4 = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="100%" height="100%">
  <defs>
    <linearGradient id="bgCoco" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#451a03"/>
      <stop offset="50%" stop-color="#78350f"/>
      <stop offset="100%" stop-color="#d97706"/>
    </linearGradient>

    <radialGradient id="cocoGlow" cx="75%" cy="50%" r="50%">
      <stop offset="0%" stop-color="#fde68a" stop-opacity="0.35"/>
      <stop offset="100%" stop-color="#451a03" stop-opacity="0"/>
    </radialGradient>
    
    <filter id="cocoShadow" x="-20%" y="-20%" width="140%" height="140%">
      <feDropShadow dx="0" dy="16" stdDeviation="20" flood-color="#000000" flood-opacity="0.55"/>
    </filter>
  </defs>

  <!-- Background -->
  <rect width="1920" height="1080" fill="url(#bgCoco)"/>
  <rect width="1920" height="1080" fill="url(#cocoGlow)"/>

  <!-- Right Visual Illustration: Ceylon Coconut & Virgin Oil Bottle -->
  <g filter="url(#cocoShadow)" transform="translate(1080, 200)">
    <!-- Palm Leaves Backdrop -->
    <path d="M 100 150 C 300 200 400 400 300 600 M 100 150 L 220 280 M 140 180 L 280 320" stroke="#15803d" stroke-width="8" stroke-linecap="round"/>

    <!-- Whole Coconut -->
    <circle cx="340" cy="460" r="140" fill="#78350f" stroke="#451a03" stroke-width="8"/>
    <!-- 3 Eyes of Coconut -->
    <circle cx="290" cy="420" r="16" fill="#292524"/>
    <circle cx="340" cy="400" r="16" fill="#292524"/>
    <circle cx="330" cy="450" r="16" fill="#292524"/>

    <!-- Split Half Coconut with White Kernel & Coconut Water -->
    <circle cx="520" cy="480" r="130" fill="#78350f" stroke="#451a03" stroke-width="6"/>
    <circle cx="520" cy="480" r="105" fill="#ffffff"/>
    <circle cx="520" cy="480" r="75" fill="#bae6fd"/>

    <!-- Virgin Coconut Oil Glass Jar -->
    <rect x="180" y="320" width="110" height="220" rx="20" fill="#ffffff" fill-opacity="0.9" stroke="#fde68a" stroke-width="6"/>
    <rect x="200" y="270" width="70" height="50" rx="8" fill="#b45309"/>
    <rect x="200" y="380" width="70" height="90" rx="10" fill="#fbbf24"/>

    <!-- Export Seal -->
    <g transform="translate(480, 160)">
      <circle cx="90" cy="90" r="75" fill="#15803d" stroke="#ffffff" stroke-width="6"/>
      <text x="90" y="75" font-family="'Outfit', sans-serif" font-size="15" font-weight="900" fill="#fde68a" text-anchor="middle" letter-spacing="2">CEYLON ORGANIC</text>
      <text x="90" y="105" font-family="'Outfit', sans-serif" font-size="18" font-weight="900" fill="#ffffff" text-anchor="middle" letter-spacing="1">COCONUT</text>
      <text x="90" y="125" font-family="'Outfit', sans-serif" font-size="12" font-weight="900" fill="#fde68a" text-anchor="middle">OIL & DESICCATED</text>
    </g>
  </g>
</svg>
SVG;

file_put_contents('assets/images/slider/slide1.svg', $slide1);
file_put_contents('assets/images/slider/slide2.svg', $slide2);
file_put_contents('assets/images/slider/slide3.svg', $slide3);
file_put_contents('assets/images/slider/slide4.svg', $slide4);

echo "Successfully generated Ceylon Cinnamon, Tea, Black Pepper & Coconut Hero SVG Slides!\n";
