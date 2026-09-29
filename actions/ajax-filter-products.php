<?php
/**
 * Dasanayaka International - AJAX Filter Products Endpoint (Light Theme)
 * Path: actions/ajax-filter-products.php
 */

require_once(__DIR__ . '/../db/db.php');

$category = isset($_GET['category']) && !empty($_GET['category']) ? intval($_GET['category']) : null;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 12;
$offset = ($page - 1) * $limit;

$where = ["1=1"];
$params = [];

if ($category) {
    $where[] = "p.cat_id = ?";
    $params[] = $category;
}

if (!empty($search)) {
    $where[] = "(p.title LIKE ? OR p.description LIKE ? OR c.title LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$orderBy = "p.id DESC";
if ($sort === 'price_low') {
    $orderBy = "CAST(SUBSTRING_INDEX(p.price_range, '-', 1) AS UNSIGNED) ASC, p.id DESC";
} elseif ($sort === 'price_high') {
    $orderBy = "CAST(SUBSTRING_INDEX(p.price_range, '-', -1) AS UNSIGNED) DESC, p.id DESC";
}

$whereSql = implode(" AND ", $where);

// Total Count
$countStmt = $conn->prepare("SELECT COUNT(p.id) FROM products p LEFT JOIN categories c ON p.cat_id = c.id WHERE $whereSql");
$countStmt->execute($params);
$totalProducts = $countStmt->fetchColumn();

// Fetch Data
$query = "SELECT p.*, c.title AS cat_title 
          FROM products p 
          LEFT JOIN categories c ON p.cat_id = c.id 
          WHERE $whereSql 
          ORDER BY $orderBy 
          LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$html = '';

foreach ($products as $p) {
    $title = htmlspecialchars($p['title']);
    $catTitle = htmlspecialchars($p['cat_title'] ?? 'Dasanayaka');
    $price = htmlspecialchars($p['price_range'] ?? 'Contact for price');
    $id = intval($p['id']);
    
    $imgSrc = 'assets/images/products/' . $p['main_image'];
    $imgFallback = "https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?q=80&w=600&auto=format&fit=crop";

    $html .= '
    <div class="product-card group bg-white rounded-3xl border border-slate-200/80 p-4 flex flex-col justify-between hover:border-emerald-400 hover:shadow-xl hover:shadow-emerald-950/5 relative overflow-hidden transition-all duration-300">
        <div>
            <!-- Image Area -->
            <a href="index.php?page=product-details&id=' . $id . '" class="block relative aspect-square rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 mb-4 flex items-center justify-center">
                <img src="' . $imgSrc . '" 
                     alt="' . $title . '" 
                     class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500 ease-out" 
                     onerror="this.onerror=null; this.src=\'' . $imgFallback . '\';">
                
                <!-- Category Floating Badge -->
                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-md px-3 py-1 rounded-xl border border-slate-200 shadow-sm pointer-events-none">
                    <span class="text-[9px] font-black text-emerald-800 uppercase tracking-wider">' . $catTitle . '</span>
                </div>
            </a>

            <!-- Content Area -->
            <div class="px-1">
                <a href="index.php?page=product-details&id=' . $id . '" class="block mb-2">
                    <h3 class="text-xs md:text-sm font-extrabold text-slate-900 uppercase tracking-tight line-clamp-2 leading-snug group-hover:text-emerald-700 transition-colors">
                        ' . $title . '
                    </h3>
                </a>
            </div>
        </div>

        <!-- Bottom Price & Actions Row -->
        <div class="pt-3 border-t border-slate-100 px-1 flex items-center justify-between gap-2 mt-2">
            <div>
                <span class="text-[8px] md:text-[9px] font-black uppercase tracking-widest text-slate-400 block leading-none mb-1">Wholesale</span>
                <span class="text-xs md:text-sm font-black text-amber-700 tracking-tight">' . $price . '</span>
            </div>

            <div class="flex items-center gap-1.5">
                <!-- Add To Inquiry Button -->
                <button type="button" 
                        onclick="addToInquiry(' . $id . ')" 
                        title="Add to Inquiry Basket"
                        class="w-9 h-9 rounded-xl bg-emerald-700 text-white hover:bg-emerald-800 flex items-center justify-center transition-all duration-300 active:scale-95 shadow-md shadow-emerald-700/20 cursor-pointer">
                    <i class="fa-solid fa-cart-plus text-xs"></i>
                </button>
                
                <!-- View Details -->
                <a href="index.php?page=product-details&id=' . $id . '" 
                   title="View Specs"
                   class="w-9 h-9 rounded-xl bg-slate-100 border border-slate-200 text-slate-600 hover:text-slate-900 hover:bg-slate-200 flex items-center justify-center transition-all duration-300">
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    ';
}

$hasMore = ($offset + $limit) < $totalProducts;

header('Content-Type: application/json');
echo json_encode([
    'html' => $html,
    'hasMore' => $hasMore,
    'total' => $totalProducts
]);
exit();