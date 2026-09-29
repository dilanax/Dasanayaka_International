<?php
/**
 * Dasanayaka International - Inquiry Basket & Bulk Order Quote Request
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
            $success_msg = "Your inquiry has been submitted successfully! Our factory team will contact you via WhatsApp / Phone shortly.";
        } catch (Exception $e) {
            $conn->rollBack();
            $error_msg = "Something went wrong processing your inquiry. Please contact factory sales directly.";
        }
    } else {
        $error_msg = "Your inquiry basket is empty.";
    }
}
?>

<section class="py-16 md:py-24 bg-slate-50 min-h-screen text-slate-800 select-none">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="mb-12">
            <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200/80 px-4 py-1.5 rounded-full mb-3">
                <span class="text-emerald-700 text-[10px] font-black uppercase tracking-[2.5px]">Factory Direct Inquiry</span>
            </div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight uppercase">Inquiry Basket</h2>
            <p class="text-slate-600 mt-2 font-medium">Review your selected items and submit specifications for wholesale quotation.</p>
        </div>

        <?php if($success_msg): ?>
            <div class="max-w-2xl mx-auto bg-white p-10 rounded-3xl shadow-xl text-center border border-slate-200/80">
                <div class="w-20 h-20 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                    <i class="fas fa-check-double"></i>
                </div>
                <h3 class="text-3xl font-black text-slate-900 mb-4">Inquiry Received!</h3>
                <p class="text-slate-600 mb-8 leading-relaxed font-medium"><?php echo $success_msg; ?></p>
                <a href="index.php?page=shop" class="inline-block bg-emerald-700 text-white px-10 py-4 rounded-2xl font-black hover:bg-emerald-800 transition shadow-md uppercase text-xs tracking-wider">Return to Catalog</a>
            </div>

        <?php elseif(empty($_SESSION['inquiry_cart'])): ?>
            <div class="max-w-3xl mx-auto py-20 bg-white rounded-3xl border border-slate-200/80 text-center px-6 shadow-sm">
                <div class="w-24 h-24 bg-emerald-50 border border-emerald-100 rounded-full flex items-center justify-center text-emerald-700 text-4xl mx-auto mb-6">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-3 uppercase tracking-tight">Your inquiry basket is empty</h3>
                <p class="text-slate-500 mb-8 max-w-sm mx-auto font-medium text-sm">Explore our catalog to add wholesale products to your inquiry request.</p>
                <a href="index.php?page=shop" class="inline-flex items-center gap-3 bg-emerald-700 text-white px-8 py-4 rounded-2xl font-black hover:bg-emerald-800 transition shadow-md uppercase text-xs tracking-wider">
                    Explore Catalog <i class="fas fa-arrow-right text-[10px]"></i>
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
                        <div class="group bg-white p-6 rounded-3xl border border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm hover:border-emerald-400 transition-all duration-300">
                            <div class="flex items-center gap-6 w-full">
                                <div class="h-24 w-24 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 shrink-0 flex items-center justify-center p-2">
                                    <?php if (!empty($p['main_image']) && file_exists('assets/images/products/' . $p['main_image'])): ?>
                                        <img src="assets/images/products/<?php echo $p['main_image']; ?>" class="h-full w-full object-contain group-hover:scale-105 transition duration-500">
                                    <?php else: ?>
                                        <i class="fa-solid fa-box-open text-3xl text-slate-300 group-hover:text-emerald-700 transition"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <span class="text-[10px] font-black text-emerald-700 uppercase tracking-wider mb-1 block">Dasanayaka Line</span>
                                    <h4 class="font-extrabold text-slate-900 text-lg tracking-tight leading-tight"><?php echo htmlspecialchars($p['title']); ?></h4>
                                    <div class="flex items-center gap-4 mt-2">
                                        <p class="text-sm font-black text-amber-700"><?php echo htmlspecialchars($p['price_range']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?page=inquiry-list&remove=<?php echo $p['id']; ?>" class="h-11 w-11 bg-slate-100 border border-slate-200 text-slate-400 rounded-xl flex items-center justify-center hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all shadow-sm shrink-0" title="Remove item">
                                <i class="fas fa-trash-alt text-sm"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Inquiry Form Panel -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-3xl text-slate-900 shadow-sm border border-slate-200/80 sticky top-28">
                        <h3 class="text-lg font-black uppercase tracking-tight mb-6 flex items-center text-slate-900">
                            <span class="w-8 h-8 bg-emerald-700 rounded-xl flex items-center justify-center mr-3 text-xs text-white shadow-sm">
                                <i class="fas fa-paper-plane"></i>
                            </span> 
                            Submit Specifications
                        </h3>
                        
                        <form method="POST" class="space-y-4">
                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider block px-1">Full Name</label>
                                <input type="text" name="name" placeholder="Contact Name" class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition text-sm text-slate-900 placeholder:text-slate-400" required>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider block px-1">Phone</label>
                                    <input type="text" name="phone" placeholder="07x xxx xxxx" class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition text-sm text-slate-900 placeholder:text-slate-400" required>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider block px-1">WhatsApp</label>
                                    <input type="text" name="whatsapp" placeholder="Optional" class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition text-sm text-slate-900 placeholder:text-slate-400">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider block px-1">Company / Institution</label>
                                <input type="text" name="company" placeholder="Company Name" class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition text-sm text-slate-900 placeholder:text-slate-400">
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider block px-1">Urgency</label>
                                <select name="urgency" class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition text-sm text-slate-900 cursor-pointer">
                                    <option>Standard Order (1-2 Weeks)</option>
                                    <option>Urgent Dispatch (3-5 Days)</option>
                                    <option>Sample Request Only</option>
                                </select>
                            </div>

                            <div class="space-y-1">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider block px-1">Special Instructions</label>
                                <textarea name="note" rows="3" placeholder="Quantities, custom branding details..." class="w-full bg-slate-50 border border-slate-200 p-3.5 rounded-xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition text-sm text-slate-900 placeholder:text-slate-400 resize-none"></textarea>
                            </div>

                            <button type="submit" name="submit_inquiry" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-black text-xs uppercase tracking-widest py-4 rounded-2xl transition-all shadow-md shadow-emerald-700/20 active:scale-95 cursor-pointer flex items-center justify-center gap-2">
                                Send Inquiry <i class="fas fa-paper-plane text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </div>
</section>