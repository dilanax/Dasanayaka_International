<?php
/**
 * Dasanayaka International - All Brands Page (Modern Light Theme)
 * Path: views/brands.php
 */

// Fetch all brands with product count
$brands = $conn->query("SELECT b.*, (SELECT COUNT(id) FROM products WHERE brand_id = b.id) as p_count FROM brands b ORDER BY name ASC")->fetchAll();
?>

<section class="py-16 md:py-24 bg-slate-50 min-h-screen text-slate-800">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200/80 px-4 py-1.5 rounded-full mb-4">
                <span class="text-emerald-700 text-[10px] font-black uppercase tracking-[2.5px]">Authorized Brands & Partners</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight uppercase leading-tight">Featured Brands</h2>
            <p class="text-slate-600 mt-4 text-sm md:text-base font-medium">Explore products manufactured under authorized brand partnerships and custom private labels.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6 max-w-7xl mx-auto">
            <?php if($brands): ?>
                <?php foreach($brands as $brand): ?>
                    <a href="index.php?page=shop&brand=<?php echo $brand['id']; ?>" class="group flex flex-col items-center justify-center bg-white p-4 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:shadow-emerald-950/5 hover:border-emerald-400 hover:-translate-y-1.5 transition-all duration-500">
                        
                        <div class="aspect-square w-full rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center p-4 mb-4 relative overflow-hidden">
                            <?php if (!empty($brand['image']) && file_exists('assets/images/brands/' . $brand['image'])): ?>
                                <img src="assets/images/brands/<?php echo $brand['image']; ?>" class="w-full h-full object-contain grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500 ease-out z-10">
                            <?php else: ?>
                                <i class="fa-solid fa-award text-4xl text-slate-300 group-hover:scale-110 group-hover:text-emerald-600 transition duration-500"></i>
                            <?php endif; ?>
                        </div>

                        <div class="text-center w-full mt-auto flex flex-col items-center pb-1">
                            <h4 class="text-xs md:text-sm font-extrabold text-slate-900 uppercase tracking-wider group-hover:text-emerald-700 transition-colors truncate w-full px-1">
                                <?php echo htmlspecialchars($brand['name']); ?>
                            </h4>
                            
                            <div class="mt-2 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $brand['p_count'] > 0 ? 'bg-emerald-600 animate-pulse' : 'bg-slate-300'; ?>"></span>
                                <span class="text-[9px] md:text-[10px] font-bold uppercase tracking-[1.5px] text-slate-500 group-hover:text-slate-700 transition-colors">
                                    <?php echo $brand['p_count']; ?> <?php echo $brand['p_count'] == 1 ? 'Product' : 'Products'; ?>
                                </span>
                            </div>
                        </div>

                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <i class="fas fa-tags text-2xl"></i>
                    </div>
                    <p class="text-slate-500 font-bold uppercase tracking-wider text-xs">No brands found.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>