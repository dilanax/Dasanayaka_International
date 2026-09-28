<?php
/**
 * Red Runner - Modern Dark Theme Knitwear Catalog & Wholesale Shop
 * Path: views/shop.php
 */

// Initial fetch for categories
$categories = $conn->query("SELECT * FROM categories ORDER BY title ASC")->fetchAll();

// Get active category from URL
$activeCatId = isset($_GET['category']) ? $_GET['category'] : null;
?>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    
    /* Mobile Sidebar Styling */
    @media (max-width: 1023.98px) {
        #filter-sidebar {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            width: 85vw; 
            max-width: 350px;
            transform: translateX(-100%);
            background: rgba(9, 9, 11, 0.98);
            backdrop-filter: blur(20px);
            border-right: 1px solid #27272a;
        }
        #filter-sidebar.active-sidebar { transform: translateX(0); }
    }
    
    /* Desktop Sidebar Styling */
    @media (min-width: 1024px) {
        #filter-sidebar {
            position: sticky;
            top: 100px;
            height: calc(100vh - 120px);
            width: 300px;
            flex-shrink: 0;
            display: block !important;
            transform: none !important;
            background: transparent;
        }
    }

    .product-card { 
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1); 
    }
    .product-card:hover { 
        transform: translateY(-8px); 
    }
    
    @keyframes dark-shimmer {
        0% { background-position: -468px 0; }
        100% { background-position: 468px 0; }
    }
    .loading-shimmer {
        background: #09090b;
        background-image: linear-gradient(to right, #09090b 0%, #18181b 20%, #09090b 40%, #09090b 100%);
        background-repeat: no-repeat;
        background-size: 800px 104px;
        animation: dark-shimmer 1.5s infinite linear;
    }
</style>

<section class="py-12 bg-black min-h-screen text-white select-none">
    <div class="container mx-auto px-4 lg:px-6">
        
        <!-- Header Bar -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div class="max-w-xl">
                <div class="inline-flex items-center gap-2 bg-red-600/10 border border-red-600/20 px-3.5 py-1.5 rounded-full mb-3">
                    <span class="text-red-500 text-[10px] font-black uppercase tracking-[3px]">Live Inventory</span>
                </div>
                <h2 class="text-4xl lg:text-6xl font-black text-white tracking-tighter uppercase leading-[0.9]">
                    Knitwear <br><span class="text-red-600">Catalog.</span>
                </h2>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <input type="text" id="shop-search" onkeyup="resetAndFilter()" placeholder="Search knitwear, school, gents..." class="w-full bg-zinc-950 border border-zinc-800 text-white pl-10 pr-4 py-3 rounded-2xl text-xs font-semibold outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition shadow-inner placeholder:text-zinc-600">
                    <i class="fas fa-search absolute left-4 top-3.5 text-zinc-500 text-xs"></i>
                </div>

                <div class="flex gap-2 w-full sm:w-auto">
                    <!-- Mobile Filter Toggle Button -->
                    <button onclick="toggleSidebar()" class="lg:hidden flex-1 flex items-center justify-center gap-2 bg-zinc-950 border border-zinc-800 py-3 px-5 rounded-2xl font-bold text-xs uppercase tracking-widest text-zinc-300 hover:border-red-600 transition cursor-pointer">
                        <i class="fas fa-filter text-red-600"></i> Categories
                    </button>
                    
                    <!-- Sorting Dropdown -->
                    <select id="sort-filter" onchange="resetAndFilter()" class="flex-1 bg-zinc-950 border border-zinc-800 px-5 py-3 rounded-2xl text-xs font-bold text-zinc-300 outline-none focus:border-red-600 transition shadow-sm cursor-pointer">
                        <option value="newest" class="bg-zinc-900 text-white">Newest First</option>
                        <option value="price_low" class="bg-zinc-900 text-white">Rate: Low to High</option>
                        <option value="price_high" class="bg-zinc-900 text-white">Rate: High to Low</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 xl:gap-12 items-start relative">
            
            <!-- Filter Sidebar -->
            <aside id="filter-sidebar" class="overflow-y-auto no-scrollbar">
                <div class="flex lg:hidden justify-between items-center p-6 border-b border-zinc-900 mb-6 bg-zinc-950 sticky top-0 z-10">
                    <h3 class="font-black text-xl uppercase tracking-tighter text-white">Categories</h3>
                    <button onclick="toggleSidebar()" class="w-10 h-10 bg-zinc-900 rounded-full flex items-center justify-center text-zinc-400 hover:bg-red-600 hover:text-white transition cursor-pointer">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="space-y-6 px-6 pb-20 lg:p-0">
                    <!-- Categories Box -->
                    <div class="bg-zinc-950 p-6 rounded-[32px] border border-zinc-900 shadow-xl">
                        <h3 class="text-[10px] font-black uppercase tracking-[3px] text-red-500 mb-6 border-b border-zinc-900 pb-3">Production Lines</h3>
                        <div class="space-y-1.5">
                            <button onclick="updateCategory(null, this)" class="cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition cursor-pointer <?php echo !$activeCatId ? 'font-black bg-red-600 text-white shadow-lg shadow-red-600/30' : 'font-bold text-zinc-400 hover:bg-zinc-900 hover:text-white'; ?>">
                                <span>All Collections</span>
                                <i class="fas fa-layer-group text-[10px]"></i>
                            </button>
                            <?php foreach($categories as $sc): 
                                $isActiveCat = ($activeCatId == $sc['id']);
                            ?>
                                <button onclick="updateCategory(<?php echo $sc['id']; ?>, this)" class="cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition cursor-pointer <?php echo $isActiveCat ? 'font-black bg-red-600 text-white shadow-lg shadow-red-600/30' : 'font-bold text-zinc-400 hover:bg-zinc-900 hover:text-white'; ?>">
                                    <span class="truncate pr-2"><?php echo htmlspecialchars($sc['title']); ?></span>
                                    <span class="text-[10px] px-2 py-0.5 rounded-lg font-black <?php echo $isActiveCat ? 'bg-white/20 text-white' : 'bg-black text-zinc-500 border border-zinc-800'; ?>">
                                        <?php echo $conn->query("SELECT id FROM products WHERE cat_id = ".$sc['id'])->rowCount(); ?>
                                    </span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Factory Wholesale Quote Box -->
                    <div class="bg-zinc-950 p-6 rounded-[32px] border border-zinc-900 space-y-3 shadow-xl">
                        <div class="w-10 h-10 rounded-xl bg-red-600/10 border border-red-600/20 text-red-500 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-industry"></i>
                        </div>
                        <h4 class="text-white text-xs font-black uppercase tracking-wider">Bulk Contract Supply</h4>
                        <p class="text-xs text-zinc-400 leading-relaxed">
                            Need institutional monogram embroidery, customized needle counts, or container volume exports? Connect directly with our dispatch department.
                        </p>
                        <a href="https://wa.me/94771179866" target="_blank" class="w-full bg-zinc-900 hover:bg-red-600 text-white text-[11px] font-black uppercase tracking-wider py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-all mt-2 border border-zinc-800 hover:border-red-600">
                            <i class="fa-brands fa-whatsapp text-sm text-emerald-400"></i> Request Quotation
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Backdrop for Mobile Sidebar -->
            <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[90] hidden lg:hidden transition-all duration-300"></div>

            <!-- Product Grid Area -->
            <div class="flex-1 w-full min-w-0">
                
                <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 lg:gap-8 transition-opacity duration-300">
                </div>
                
                <!-- Skeleton Shimmer Loader -->
                <div id="product-loader" class="hidden grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 lg:gap-8 mt-6">
                    <?php for($i=0; $i<6; $i++): ?>
                        <div class="h-96 rounded-[28px] loading-shimmer border border-zinc-900"></div>
                    <?php endfor; ?>
                </div>

                <!-- Load More Button -->
                <div id="load-more-container" class="mt-12 text-center hidden">
                    <button onclick="loadMoreProducts()" class="bg-zinc-950 border border-zinc-800 text-zinc-300 hover:text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:border-red-600 hover:bg-red-600 transition-all shadow-xl active:scale-95 cursor-pointer">
                        Load More Products <i class="fas fa-arrow-down ml-2"></i>
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</section>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    let currentCategory = urlParams.get('category') || null;
    
    let currentPage = 1;
    const limit = 12;

    document.addEventListener('DOMContentLoaded', () => resetAndFilter());

    function toggleSidebar() {
        const sidebar = document.getElementById('filter-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('active-sidebar');
        overlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    }

    function updateCategory(id, btn) {
        currentCategory = id;
        
        document.querySelectorAll('.cat-btn').forEach(b => {
            b.className = 'cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider font-bold text-zinc-400 hover:bg-zinc-900 hover:text-white transition cursor-pointer';
            const badge = b.querySelector('span:last-child');
            if(badge) badge.className = 'text-[10px] px-2 py-0.5 rounded-lg font-black bg-black text-zinc-500 border border-zinc-800';
        });
        
        btn.className = 'cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider font-black bg-red-600 text-white shadow-lg shadow-red-600/30 transition cursor-pointer';
        const activeBadge = btn.querySelector('span:last-child');
        if(activeBadge) activeBadge.className = 'text-[10px] px-2 py-0.5 rounded-lg font-black bg-white/20 text-white';

        if(id) urlParams.set('category', id); else urlParams.delete('category');
        window.history.replaceState({}, '', `${window.location.pathname}?${urlParams}`);

        resetAndFilter();
        if(window.innerWidth < 1024) toggleSidebar();
    }

    function resetAndFilter() {
        currentPage = 1;
        document.getElementById('product-grid').innerHTML = ''; 
        fetchProducts(false);
    }

    function loadMoreProducts() {
        currentPage++;
        fetchProducts(true);
    }

    function fetchProducts(isAppend = false) {
        const loader = document.getElementById('product-loader');
        const grid = document.getElementById('product-grid');
        const loadMoreBtn = document.getElementById('load-more-container');
        
        loader.classList.remove('hidden');
        if(!isAppend) loadMoreBtn.classList.add('hidden');

        const params = new URLSearchParams({
            category: currentCategory || '',
            search: document.getElementById('shop-search').value,
            sort: document.getElementById('sort-filter').value,
            page: currentPage,
            limit: limit
        });

        fetch('actions/ajax-filter-products.php?' + params)
            .then(res => res.json())
            .then(data => {
                loader.classList.add('hidden');
                
                if (data.html && data.html.trim() !== "") {
                    if(isAppend) {
                        grid.insertAdjacentHTML('beforeend', data.html);
                    } else {
                        grid.innerHTML = data.html;
                    }
                    
                    if (data.hasMore) {
                        loadMoreBtn.classList.remove('hidden');
                    } else {
                        loadMoreBtn.classList.add('hidden');
                    }
                } else if (!isAppend) {
                    grid.innerHTML = `
                        <div class="col-span-full py-24 text-center bg-zinc-950 rounded-[32px] border border-zinc-900 p-8">
                            <div class="w-16 h-16 bg-black border border-zinc-800 rounded-2xl flex items-center justify-center mx-auto mb-4 text-zinc-600">
                                <i class="fa-solid fa-socks text-2xl"></i>
                            </div>
                            <h3 class="text-sm font-black uppercase text-white tracking-wider">No Knitwear Products Found</h3>
                            <p class="text-zinc-500 font-medium text-xs mt-1">Try clearing your search terms or choosing a different collection.</p>
                        </div>`;
                }
            })
            .catch(err => {
                loader.classList.add('hidden');
                console.error("Fetch error:", err);
            });
    }
</script>