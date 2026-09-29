<?php
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . " | Dasanayaka International" : "Dasanayaka International | Premium Agricultural Products & Botanicals Exporter"; ?></title>
    
    <link rel="icon" type="image/png" href="assets/images/readrunnerlogo.jpg">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    container: {
                        center: true,
                        screens: {
                            sm: '640px',
                            md: '768px',
                            lg: '1024px',
                            xl: '1280px',
                            '2xl': '1280px',
                        },
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .container { max-width: 1280px !important; margin-left: auto; margin-right: auto; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        h1, h2, h3, h4, .font-heading { font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif; }
        .font-hero { font-family: 'Outfit', 'Space Grotesk', 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.02em; }
        .font-body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Modern Emerald Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #047857; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #059669; }
        
        /* Navigation Underline Animations */
        .nav-link { position: relative; transition: all 0.3s ease; white-space: nowrap; }
        .nav-link::after { 
            content: ''; position: absolute; bottom: -4px; left: 50%; transform: translateX(-50%);
            width: 0; height: 2.5px; background: #d97706; border-radius: 2px; transition: all 0.3s ease; 
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* Full Screen Light Glassmorphism Search Overlay */
        #search-overlay {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.98); 
            backdrop-filter: blur(25px);
        }
        #search-overlay.hidden {
            opacity: 0;
            pointer-events: none;
            transform: scale(1.03);
        }

        /* Mobile Menu Accordion */
        #mobile-menu { transition: all 0.3s ease-in-out; max-height: 0; overflow: hidden; opacity: 0; }
        #mobile-menu.active { max-height: 600px; opacity: 1; padding: 1.25rem 0; }

        .swal2-toast { border-radius: 16px !important; background: #ffffff !important; color: #0f172a !important; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Cart Bounce */
        @keyframes cart-bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }
        .cart-animate { animation: cart-bounce 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

        @keyframes float-up {
            0% { opacity: 0; transform: translateY(0); }
            20% { opacity: 1; }
            100% { opacity: 0; transform: translateY(-40px); }
        }
        .float-badge { 
            position: absolute; 
            top: -5px; 
            right: 15px; 
            color: #ffffff; 
            background: #d97706;
            font-size: 11px; 
            font-weight: 900; 
            padding: 2px 7px; 
            border-radius: 10px; 
            pointer-events: none; 
            z-index: 100; 
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.4);
            animation: float-up 0.8s ease-out forwards; 
        }
    </style>

    <script>
    function addToInquiry(productId) {
        fetch('actions/add-to-inquiry.php?id=' + productId)
        .then(response => response.json())
        .then(data => {
            const cartBtn = document.getElementById('inquiry-cart-btn');
            const countBadge = document.getElementById('inquiry-count');
            
            if(data.status === 'success' || data.status === 'exists') {
                if (countBadge) countBadge.innerText = data.count;

                if (cartBtn) {
                    cartBtn.classList.remove('cart-animate');
                    void cartBtn.offsetWidth;
                    cartBtn.classList.add('cart-animate');

                    if(data.status === 'success') {
                        const float = document.createElement('span');
                        float.innerText = '+1';
                        float.className = 'float-badge';
                        cartBtn.appendChild(float);
                        setTimeout(() => float.remove(), 800);
                    }
                }
            }
        })
        .catch(error => console.error('Error adding inquiry:', error));
    }

    function openSearch() {
        const overlay = document.getElementById('search-overlay');
        if (!overlay) return;
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden'; 
        setTimeout(() => {
            const input = document.getElementById('search-input');
            if (input) input.focus();
        }, 100);
    }

    function closeSearch() {
        const overlay = document.getElementById('search-overlay');
        if (!overlay) return;
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        document.body.style.overflow = 'auto'; 
    }

    function liveSearch(query) {
        const resultsDiv = document.getElementById('search-results');
        if (!resultsDiv) return;
        if (query.length < 2) {
            resultsDiv.innerHTML = "";
            return;
        }

        fetch('actions/ajax-search.php?q=' + encodeURIComponent(query))
        .then(response => response.text())
        .then(data => {
            resultsDiv.innerHTML = data;
        });
    }

    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        if (menu) menu.classList.toggle('active');
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === "Escape") closeSearch();
    });

    window.addEventListener('scroll', () => {
        const mainNav = document.getElementById('main-nav');
        if (mainNav) {
            if (window.scrollY > 10) {
                mainNav.classList.add('shadow-md', 'border-b-0');
                mainNav.classList.remove('border-b', 'border-slate-200/80');
            } else {
                mainNav.classList.remove('shadow-md');
            }
        }
    });
    </script>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-emerald-700 selection:text-white">

    <!-- Top Light Utility Ribbon -->
    <div id="top-ribbon" class="bg-gradient-to-r from-slate-100 via-emerald-50/50 to-slate-100 text-slate-700 text-[11px] font-semibold py-2 border-b border-slate-200/80">
        <div class="w-full px-4 sm:px-6 md:px-8 lg:px-12 flex items-center justify-between gap-4">
            <div class="flex items-center gap-5 sm:gap-6">
                <a href="tel:+94771179866" class="hover:text-emerald-700 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-phone text-emerald-700 text-xs"></i> <span>+94 77 117 9866</span>
                </a>
                <a href="mailto:info@redrunner.lk" class="hidden sm:flex hover:text-emerald-700 transition items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-envelope text-emerald-700 text-xs"></i> <span>info@redrunner.lk</span>
                </a>
                <span class="hidden md:inline-flex items-center gap-1.5 text-emerald-800 font-extrabold bg-white border border-emerald-200 px-3 py-0.5 rounded-full text-[10px] shadow-sm whitespace-nowrap">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Export Desk Active
                </span>
            </div>
            <div class="flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-500 ml-auto whitespace-nowrap">
                <span class="text-amber-700 bg-amber-100 border border-amber-200 px-2 py-0.5 rounded-md">20+ Countries</span>
                <span class="text-slate-300">&bull;</span>
                <span class="hover:text-slate-900 transition">Dehydrated Leaves</span>
                <span class="text-slate-300">&bull;</span>
                <span class="hover:text-slate-900 transition">Ceylon Spices & Fruits</span>
            </div>
        </div>
    </div>

    <!-- Ultra-Modern Light Glassmorphism Header -->
    <nav id="main-nav" class="sticky top-0 z-40 bg-white/95 backdrop-blur-xl transition-all duration-300 border-b-0 shadow-sm">
        <div class="w-full px-4 sm:px-6 md:px-8 lg:px-12 py-3">
            <div class="flex items-center justify-between gap-4 sm:gap-6">
                
                <!-- Modern Brand Logo Header -->
                <a href="index.php?page=home" class="shrink-0 flex items-center gap-3 group">
                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-white border border-slate-200 p-1 flex items-center justify-center shrink-0 shadow-md group-hover:border-emerald-500 transition-all duration-300 overflow-hidden">
                        <img src="assets/images/logo.png" alt="Dasanayaka International Logo" class="w-full h-full object-contain">
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="text-base md:text-lg font-black font-heading tracking-tight text-slate-900 leading-tight flex items-center gap-1">
                            DASANAYAKA <span class="text-emerald-700">INT.</span>
                        </h1>
                        <p class="text-[9px] uppercase tracking-[1.8px] text-slate-500 font-extrabold group-hover:text-amber-600 transition whitespace-nowrap">Agricultural Products & Botanical Exporter</p>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center gap-6 xl:gap-8 text-xs font-bold uppercase tracking-wider whitespace-nowrap">
                    <a href="index.php?page=home" class="nav-link py-2 <?= ($currentPage === 'home') ? 'text-emerald-700 active font-extrabold' : 'text-slate-700 hover:text-emerald-700' ?>">Home</a>
                    <a href="index.php?page=about" class="nav-link py-2 <?= ($currentPage === 'about') ? 'text-emerald-700 active font-extrabold' : 'text-slate-700 hover:text-emerald-700' ?>">About Us</a>
                    <a href="index.php?page=shop" class="nav-link py-2 <?= ($currentPage === 'shop') ? 'text-emerald-700 active font-extrabold' : 'text-slate-700 hover:text-emerald-700' ?>">Products</a>
                    <a href="index.php?page=categories" class="nav-link py-2 <?= ($currentPage === 'categories') ? 'text-emerald-700 active font-extrabold' : 'text-slate-700 hover:text-emerald-700' ?>">Categories</a>
                    <a href="index.php?page=brands" class="nav-link py-2 <?= ($currentPage === 'brands') ? 'text-emerald-700 active font-extrabold' : 'text-slate-700 hover:text-emerald-700' ?>">Brands</a>
                    <a href="index.php?page=contact" class="nav-link py-2 <?= ($currentPage === 'contact') ? 'text-emerald-700 active font-extrabold' : 'text-slate-700 hover:text-emerald-700' ?>">Contact</a>
                </div>

                <!-- Right Action Controls -->
                <div class="flex items-center gap-3 shrink-0">
                    
                    <!-- Search Trigger Icon Button -->
                    <button onclick="openSearch()" 
                            title="Search Products"
                            class="h-10 w-10 flex items-center justify-center rounded-xl bg-slate-100/90 hover:bg-emerald-700 hover:text-white text-slate-700 border border-slate-200/80 transition-all duration-300 active:scale-95 shadow-sm">
                        <i class="fas fa-search text-sm"></i>
                    </button>

                    <!-- Inquiry Basket Pill Button -->
                    <a href="index.php?page=inquiry-list" id="inquiry-cart-btn" class="h-10 px-4 md:px-5 relative group flex items-center justify-center bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl transition-all duration-300 shadow-md shadow-emerald-700/20 border border-emerald-600/30 active:scale-95">
                        <i class="fas fa-shopping-basket text-sm md:mr-2"></i> 
                        <span class="hidden md:inline text-xs font-bold uppercase tracking-wider">Inquiry Basket</span>
                        
                        <span id="inquiry-count" class="ml-2 bg-amber-400 text-slate-950 text-[10px] font-black h-5 w-5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">
                            <?php echo isset($_SESSION['inquiry_cart']) ? count($_SESSION['inquiry_cart']) : '0'; ?>
                        </span>
                    </a>

                    <!-- Get Quote CTA (Desktop) -->
                    <a href="index.php?page=contact" class="h-10 px-4 hidden xl:inline-flex items-center justify-center gap-2 bg-amber-400 hover:bg-amber-300 text-slate-950 font-black text-xs uppercase tracking-wider rounded-xl shadow-md shadow-amber-400/20 border border-amber-300 transition-all duration-300 active:scale-95">
                        <span>Get Quote</span>
                        <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>

                    <!-- Mobile Menu Drawer Toggle -->
                    <button onclick="toggleMenu()" class="lg:hidden h-10 w-10 flex items-center justify-center text-lg text-slate-700 hover:text-emerald-700 transition bg-slate-100/90 rounded-xl border border-slate-200/80">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                </div>
            </div>

            <!-- Mobile Navigation Dropdown Card -->
            <div id="mobile-menu" class="lg:hidden">
                <div class="bg-white/95 backdrop-blur-xl border border-slate-200/80 rounded-2xl p-5 shadow-xl mt-3 flex flex-col gap-3">
                    <a href="index.php?page=home" class="flex items-center justify-between px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider <?= ($currentPage === 'home') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <span>Home</span> <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="index.php?page=about" class="flex items-center justify-between px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider <?= ($currentPage === 'about') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <span>About Us</span> <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="index.php?page=shop" class="flex items-center justify-between px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider <?= ($currentPage === 'shop') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <span>Products Catalog</span> <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="index.php?page=categories" class="flex items-center justify-between px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider <?= ($currentPage === 'categories') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <span>Product Categories</span> <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="index.php?page=brands" class="flex items-center justify-between px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider <?= ($currentPage === 'brands') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <span>Our Brands</span> <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="index.php?page=inquiry-list" class="flex items-center justify-between px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider <?= ($currentPage === 'inquiry-list') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <span>Inquiry Basket</span> <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                    <a href="index.php?page=contact" class="flex items-center justify-between px-4 py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider <?= ($currentPage === 'contact') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' ?>">
                        <span>Contact Factory</span> <i class="fas fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Light Glassmorphism Fullscreen Search Modal -->
    <div id="search-overlay" class="fixed inset-0 z-[60] hidden flex-col items-center pt-16 md:pt-24 px-4 md:px-6 overflow-y-auto">
        <div class="absolute top-0 right-0 w-80 md:w-[500px] h-80 md:h-[500px] bg-emerald-500/10 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 md:w-[500px] h-80 md:h-[500px] bg-amber-500/10 blur-[100px] rounded-full pointer-events-none"></div>

        <button onclick="closeSearch()" class="absolute top-6 md:top-8 right-6 md:right-8 text-slate-600 hover:text-slate-900 text-3xl transition-all hover:rotate-90 z-10 w-12 h-12 flex items-center justify-center rounded-full bg-slate-100 border border-slate-200 shadow-md">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="w-full max-w-3xl relative z-10 mt-6 md:mt-0">
            <div class="mb-2 text-emerald-700 text-xs font-black uppercase tracking-[4px] text-center">Instant Catalog Search</div>
            <h2 class="text-slate-900 text-2xl md:text-4xl font-black text-center mb-6 md:mb-8 tracking-tight uppercase leading-tight">Search Agricultural Products</h2>
            
            <div class="relative max-w-2xl mx-auto">
                <input type="text" id="search-input" onkeyup="liveSearch(this.value)" 
                       placeholder="Search dehydrated gotukola, ceylon cinnamon, moringa powder..." 
                       class="w-full bg-white border-2 border-emerald-600/30 py-4 md:py-5 pl-6 pr-16 text-base md:text-xl text-slate-900 rounded-2xl outline-none focus:border-emerald-700 focus:ring-4 focus:ring-emerald-500/15 transition-all font-semibold placeholder:text-slate-400 shadow-2xl">
                
                <div class="absolute right-3 top-3 md:top-3.5 w-10 h-10 md:w-11 md:h-11 bg-emerald-700 rounded-xl flex items-center justify-center text-white shadow-lg pointer-events-none">
                    <i class="fas fa-search text-base"></i>
                </div>
            </div>

            <div id="search-results" class="mt-8 md:mt-12 grid grid-cols-1 md:grid-cols-2 gap-4 pb-20 no-scrollbar max-w-2xl mx-auto">
            </div>

            <div class="fixed bottom-6 left-0 right-0 text-center pointer-events-none">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Press <span class="text-emerald-800 bg-white px-2.5 py-1 rounded-md border border-slate-300 mx-1 font-black shadow-sm">ESC</span> to exit search</p>
            </div>
        </div>
    </div>

