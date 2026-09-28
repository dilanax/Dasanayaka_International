<?php
/**
 * VenVel Group - All Brands Page (Modern Minimal UI with 1:1 Ratio Images)
 * Path: views/brands.php
 */

// Fetch all brands with product count
$brands = $conn->query("SELECT b.*, (SELECT COUNT(id) FROM products WHERE brand_id = b.id) as p_count FROM brands b ORDER BY name ASC")->fetchAll();
?>

<section class="pt-32 pb-24 bg-slate-50 min-h-screen">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h3 class="text-blue-600 font-black uppercase tracking-[4px] md:tracking-[5px] text-[10px] md:text-xs mb-3">Authorized Partners</h3>
            <h2 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tighter uppercase leading-tight">Shop by Brand</h2>
            <p class="text-slate-500 mt-4 text-sm md:text-base font-medium">We partner with the world's leading technology brands to bring you the best wholesale deals.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6 max-w-7xl mx-auto">
            <?php if($brands): ?>
                <?php foreach($brands as $brand): ?>
                    <a href="index.php?page=shop&brand=<?php echo $brand['id']; ?>" class="group flex flex-col items-center justify-center bg-white p-3 md:p-4 rounded-[20px] md:rounded-[24px] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1.5 transition-all duration-500">
                        
                        <div class="aspect-square w-full rounded-[16px] md:rounded-[18px] bg-[#f8fafc] border border-slate-50 flex items-center justify-center p-4 md:p-6 mb-4 relative overflow-hidden">
                            <img src="assets/images/brands/<?php echo $brand['image']; ?>" class="w-full h-full object-contain grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500 ease-out z-10">
                            
                            <div class="absolute inset-0 bg-gradient-to-tr from-slate-100 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <div class="text-center w-full mt-auto flex flex-col items-center pb-2">
                            <h4 class="text-xs md:text-sm font-black text-slate-900 uppercase tracking-widest group-hover:text-blue-600 transition-colors truncate w-full px-2">
                                <?php echo $brand['name']; ?>
                            </h4>
                            
                            <div class="mt-2 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $brand['p_count'] > 0 ? 'bg-green-500 animate-pulse' : 'bg-slate-300'; ?>"></span>
                                <span class="text-[9px] md:text-[10px] font-bold uppercase tracking-[2px] text-slate-400 group-hover:text-slate-600 transition-colors">
                                    <?php echo $brand['p_count']; ?> <?php echo $brand['p_count'] == 1 ? 'Product' : 'Products'; ?>
                                </span>
                            </div>
                        </div>

                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tags text-3xl text-slate-400"></i>
                    </div>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-sm">No brands found.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>