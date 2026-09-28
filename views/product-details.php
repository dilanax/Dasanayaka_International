<?php
/**
 * Red Runner - Premium Product Details Page
 * Path: views/product-details.php
 */

if (!isset($_GET['id'])) {
    echo "<script>window.location='index.php?page=shop';</script>";
    exit();
}

$product_id = intval($_GET['id']);

// 1. Fetch Product Data (Brands table join removed or handled safely since brands were dropped from header/catalog)
// Let's use a safe query joining categories, handling brand info if present or directly from products table
$stmt = $conn->prepare("SELECT p.*, c.title as cat_name 
                        FROM products p 
                        JOIN categories c ON p.cat_id = c.id 
                        WHERE p.id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "
    <section class='py-32 bg-black text-center min-h-[60vh] flex flex-col items-center justify-center text-white'>
        <i class='fas fa-box-open text-6xl text-zinc-700 mb-6'></i>
        <h2 class='text-3xl font-black uppercase tracking-tighter'>Product Not Found</h2>
        <a href='index.php?page=shop' class='mt-6 text-red-600 font-bold hover:underline'>Return to Catalog</a>
    </section>";
    exit();
}

// 2. Fetch Additional Gallery Images
$stmtGallery = $conn->prepare("SELECT image_name FROM product_images WHERE product_id = ?");
$stmtGallery->execute([$product_id]);
$gallery_images = $stmtGallery->fetchAll(PDO::FETCH_COLUMN);

// Brand name fallback
$brand_title = isset($product['brand_name']) ? $product['brand_name'] : 'Red Runner';
?>

<section class="pt-32 pb-24 bg-black min-h-screen text-white select-none">
    <div class="container mx-auto px-4 md:px-8 max-w-7xl">
        
        <!-- Breadcrumbs -->
        <div class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[3px] text-zinc-500 mb-16">
            <a href="index.php?page=home" class="hover:text-red-500 transition">Home</a>
            <span class="w-1 h-1 bg-zinc-700 rounded-full"></span>
            <a href="index.php?page=shop" class="hover:text-red-500 transition">Catalog</a>
            <span class="w-1 h-1 bg-zinc-700 rounded-full"></span>
            <span class="text-white truncate max-w-[200px] md:max-w-none"><?php echo htmlspecialchars($product['title']); ?></span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">
            
            <!-- Gallery & Main Image Column -->
            <div class="lg:col-span-7 space-y-6 lg:sticky lg:top-32 relative z-20">
                <div class="aspect-square bg-zinc-950 rounded-[40px] md:rounded-[60px] flex items-center justify-center relative overflow-hidden group border border-zinc-900 shadow-2xl">
                    <div class="absolute inset-0 bg-gradient-to-tr from-zinc-900/50 to-transparent opacity-50"></div>
                    <img id="main-display-img" src="assets/images/products/<?php echo $product['main_image']; ?>" 
                         class="w-full h-full object-contain p-10 relative z-10 transition-all duration-500 ease-out group-hover:scale-[1.05] drop-shadow-2xl"
                         onerror="this.src='https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?q=80&w=800&auto=format&fit=crop';">
                </div>
                
                <!-- Thumbnails -->
                <div class="flex gap-4 overflow-x-auto no-scrollbar py-2 px-1 relative z-30">
                    <div class="w-20 h-20 md:w-24 md:h-24 shrink-0 bg-zinc-900 border-2 border-red-600 rounded-[20px] overflow-hidden cursor-pointer transition-all duration-300 thumbnail-item shadow-md" 
                         onclick="changeImg('assets/images/products/<?php echo $product['main_image']; ?>', this)">
                        <img src="assets/images/products/<?php echo $product['main_image']; ?>" class="w-full h-full object-cover">
                    </div>
                    
                    <?php foreach($gallery_images as $img): ?>
                    <div class="w-20 h-20 md:w-24 md:h-24 shrink-0 bg-zinc-950 border-2 border-transparent rounded-[20px] overflow-hidden cursor-pointer hover:bg-zinc-900 transition-all duration-300 thumbnail-item" 
                         onclick="changeImg('assets/images/products/gallery/<?php echo $img; ?>', this)">
                        <img src="assets/images/products/gallery/<?php echo $img; ?>" class="w-full h-full object-cover opacity-60 hover:opacity-100 transition">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Product Info Column -->
            <div class="lg:col-span-5 flex flex-col h-full lg:py-8 relative z-10">
                
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="inline-block bg-zinc-900 border border-zinc-800 text-zinc-300 text-[9px] font-black px-4 py-1.5 rounded-xl uppercase tracking-[3px]">
                            <?php echo htmlspecialchars($brand_title); ?>
                        </span>
                        <span class="inline-block bg-red-600/10 border border-red-600/20 text-red-500 text-[9px] font-black px-4 py-1.5 rounded-xl uppercase tracking-[3px]">
                            <?php echo htmlspecialchars($product['cat_name']); ?>
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tighter leading-[1.1] uppercase">
                        <?php echo htmlspecialchars($product['title']); ?>
                    </h1>
                </div>

                <!-- Price / Wholesale Box -->
                <div class="bg-zinc-950 border border-zinc-900 rounded-[32px] p-8 mb-10 shadow-inner">
                    <div class="flex items-end justify-between mb-2">
                        <div>
                            <p class="text-[10px] font-black text-red-500 uppercase tracking-[3px] mb-1">Wholesale Rate</p>
                            <h3 class="text-4xl font-black text-white tracking-tighter leading-none"><?php echo htmlspecialchars($product['price_range']); ?></h3>
                        </div>
                    </div>
                    <div class="h-px w-full bg-zinc-900 my-5"></div>
                    <div class="flex justify-between items-center text-sm font-bold text-zinc-300">
                        <span>Minimum Order Quantity</span>
                        <span class="bg-zinc-900 border border-zinc-800 px-4 py-1 rounded-xl text-white shadow-sm"><?php echo htmlspecialchars($product['min_qty']); ?> Units</span>
                    </div>
                </div>

                <div class="mb-8">
                    <h4 class="text-[10px] font-black text-zinc-500 uppercase tracking-[3px] mb-4">Key Specifications</h4>
                    <div class="text-zinc-300 text-sm font-semibold leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($product['short_desc'])); ?>
                    </div>
                </div>

                <!-- Warranty & Delivery Grid -->
                <div class="grid grid-cols-2 gap-4 mb-10">
                    <div class="bg-zinc-950 border border-zinc-900 p-5 rounded-[24px] shadow-sm flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 text-red-500 flex items-center justify-center text-lg border border-zinc-800">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest leading-none mb-1">Quality Check</p>
                            <p class="text-sm font-bold text-white"><?php echo htmlspecialchars($product['warranty_status']); ?></p>
                        </div>
                    </div>
                    <div class="bg-zinc-950 border border-zinc-900 p-5 rounded-[24px] shadow-sm flex flex-col gap-3">
                        <div class="w-10 h-10 rounded-full bg-zinc-900 text-emerald-400 flex items-center justify-center text-lg border border-zinc-800">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest leading-none mb-1">Export / Dispatch</p>
                            <p class="text-sm font-bold text-white">Islandwide & Global</p>
                        </div>
                    </div>
                </div>

                <div class="mb-12">
                    <h4 class="text-xs font-black text-white uppercase tracking-[3px] mb-5 border-b border-zinc-900 pb-3">Technical Details</h4>
                    <div class="text-zinc-400 text-sm font-medium leading-relaxed prose max-w-none">
                        <?php echo nl2br(htmlspecialchars($product['long_desc'])); ?>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="mt-auto pt-6 border-t border-zinc-900 relative z-30">
                    <button onclick="addToInquiry(<?php echo $product['id']; ?>)" 
                            class="group relative w-full bg-red-600 text-white py-5 rounded-[24px] font-black uppercase tracking-[3px] text-xs transition-all duration-300 shadow-2xl shadow-red-600/30 hover:bg-red-700 active:scale-[0.98] overflow-hidden cursor-pointer">
                        <span class="relative flex items-center justify-center gap-4">
                            <i class="fas fa-shopping-basket text-lg"></i> Add to Inquiry List
                        </span>
                    </button>
                    <p class="text-center text-[10px] text-zinc-600 font-bold uppercase tracking-[2px] mt-4">
                        Secure B2B Ordering &bull; Custom Monogramming Available
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
<section class="py-24 bg-zinc-950 border-t border-zinc-900 text-white select-none">
    <div class="container mx-auto px-4 md:px-8 max-w-7xl">
        <h3 class="text-3xl font-black text-white tracking-tighter uppercase mb-12 text-center md:text-left">Similar Knitwear Items</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
            <?php
            $related = $conn->query("SELECT p.* FROM products p WHERE p.cat_id = {$product['cat_id']} AND p.id != $product_id LIMIT 4")->fetchAll();
            if($related):
                foreach($related as $rp): ?>
                    <a href="index.php?page=product-details&id=<?php echo $rp['id']; ?>" class="group flex flex-col bg-black rounded-[30px] md:rounded-[40px] border border-zinc-900 p-3 shadow-sm hover:border-red-600/40 hover:shadow-2xl hover:shadow-red-600/10 transition-all duration-500">
                        <div class="relative aspect-square overflow-hidden rounded-[20px] md:rounded-[28px] bg-zinc-950 mb-4 border border-zinc-900 flex items-center justify-center">
                            <?php if (!empty($rp['main_image']) && file_exists('assets/images/products/' . $rp['main_image'])): ?>
                                <img src="assets/images/products/<?php echo $rp['main_image']; ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            <?php else: ?>
                                <i class="fa-solid fa-socks text-4xl text-zinc-800"></i>
                            <?php endif; ?>
                            <div class="absolute top-3 left-3 bg-black/80 backdrop-blur-sm px-2.5 py-1 rounded-lg border border-white/10 shadow-sm">
                                <span class="text-[8px] font-black text-white uppercase tracking-widest">Red Runner</span>
                            </div>
                        </div>
                        <div class="px-2 pb-2 flex-1 flex flex-col">
                            <h5 class="font-bold text-white text-sm md:text-base line-clamp-2 leading-tight group-hover:text-red-500 transition"><?php echo htmlspecialchars($rp['title']); ?></h5>
                            <p class="text-[10px] md:text-xs font-black text-red-500 mt-2 tracking-tighter"><?php echo htmlspecialchars($rp['price_range']); ?></p>
                        </div>
                    </a>
                <?php endforeach; 
            else:
                echo "<div class='col-span-full text-center text-zinc-600 font-bold uppercase tracking-widest text-xs'>No similar items found.</div>";
            endif; ?>
        </div>
    </div>
</section>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
function changeImg(src, el) {
    const mainImg = document.getElementById('main-display-img');
    
    mainImg.style.opacity = '0';
    mainImg.style.transform = 'scale(0.95)';
    
    setTimeout(() => {
        mainImg.src = src;
        mainImg.style.opacity = '1';
        mainImg.style.transform = 'scale(1)';
    }, 200);

    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.classList.remove('border-red-600', 'bg-zinc-900', 'shadow-md');
        item.classList.add('border-transparent', 'bg-zinc-950');
        item.querySelector('img').classList.add('opacity-60');
    });
    
    el.classList.remove('border-transparent', 'bg-zinc-950');
    el.classList.add('border-red-600', 'bg-zinc-900', 'shadow-md');
    el.querySelector('img').classList.remove('opacity-60');
}
</script>