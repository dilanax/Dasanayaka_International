<?php
/**
 * Dasanayaka International - Modern Light Theme Catalog & Shop
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
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-right: 1px solid #e2e8f0;
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
        transform: translateY(-6px); 
    }
    
    @keyframes light-shimmer {
        0% { background-position: -468px 0; }
        100% { background-position: 468px 0; }
    }
    .loading-shimmer {
        background: #f8fafc;
        background-image: linear-gradient(to right, #f8fafc 0%, #e2e8f0 20%, #f8fafc 40%, #f8fafc 100%);
        background-repeat: no-repeat;
        background-size: 800px 104px;
        animation: light-shimmer 1.5s infinite linear;
    }
</style>

<section class="py-12 bg-slate-50 min-h-screen text-slate-800 select-none">
    <div class="container mx-auto px-4 lg:px-6">
        
        <!-- Header Bar -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
            <div class="max-w-xl">
                <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 px-3.5 py-1.5 rounded-full mb-3">
                    <span class="text-emerald-700 text-[10px] font-black uppercase tracking-[2.5px]">Factory Direct Catalog</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tight uppercase leading-[0.95]">
                    Wholesale <span class="text-emerald-700">Catalog</span>
                </h2>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <input type="text" id="shop-search" onkeyup="resetAndFilter()" placeholder="Search products, categories..." class="w-full bg-white border border-slate-200 text-slate-900 pl-10 pr-4 py-3 rounded-2xl text-xs font-semibold outline-none focus:border-emerald-600 focus:ring-2 focus:ring-emerald-500/10 transition shadow-sm placeholder:text-slate-400">
                    <i class="fas fa-search absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                </div>

                <div class="flex gap-2 w-full sm:w-auto">
                    <!-- Mobile Filter Toggle Button -->
                    <button onclick="toggleSidebar()" class="lg:hidden flex-1 flex items-center justify-center gap-2 bg-white border border-slate-200 py-3 px-5 rounded-2xl font-bold text-xs uppercase tracking-wider text-slate-700 hover:border-emerald-500 transition cursor-pointer shadow-sm">
                        <i class="fas fa-filter text-emerald-700"></i> Categories
                    </button>
                    
                    <!-- Sorting Dropdown -->
                    <select id="sort-filter" onchange="resetAndFilter()" class="flex-1 bg-white border border-slate-200 px-5 py-3 rounded-2xl text-xs font-bold text-slate-700 outline-none focus:border-emerald-600 transition shadow-sm cursor-pointer">
                        <option value="newest">Newest First</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 xl:gap-12 items-start relative">
            
            <!-- Filter Sidebar -->
            <aside id="filter-sidebar" class="overflow-y-auto no-scrollbar">
                <div class="flex lg:hidden justify-between items-center p-6 border-b border-slate-200 mb-6 bg-white sticky top-0 z-10">
                    <h3 class="font-black text-xl uppercase tracking-tight text-slate-900">Categories</h3>
                    <button onclick="toggleSidebar()" class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 hover:bg-emerald-700 hover:text-white transition cursor-pointer">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="space-y-6 px-6 pb-20 lg:p-0">
                    <!-- Categories Box -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm">
                        <h3 class="text-[10px] font-black uppercase tracking-[2.5px] text-emerald-800 mb-6 border-b border-slate-100 pb-3">Production Lines</h3>
                        <div class="space-y-1.5">
                            <button onclick="updateCategory(null, this)" class="cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition cursor-pointer <?php echo !$activeCatId ? 'font-black bg-emerald-700 text-white shadow-md shadow-emerald-700/20' : 'font-bold text-slate-600 hover:bg-slate-50 hover:text-emerald-700'; ?>">
                                <span>All Collections</span>
                                <i class="fas fa-layer-group text-[10px]"></i>
                            </button>
                            <?php foreach($categories as $sc): 
                                $isActiveCat = ($activeCatId == $sc['id']);
                            ?>
                                <button onclick="updateCategory(<?php echo $sc['id']; ?>, this)" class="cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider transition cursor-pointer <?php echo $isActiveCat ? 'font-black bg-emerald-700 text-white shadow-md shadow-emerald-700/20' : 'font-bold text-slate-600 hover:bg-slate-50 hover:text-emerald-700'; ?>">
                                    <span class="truncate pr-2"><?php echo htmlspecialchars($sc['title']); ?></span>
                                    <span class="text-[10px] px-2 py-0.5 rounded-lg font-black <?php echo $isActiveCat ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500 border border-slate-200'; ?>">
                                        <?php echo $conn->query("SELECT id FROM products WHERE cat_id = ".$sc['id'])->rowCount(); ?>
                                    </span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Factory Wholesale Quote Box -->
                    <div class="bg-gradient-to-br from-emerald-900 to-slate-900 p-6 rounded-3xl text-white space-y-3 shadow-md">
                        <div class="w-10 h-10 rounded-xl bg-amber-400/20 border border-amber-400/30 text-amber-300 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-industry"></i>
                        </div>
                        <h4 class="text-white text-xs font-black uppercase tracking-wider">Bulk OEM Production</h4>
                        <p class="text-xs text-slate-200 leading-relaxed font-medium">
                            Custom private label packaging, bulk international shipping, and specialized production runs available directly.
                        </p>
                        <a href="https://wa.me/94771179866" target="_blank" class="w-full bg-amber-400 hover:bg-amber-500 text-slate-950 text-[11px] font-black uppercase tracking-wider py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-all mt-2 shadow-md">
                            <i class="fa-brands fa-whatsapp text-sm"></i> Request Quotation
                        </a>
                    </div>
                </div>
            </aside>

            <!-- Backdrop for Mobile Sidebar -->
            <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[90] hidden lg:hidden transition-all duration-300"></div>

            <!-- Product Grid Area -->
            <div class="flex-1 w-full min-w-0">
                
                <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 lg:gap-8 transition-opacity duration-300">
                </div>
                
                <!-- Skeleton Shimmer Loader -->
                <div id="product-loader" class="hidden grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 lg:gap-8 mt-6">
                    <?php for($i=0; $i<6; $i++): ?>
                        <div class="h-80 rounded-3xl loading-shimmer border border-slate-200"></div>
                    <?php endfor; ?>
                </div>

                <!-- Load More Button -->
                <div id="load-more-container" class="mt-12 text-center hidden">
                    <button onclick="loadMoreProducts()" class="bg-white border border-slate-200 text-slate-700 hover:text-white px-10 py-4 rounded-2xl font-black uppercase tracking-wider text-xs hover:border-emerald-700 hover:bg-emerald-700 transition-all shadow-md active:scale-95 cursor-pointer">
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
            b.className = 'cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider font-bold text-slate-600 hover:bg-slate-50 hover:text-emerald-700 transition cursor-pointer';
            const badge = b.querySelector('span:last-child');
            if(badge) badge.className = 'text-[10px] px-2 py-0.5 rounded-lg font-black bg-slate-100 text-slate-500 border border-slate-200';
        });
        
        btn.className = 'cat-btn w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs uppercase tracking-wider font-black bg-emerald-700 text-white shadow-md shadow-emerald-700/20 transition cursor-pointer';
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
                        <div class="col-span-full py-24 text-center bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm">
                            <div class="w-16 h-16 bg-slate-100 border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
                                <i class="fa-solid fa-box-open text-2xl"></i>
                            </div>
                            <h3 class="text-sm font-black uppercase text-slate-900 tracking-wider">No Products Found</h3>
                            <p class="text-slate-500 font-medium text-xs mt-1">Try clearing your search terms or selecting a different category.</p>
                        </div>`;
                }
            })
            .catch(err => {
                loader.classList.add('hidden');
                console.error("Fetch error:", err);
            });
    }
</script>