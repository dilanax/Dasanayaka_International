<?php
// Script to create 4 ultra-modern, high-attraction 16:9 Hero Slider SVG Images

$slides = [
    [
        'file' => 'slide1.svg',
        'badge' => 'GLOBAL AGRICULTURAL EXPORTER',
        'title' => 'Lush Ceylon Plantations & Global Export',
        'g1' => '#022c22', 'g2' => '#064e3b', 'g3' => '#047857',
        'accent' => '#f59e0b', 'particle' => '#34d399',
        'icon' => '<path d="M 960 400 C 700 200 600 500 960 700 C 1320 500 1220 200 960 400 Z" fill="url(#leafGrad)" opacity="0.85"/>'
    ],
    [
        'file' => 'slide2.svg',
        'badge' => 'DEHYDRATED MEDICINAL LEAVES',
        'title' => 'Export-Grade Gotukola, Moringa & Curry Leaves',
        'g1' => '#064e3b', 'g2' => '#0d9488', 'g3' => '#0f766e',
        'accent' => '#10b981', 'particle' => '#a7f3d0',
        'icon' => '<ellipse cx="960" cy="540" rx="300" ry="180" fill="url(#leafGrad)" opacity="0.8"/>'
    ],
    [
        'file' => 'slide3.svg',
        'badge' => 'PURE CEYLON SPICES',
        'title' => 'Grade Alba Cinnamon, Cardamom & Black Pepper',
        'g1' => '#451a03', 'g2' => '#78350f', 'g3' => '#b45309',
        'accent' => '#f59e0b', 'particle' => '#fde68a',
        'icon' => '<rect x="760" y="340" width="400" height="400" rx="60" fill="url(#leafGrad)" transform="rotate(45 960 540)" opacity="0.8"/>'
    ],
    [
        'file' => 'slide4.svg',
        'badge' => 'DRIED FRUITS & ORNAMENTAL FLORA',
        'title' => 'Dehydrated Young Jackfruit & Tropical Foliage',
        'g1' => '#1c1917', 'g2' => '#065f46', 'g3' => '#d97706',
        'accent' => '#fbbf24', 'particle' => '#6ee7b7',
        'icon' => '<circle cx="960" cy="540" r="260" fill="url(#leafGrad)" opacity="0.8"/>'
    ]
];

foreach ($slides as $s) {
    $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="100%" height="100%">
  <defs>
    <!-- Background Multi-Stop Rich Gradient -->
    <linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$s['g1']}"/>
      <stop offset="50%" stop-color="{$s['g2']}"/>
      <stop offset="100%" stop-color="{$s['g3']}"/>
    </linearGradient>
    
    <linearGradient id="leafGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$s['accent']}"/>
      <stop offset="100%" stop-color="{$s['particle']}"/>
    </linearGradient>

    <radialGradient id="sunburst" cx="80%" cy="30%" r="70%">
      <stop offset="0%" stop-color="{$s['accent']}" stop-opacity="0.35"/>
      <stop offset="50%" stop-color="{$s['particle']}" stop-opacity="0.15"/>
      <stop offset="100%" stop-color="#000000" stop-opacity="0"/>
    </radialGradient>

    <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
      <feGaussianBlur stdDeviation="30" result="blur" />
      <feComposite in="SourceGraphic" in2="blur" operator="over"/>
    </filter>
  </defs>

  <!-- Base Dark Gradient Background -->
  <rect width="1920" height="1080" fill="url(#bgGrad)"/>
  
  <!-- Sunburst Glow Effect -->
  <rect width="1920" height="1080" fill="url(#sunburst)"/>

  <!-- Geometric Grid Optics -->
  <g opacity="0.08" stroke="#ffffff" stroke-width="1.5">
    <line x1="0" y1="270" x2="1920" y2="270"/>
    <line x1="0" y1="540" x2="1920" y2="540"/>
    <line x1="0" y1="810" x2="1920" y2="810"/>
    <line x1="480" y1="0" x2="480" y2="1080"/>
    <line x1="960" y1="0" x2="960" y2="1080"/>
    <line x1="1440" y1="0" x2="1440" y2="1080"/>
  </g>

  <!-- Floating Glowing Particles -->
  <circle cx="200" cy="150" r="140" fill="{$s['accent']}" opacity="0.15" filter="url(#glow)"/>
  <circle cx="1700" cy="850" r="220" fill="{$s['particle']}" opacity="0.2" filter="url(#glow)"/>
  <circle cx="1400" cy="250" r="90" fill="{$s['accent']}" opacity="0.2" filter="url(#glow)"/>
  <circle cx="350" cy="900" r="180" fill="{$s['particle']}" opacity="0.12" filter="url(#glow)"/>

  <!-- Right Visual Focus Hero Graphic -->
  <g filter="url(#glow)" transform="translate(100, 0)">
    {$s['icon']}
  </g>

  <!-- Light Accent Lines -->
  <path d="M 0 1000 Q 960 850 1920 1040" fill="none" stroke="{$s['accent']}" stroke-width="3" opacity="0.4"/>
  <path d="M 0 1020 Q 960 900 1920 1070" fill="none" stroke="{$s['particle']}" stroke-width="2" opacity="0.3"/>
</svg>
SVG;
    file_put_contents("assets/images/slider/{$s['file']}", $svg);
    echo "Generated assets/images/slider/{$s['file']}\n";
}
