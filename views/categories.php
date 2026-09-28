<?php
/**
 * Red Runner - All Categories Page (Modern Dark Minimal UI)
 * Path: views/categories.php
 */

// Fetch all categories with product count
$cats = $conn->query("SELECT c.*, (SELECT COUNT(id) FROM products WHERE cat_id = c.id) as p_count FROM categories c ORDER BY title ASC")->fetchAll();
?>

<section class="pt-32 pb-24 bg-black min-h-screen text-white select-none">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="inline-flex items-center gap-2 bg-red-600/10 border border-red-600/20 px-4 py-2 rounded-full mb-4">
                <span class="text-red-500 text-[10px] font-black uppercase tracking-[3px]">Production Lines</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-black text-white tracking-tighter uppercase leading-tight">Browse Categories</h2>
            <p class="text-zinc-400 mt-4 text-sm md:text-base font-medium">Explore our full range of wholesale knitwear and hosiery products organized by department.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6 lg:gap-8 max-w-7xl mx-auto">
            <?php if($cats): ?>
                <?php foreach($cats as $cat): ?>
                    <a href="index.php?page=shop&category=<?php echo $cat['id']; ?>" class="group flex flex-col bg-zinc-950 p-3 md:p-4 rounded-[24px] border border-zinc-900 shadow-sm hover:shadow-2xl hover:shadow-red-600/10 hover:border-red-600/40 hover:-translate-y-1.5 transition-all duration-500 overflow-hidden relative">
                        
                        <div class="aspect-square w-full overflow-hidden rounded-[18px] bg-zinc-900 relative mb-4 flex items-center justify-center">
                            <?php if (!empty($cat['image']) && file_exists('assets/images/categories/' . $cat['image'])): ?>
                                <img src="assets/images/categories/<?php echo $cat['image']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            <?php else: ?>
                                <i class="fa-solid fa-layer-group text-4xl text-zinc-700 group-hover:scale-110 group-hover:text-red-600 transition duration-500"></i>
                            <?php endif; ?>
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        <div class="text-center px-1 pb-2 flex flex-col items-center justify-center flex-1">
                            <h4 class="text-xs md:text-sm font-black text-zinc-200 uppercase tracking-widest group-hover:text-red-500 transition-colors leading-snug line-clamp-2">
                                <?php echo htmlspecialchars($cat['title']); ?>
                            </h4>
                            
                            <div class="mt-2 inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $cat['p_count'] > 0 ? 'bg-red-600 animate-pulse' : 'bg-zinc-700'; ?>"></span>
                                <span class="text-[9px] md:text-[10px] font-bold uppercase tracking-[2px] text-zinc-500 group-hover:text-zinc-300 transition-colors">
                                    <?php echo $cat['p_count']; ?> <?php echo $cat['p_count'] == 1 ? 'Item' : 'Items'; ?>
                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-20 text-center">
                    <div class="w-20 h-20 bg-zinc-900 border border-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4 text-zinc-500">
                        <i class="fas fa-folder-open text-3xl"></i>
                    </div>
                    <p class="text-zinc-500 font-bold uppercase tracking-widest text-sm">No categories found.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>