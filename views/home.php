<!-- Modern Image-Only Top Slider (3 Slides) -->
<section class="relative w-full h-[52vh] sm:h-[65vh] lg:h-[75vh] bg-black overflow-hidden border-b border-zinc-900 select-none">
    <div id="hero-slider" class="relative w-full h-full">
        <!-- Slide 1 -->
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-100 z-10">
            <img src="assets/images/slider/slide1.jpg" alt="Knitwear Factory Production" class="w-full h-full object-cover object-center transform scale-105 transition-transform duration-[7000ms] ease-out slide-zoom" onerror="this.src='https://images.unsplash.com/photo-1582735689369-4fe89db7114c?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-transparent to-black/80"></div>
        </div>

        <!-- Slide 2 -->
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="assets/images/slider/slide2.jpg" alt="Premium Sock Manufacturing" class="w-full h-full object-cover object-center transform scale-105 transition-transform duration-[7000ms] ease-out slide-zoom" onerror="this.src='https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-transparent to-black/80"></div>
        </div>

        <!-- Slide 3 -->
        <div class="slide absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 z-0">
            <img src="assets/images/slider/slide3.jpg" alt="Textile and Yarn Selection" class="w-full h-full object-cover object-center transform scale-105 transition-transform duration-[7000ms] ease-out slide-zoom" onerror="this.src='https://images.unsplash.com/photo-1606902965551-dce093cda6e7?q=80&w=1920&auto=format&fit=crop';">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-transparent to-black/80"></div>
        </div>
    </div>

    <!-- Slider Navigation Buttons -->
    <button id="slider-prev" aria-label="Previous Slide" class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 sm:w-13 sm:h-13 rounded-2xl bg-black/60 hover:bg-red-600 border border-white/10 hover:border-red-600 text-white flex items-center justify-center backdrop-blur-md transition-all duration-300 active:scale-95 group shadow-xl">
        <i class="fas fa-chevron-left text-sm sm:text-base group-hover:-translate-x-0.5 transition-transform"></i>
    </button>
    <button id="slider-next" aria-label="Next Slide" class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 sm:w-13 sm:h-13 rounded-2xl bg-black/60 hover:bg-red-600 border border-white/10 hover:border-red-600 text-white flex items-center justify-center backdrop-blur-md transition-all duration-300 active:scale-95 group shadow-xl">
        <i class="fas fa-chevron-right text-sm sm:text-base group-hover:translate-x-0.5 transition-transform"></i>
    </button>

    <!-- Slider Pagination Dots -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3 bg-black/60 border border-white/10 backdrop-blur-md px-4 py-2 rounded-full">
        <button class="slider-dot w-8 h-1.5 rounded-full bg-red-600 transition-all duration-300" data-index="0" aria-label="Slide 1"></button>
        <button class="slider-dot w-2 h-1.5 rounded-full bg-white/30 hover:bg-white/70 transition-all duration-300" data-index="1" aria-label="Slide 2"></button>
        <button class="slider-dot w-2 h-1.5 rounded-full bg-white/30 hover:bg-white/70 transition-all duration-300" data-index="2" aria-label="Slide 3"></button>
    </div>
</section>

<!-- Manufacturing KPI Ribbon -->
<section class="bg-black border-y border-zinc-900/80 py-12 relative overflow-hidden select-none">
    <!-- Subtle Background Glow -->
    <div class="absolute inset-0 bg-radial-[circle_at_center] from-red-950/10 via-transparent to-transparent pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
            
            <!-- Metric 1: Established Year -->
            <div class="group bg-zinc-950/70 hover:bg-zinc-900/50 border border-zinc-900 hover:border-red-600/40 p-6 rounded-2xl transition-all duration-300 flex items-center gap-5 shadow-lg shadow-black/40">
                <div class="w-13 h-13 rounded-xl bg-zinc-900/80 border border-zinc-800 text-red-500 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.15)]">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-white tracking-tight leading-none mb-1 group-hover:text-red-500 transition-colors">
                        2015
                    </h4>
                    <p class="text-[11px] text-zinc-400 font-bold uppercase tracking-[2px] leading-tight">
                        Established Year
                    </p>
                </div>
            </div>

            <!-- Metric 2: Gents Sock Designs -->
            <div class="group bg-zinc-950/70 hover:bg-zinc-900/50 border border-zinc-900 hover:border-red-600/40 p-6 rounded-2xl transition-all duration-300 flex items-center gap-5 shadow-lg shadow-black/40">
                <div class="w-13 h-13 rounded-xl bg-zinc-900/80 border border-zinc-800 text-red-500 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.15)]">
                    <i class="fa-solid fa-socks"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-white tracking-tight leading-none mb-1 group-hover:text-red-500 transition-colors">
                        20+
                    </h4>
                    <p class="text-[11px] text-zinc-400 font-bold uppercase tracking-[2px] leading-tight">
                        Gents Sock Designs
                    </p>
                </div>
            </div>

            <!-- Metric 3: Ethical Production -->
            <div class="group bg-zinc-950/70 hover:bg-zinc-900/50 border border-zinc-900 hover:border-red-600/40 p-6 rounded-2xl transition-all duration-300 flex items-center gap-5 shadow-lg shadow-black/40">
                <div class="w-13 h-13 rounded-xl bg-zinc-900/80 border border-zinc-800 text-red-500 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.15)]">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-white tracking-tight leading-none mb-1 group-hover:text-red-500 transition-colors">
                        100%
                    </h4>
                    <p class="text-[11px] text-zinc-400 font-bold uppercase tracking-[2px] leading-tight">
                        Ethical Production
                    </p>
                </div>
            </div>

            <!-- Metric 4: Bulk & Private Label -->
            <div class="group bg-zinc-950/70 hover:bg-zinc-900/50 border border-zinc-900 hover:border-red-600/40 p-6 rounded-2xl transition-all duration-300 flex items-center gap-5 shadow-lg shadow-black/40">
                <div class="w-13 h-13 rounded-xl bg-zinc-900/80 border border-zinc-800 text-red-500 flex items-center justify-center text-xl shrink-0 group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.15)]">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-white tracking-tight leading-none mb-1 group-hover:text-red-500 transition-colors">
                        OEM
                    </h4>
                    <p class="text-[11px] text-zinc-400 font-bold uppercase tracking-[2px] leading-tight">
                        Bulk & Private Label
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Dynamic Category Browser -->
<section id="categories" class="py-20 bg-black">
    <div class="container mx-auto px-6 mb-12">
        <h3 class="text-red-600 font-black uppercase tracking-[4px] text-xs mb-2">Production Lines</h3>
        <h2 class="text-3xl font-black text-white tracking-tighter uppercase">Browse Categories</h2>
    </div>

    <div class="container mx-auto px-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        <?php
        $cats = $conn->query("SELECT c.*, (SELECT COUNT(id) FROM products WHERE cat_id = c.id) as p_count FROM categories c ORDER BY title ASC")->fetchAll();
        foreach($cats as $cat): ?>
            <div class="flex">
                <a href="index.php?page=shop&category=<?php echo $cat['id']; ?>" class="group w-full flex flex-col bg-zinc-950 p-4 rounded-[24px] border border-zinc-900 shadow-sm hover:shadow-xl hover:shadow-red-600/10 hover:border-red-600/30 transition-all duration-500">
                    <div class="aspect-square w-full overflow-hidden rounded-[18px] bg-zinc-900 relative mb-4 flex items-center justify-center">
                        <?php if (!empty($cat['image']) && file_exists('assets/images/categories/' . $cat['image'])): ?>
                            <img src="assets/images/categories/<?php echo $cat['image']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        <?php else: ?>
                            <i class="fa-solid fa-layer-group text-4xl text-zinc-700 group-hover:scale-110 group-hover:text-red-600 transition duration-500"></i>
                        <?php endif; ?>
                        <span class="absolute bottom-2 right-2 bg-black/80 backdrop-blur-sm text-zinc-300 text-[9px] font-bold px-2 py-1 rounded-lg border border-white/10">
                            <?php echo $cat['p_count']; ?> Items
                        </span>
                    </div>
                    <div class="text-center mt-auto">
                        <h4 class="text-[11px] font-black text-zinc-300 uppercase tracking-widest group-hover:text-red-600 transition leading-tight">
                            <?php echo htmlspecialchars($cat['title']); ?>
                        </h4>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Live Inventory Grid -->
<section id="items" class="py-24 bg-zinc-950 border-t border-zinc-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-4">
            <div>
                <h3 class="text-red-600 font-black uppercase tracking-[3px] text-xs mb-2">Current Batch</h3>
                <h2 class="text-4xl font-black text-white tracking-tighter uppercase">Featured Knitwear</h2>
            </div>
            <a href="index.php?page=shop" class="bg-zinc-900 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-600 transition-all self-start md:self-auto border border-zinc-800">
                Full Catalog <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            <?php
            $products = $conn->query("SELECT p.*, b.name as brand FROM products p JOIN brands b ON p.brand_id = b.id ORDER BY p.id DESC LIMIT 8")->fetchAll();
            foreach($products as $p): ?>
                <div class="group flex flex-col bg-black rounded-[40px] border border-zinc-900 p-3 hover:shadow-2xl hover:shadow-red-600/10 hover:border-zinc-800 transition-all duration-500">
                    <a href="index.php?page=product-details&id=<?php echo $p['id']; ?>" class="relative aspect-square overflow-hidden rounded-[32px] bg-zinc-950 border border-zinc-900 block cursor-pointer flex items-center justify-center">
                        <?php if (!empty($p['main_image']) && file_exists('assets/images/products/' . $p['main_image'])): ?>
                            <img src="assets/images/products/<?php echo $p['main_image']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <?php else: ?>
                            <i class="fa-solid fa-socks text-6xl text-zinc-800 group-hover:scale-110 group-hover:text-red-600 transition duration-500"></i>
                        <?php endif; ?>
                        <div class="absolute top-4 left-4">
                            <span class="bg-black/90 backdrop-blur-md text-white text-[9px] font-black px-3 py-1.5 rounded-xl shadow-sm uppercase tracking-widest border border-white/10">
                                <?php echo htmlspecialchars($p['brand']); ?>
                            </span>
                        </div>
                    </a>
                    <div class="mt-5 px-3 flex-1 flex flex-col">
                        <a href="index.php?page=product-details&id=<?php echo $p['id']; ?>" class="text-lg font-bold text-white line-clamp-1 hover:text-red-500 transition tracking-tight">
                            <?php echo htmlspecialchars($p['title']); ?>
                        </a>
                        <div class="flex items-center gap-2 mt-2 mb-4">
                            <span class="text-[10px] font-black text-red-500 uppercase tracking-widest leading-none">Wholesale Rate</span>
                            <span class="text-base font-black text-white leading-none tracking-tighter"><?php echo htmlspecialchars($p['price_range']); ?></span>
                        </div>
                        <div class="mt-auto grid grid-cols-2 gap-2 pb-2">
                            <a href="index.php?page=product-details&id=<?php echo $p['id']; ?>" class="flex items-center justify-center gap-2 bg-zinc-900 text-zinc-300 py-3 rounded-2xl font-bold text-[11px] uppercase tracking-wider hover:bg-zinc-800 hover:text-white transition-all border border-zinc-800">
                                <i class="fas fa-eye text-xs"></i> Specs
                            </a>
                            <button onclick="addToInquiry(<?php echo $p['id']; ?>)" class="flex items-center justify-center gap-2 bg-red-600 text-white py-3 rounded-2xl font-bold text-[11px] uppercase tracking-wider hover:bg-red-700 transition-all active:scale-95 shadow-lg shadow-red-600/20">
                                <i class="fas fa-plus text-xs"></i> Inquire
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Slider JavaScript -->
<script>
    (function() {
        const slides = document.querySelectorAll('#hero-slider .slide');
        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('slider-prev');
        const nextBtn = document.getElementById('slider-next');
        let currentSlide = 0;
        let sliderTimer = null;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                    const img = slide.querySelector('.slide-zoom');
                    if(img) {
                        img.classList.remove('scale-105');
                        img.classList.add('scale-100');
                    }
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                    const img = slide.querySelector('.slide-zoom');
                    if(img) {
                        img.classList.remove('scale-100');
                        img.classList.add('scale-105');
                    }
                }
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('w-2', 'bg-white/30');
                    dot.classList.add('w-8', 'bg-red-600');
                } else {
                    dot.classList.remove('w-8', 'bg-red-600');
                    dot.classList.add('w-2', 'bg-white/30');
                }
            });
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
            sliderTimer = setInterval(nextSlide, 5000);
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

        showSlide(0);
        startAutoplay();
    })();
</script>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>