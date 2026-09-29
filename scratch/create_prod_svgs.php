<?php
$targetDir = 'assets/images/products';

$prods = [
    [
        'file' => 'prod_dehydrated_gotukola.svg',
        'title' => 'GOTUKOLA LEAVES',
        'bg1' => '#ecfdf5', 'bg2' => '#a7f3d0', 'accent' => '#047857', 'pill' => '#10b981'
    ],
    [
        'file' => 'prod_ceylon_cinnamon.svg',
        'title' => 'CEYLON CINNAMON',
        'bg1' => '#fdfaef', 'bg2' => '#fde68a', 'accent' => '#78350f', 'pill' => '#d97706'
    ],
    [
        'file' => 'prod_dehydrated_jackfruit.svg',
        'title' => 'DRIED JACKFRUIT',
        'bg1' => '#fffbeb', 'bg2' => '#fde68a', 'accent' => '#b45309', 'pill' => '#f59e0b'
    ],
    [
        'file' => 'prod_curry_leaves.svg',
        'title' => 'CURRY LEAVES',
        'bg1' => '#f0fdf4', 'bg2' => '#86efac', 'accent' => '#14532d', 'pill' => '#16a34a'
    ],
    [
        'file' => 'prod_moringa_powder.svg',
        'title' => 'MORINGA POWDER',
        'bg1' => '#f0fdf4', 'bg2' => '#a7f3d0', 'accent' => '#065f46', 'pill' => '#059669'
    ],
    [
        'file' => 'prod_ornamental_plants.svg',
        'title' => 'EXPORT PLANTS',
        'bg1' => '#ccfbf1', 'bg2' => '#5eead4', 'accent' => '#0f766e', 'pill' => '#14b8a6'
    ],
];

foreach ($prods as $p) {
    $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600" width="100%" height="100%">
  <defs>
    <linearGradient id="pGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$p['bg1']}"/>
      <stop offset="100%" stop-color="{$p['bg2']}"/>
    </linearGradient>
    <filter id="pShadow" x="-20%" y="-20%" width="140%" height="140%">
      <feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="{$p['accent']}" flood-opacity="0.2"/>
    </filter>
  </defs>
  <rect width="600" height="600" fill="url(#pGrad)"/>
  
  <g filter="url(#pShadow)">
    <rect x="150" y="140" width="300" height="360" rx="40" fill="#ffffff" stroke="{$p['bg2']}" stroke-width="4"/>
    <path d="M 170 140 L 430 140 L 400 190 L 200 190 Z" fill="{$p['accent']}"/>
    
    <circle cx="300" cy="300" r="80" fill="{$p['pill']}"/>
    <circle cx="300" cy="300" r="55" fill="#ffffff"/>
    
    <path d="M 300 250 C 260 280 260 320 300 350 C 340 320 340 280 300 250 Z" fill="{$p['accent']}"/>
    
    <rect x="190" y="420" width="220" height="44" rx="22" fill="{$p['accent']}"/>
    <text x="300" y="448" font-family="'Plus Jakarta Sans', sans-serif" font-size="14" font-weight="900" fill="#ffffff" text-anchor="middle" letter-spacing="1">{$p['title']}</text>
  </g>
</svg>
SVG;
    file_put_contents("$targetDir/{$p['file']}", $svg);
    echo "Created $targetDir/{$p['file']}\n";
}
