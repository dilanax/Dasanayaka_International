<?php
/**
 * Red Runner - Inquiry Basket & Bulk Order Quote Request
 * Path: views/inquiry-list.php
 */

// 1. Remove Item Logic
if (isset($_GET['remove'])) {
    $id_to_remove = intval($_GET['remove']);
    if (isset($_SESSION['inquiry_cart'])) {
        if (($key = array_search($id_to_remove, $_SESSION['inquiry_cart'])) !== false) {
            unset($_SESSION['inquiry_cart'][$key]);
            $_SESSION['inquiry_cart'] = array_values($_SESSION['inquiry_cart']);
        }
    }
    echo "<script>window.location.href='index.php?page=inquiry-list&msg=Item Removed';</script>";
    exit();
}

// 2. Submission Logic
$success_msg = null;
$error_msg = null;

if (isset($_POST['submit_inquiry'])) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $whatsapp = htmlspecialchars($_POST['whatsapp']);
    $company = htmlspecialchars($_POST['company']);
    $urgency = htmlspecialchars($_POST['urgency']);
    $note = htmlspecialchars($_POST['note']);

    if (!empty($_SESSION['inquiry_cart'])) {
        try {
            $conn->beginTransaction();

            $stmt = $conn->prepare("INSERT INTO inquiries (name, phone, whatsapp, company, urgency, order_note, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')");
            $stmt->execute([$name, $phone, $whatsapp, $company, $urgency, $note]);
            $inquiry_id = $conn->lastInsertId();

            $stmtItem = $conn->prepare("INSERT INTO inquiry_items (inquiry_id, product_id) VALUES (?, ?)");
            foreach ($_SESSION['inquiry_cart'] as $p_id) {
                $stmtItem->execute([$inquiry_id, $p_id]);
            }

            $conn->commit();
            unset($_SESSION['inquiry_cart']);
            $success_msg = "Your factory inquiry has been submitted! Our production team will contact you via WhatsApp / Phone shortly.";
        } catch (Exception $e) {
            $conn->rollBack();
            $error_msg = "Something went wrong processing your inquiry. Please contact factory sales directly.";
        }
    } else {
        $error_msg = "Your inquiry basket is empty.";
    }
}
?>

<section class="py-20 bg-black min-h-screen text-white select-none">
    <div class="container mx-auto px-6">
        
        <div class="mb-12">
            <div class="inline-flex items-center gap-2 bg-red-600/10 border border-red-600/20 px-3.5 py-1.5 rounded-full mb-3">
                <span class="text-red-500 text-[10px] font-black uppercase tracking-[3px]">Bulk Orders</span>
            </div>
            <h2 class="text-4xl font-black text-white tracking-tighter uppercase">Inquiry Basket</h2>
            <p class="text-zinc-400 mt-2">Review your selected knitwear lines and submit your specifications for bulk quotations.</p>
        </div>

        <?php if($success_msg): ?>
            <div class="max-w-2xl mx-auto bg-zinc-950 p-12 rounded-[40px] shadow-2xl shadow-red-600/10 text-center border border-zinc-900">
                <div class="w-20 h-20 bg-red-600/10 border border-red-600/30 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fas fa-check-double"></i>
                </div>
                <h3 class="text-3xl font-black text-white mb-4">Inquiry Received!</h3>
                <p class="text-zinc-400 mb-8 leading-relaxed"><?php echo $success_msg; ?></p>
                <a href="index.php?page=shop" class="inline-block bg-red-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-red-700 transition shadow-xl shadow-red-600/25 uppercase text-sm tracking-widest">Return to Catalog</a>
            </div>

        <?php elseif(empty($_SESSION['inquiry_cart'])): ?>
            <div class="max-w-4xl mx-auto py-20 bg-zinc-950 rounded-[50px] border border-zinc-900 text-center px-6">
                <div class="relative w-32 h-32 mx-auto mb-8">
                    <div class="absolute inset-0 bg-red-600/10 rounded-full animate-ping opacity-30"></div>
                    <div class="relative w-full h-full bg-zinc-900 border border-zinc-800 rounded-full flex items-center justify-center text-zinc-600 text-5xl">
                        <i class="fa-solid fa-socks"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-black text-white mb-3 uppercase tracking-tight">Your inquiry basket is empty</h3>
                <p class="text-zinc-500 mb-10 max-w-sm mx-auto font-medium">Add socks and knitwear products from our catalog to request bulk pricing, color swatches, and custom cresting.</p>
                <a href="index.php?page=shop" class="inline-flex items-center gap-3 bg-red-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-red-700 transition shadow-xl shadow-red-600/20 uppercase text-xs tracking-widest">
                    Explore Knitwear <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                
                <!-- Selected Products List -->
                <div class="lg:col-span-2 space-y-4">
                    <?php
                    $ids = implode(',', array_map('intval', $_SESSION['inquiry_cart']));
                    $products = $conn->query("SELECT * FROM products WHERE id IN ($ids)")->fetchAll();

                    foreach($products as $p): ?>
                        <div class="group bg-zinc-950 p-6 rounded-[32px] border border-zinc-900 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm hover:border-red-600/30 transition-all duration-300">
                            <div class="flex items-center gap-6 w-full">
                                <div class="h-24 w-24 rounded-2xl overflow-hidden bg-black border border-zinc-900 shrink-0 flex items-center justify-center">
                                    <?php if (!empty($p['main_image']) && file_exists('assets/images/products/' . $p['main_image'])): ?>
                                        <img src="assets/images/products/<?php echo $p['main_image']; ?>" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                                    <?php else: ?>
                                        <i class="fa-solid fa-socks text-4xl text-zinc-800 group-hover:text-red-600 transition"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <span class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-1 block">Red Runner Knit</span>
                                    <h4 class="font-bold text-white text-xl tracking-tight leading-tight"><?php echo htmlspecialchars($p['title']); ?></h4>
                                    <div class="flex items-center gap-4 mt-2">
                                        <p class="text-sm font-black text-zinc-300"><?php echo htmlspecialchars($p['price_range']); ?></p>
                                        <?php if (!empty($p['min_qty'])): ?>
                                            <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-widest bg-zinc-900 px-2 py-1 rounded-md border border-zinc-800">MOQ: <?php echo htmlspecialchars($p['min_qty']); ?> Pairs</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?page=inquiry-list&remove=<?php echo $p['id']; ?>" class="h-12 w-12 bg-zinc-900 border border-zinc-800 text-zinc-400 rounded-2xl flex items-center justify-center hover:bg-red-600 hover:text-white hover:border-red-600 transition-all shadow-sm shrink-0" title="Remove from list">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Inquiry Form Panel -->
                <div class="lg:col-span-1">
                    <div class="bg-zinc-950 p-8 rounded-[36px] text-white shadow-2xl h-fit sticky top-28 border border-zinc-900">
                        <h3 class="text-xl font-bold mb-8 flex items-center">
                            <span class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center mr-3 text-xs text-white">
                                <i class="fas fa-paper-plane"></i>
                            </span> 
                            Submit Specifications
                        </h3>
                        
                        <form method="POST" class="space-y-5">
                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-zinc-500 uppercase tracking-[2px] block px-1">Full Name</label>
                                <input type="text" name="name" placeholder="Contact Name" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition text-sm text-white placeholder:text-zinc-600" required>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-bold text-zinc-500 uppercase tracking-[2px] block px-1">Phone</label>
                                    <input type="text" name="phone" placeholder="07x xxx xxxx" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition text-sm text-white placeholder:text-zinc-600" required>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-bold text-zinc-500 uppercase tracking-[2px] block px-1">WhatsApp</label>
                                    <input type="text" name="whatsapp" placeholder="Optional" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition text-sm text-white placeholder:text-zinc-600">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-zinc-500 uppercase tracking-[2px] block px-1">School / Company / Brand</label>
                                <input type="text" name="company" placeholder="Institution or Brand Name" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition text-sm text-white placeholder:text-zinc-600">
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-zinc-500 uppercase tracking-[2px] block px-1">Order Urgency</label>
                                <div class="relative">
                                    <select name="urgency" class="w-full bg-black border border-zinc-800 p-4 rounded-2xl outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition appearance-none text-sm text-white cursor-pointer">
                                        <option value="Standard" class="bg-zinc-900">Standard Timeline (1 - 2 Weeks)</option>
                                        <option value="Urgent" class="bg-zinc-900">Priority Production (Within 7 Days)</option>
                                        <option value="Planning" class="bg-zinc-900">Future Production Planning</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-5 text-zinc-600 pointer-events-none text-xs"></i>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-bold text-zinc-500 uppercase tracking-[2px] block px-1">Custom Requirements</label>
                                <textarea name="note" placeholder="Provide sizing breakdown, target quantities, monogram embroidery details, or yarn specifications..." class="w-full bg-black border border-zinc-800 p-4 rounded-2xl h-28 outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition resize-none text-sm text-white placeholder:text-zinc-600"></textarea>
                            </div>

                            <button name="submit_inquiry" type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all duration-300 shadow-xl shadow-red-600/30 active:scale-95 mt-4 flex items-center justify-center gap-2">
                                <span>Request Quotation</span>
                                <i class="fas fa-paper-plane text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </div>
</section>