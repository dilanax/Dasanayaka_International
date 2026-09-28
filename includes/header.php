<?php
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . " | Red Runner" : "Red Runner | Sri Lanka's Premier Knitwear Manufacturer"; ?></title>
    
    <link rel="icon" type="image/png" href="/assets/images/readrunnerlogo.jpg">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800;900&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        
        /* Modern Scrollbar: Black & Red */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #000000; }
        ::-webkit-scrollbar-thumb { background: #dc2626; border-radius: 10px; }
        
        /* Navigation Links */
        .nav-link { position: relative; transition: all 0.3s; }
        .nav-link::after { 
            content: ''; position: absolute; bottom: -4px; left: 0; 
            width: 0; height: 2px; background: #dc2626; transition: 0.3s; 
        }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }

        /* Full Screen Search Overlay */
        #search-overlay {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(0, 0, 0, 0.98); 
            backdrop-filter: blur(25px);
        }
        #search-overlay.hidden {
            opacity: 0;
            pointer-events: none;
            transform: scale(1.05);
        }

        /* Mobile Menu Transition */
        #mobile-menu { transition: all 0.3s ease-in-out; max-height: 0; overflow: hidden; }
        #mobile-menu.active { max-height: 500px; padding: 1.5rem 0; border-top: 1px solid rgba(255,255,255,0.1); }

        .swal2-toast { border-radius: 15px !important; background: #000000 !important; color: #ffffff !important; border: 1px solid #27272a; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Cart Animation */
        @keyframes cart-bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }
        .cart-animate { animation: cart-bounce 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

        @keyframes float-up {
            0% { opacity: 0; transform: translateY(0); }
            20% { opacity: 1; }
            100% { opacity: 0; transform: translateY(-50px); }
        }
        .float-badge { 
            position: absolute; 
            top: 0; 
            right: 20px; 
            color: #ffffff; 
            background: #dc2626;
            font-size: 12px; 
            font-weight: 900; 
            padding: 2px 6px; 
            border-radius: 8px; 
            pointer-events: none; 
            z-index: 100; 
            animation: float-up 0.8s ease-out forwards; 
        }
    </style>

    <script>
    function addToInquiry(productId) {
        fetch('/actions/add-to-inquiry.php?id=' + productId)
        .then(response => response.json())
        .then(data => {
            const cartBtn = document.getElementById('inquiry-cart-btn');
            const countBadge = document.getElementById('inquiry-count');
            
            if(data.status === 'success' || data.status === 'exists') {
                countBadge.innerText = data.count;

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
        })
        .catch(error => console.error('Error:', error));
    }

    function openSearch() {
        const overlay = document.getElementById('search-overlay');
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden'; 
        setTimeout(() => {
            document.getElementById('search-input').focus();
        }, 100);
    }

    function closeSearch() {
        const overlay = document.getElementById('search-overlay');
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        document.body.style.overflow = 'auto'; 
    }

    function liveSearch(query) {
        const resultsDiv = document.getElementById('search-results');
        if (query.length < 2) {
            resultsDiv.innerHTML = "";
            return;
        }

        fetch('/actions/ajax-search.php?q=' + encodeURIComponent(query))
        .then(response => response.text())
        .then(data => {
            resultsDiv.innerHTML = data;
        });
    }

    function toggleMenu() {
        document.getElementById('mobile-menu').classList.toggle('active');
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === "Escape") closeSearch();
    });
    </script>
</head>
<body class="bg-black text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-zinc-950 text-zinc-400 text-xs py-2 px-4 border-b border-zinc-900">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="tel:+94771179866" class="hover:text-white transition flex items-center gap-2">
                    <i class="fa-solid fa-phone text-red-600"></i> +94 77 117 9866
                </a>
                <a href="mailto:info@redrunner.lk" class="hidden sm:flex hover:text-white transition items-center gap-2">
                    <i class="fa-solid fa-envelope text-red-600"></i> info@redrunner.lk
                </a>
            </div>
            <div class="flex items-center gap-3 text-[11px] font-bold uppercase tracking-wider text-zinc-400">
                <span>Bulk Production</span>
                <span class="text-zinc-700">&bull;</span>
                <span>Global Export</span>
                <span class="text-zinc-700">&bull;</span>
                <span>Est. 2015</span>
            </div>
        </div>
    </div>

    <!-- Navigation Header -->
    <nav class="sticky top-0 z-40 bg-black/95 text-white border-b border-zinc-900 backdrop-blur-xl">
        <div class="container mx-auto px-4 md:px-6 py-2.5">
            <div class="flex justify-between items-center gap-4">
                
                <!-- 1:1 Enlarged Modern Brand Logo (56x56 px) -->
                <a href="/" class="shrink-0 flex items-center gap-3.5 group">
                    <div class="w-14 h-14 md:w-16 md:h-16 aspect-square rounded-2xl bg-zinc-950 border border-zinc-800 group-hover:border-red-600 flex items-center justify-center p-2 transition-all duration-300 shadow-[0_0_20px_rgba(220,38,38,0.2)] group-hover:shadow-[0_0_25px_rgba(220,38,38,0.45)] overflow-hidden">
                        <img src="/assets/images/logo.png" 
                             alt="Red Runner Logo" 
                             class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105"
                             onerror="this.onerror=null; this.src='/assets/images/readrunnerlogo.jpg';">
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-xl md:text-2xl font-black tracking-tighter text-white leading-none font-sans">
                            RED <span class="text-red-600">RUNNER</span>
                        </h1>
                        <p class="text-[9px] uppercase tracking-[2.5px] text-zinc-400 font-bold mt-1 group-hover:text-white transition">Knitwear Manufacturer</p>
                    </div>
                </a>

                <!-- Desktop Navigation with Clean URLs -->
                <div class="hidden lg:flex gap-10 text-[11px] font-black uppercase tracking-[2px]">
                    <a href="/" class="nav-link <?= ($currentPage === 'home') ? 'text-white active' : 'text-zinc-300 hover:text-white' ?>">Home</a>
                    <a href="/about" class="nav-link <?= ($currentPage === 'about') ? 'text-white active' : 'text-zinc-300 hover:text-white' ?>">About Us</a>
                    <a href="/shop" class="nav-link <?= ($currentPage === 'shop') ? 'text-white active' : 'text-zinc-300 hover:text-white' ?>">Products</a>
                    <a href="/categories" class="nav-link <?= ($currentPage === 'categories') ? 'text-white active' : 'text-zinc-300 hover:text-white' ?>">Categories</a>
                    <a href="/contact" class="nav-link <?= ($currentPage === 'contact') ? 'text-white active' : 'text-zinc-300 hover:text-white' ?>">Contact</a>
                </div>

                <!-- Right Action Buttons -->
                <div class="flex items-center gap-3 md:gap-4 shrink-0">
                    
                    <!-- Search Button -->
                    <button onclick="openSearch()" class="h-10 w-10 md:h-11 md:w-11 flex items-center justify-center rounded-xl bg-zinc-900 border border-zinc-800 hover:bg-red-600 hover:border-red-600 transition-all duration-300 active:scale-95 text-white">
                        <i class="fas fa-search text-sm"></i>
                    </button>

                    <!-- Inquiry Button with Clean URL -->
                    <a href="/inquiry-list" id="inquiry-cart-btn" class="relative group flex items-center bg-red-600 px-4 md:px-6 py-2.5 md:py-3 rounded-xl hover:bg-red-700 transition shadow-[0_0_20px_rgba(220,38,38,0.3)] active:scale-95 text-white">
                        <i class="fas fa-shopping-basket text-sm md:mr-2.5"></i> 
                        <span class="hidden md:inline text-xs font-black uppercase tracking-widest">Inquiry</span>
                        
                        <span id="inquiry-count" class="absolute -top-2 -right-2 bg-white text-red-600 text-[10px] md:text-[11px] font-black h-5 w-5 md:h-6 md:w-6 rounded-full flex items-center justify-center border-2 border-red-600 shadow-lg">
                            <?php echo isset($_SESSION['inquiry_cart']) ? count($_SESSION['inquiry_cart']) : '0'; ?>
                        </span>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMenu()" class="lg:hidden h-10 w-10 flex items-center justify-center text-xl text-zinc-300 hover:text-white transition bg-zinc-900 rounded-xl border border-zinc-800">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Dropdown Navigation with Clean URLs -->
            <div id="mobile-menu" class="lg:hidden">
                <div class="flex flex-col gap-5 text-sm font-bold uppercase tracking-[2.5px] text-center mt-4">
                    <a href="/" class="<?= ($currentPage === 'home') ? 'text-red-500' : 'text-zinc-300 hover:text-red-500' ?> transition">Home</a>
                    <a href="/about" class="<?= ($currentPage === 'about') ? 'text-red-500' : 'text-zinc-300 hover:text-red-500' ?> transition">About Us</a>
                    <a href="/shop" class="<?= ($currentPage === 'shop') ? 'text-red-500' : 'text-zinc-300 hover:text-red-500' ?> transition">Wholesale Products</a>
                    <a href="/categories" class="<?= ($currentPage === 'categories') ? 'text-red-500' : 'text-zinc-300 hover:text-red-500' ?> transition">Categories</a>
                    <a href="/inquiry-list" class="<?= ($currentPage === 'inquiry-list') ? 'text-red-500' : 'text-zinc-300 hover:text-red-500' ?> transition">Inquiry List</a>
                    <a href="/contact" class="<?= ($currentPage === 'contact') ? 'text-red-500' : 'text-zinc-300 hover:text-red-500' ?> transition pb-3">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Overlay -->
    <div id="search-overlay" class="fixed inset-0 z-[60] hidden flex-col items-center pt-20 md:pt-32 px-4 md:px-6 overflow-y-auto">
        <div class="absolute top-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-red-600/10 blur-[90px] rounded-full pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 md:w-96 h-64 md:h-96 bg-red-950/20 blur-[90px] rounded-full pointer-events-none"></div>

        <button onclick="closeSearch()" class="absolute top-6 md:top-8 right-6 md:right-8 text-zinc-500 hover:text-white text-3xl transition-all hover:rotate-90 z-10 w-12 h-12 flex items-center justify-center">
            <i class="fas fa-times"></i>
        </button>

        <div class="w-full max-w-4xl relative z-10 mt-8 md:mt-0">
            <div class="mb-2 text-red-500 text-[10px] md:text-xs font-black uppercase tracking-[4px] text-center">Instant Wholesale Search</div>
            <h2 class="text-white text-3xl md:text-5xl font-black text-center mb-8 md:mb-10 tracking-tighter uppercase leading-tight">Search Knitwear Catalog</h2>
            
            <div class="relative max-w-2xl mx-auto">
                <input type="text" id="search-input" onkeyup="liveSearch(this.value)" 
                       placeholder="Search school socks, gents designs, diabetic care..." 
                       class="w-full bg-zinc-950 border border-zinc-800 py-5 pl-6 md:pl-8 pr-16 md:pr-20 text-lg md:text-2xl text-white rounded-2xl outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all font-medium placeholder:text-zinc-600 shadow-2xl">
                
                <div class="absolute right-2.5 top-2.5 w-12 h-12 md:w-14 md:h-14 bg-red-600 rounded-xl flex items-center justify-center text-white shadow-lg pointer-events-none">
                    <i class="fas fa-search text-lg md:text-xl"></i>
                </div>
            </div>

            <div id="search-results" class="mt-10 md:mt-16 grid grid-cols-1 md:grid-cols-2 gap-4 pb-24 no-scrollbar max-w-3xl mx-auto">
            </div>

            <div class="fixed bottom-6 md:bottom-8 left-0 right-0 text-center pointer-events-none">
                <p class="text-zinc-600 text-[10px] md:text-xs font-black uppercase tracking-[3px]">Press <span class="text-zinc-300 bg-zinc-900 px-2.5 py-1 rounded-md border border-zinc-800 mx-1">ESC</span> to close</p>
            </div>
        </div>
    </div>