<?php
/**
 * Red Runner - Admin Dashboard (Full Width & Pure Dark Theme)
 * Path: PraBaK/dashboard.php
 */

try {
    // Get summary statistics
    $totalProds = $conn->query("SELECT COUNT(id) FROM products")->fetchColumn();
    $totalCats = $conn->query("SELECT COUNT(id) FROM categories")->fetchColumn();
    $totalBrands = $conn->query("SELECT COUNT(id) FROM brands")->fetchColumn();
    
    // Get new inquiries (Only 'Pending' status)
    $totalInquiries = $conn->query("SELECT COUNT(id) FROM inquiries WHERE status = 'Pending'")->fetchColumn();

} catch (PDOException $e) {
    $totalProds = $totalInquiries = $totalCats = $totalBrands = 0;
}
?>

<div class="w-full space-y-8 select-none">
    
    <!-- KPI Metric Cards (Full-Width Responsive Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        
        <!-- Total Products Card -->
        <a href="?page=products" class="bg-zinc-950 p-6 rounded-3xl border border-zinc-900 flex items-center justify-between hover:border-red-600/50 hover:shadow-[0_0_25px_rgba(220,38,38,0.15)] transition-all duration-300 group">
            <div>
                <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-[2px] mb-1">Products</p>
                <h3 class="text-3xl font-black text-white tracking-tight group-hover:text-red-500 transition-colors"><?php echo $totalProds; ?></h3>
            </div>
            <div class="text-red-500 bg-zinc-900 border border-zinc-800 p-4 rounded-2xl group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-md">
                <i class="fa-solid fa-socks text-2xl"></i>
            </div>
        </a>

        <!-- Pending Inquiries Card -->
        <a href="?page=inquiries" class="bg-zinc-950 p-6 rounded-3xl border border-zinc-900 flex items-center justify-between hover:border-red-600/50 hover:shadow-[0_0_25px_rgba(220,38,38,0.15)] transition-all duration-300 group">
            <div>
                <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-[2px] mb-1">Pending Inquiries</p>
                <h3 class="text-3xl font-black text-white tracking-tight group-hover:text-red-500 transition-colors"><?php echo $totalInquiries; ?></h3>
            </div>
            <div class="text-red-500 bg-zinc-900 border border-zinc-800 p-4 rounded-2xl group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-md">
                <i class="fas fa-clipboard-list text-2xl"></i>
            </div>
        </a>

        <!-- Categories Card -->
        <a href="?page=categories" class="bg-zinc-950 p-6 rounded-3xl border border-zinc-900 flex items-center justify-between hover:border-red-600/50 hover:shadow-[0_0_25px_rgba(220,38,38,0.15)] transition-all duration-300 group">
            <div>
                <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-[2px] mb-1">Categories</p>
                <h3 class="text-3xl font-black text-white tracking-tight group-hover:text-red-500 transition-colors"><?php echo $totalCats; ?></h3>
            </div>
            <div class="text-red-500 bg-zinc-900 border border-zinc-800 p-4 rounded-2xl group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-md">
                <i class="fas fa-layer-group text-2xl"></i>
            </div>
        </a>

        <!-- Brands Card -->
        <a href="?page=brands" class="bg-zinc-950 p-6 rounded-3xl border border-zinc-900 flex items-center justify-between hover:border-red-600/50 hover:shadow-[0_0_25px_rgba(220,38,38,0.15)] transition-all duration-300 group">
            <div>
                <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-[2px] mb-1">Brands</p>
                <h3 class="text-3xl font-black text-white tracking-tight group-hover:text-red-500 transition-colors"><?php echo $totalBrands; ?></h3>
            </div>
            <div class="text-red-500 bg-zinc-900 border border-zinc-800 p-4 rounded-2xl group-hover:bg-red-600 group-hover:text-white group-hover:border-red-600 transition-all duration-300 shadow-md">
                <i class="fas fa-tags text-2xl"></i>
            </div>
        </a>
    </div>

    <!-- Full-Width Hero Action Banner -->
    <div class="w-full bg-zinc-950 rounded-[36px] p-8 md:p-12 text-white flex flex-col lg:flex-row items-center justify-between gap-10 overflow-hidden relative shadow-2xl border border-zinc-900">
        
        <!-- Ambient Red Glows -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/10 blur-[140px] rounded-full pointer-events-none -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-red-950/20 blur-[100px] rounded-full pointer-events-none -ml-20 -mb-20"></div>
        
        <div class="z-10 flex-1">
            <div class="inline-flex items-center gap-2 bg-red-600/10 border border-red-600/20 px-3.5 py-1.5 rounded-full mb-4">
                <span class="text-red-500 text-[10px] font-black uppercase tracking-[3px]">Factory Operations Desk</span>
            </div>
            <h2 class="text-3xl md:text-5xl font-black tracking-tight mb-4">
                Welcome back, RedRunner
            </h2>
            <p class="text-zinc-400 max-w-2xl mb-8 leading-relaxed text-sm md:text-base font-medium">
                The Red Runner manufacturing and catalog hub is online. Manage wholesale quotes, organize knitted hosiery categories, and dispatch custom inquiries efficiently.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="?page=inquiries" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3.5 rounded-2xl font-black uppercase tracking-wider text-xs transition-all shadow-xl shadow-red-600/25 flex items-center gap-2.5 active:scale-95">
                    <i class="fas fa-inbox text-sm"></i> Review Inquiries
                </a>
                <a href="?page=products" class="bg-zinc-900 hover:bg-zinc-800 text-zinc-200 hover:text-white px-8 py-3.5 rounded-2xl font-black uppercase tracking-wider text-xs transition-all border border-zinc-800 flex items-center gap-2.5">
                    <i class="fas fa-plus text-sm text-red-500"></i> Manage Catalog
                </a>
            </div>
        </div>
        
        <!-- Factory Graphic Icon Badge -->
        <div class="relative z-10 hidden lg:flex items-center justify-center shrink-0">
            <div class="w-64 h-64 rounded-3xl bg-black/60 border border-zinc-800 flex flex-col items-center justify-center p-8 backdrop-blur-md shadow-2xl relative">
                <div class="absolute inset-0 bg-red-600/5 rounded-3xl blur-xl"></div>
                <i class="fa-solid fa-industry text-6xl text-red-600 mb-4 relative z-10"></i>
                <span class="text-xs font-black uppercase tracking-widest text-white relative z-10">Red Runner</span>
                <span class="text-[9px] uppercase tracking-[2px] text-zinc-500 font-bold mt-1 relative z-10">Production Core</span>
            </div>
        </div>

    </div>

</div>