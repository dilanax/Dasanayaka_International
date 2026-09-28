<?php
require_once('../db/db.php');

if (isset($_GET['q'])) {
    $q = "%" . $_GET['q'] . "%";
    $stmt = $conn->prepare("SELECT p.id, p.title, p.main_image, p.price_range, b.name as brand FROM products p JOIN brands b ON p.brand_id = b.id WHERE p.title LIKE ? OR b.name LIKE ? LIMIT 6");
    $stmt->execute([$q, $q]);
    $results = $stmt->fetchAll();

    if ($results) {
        foreach ($results as $row) {
            echo "
            <a href='index.php?page=product-details&id={$row['id']}' class='group flex items-center gap-5 p-3 pr-5 bg-slate-900/60 rounded-[24px] border border-white/5 hover:border-blue-500/50 hover:bg-slate-800 transition-all duration-300 shadow-xl'>
                
                <div class='h-20 w-20 rounded-[18px] bg-slate-800 overflow-hidden shrink-0 p-1 border border-white/5'>
                    <img src='assets/images/products/{$row['main_image']}' class='h-full w-full object-cover rounded-[14px] group-hover:scale-110 transition duration-500'>
                </div>
                
                <div class='flex-1 min-w-0'>
                    <span class='text-[9px] text-blue-400 font-black uppercase tracking-widest block mb-1'>{$row['brand']}</span>
                    <h4 class='text-white font-bold text-base truncate group-hover:text-blue-400 transition'>{$row['title']}</h4>
                    <p class='text-sm text-slate-300 font-bold mt-1'>{$row['price_range']}</p>
                </div>
                
                <div class='w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-all'>
                    <i class='fas fa-arrow-right text-xs'></i>
                </div>
                
            </a>";
        }
    } else {
        // Modern Empty State for No Results
        echo "
        <div class='col-span-full py-16 text-center border border-white/5 bg-slate-900/40 rounded-[30px]'>
            <i class='fas fa-search-minus text-4xl text-slate-600 mb-4'></i>
            <p class='text-slate-400 font-bold uppercase tracking-widest text-sm'>No products found matching your search.</p>
        </div>";
    }
}
?>