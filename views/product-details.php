<?php
/**
 * Dasanayaka International - Product Details Page (Modern Light Theme)
 * Path: views/product-details.php
 */

if (!isset($_GET['id'])) {
    echo "<script>window.location='index.php?page=shop';</script>";
    exit();
}

$product_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT p.*, c.title as cat_name 
                        FROM products p 
                        LEFT JOIN categories c ON p.cat_id = c.id 
                        WHERE p.id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product) {
    echo "
    <section class='py-32 bg-slate-50 text-center min-h-[60vh] flex flex-col items-center justify-center text-slate-800'>
        <i class='fas fa-box-open text-6xl text-slate-300 mb-6'></i>
        <h2 class='text-3xl font-black uppercase tracking-tight text-slate-900'>Product Not Found</h2>
        <a href='index.php?page=shop' class='mt-6 text-emerald-700 font-bold hover:underline'>Return to Catalog</a>
    </section>";
    exit();
}

// Fetch Additional Gallery Images
$stmtGallery = $conn->prepare("SELECT image_name FROM product_images WHERE product_id = ?");
$stmtGallery->execute([$product_id]);
$gallery_images = $stmtGallery->fetchAll(PDO::FETCH_COLUMN);

$brand_title = isset($product['brand_name']) ? $product['brand_name'] : 'Dasanayaka Line';
?>

<section class="py-16 md:py-24 bg-slate-50 min-h-screen text-slate-800 select-none">
    <div class="container mx-auto px-4 md:px-8 max-w-7xl">
        
        <!-- Breadcrumbs -->
        <div class="flex items-center gap-2.5 text-xs font-bold uppercase tracking-wider text-slate-400 mb-10">
            <a href="index.php?page=home" class="hover:text-emerald-700 transition">Home</a>
            <span class="text-slate-300">&bull;</span>
            <a href="index.php?page=shop" class="hover:text-emerald-700 transition">Catalog</a>
            <span class="text-slate-300">&bull;</span>
            <span class="text-slate-900 font-extrabold truncate max-w-[200px] md:max-w-none"><?php echo htmlspecialchars($product['title']); ?></span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
            
            <!-- Gallery & Main Image Column -->
            <div class="lg:col-span-7 space-y-6 lg:sticky lg:top-28 relative z-20">
                <div class="aspect-square bg-white rounded-3xl p-8 flex items-center justify-center relative overflow-hidden group border border-slate-200/80 shadow-sm">
                    <img id="main-display-img" src="assets/images/products/<?php echo $product['main_image']; ?>" 
                         class="w-full h-full object-contain relative z-10 transition-all duration-500 ease-out group-hover:scale-[1.04]"
                         onerror="this.src='https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?q=80&w=800&auto=format&fit=crop';">
                </div>
                
                <!-- Thumbnails -->
                <?php if(!empty($gallery_images)): ?>
                <div class="flex gap-4 overflow-x-auto no-scrollbar py-1 relative z-30">
                    <div class="w-20 h-20 shrink-0 bg-white border-2 border-emerald-600 rounded-2xl overflow-hidden cursor-pointer transition-all duration-300 thumbnail-item shadow-sm p-1" 
                         onclick="changeImg('assets/images/products/<?php echo $product['main_image']; ?>', this)">
                        <img src="assets/images/products/<?php echo $product['main_image']; ?>" class="w-full h-full object-contain">
                    </div>
                    
                    <?php foreach($gallery_images as $img): ?>
                    <div class="w-20 h-20 shrink-0 bg-white border border-slate-200 rounded-2xl overflow-hidden cursor-pointer hover:border-emerald-500 transition-all duration-300 thumbnail-item p-1" 
                         onclick="changeImg('assets/images/products/gallery/<?php echo $img; ?>', this)">
                        <img src="assets/images/products/gallery/<?php echo $img; ?>" class="w-full h-full object-contain opacity-70 hover:opacity-100 transition">
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Product Info Column -->
            <div class="lg:col-span-5 flex flex-col h-full relative z-10">
                
                <div class="mb-8">
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="inline-block bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-[10px] font-black px-3.5 py-1 rounded-xl uppercase tracking-wider">
                            <?php echo htmlspecialchars($product['cat_name'] ?? 'Production Line'); ?>
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight uppercase font-sans">
                        <?php echo htmlspecialchars($product['title']); ?>
                    </h1>
                </div>

                <!-- Price / Wholesale Box -->
                <div class="bg-white border border-slate-200/80 rounded-3xl p-6 mb-8 shadow-sm">
                    <div class="flex items-end justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Wholesale Rate</p>
                            <h3 class="text-3xl font-black text-amber-700 tracking-tight leading-none"><?php echo htmlspecialchars($product['price_range'] ?? 'Contact for Quote'); ?></h3>
                        </div>
                    </div>
                </div>

                <?php if(!empty($product['description'])): ?>
                <div class="mb-8">
                    <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider mb-3">Product Description</h4>
                    <div class="text-slate-600 text-sm font-medium leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Action Button -->
                <div class="mt-auto pt-6 border-t border-slate-200/80">
                    <button onclick="addToInquiry(<?php echo $product['id']; ?>)" 
                            class="group relative w-full bg-emerald-700 text-white py-4 rounded-2xl font-black uppercase tracking-wider text-xs transition-all duration-300 shadow-md shadow-emerald-700/20 hover:bg-emerald-800 active:scale-[0.98] cursor-pointer flex items-center justify-center gap-3">
                        <i class="fas fa-shopping-basket text-base"></i> Add to Inquiry List
                    </button>
                    <p class="text-center text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-3">
                        Direct Factory Wholesale &bull; Global Export Available
                    </p>
                </div>

            </div>

        </div>
    </div>
</section>

<script>
    function changeImg(src, elem) {
        document.getElementById('main-display-img').src = src;
        document.querySelectorAll('.thumbnail-item').forEach(el => {
            el.className = 'w-20 h-20 shrink-0 bg-white border border-slate-200 rounded-2xl overflow-hidden cursor-pointer hover:border-emerald-500 transition-all duration-300 thumbnail-item p-1';
        });
        elem.className = 'w-20 h-20 shrink-0 bg-white border-2 border-emerald-600 rounded-2xl overflow-hidden cursor-pointer transition-all duration-300 thumbnail-item shadow-sm p-1';
    }
</script>