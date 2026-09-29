<?php
/**
 * Dasanayaka International - Production Categories Page (Modern Light Theme)
 * Path: views/categories.php
 */

// Fetch all categories with product count
$cats = $conn->query("SELECT c.*, (SELECT COUNT(id) FROM products WHERE cat_id = c.id) as p_count FROM categories c ORDER BY title ASC")->fetchAll();
?>

<section class="py-16 md:py-24 bg-slate-50 min-h-screen text-slate-800 select-none">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200/80 px-4 py-1.5 rounded-full mb-4">
                <span class="text-emerald-700 text-[10px] font-black uppercase tracking-[2.5px]">Factory Production Lines</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight uppercase leading-tight">Browse Categories</h2>
            <p class="text-slate-600 mt-4 text-sm md:text-base font-medium">Explore our full range of wholesale product categories and specialized manufacturing lines.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6 lg:gap-8 max-w-7xl mx-auto">
            <?php if($cats): ?>
                <?php foreach($cats as $cat): ?>
                    <a href="index.php?page=shop&category=<?php echo $cat['id']; ?>" class="group flex flex-col bg-white p-3 md:p-4 rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:shadow-emerald-950/10 hover:border-emerald-400 hover:-translate-y-1.5 transition-all duration-500 overflow-hidden relative">
                        
                        <div class="aspect-square w-full overflow-hidden rounded-2xl bg-slate-100 relative mb-4 flex items-center justify-center">
                            <?php if (!empty($cat['image']) && file_exists('assets/images/categories/' . $cat['image'])): ?>
                                <img src="assets/images/categories/<?php echo $cat['image']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            <?php else: ?>
                                <i class="fa-solid fa-layer-group text-4xl text-slate-300 group-hover:scale-110 group-hover:text-emerald-600 transition duration-500"></i>
                            <?php endif; ?>
                        </div>

                        <div class="text-center px-1 pb-2 flex flex-col items-center justify-center flex-1">
                            <h4 class="text-xs md:text-sm font-extrabold text-slate-900 uppercase tracking-wider group-hover:text-emerald-700 transition-colors leading-snug line-clamp-2">
                                <?php echo htmlspecialchars($cat['title']); ?>
                            </h4>
                            
                            <div class="mt-2 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $cat['p_count'] > 0 ? 'bg-emerald-600 animate-pulse' : 'bg-slate-300'; ?>"></span>
                                <span class="text-[9px] md:text-[10px] font-bold uppercase tracking-[1.5px] text-slate-500 group-hover:text-slate-700 transition-colors">
                                    <?php echo $cat['p_count']; ?> <?php echo $cat['p_count'] == 1 ? 'Item' : 'Items'; ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm">
                    <div class="w-16 h-16 bg-slate-100 border border-slate-200 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                        <i class="fas fa-folder-open text-2xl"></i>
                    </div>
                    <p class="text-slate-500 font-bold uppercase tracking-wider text-xs">No categories found.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>