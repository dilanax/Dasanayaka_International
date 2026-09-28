<?php
/**
 * Red Runner Admin - Product Management (Full Width, Pure Dark Theme, SweetAlert2 Confirmation & Real-time Search)
 * Path: PraBaK/products.php
 */

$msg = "";

// --- DELETE GALLERY IMAGE ---
if (isset($_GET['del_gal_img'])) {
    $img_id = intval($_GET['del_gal_img']);
    $prod_id = intval($_GET['p_id']);
    
    $stmt = $conn->prepare("SELECT image_name FROM product_images WHERE id = ?");
    $stmt->execute([$img_id]);
    $img = $stmt->fetch();
    
    if ($img) {
        $file_path = "../assets/images/products/gallery/" . $img['image_name'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        $conn->prepare("DELETE FROM product_images WHERE id = ?")->execute([$img_id]);
        
        echo "<script>window.location.href='?page=products&edit=$prod_id&msg=Gallery image removed';</script>";
        exit();
    }
}

// --- DELETE PRODUCT ---
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("SELECT main_image FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $prod = $stmt->fetch();
    
    if ($prod) {
        if (!empty($prod['main_image']) && file_exists("../assets/images/products/" . $prod['main_image'])) {
            unlink("../assets/images/products/" . $prod['main_image']);
        }
        
        $stmtG = $conn->prepare("SELECT image_name FROM product_images WHERE product_id = ?");
        $stmtG->execute([$id]);
        $gallery = $stmtG->fetchAll();
        foreach($gallery as $g) {
            $g_path = "../assets/images/products/gallery/" . $g['image_name'];
            if (file_exists($g_path)) {
                unlink($g_path);
            }
        }
        
        $conn->prepare("DELETE FROM product_images WHERE product_id = ?")->execute([$id]);
        $conn->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
        
        echo "<script>window.location.href='?page=products&msg=Product permanently deleted';</script>";
        exit();
    }
}

// --- ADD / UPDATE LOGIC ---
if (isset($_POST['save_product'])) {
    $title = htmlspecialchars($_POST['title']);
    $cat_id = intval($_POST['cat_id']);
    $brand_id = !empty($_POST['brand_id']) ? intval($_POST['brand_id']) : null;
    $short_desc = htmlspecialchars($_POST['short_desc']);
    $long_desc = htmlspecialchars($_POST['long_desc']);
    $price_range = htmlspecialchars($_POST['price_range']);
    $min_qty = intval($_POST['min_qty']);
    $warranty = htmlspecialchars($_POST['warranty']);
    
    // Main Image
    $image = $_FILES['main_image']['name'] ?? '';
    if (!empty($image)) {
        $clean_img = preg_replace('/[^a-zA-Z0-9._-]/', '', str_replace(' ', '_', $image));
        $image_name = time() . "_" . $clean_img;
        
        if (!file_exists('../assets/images/products/')) {
            mkdir('../assets/images/products/', 0777, true);
        }
        
        move_uploaded_file($_FILES['main_image']['tmp_name'], "../assets/images/products/" . $image_name);
        
        if (!empty($_POST['old_image']) && file_exists("../assets/images/products/" . $_POST['old_image'])) {
            unlink("../assets/images/products/" . $_POST['old_image']);
        }
    } else {
        $image_name = $_POST['old_image'] ?? '';
    }

    if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        $sql = "UPDATE products SET cat_id=?, brand_id=?, title=?, main_image=?, short_desc=?, long_desc=?, price_range=?, min_qty=?, warranty_status=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cat_id, $brand_id, $title, $image_name, $short_desc, $long_desc, $price_range, $min_qty, $warranty, $product_id]);
        $msg = "Product updated successfully!";
    } else {
        $sql = "INSERT INTO products (cat_id, brand_id, title, main_image, short_desc, long_desc, price_range, min_qty, warranty_status) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cat_id, $brand_id, $title, $image_name, $short_desc, $long_desc, $price_range, $min_qty, $warranty]);
        $product_id = $conn->lastInsertId();
        $msg = "Product added successfully!";
    }

    // Gallery Uploads
    if (!empty($_FILES['gallery_images']['name'][0])) {
        if (!file_exists('../assets/images/products/gallery/')) { 
            mkdir('../assets/images/products/gallery/', 0777, true); 
        }
        foreach ($_FILES['gallery_images']['tmp_name'] as $key => $tmp_name) {
            if(!empty($tmp_name)) {
                $g_image_orig = preg_replace('/[^a-zA-Z0-9._-]/', '', str_replace(' ', '_', $_FILES['gallery_images']['name'][$key]));
                $g_image_name = time() . "_" . $key . "_" . $g_image_orig;
                $g_target = "../assets/images/products/gallery/" . $g_image_name;
                
                if (move_uploaded_file($tmp_name, $g_target)) {
                    $conn->prepare("INSERT INTO product_images (product_id, image_name) VALUES (?, ?)")->execute([$product_id, $g_image_name]);
                }
            }
        }
    }
    echo "<script>window.location.href='?page=products&msg=$msg';</script>";
    exit();
}

// Data Fetching
$edit_data = null;
$gallery_data = [];
if (isset($_GET['edit'])) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([intval($_GET['edit'])]);
    $edit_data = $stmt->fetch();
    
    if ($edit_data) {
        $stmtG = $conn->prepare("SELECT * FROM product_images WHERE product_id = ?");
        $stmtG->execute([$edit_data['id']]);
        $gallery_data = $stmtG->fetchAll();
    }
}
$all_cats = $conn->query("SELECT * FROM categories ORDER BY title ASC")->fetchAll();
$all_brands = $conn->query("SELECT * FROM brands ORDER BY name ASC")->fetchAll();
$products = $conn->query("SELECT p.*, c.title as cat_title, b.name as brand_name FROM products p LEFT JOIN categories c ON p.cat_id = c.id LEFT JOIN brands b ON p.brand_id = b.id ORDER BY p.id DESC")->fetchAll();
?>

<!-- SweetAlert2 Library Fallback -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="w-full space-y-8 select-none pb-12">
    
    <!-- Onboarding / Edit Form Container -->
    <div class="bg-zinc-950 p-6 sm:p-10 rounded-[36px] border border-zinc-900 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-80 h-80 bg-red-600/10 blur-[130px] rounded-full pointer-events-none"></div>
        
        <div class="flex items-center justify-between gap-4 mb-8 border-b border-zinc-900 pb-6">
            <h2 class="text-xl sm:text-2xl font-black text-white flex items-center gap-3.5 tracking-tight uppercase">
                <div class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-red-600/30">
                    <i class="fas <?php echo $edit_data ? 'fa-pen-to-square' : 'fa-socks'; ?> text-base"></i>
                </div>
                <span><?php echo $edit_data ? 'Edit Product Item' : 'Add New Knitwear Product'; ?></span>
            </h2>

            <?php if($edit_data): ?>
                <a href="?page=products" class="text-xs font-black uppercase tracking-widest text-zinc-400 hover:text-red-500 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Cancel Edit
                </a>
            <?php endif; ?>
        </div>

        <?php if(isset($_GET['msg'])): ?>
            <div class="bg-zinc-900 border-l-4 border-red-600 p-4 mb-8 rounded-r-2xl border border-zinc-800 shadow-md flex items-center gap-3">
                <i class="fas fa-check-circle text-red-500"></i>
                <p class="text-zinc-200 font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($_GET['msg']); ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-10">
            <input type="hidden" name="product_id" value="<?php echo $edit_data['id'] ?? ''; ?>">
            <input type="hidden" name="old_image" value="<?php echo $edit_data['main_image'] ?? ''; ?>">

            <!-- Main Form Content -->
            <div class="lg:col-span-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Product Title</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($edit_data['title'] ?? ''); ?>" placeholder="e.g. Classic School White Socks, Executive Gents Cotton" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl focus:border-red-600 focus:ring-1 focus:ring-red-600 outline-none transition font-semibold text-white placeholder:text-zinc-700 text-sm" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Category</label>
                            <select name="cat_id" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl outline-none font-semibold text-xs text-white focus:border-red-600 cursor-pointer" required>
                                <option value="" class="bg-zinc-900 text-zinc-400">Select Category</option>
                                <?php foreach($all_cats as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" class="bg-zinc-900" <?php echo (isset($edit_data['cat_id']) && $edit_data['cat_id'] == $c['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($c['title']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Brand</label>
                            <select name="brand_id" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl outline-none font-semibold text-xs text-white focus:border-red-600 cursor-pointer">
                                <option value="" class="bg-zinc-900 text-zinc-400">Default (Red Runner)</option>
                                <?php foreach($all_brands as $b): ?>
                                    <option value="<?php echo $b['id']; ?>" class="bg-zinc-900" <?php echo (isset($edit_data['brand_id']) && $edit_data['brand_id'] == $b['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($b['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Short Feature Highlights</label>
                    <textarea name="short_desc" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl h-24 outline-none resize-none font-medium text-sm text-white focus:border-red-600 placeholder:text-zinc-700" placeholder="Highlight knit style, elastic properties, seamless toes, fabric composition..."><?php echo htmlspecialchars($edit_data['short_desc'] ?? ''); ?></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest ml-1">Technical Overview / Full Description</label>
                    <textarea name="long_desc" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl h-40 outline-none font-medium text-sm text-white focus:border-red-600 placeholder:text-zinc-700" placeholder="Provide complete technical knit details, needle gauges, wash instructions, and yarn specifications..."><?php echo htmlspecialchars($edit_data['long_desc'] ?? ''); ?></textarea>
                </div>
            </div>

            <!-- Media & Pricing Side Column -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Image Management Card -->
                <div class="p-6 bg-black border border-zinc-800 rounded-3xl space-y-4">
                    <label class="text-[10px] font-black text-white uppercase tracking-widest block border-b border-zinc-800 pb-2">Hero / Main Image</label>
                    
                    <?php if(!empty($edit_data['main_image'])): ?>
                        <div class="relative group aspect-square rounded-2xl overflow-hidden border border-zinc-800 bg-zinc-950 flex items-center justify-center">
                            <img src="../assets/images/products/<?php echo $edit_data['main_image']; ?>" class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>
                    
                    <input type="file" name="main_image" accept="image/*" class="text-xs text-zinc-400 w-full file:bg-zinc-900 file:text-white file:border-0 file:rounded-xl file:px-4 file:py-2.5 file:font-black file:uppercase file:text-[9px] hover:file:bg-red-600 file:transition cursor-pointer">

                    <label class="text-[10px] font-black text-white uppercase tracking-widest block pt-4 border-b border-zinc-800 pb-2">Gallery Assets (Multiple)</label>
                    <input type="file" name="gallery_images[]" multiple accept="image/*" class="text-xs text-zinc-400 w-full file:bg-zinc-900 file:text-white file:border-0 file:rounded-xl file:px-4 file:py-2.5 file:font-black file:uppercase file:text-[9px] hover:file:bg-red-600 file:transition cursor-pointer mb-2">
                    
                    <?php if(!empty($gallery_data)): ?>
                    <div class="grid grid-cols-3 gap-2.5 pt-2">
                        <?php foreach($gallery_data as $img): ?>
                            <div class="relative group aspect-square rounded-xl overflow-hidden border border-zinc-800 bg-zinc-950">
                                <img src="../assets/images/products/gallery/<?php echo $img['image_name']; ?>" class="w-full h-full object-cover">
                                <a href="?page=products&p_id=<?php echo $edit_data['id']; ?>&del_gal_img=<?php echo $img['id']; ?>" 
                                   class="absolute inset-0 flex items-center justify-center bg-red-600/90 text-white opacity-0 group-hover:opacity-100 transition duration-200"
                                   onclick="return confirm('Permanently remove this gallery image?')">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Commercial Pricing Card -->
                <div class="p-6 bg-zinc-900 border border-zinc-800 rounded-3xl space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-red-500 uppercase tracking-widest leading-none">Wholesale Pricing Range</label>
                        <input type="text" name="price_range" value="<?php echo htmlspecialchars($edit_data['price_range'] ?? ''); ?>" placeholder="e.g. LKR 250 - 320 / Pair" class="w-full bg-black border border-zinc-800 p-3 rounded-xl outline-none font-bold text-sm text-white focus:border-red-600" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black text-zinc-400 uppercase tracking-widest leading-none">Min Order (MOQ)</label>
                            <input type="number" name="min_qty" value="<?php echo htmlspecialchars($edit_data['min_qty'] ?? '50'); ?>" class="w-full bg-black border border-zinc-800 p-3 rounded-xl outline-none font-bold text-sm text-white focus:border-red-600" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black text-zinc-400 uppercase tracking-widest leading-none">Quality Assurance</label>
                            <input type="text" name="warranty" value="<?php echo htmlspecialchars($edit_data['warranty_status'] ?? 'Factory Tested'); ?>" placeholder="Tested" class="w-full bg-black border border-zinc-800 p-3 rounded-xl outline-none font-bold text-sm text-white focus:border-red-600">
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button name="save_product" type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all shadow-xl shadow-red-600/30 active:scale-95 flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fas fa-save text-sm"></i>
                        <span><?php echo $edit_data ? 'Update Product' : 'Save & Publish Product'; ?></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Inventory Table Container (Full Width) -->
    <div class="bg-zinc-950 rounded-[36px] border border-zinc-900 shadow-2xl overflow-hidden">
        
        <div class="p-6 sm:p-8 border-b border-zinc-900 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-black/40">
            <div>
                <h3 class="font-black text-white uppercase tracking-tight text-sm sm:text-base">Knitwear Inventory</h3>
                <span class="bg-zinc-900 border border-zinc-800 text-zinc-400 text-[10px] font-black px-3.5 py-1 rounded-xl uppercase mt-1 inline-block" id="productCount"><?php echo count($products); ?> Records</span>
            </div>
            
            <div class="relative w-full md:w-80 group">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500 group-focus-within:text-red-500 transition-colors"></i>
                <input type="text" id="productSearch" onkeyup="filterProducts()" placeholder="Search product title, category, brand..." 
                       class="w-full bg-black border border-zinc-800 py-3 pl-11 pr-4 rounded-2xl outline-none focus:border-red-600 transition-all text-xs font-semibold text-white placeholder:text-zinc-600 shadow-inner">
            </div>
        </div>

        <!-- Desktop View Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left" id="desktopTable">
                <thead class="bg-black/60 text-zinc-500 text-[10px] uppercase tracking-[2px] font-black border-b border-zinc-900">
                    <tr>
                        <th class="p-6">Product Details</th>
                        <th class="p-6">Classification</th>
                        <th class="p-6">Wholesale Specs</th>
                        <th class="p-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900">
                    <?php foreach($products as $p): ?>
                    <tr class="hover:bg-zinc-900/30 transition group product-item" data-search="<?php echo strtolower(htmlspecialchars($p['title'] . ' ' . ($p['brand_name'] ?? '') . ' ' . ($p['cat_title'] ?? ''))); ?>">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-black border border-zinc-800 rounded-2xl overflow-hidden shrink-0 flex items-center justify-center">
                                    <?php if(!empty($p['main_image']) && file_exists('../assets/images/products/' . $p['main_image'])): ?>
                                        <img src="../assets/images/products/<?php echo $p['main_image']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition">
                                    <?php else: ?>
                                        <i class="fa-solid fa-socks text-2xl text-zinc-700"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="min-w-0">
                                    <span class="block font-bold text-white text-sm leading-tight truncate group-hover:text-red-500 transition-colors"><?php echo htmlspecialchars($p['title']); ?></span>
                                    <span class="text-[9px] font-black text-red-500 uppercase tracking-widest">ID #<?php echo $p['id']; ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="p-6">
                            <span class="inline-block bg-black border border-zinc-800 text-zinc-300 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider"><?php echo htmlspecialchars($p['cat_title'] ?? 'Uncategorized'); ?></span>
                            <?php if(!empty($p['brand_name'])): ?>
                                <p class="text-zinc-500 text-[10px] font-bold mt-1 uppercase tracking-wider"><?php echo htmlspecialchars($p['brand_name']); ?></p>
                            <?php endif; ?>
                        </td>
                        <td class="p-6">
                            <span class="block font-black text-white text-sm tracking-tight"><?php echo htmlspecialchars($p['price_range']); ?></span>
                            <span class="text-[10px] text-zinc-500 font-bold uppercase tracking-wider">MOQ: <?php echo htmlspecialchars($p['min_qty']); ?> &bull; <?php echo htmlspecialchars($p['warranty_status']); ?></span>
                        </td>
                        <td class="p-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="?page=products&edit=<?php echo $p['id']; ?>" class="w-9 h-9 bg-black border border-zinc-800 text-zinc-300 hover:text-white hover:bg-zinc-800 rounded-xl flex items-center justify-center transition shadow-sm" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <button type="button" 
                                        onclick="confirmProductDelete(<?php echo $p['id']; ?>, '<?php echo addslashes(htmlspecialchars($p['title'])); ?>')" 
                                        class="w-9 h-9 bg-black border border-zinc-800 text-zinc-500 hover:text-white hover:bg-red-600 hover:border-red-600 rounded-xl flex items-center justify-center transition shadow-sm cursor-pointer" 
                                        title="Delete">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile View Cards -->
        <div class="md:hidden divide-y divide-zinc-900" id="mobileCards">
            <?php foreach($products as $p): ?>
            <div class="p-4 space-y-4 product-item" data-search="<?php echo strtolower(htmlspecialchars($p['title'] . ' ' . ($p['brand_name'] ?? '') . ' ' . ($p['cat_title'] ?? ''))); ?>">
                <div class="flex gap-4 items-center">
                    <div class="w-16 h-16 bg-black border border-zinc-800 rounded-2xl overflow-hidden shrink-0 flex items-center justify-center">
                        <?php if(!empty($p['main_image']) && file_exists('../assets/images/products/' . $p['main_image'])): ?>
                            <img src="../assets/images/products/<?php echo $p['main_image']; ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <i class="fa-solid fa-socks text-2xl text-zinc-700"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="block font-bold text-white text-sm truncate"><?php echo htmlspecialchars($p['title']); ?></span>
                        <div class="flex gap-2 mt-1">
                            <span class="text-[9px] font-black bg-black border border-zinc-800 px-2.5 py-0.5 rounded-lg text-zinc-400 uppercase tracking-wider"><?php echo htmlspecialchars($p['cat_title'] ?? 'Uncategorized'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="bg-black border border-zinc-900 p-3 rounded-2xl flex justify-between items-center">
                    <div>
                        <p class="text-[9px] text-zinc-500 font-black uppercase tracking-widest leading-none">Rate</p>
                        <p class="text-xs font-black text-white leading-none mt-1"><?php echo htmlspecialchars($p['price_range']); ?></p>
                    </div>
                    <div class="flex gap-2">
                        <a href="?page=products&edit=<?php echo $p['id']; ?>" class="w-9 h-9 bg-zinc-900 border border-zinc-800 text-zinc-300 rounded-xl flex items-center justify-center"><i class="fas fa-edit text-xs"></i></a>
                        <button type="button" onclick="confirmProductDelete(<?php echo $p['id']; ?>, '<?php echo addslashes(htmlspecialchars($p['title'])); ?>')" class="w-9 h-9 bg-zinc-900 border border-zinc-800 text-zinc-500 hover:text-red-500 rounded-xl flex items-center justify-center"><i class="fas fa-trash-alt text-xs"></i></button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div id="noResults" class="hidden py-16 text-center bg-black/40">
            <div class="w-16 h-16 bg-zinc-900 text-zinc-600 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fas fa-search-minus"></i>
            </div>
            <h4 class="text-base font-black text-white tracking-tight uppercase">No products match search</h4>
            <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-500 mt-1">Refine your keywords or catalog filters.</p>
        </div>
        
    </div>
</div>

<script>
// --- SweetAlert2 Delete Confirmation ---
function confirmProductDelete(id, title) {
    Swal.fire({
        title: '<span class="text-white text-lg font-black uppercase tracking-wider">Delete Product?</span>',
        text: `Are you sure you want to permanently remove "${title}" and all its gallery images?`,
        icon: 'warning',
        iconColor: '#dc2626',
        background: '#09090b',
        color: '#ffffff',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#27272a',
        customClass: {
            popup: 'rounded-3xl border border-zinc-800 shadow-2xl',
            confirmButton: 'rounded-xl font-black uppercase tracking-wider text-xs px-6 py-3',
            cancelButton: 'rounded-xl font-black uppercase tracking-wider text-xs px-6 py-3'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `?page=products&delete=${id}`;
        }
    });
}

// --- Real-time Search Filter Logic ---
function filterProducts() {
    const input = document.getElementById('productSearch').value.toLowerCase().trim();
    const items = document.querySelectorAll('.product-item');
    const noResults = document.getElementById('noResults');
    const productCountBadge = document.getElementById('productCount');
    let visibleCount = 0;

    items.forEach(item => {
        const searchData = item.getAttribute('data-search') || '';
        if (searchData.includes(input)) {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    const actualCount = Math.floor(visibleCount / 2);
    productCountBadge.innerText = actualCount + (actualCount === 1 ? ' Record' : ' Records');

    if (visibleCount === 0 && items.length > 0) {
        noResults.classList.remove('hidden');
        document.getElementById('desktopTable')?.classList.add('hidden');
    } else {
        noResults.classList.add('hidden');
        if (window.innerWidth >= 768) {
            document.getElementById('desktopTable')?.classList.remove('hidden');
        }
    }
}
</script>