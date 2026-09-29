<!-- Full-Width Modern E-Commerce Hero Slider Section -->
<style>
    .card-3d-wrapper { perspective: 1000px; }
    .card-3d-box {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        transform-style: preserve-3d;
    }
    .card-3d-wrapper:hover .card-3d-box {
        transform: translateY(-6px) rotateX(3deg) rotateY(-3deg);
        box-shadow: 0 20px 35px -5px rgba(0, 0, 0, 0.18), 0 10px 15px -5px rgba(4, 120, 87, 0.25);
    }
    .card-3d-img { transition: transform 0.4s ease; }
    .card-3d-wrapper:hover .card-3d-img { transform: scale(1.1); }
</style>

<section id="hero-section" class="relative w-full h-[calc(100vh-115px)] min-h-[460px] bg-slate-950 text-white overflow-hidden select-none flex flex-col justify-between border-b border-slate-800">
    
    <!-- Bottom Progress Bar Indicator -->
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-slate-900/90 z-40 overflow-hidden">
        <div id="slider-progress-bar" class="h-full bg-gradient-to-r from-emerald-500 via-amber-400 to-amber-500 w-0 transition-all duration-[3800ms] linear"></div>
    </div>

    <!-- Background Slider Track -->
    <div id="hero-slider" class="absolute inset-0 w-full h-full">
        <!-- Slide 1 -->
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100 z-10">
            <img src="assets/images/slider/slide1.jpg" alt="Pure Ceylon Spices & Black Pepper" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out slide-zoom">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/50 to-transparent"></div>
        </div>

        <!-- Slide 2 -->
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="assets/images/slider/slide2.jpg" alt="Dehydrated Vegetables & Herbs" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out slide-zoom">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/50 to-transparent"></div>
        </div>

        <!-- Slide 3 -->
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="assets/images/slider/slide3.jpg" alt="Spiced Ceylon Cinnamon Tea & Whole Spices" class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-[8000ms] ease-out slide-zoom">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/50 to-transparent"></div>
        </div>
    </div>

    <!-- Hero Content Overlay -->
    <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 my-auto pt-6 pb-12 flex flex-col justify-center">
        <div class="max-w-2xl lg:max-w-3xl space-y-4 sm:space-y-5">
            
            <!-- Main Display Headline -->
            <h1 id="hero-title" class="font-hero text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-[1.15] drop-shadow-sm">
                Authentic Ceylon Spices, Ground Spices & Black Pepper
            </h1>

            <!-- Subtitle -->
            <p id="hero-desc" class="text-slate-200 text-sm sm:text-base lg:text-lg font-normal leading-relaxed max-w-2xl drop-shadow-sm">
                Grade Alba Ceylon Cinnamon quills, organic black pepper, crushed chili, turmeric, and pure Sri Lankan spice harvest.
            </p>

            <!-- Dual Action Buttons -->
            <div class="flex flex-wrap items-center gap-3.5 pt-2">
                <a href="index.php?page=shop" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs uppercase tracking-[2px] px-7 py-3.5 rounded-xl shadow-lg shadow-emerald-950/50 border border-emerald-600 transition-all duration-300 active:scale-95 flex items-center gap-2.5">
                    BROWSE PRODUCTS <i class="fas fa-arrow-right text-[11px]"></i>
                </a>
                <a href="index.php?page=contact" class="bg-amber-600 hover:bg-amber-500 text-white font-bold text-xs uppercase tracking-[2px] px-7 py-3.5 rounded-xl shadow-lg shadow-amber-950/50 border border-amber-500 transition-all duration-300 active:scale-95 flex items-center gap-2.5">
                    REQUEST EXPORT QUOTE
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button id="slider-prev" aria-label="Previous Slide" class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-slate-900/80 hover:bg-emerald-600 border border-slate-700/80 text-white flex items-center justify-center backdrop-blur-md transition-all duration-300 active:scale-95 shadow-xl cursor-pointer">
        <i class="fas fa-chevron-left text-sm"></i>
    </button>
    <button id="slider-next" aria-label="Next Slide" class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-slate-900/80 hover:bg-emerald-600 border border-slate-700/80 text-white flex items-center justify-center backdrop-blur-md transition-all duration-300 active:scale-95 shadow-xl cursor-pointer">
        <i class="fas fa-chevron-right text-sm"></i>
    </button>

    <!-- Bottom Dots Pagination Bar -->
    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2.5 bg-slate-950/80 border border-slate-800 backdrop-blur-md px-4 py-2 rounded-full shadow-lg">
        <button class="slider-dot w-8 h-2 rounded-full bg-amber-400 transition-all duration-300" data-index="0" aria-label="Slide 1"></button>
        <button class="slider-dot w-2.5 h-2 rounded-full bg-white/30 hover:bg-white/60 transition-all duration-300" data-index="1" aria-label="Slide 2"></button>
        <button class="slider-dot w-2.5 h-2 rounded-full bg-white/30 hover:bg-white/60 transition-all duration-300" data-index="2" aria-label="Slide 3"></button>
    </div>
</section>

<!-- Key Metrics / KPI Ribbon (Light Theme) -->
<section class="bg-gradient-to-r from-emerald-50 via-white to-amber-50/40 border-b border-slate-200/80 py-12 relative overflow-hidden select-none">
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Metric 1 -->
            <div class="group bg-white border border-slate-200/80 hover:border-emerald-500/50 p-6 rounded-3xl transition-all duration-300 flex items-center gap-5 shadow-sm hover:shadow-xl hover:shadow-emerald-900/5">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-emerald-700 group-hover:text-white transition-all duration-300 shadow-sm">
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-slate-900 tracking-tight leading-none mb-1 group-hover:text-emerald-700 transition-colors">
                        20+
                    </h4>
                    <p class="text-[11px] text-slate-500 font-bold uppercase tracking-[1.5px] leading-tight">
                        Global Export Countries
                    </p>
                </div>
            </div>

            <!-- Metric 2 -->
            <div class="group bg-white border border-slate-200/80 hover:border-emerald-500/50 p-6 rounded-3xl transition-all duration-300 flex items-center gap-5 shadow-sm hover:shadow-xl hover:shadow-emerald-900/5">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-emerald-700 group-hover:text-white transition-all duration-300 shadow-sm">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-slate-900 tracking-tight leading-none mb-1 group-hover:text-emerald-700 transition-colors">
                        100%
                    </h4>
                    <p class="text-[11px] text-slate-500 font-bold uppercase tracking-[1.5px] leading-tight">
                        Organic & Ethically Sourced
                    </p>
                </div>
            </div>

            <!-- Metric 3 -->
            <div class="group bg-white border border-slate-200/80 hover:border-emerald-500/50 p-6 rounded-3xl transition-all duration-300 flex items-center gap-5 shadow-sm hover:shadow-xl hover:shadow-emerald-900/5">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-emerald-700 group-hover:text-white transition-all duration-300 shadow-sm">
                    <i class="fa-solid fa-seedling"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-slate-900 tracking-tight leading-none mb-1 group-hover:text-emerald-700 transition-colors">
                        5 Pillars
                    </h4>
                    <p class="text-[11px] text-slate-500 font-bold uppercase tracking-[1.5px] leading-tight">
                        Leaves, Spices, Fruits & Plants
                    </p>
                </div>
            </div>

            <!-- Metric 4 -->
            <div class="group bg-white border border-slate-200/80 hover:border-emerald-500/50 p-6 rounded-3xl transition-all duration-300 flex items-center gap-5 shadow-sm hover:shadow-xl hover:shadow-emerald-900/5">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-emerald-700 group-hover:text-white transition-all duration-300 shadow-sm">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-slate-900 tracking-tight leading-none mb-1 group-hover:text-emerald-700 transition-colors">
                        ISO Grade
                    </h4>
                    <p class="text-[11px] text-slate-500 font-bold uppercase tracking-[1.5px] leading-tight">
                        International Supply Chain
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3D Interactive Product Showcase Section (Light Brand Theme) -->
<section id="featured-3d-products" class="py-16 bg-white border-b border-slate-200/80">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-10">
            <div>
                <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-black uppercase tracking-[2px] px-3.5 py-1.5 rounded-full shadow-sm mb-3">
                    <i class="fa-solid fa-cube text-emerald-600 animate-pulse"></i> Interactive 3D Product Showcase
                </div>
                <h2 class="text-3xl md:text-4xl font-black font-heading text-slate-900 tracking-tight">
                    Featured Agricultural Export Lines
                </h2>
                <p class="text-slate-500 text-xs sm:text-sm font-semibold mt-1">
                    Explore 3D product renders, moisture specifications, and bulk international packaging standards.
                </p>
            </div>
            <a href="index.php?page=shop" class="bg-slate-100 hover:bg-emerald-700 hover:text-white text-slate-800 font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl border border-slate-200 transition-all duration-300 flex items-center gap-2">
                Full Catalog <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $hero3DProducts = $conn->query("SELECT p.*, COALESCE(b.name, 'Dasanayaka') as brand FROM products p LEFT JOIN brands b ON p.brand_id = b.id ORDER BY p.id ASC LIMIT 3")->fetchAll();
            foreach($hero3DProducts as $p): ?>
                <div class="card-3d-wrapper">
                    <div class="card-3d-box bg-slate-50/80 border border-slate-200/90 p-4 rounded-3xl shadow-sm hover:shadow-xl hover:border-emerald-500/60 transition-all duration-300 flex items-center gap-4">
                        <!-- Product Image with 3D Spec Tag -->
                        <div onclick="open3DSpecsModal(<?php echo $p['id']; ?>, '<?php echo htmlspecialchars(addslashes($p['title'])); ?>', '<?php echo htmlspecialchars(addslashes($p['main_image'])); ?>', '<?php echo htmlspecialchars(addslashes($p['price_range'])); ?>', '<?php echo htmlspecialchars(addslashes($p['description'])); ?>')" class="w-24 h-24 rounded-2xl bg-white overflow-hidden shrink-0 border border-slate-200 relative shadow-sm cursor-pointer group">
                            <?php if (!empty($p['main_image']) && file_exists('assets/images/products/' . $p['main_image'])): ?>
                                <img src="assets/images/products/<?php echo $p['main_image']; ?>" class="card-3d-img w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100"><i class="fa-solid fa-cube text-2xl"></i></div>
                            <?php endif; ?>
                            <span class="absolute top-1.5 left-1.5 bg-emerald-700 text-white text-[8px] font-black px-1.5 py-0.5 rounded-md shadow flex items-center gap-0.5 z-10">
                                <i class="fa-solid fa-cube text-[8px]"></i> 3D VIEW
                            </span>
                        </div>
                        
                        <!-- Product Info & Actions -->
                        <div class="flex-1 min-w-0">
                            <span class="text-[9px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-md">
                                <?php echo htmlspecialchars($p['brand']); ?>
                            </span>
                            <div onclick="open3DSpecsModal(<?php echo $p['id']; ?>, '<?php echo htmlspecialchars(addslashes($p['title'])); ?>', '<?php echo htmlspecialchars(addslashes($p['main_image'])); ?>', '<?php echo htmlspecialchars(addslashes($p['price_range'])); ?>', '<?php echo htmlspecialchars(addslashes($p['description'])); ?>')" class="cursor-pointer block font-bold text-sm text-slate-900 truncate hover:text-emerald-700 transition mt-1">
                                <?php echo htmlspecialchars($p['title']); ?>
                            </div>
                            <p class="text-[11px] font-black text-amber-700 mt-0.5">
                                <?php echo htmlspecialchars($p['price_range']); ?>
                            </p>
                            
                            <div class="flex items-center gap-2 mt-2.5">
                                <button onclick="addToInquiry(<?php echo $p['id']; ?>)" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-[10px] uppercase tracking-wider px-3.5 py-1.5 rounded-xl transition-all active:scale-95 shadow-sm flex items-center gap-1">
                                    <i class="fas fa-plus text-[9px]"></i> Inquire
                                </button>
                                <button onclick="open3DSpecsModal(<?php echo $p['id']; ?>, '<?php echo htmlspecialchars(addslashes($p['title'])); ?>', '<?php echo htmlspecialchars(addslashes($p['main_image'])); ?>', '<?php echo htmlspecialchars(addslashes($p['price_range'])); ?>', '<?php echo htmlspecialchars(addslashes($p['description'])); ?>')" class="bg-white hover:bg-slate-100 text-slate-700 font-bold text-[10px] uppercase tracking-wider px-3 py-1.5 rounded-xl border border-slate-200 transition flex items-center gap-1">
                                    <i class="fa-solid fa-cube text-[9px] text-emerald-600"></i> 3D Specs
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Production Categories Section (Light Theme) -->
<section id="categories" class="py-20 bg-slate-50">
    <div class="container mx-auto px-6 mb-12 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <div class="inline-flex items-center gap-2 text-emerald-700 text-xs font-black uppercase tracking-[2.5px] mb-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span> Export Product Pillars
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight uppercase">Browse Categories</h2>
        </div>
        <a href="index.php?page=categories" class="text-emerald-700 hover:text-emerald-800 font-black text-xs uppercase tracking-wider flex items-center gap-2 group">
            All Categories <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    <div class="container mx-auto px-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
        <?php
        $cats = $conn->query("SELECT c.*, (SELECT COUNT(id) FROM products WHERE cat_id = c.id) as p_count FROM categories c ORDER BY id ASC")->fetchAll();
        foreach($cats as $cat): ?>
            <div class="flex">
                <a href="index.php?page=shop&category=<?php echo $cat['id']; ?>" class="group w-full flex flex-col bg-white p-4 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:shadow-emerald-900/10 hover:border-emerald-400 transition-all duration-500">
                    <div class="aspect-square w-full overflow-hidden rounded-2xl bg-slate-100 relative mb-4 flex items-center justify-center">
                        <?php if (!empty($cat['image']) && file_exists('assets/images/categories/' . $cat['image'])): ?>
                            <img src="assets/images/categories/<?php echo $cat['image']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <?php else: ?>
                            <i class="fa-solid fa-layer-group text-4xl text-slate-300 group-hover:scale-110 group-hover:text-emerald-600 transition duration-500"></i>
                        <?php endif; ?>
                        <span class="absolute bottom-2 right-2 bg-white/90 backdrop-blur-sm text-slate-700 text-[10px] font-extrabold px-2.5 py-1 rounded-lg shadow-sm border border-slate-200/60">
                            <?php echo $cat['p_count']; ?> Items
                        </span>
                    </div>
                    <div class="text-center mt-auto">
                        <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider group-hover:text-emerald-700 transition leading-tight">
                            <?php echo htmlspecialchars($cat['title']); ?>
                        </h4>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Featured Products Catalog (Light Theme Grid) -->
<section id="items" class="py-24 bg-white border-t border-slate-200/80">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-4">
            <div>
                <div class="inline-flex items-center gap-2 text-emerald-700 text-xs font-black uppercase tracking-[2.5px] mb-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> Export Direct Wholesale
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight uppercase">Featured Agricultural Products</h2>
            </div>
            <a href="index.php?page=shop" class="bg-slate-100 hover:bg-emerald-700 hover:text-white text-slate-800 px-7 py-3.5 rounded-2xl font-black text-xs uppercase tracking-wider transition-all duration-300 border border-slate-200 flex items-center gap-2">
                Full Catalog <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            $products = $conn->query("SELECT p.*, b.name as brand FROM products p JOIN brands b ON p.brand_id = b.id ORDER BY p.id DESC LIMIT 8")->fetchAll();
            foreach($products as $p): ?>
                <div class="group flex flex-col bg-white rounded-3xl border border-slate-200/80 p-4 hover:shadow-2xl hover:shadow-emerald-950/10 hover:border-emerald-300 transition-all duration-500">
                    <a href="index.php?page=product-details&id=<?php echo $p['id']; ?>" class="relative aspect-square overflow-hidden rounded-2xl bg-slate-50 border border-slate-100 block cursor-pointer flex items-center justify-center">
                        <?php if (!empty($p['main_image']) && file_exists('assets/images/products/' . $p['main_image'])): ?>
                            <img src="assets/images/products/<?php echo $p['main_image']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <?php else: ?>
                            <i class="fa-solid fa-box-open text-5xl text-slate-300 group-hover:scale-110 group-hover:text-emerald-600 transition duration-500"></i>
                        <?php endif; ?>
                        <div class="absolute top-3 left-3">
                            <span class="bg-white/95 backdrop-blur-md text-emerald-800 text-[10px] font-black px-3 py-1 rounded-xl shadow-sm uppercase tracking-wider border border-slate-200">
                                <?php echo htmlspecialchars($p['brand']); ?>
                            </span>
                        </div>
                    </a>
                    <div class="mt-5 px-1 flex-1 flex flex-col">
                        <a href="index.php?page=product-details&id=<?php echo $p['id']; ?>" class="text-base font-extrabold text-slate-900 line-clamp-1 hover:text-emerald-700 transition tracking-tight mb-2">
                            <?php echo htmlspecialchars($p['title']); ?>
                        </a>
                        <div class="flex items-center justify-between gap-2 mb-4">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Wholesale</span>
                            <span class="text-sm font-black text-amber-700 leading-none tracking-tight bg-amber-50 border border-amber-200/60 px-2.5 py-1 rounded-lg"><?php echo htmlspecialchars($p['price_range']); ?></span>
                        </div>
                        <div class="mt-auto grid grid-cols-2 gap-2 pt-2">
                            <a href="index.php?page=product-details&id=<?php echo $p['id']; ?>" class="flex items-center justify-center gap-1.5 bg-slate-100 text-slate-700 py-3 rounded-xl font-extrabold text-[11px] uppercase tracking-wider hover:bg-slate-200 transition-all border border-slate-200">
                                <i class="fas fa-eye text-xs"></i> Specs
                            </a>
                            <button onclick="addToInquiry(<?php echo $p['id']; ?>)" class="flex items-center justify-center gap-1.5 bg-emerald-700 text-white py-3 rounded-xl font-extrabold text-[11px] uppercase tracking-wider hover:bg-emerald-800 transition-all active:scale-95 shadow-md shadow-emerald-700/20">
                                <i class="fas fa-plus text-xs"></i> Inquire
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Full-Width Dynamic Hero Slider JavaScript -->
<script>
    (function() {
        const slides = document.querySelectorAll('#hero-slider .slide');
        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('slider-prev');
        const nextBtn = document.getElementById('slider-next');
        const numDisplay = document.getElementById('slide-num');
        const progressBar = document.getElementById('slider-progress-bar');
        const slideData = [
            {
                badge: "PURE CEYLON SPICES EXPORTER",
                title: 'Authentic Ceylon Spices, Ground Spices & Black Pepper',
                desc: "Grade Alba Ceylon Cinnamon quills, organic black pepper, crushed chili, turmeric, and pure Sri Lankan spice harvest."
            },
            {
                badge: "NATURAL CEYLON HERBS & VEGETABLES",
                title: 'Dehydrated Vegetables, Herbs & Spice Extracts',
                desc: "Premium quality Sri Lankan dehydrated vegetables, ground chili, crushed herbs, and fresh agricultural produce."
            },
            {
                badge: "PURE CEYLON TEA & CINNAMON EXPORTER",
                title: 'Spiced Ceylon Cinnamon Tea & Whole Spices',
                desc: "Aromatic Sri Lankan spiced Ceylon tea crafted with pure cinnamon sticks, aromatic cloves, dried lime, and star anise."
            }
        ];

        const badgeText = document.getElementById('badge-text');
        const heroTitle = document.getElementById('hero-title');
        const heroDesc = document.getElementById('hero-desc');

        let currentSlide = 0;
        let sliderTimer = null;

        function resetProgressBar() {
            if (progressBar) {
                progressBar.style.transition = 'none';
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.transition = 'width 3800ms linear';
                    progressBar.style.width = '100%';
                }, 50);
            }
        }

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                }
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('w-2.5', 'bg-white/30');
                    dot.classList.add('w-8', 'bg-amber-400');
                } else {
                    dot.classList.remove('w-8', 'bg-amber-400');
                    dot.classList.add('w-2.5', 'bg-white/30');
                }
            });

            if (numDisplay) {
                numDisplay.innerText = "0" + (index + 1);
            }

            if (slideData[index]) {
                if (badgeText) badgeText.innerText = slideData[index].badge;
                if (heroTitle) {
                    heroTitle.style.opacity = '0';
                    heroTitle.style.transform = 'translateY(8px)';
                    setTimeout(() => {
                        heroTitle.innerText = slideData[index].title;
                        heroTitle.style.transition = 'all 0.4s ease';
                        heroTitle.style.opacity = '1';
                        heroTitle.style.transform = 'translateY(0)';
                    }, 150);
                }
                if (heroDesc) {
                    heroDesc.style.opacity = '0';
                    setTimeout(() => {
                        heroDesc.innerText = slideData[index].desc;
                        heroDesc.style.transition = 'opacity 0.4s ease';
                        heroDesc.style.opacity = '1';
                    }, 150);
                }
            }

            resetProgressBar();
            currentSlide = index;
        }

        function nextSlide() {
            let nextIndex = (currentSlide + 1) % slides.length;
            showSlide(nextIndex);
        }

        function prevSlide() {
            let prevIndex = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prevIndex);
        }

        function startAutoplay() {
            stopAutoplay();
            sliderTimer = setInterval(nextSlide, 3800);
        }

        function stopAutoplay() {
            if (sliderTimer) clearInterval(sliderTimer);
        }

        if (nextBtn && prevBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                startAutoplay();
            });
            prevBtn.addEventListener('click', () => {
                prevSlide();
                startAutoplay();
            });
        }

        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const targetIndex = parseInt(dot.getAttribute('data-index'));
                showSlide(targetIndex);
                startAutoplay();
            });
        });

        function adjustHeroHeight() {
            const topRibbon = document.getElementById('top-ribbon');
            const mainNav = document.getElementById('main-nav');
            const heroSec = document.getElementById('hero-section');
            if (heroSec) {
                const ribbonH = topRibbon ? topRibbon.offsetHeight : 0;
                const navH = mainNav ? mainNav.offsetHeight : 0;
                const totalHeaderH = ribbonH + navH;
                const targetH = Math.max(460, window.innerHeight - totalHeaderH);
                heroSec.style.height = targetH + 'px';
            }
        }

        window.addEventListener('resize', adjustHeroHeight);
        window.addEventListener('load', adjustHeroHeight);

        showSlide(0);
        startAutoplay();
        adjustHeroHeight();
    })();
</script>