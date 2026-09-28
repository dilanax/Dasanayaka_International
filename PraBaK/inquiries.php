<?php
/**
 * Red Runner Admin - Factory Inquiry Management Hub (Full Width Pure Dark)
 * Path: PraBaK/inquiries.php
 */

// --- CSV EXPORT LOGIC ---
if (isset($_GET['export_csv'])) {
    $filename = "RedRunner_Inquiries_" . date('Ymd') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Date', 'Name', 'Company', 'Phone', 'WhatsApp', 'Urgency', 'Status', 'Note']);

    $query = "SELECT * FROM inquiries ORDER BY created_at DESC";
    $rows = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        fputcsv($output, [
            $row['id'], $row['created_at'], $row['name'], $row['company'], 
            $row['phone'], $row['whatsapp'], $row['urgency'], $row['status'], $row['order_note']
        ]);
    }
    fclose($output);
    exit();
}

// --- UPDATE STATUS LOGIC ---
if (isset($_POST['update_status'])) {
    $inq_id = $_POST['inquiry_id'];
    $new_status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE inquiries SET status = ? WHERE id = ?");
    if ($stmt->execute([$new_status, $inq_id])) {
        echo "<script>window.location.href='?page=inquiries&msg=Status Updated';</script>";
        exit();
    }
}

// --- DELETE INQUIRY ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->prepare("DELETE FROM inquiries WHERE id = ?")->execute([$id]);
    echo "<script>window.location.href='?page=inquiries&msg=Record Deleted';</script>";
    exit();
}

// --- ADVANCED MULTI-FILTER LOGIC ---
$conditions = [];
$params = [];

// 1. Date Range Filter
if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
    $conditions[] = "DATE(created_at) BETWEEN ? AND ?";
    $params[] = $_GET['start_date'];
    $params[] = $_GET['end_date'];
}

// 2. Urgency Filter
if (!empty($_GET['urgency_filter'])) {
    $conditions[] = "urgency = ?";
    $params[] = $_GET['urgency_filter'];
}

// 3. Status Filter
if (!empty($_GET['status_filter'])) {
    $conditions[] = "status = ?";
    $params[] = $_GET['status_filter'];
}

$where_clause = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";

$query = "SELECT * FROM inquiries $where_clause ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute($params);
$inquiries = $stmt->fetchAll();
?>

<div class="w-full space-y-6 sm:space-y-8 pb-12 select-none">
    
    <!-- Filter Bar Header -->
    <div class="bg-zinc-950 p-6 md:p-8 rounded-[32px] border border-zinc-900 shadow-2xl flex flex-col gap-6">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-red-600/30">
                        <i class="fas fa-filter text-xs"></i>
                    </div>
                    Factory Inquiries Hub
                </h2>
                <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-[2px] mt-1.5 ml-1">Knitwear Quotes & Lead Archive</p>
            </div>
            <a href="?page=inquiries&export_csv=true" class="bg-zinc-900 border border-zinc-800 text-zinc-200 hover:text-white hover:border-red-600 hover:bg-red-600 h-11 px-6 rounded-2xl text-[10px] font-black uppercase tracking-widest transition shadow-lg flex items-center gap-2">
                <i class="fas fa-file-csv text-emerald-400"></i> Export CSV
            </a>
        </div>

        <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3">
            <input type="hidden" name="page" value="inquiries">
            
            <div class="flex items-center bg-black border border-zinc-800 rounded-2xl px-4 py-2.5">
                <span class="text-[9px] font-black uppercase text-zinc-500 mr-2 border-r border-zinc-800 pr-2">Urgency</span>
                <select name="urgency_filter" class="bg-transparent outline-none text-xs font-bold text-zinc-300 w-full cursor-pointer">
                    <option value="" class="bg-zinc-900">All Levels</option>
                    <option value="Low" class="bg-zinc-900" <?php echo (isset($_GET['urgency_filter']) && $_GET['urgency_filter'] == 'Low') ? 'selected' : ''; ?>>Low / Standard</option>
                    <option value="Medium" class="bg-zinc-900" <?php echo (isset($_GET['urgency_filter']) && $_GET['urgency_filter'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                    <option value="High" class="bg-zinc-900" <?php echo (isset($_GET['urgency_filter']) && $_GET['urgency_filter'] == 'High') ? 'selected' : ''; ?>>High / Urgent</option>
                </select>
            </div>

            <div class="flex items-center bg-black border border-zinc-800 rounded-2xl px-4 py-2.5">
                <span class="text-[9px] font-black uppercase text-zinc-500 mr-2 border-r border-zinc-800 pr-2">Status</span>
                <select name="status_filter" class="bg-transparent outline-none text-xs font-bold text-zinc-300 w-full cursor-pointer">
                    <option value="" class="bg-zinc-900">All Status</option>
                    <option value="Pending" class="bg-zinc-900" <?php echo (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="Reviewed" class="bg-zinc-900" <?php echo (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Reviewed') ? 'selected' : ''; ?>>Reviewed</option>
                    <option value="Completed" class="bg-zinc-900" <?php echo (isset($_GET['status_filter']) && $_GET['status_filter'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>

            <div class="flex items-center bg-black border border-zinc-800 rounded-2xl px-4 py-2.5">
                <span class="text-[9px] font-black uppercase text-zinc-500 mr-2">From</span>
                <input type="date" name="start_date" value="<?php echo $_GET['start_date'] ?? ''; ?>" class="bg-transparent outline-none text-xs font-bold text-zinc-300 w-full [color-scheme:dark]">
            </div>
            <div class="flex items-center bg-black border border-zinc-800 rounded-2xl px-4 py-2.5">
                <span class="text-[9px] font-black uppercase text-zinc-500 mr-2">To</span>
                <input type="date" name="end_date" value="<?php echo $_GET['end_date'] ?? ''; ?>" class="bg-transparent outline-none text-xs font-bold text-zinc-300 w-full [color-scheme:dark]">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white h-11 rounded-2xl text-[10px] font-black uppercase tracking-widest transition shadow-lg shadow-red-600/25">Filter</button>
                <?php if(!empty($_GET['start_date']) || !empty($_GET['urgency_filter']) || !empty($_GET['status_filter'])): ?>
                    <a href="?page=inquiries" class="bg-zinc-900 border border-zinc-800 text-zinc-400 hover:text-white hover:border-zinc-700 h-11 px-4 rounded-2xl flex items-center justify-center transition"><i class="fas fa-undo-alt"></i></a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <?php if(isset($_GET['msg'])): ?>
        <div class="bg-zinc-950 border-l-4 border-red-600 p-4 rounded-r-2xl border border-zinc-900 shadow-md flex items-center gap-3">
            <i class="fas fa-info-circle text-red-500"></i>
            <p class="text-zinc-200 font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($_GET['msg']); ?></p>
        </div>
    <?php endif; ?>

    <!-- Inquiries List (Full Width Cards) -->
    <div class="grid grid-cols-1 gap-6">
        <?php foreach($inquiries as $inq): ?>
        <div class="bg-zinc-950 rounded-[32px] border border-zinc-900 overflow-hidden hover:border-zinc-800 transition-all duration-300 shadow-xl">
            
            <div class="p-6 md:p-8 border-b border-zinc-900 flex flex-col lg:flex-row justify-between items-start gap-6">
                <div class="flex gap-5">
                    <div class="bg-black h-14 w-14 rounded-2xl flex items-center justify-center text-zinc-600 border border-zinc-800 shrink-0">
                        <i class="fas fa-user-tie text-2xl text-red-500"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white tracking-tight leading-none mb-2.5">
                            <?php echo htmlspecialchars($inq['name']); ?> 
                            <?php if(!empty($inq['company'])): ?>
                            <span class="text-[10px] font-black text-red-500 bg-red-600/10 border border-red-600/20 px-2.5 py-1 rounded-md ml-1 uppercase tracking-wider"><?php echo htmlspecialchars($inq['company']); ?></span>
                            <?php endif; ?>
                        </h3>
                        <div class="flex flex-wrap gap-x-5 gap-y-2">
                            <a href="tel:<?php echo $inq['phone']; ?>" class="text-[11px] font-bold text-zinc-400 hover:text-white transition flex items-center gap-2">
                                <i class="fas fa-phone-alt text-red-500 text-xs"></i> <?php echo htmlspecialchars($inq['phone']); ?>
                            </a>
                            <?php if(!empty($inq['whatsapp'])): ?>
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $inq['whatsapp']); ?>" target="_blank" class="text-[11px] font-bold text-zinc-400 hover:text-white transition flex items-center gap-2">
                                <i class="fab fa-whatsapp text-emerald-400 text-xs"></i> <?php echo htmlspecialchars($inq['whatsapp']); ?>
                            </a>
                            <?php endif; ?>
                            <span class="text-[11px] font-bold text-zinc-500 flex items-center gap-2">
                                <i class="far fa-clock text-zinc-600 text-xs"></i> <?php echo date('M d, Y &bull; h:i A', strtotime($inq['created_at'])); ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 w-full lg:w-auto shrink-0 border-t lg:border-0 border-zinc-900 pt-4 lg:pt-0">
                    <span class="px-3.5 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest <?php echo $inq['urgency'] == 'High' ? 'bg-red-600/15 text-red-500 border border-red-600/30' : 'bg-black text-zinc-400 border border-zinc-800'; ?>">
                        <?php echo htmlspecialchars($inq['urgency']); ?> Priority
                    </span>
                    
                    <form method="POST" class="shrink-0">
                        <input type="hidden" name="inquiry_id" value="<?php echo $inq['id']; ?>">
                        <select name="status" onchange="this.form.submit()" class="text-[10px] font-black uppercase tracking-widest border border-zinc-800 rounded-xl px-4 py-2 outline-none cursor-pointer transition-all bg-black text-zinc-200 focus:border-red-600">
                            <option value="Pending" class="bg-zinc-900 text-amber-400" <?php echo $inq['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Reviewed" class="bg-zinc-900 text-blue-400" <?php echo $inq['status'] == 'Reviewed' ? 'selected' : ''; ?>>Reviewed</option>
                            <option value="Completed" class="bg-zinc-900 text-emerald-400" <?php echo $inq['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                        </select>
                        <input type="hidden" name="update_status">
                    </form>
                    
                    <a href="?page=inquiries&delete=<?php echo $inq['id']; ?>" onclick="return confirm('Delete this inquiry permanently?')" class="w-10 h-10 bg-black border border-zinc-800 text-zinc-500 hover:text-white hover:bg-red-600 hover:border-red-600 rounded-xl flex items-center justify-center transition-all shadow-sm">
                        <i class="fas fa-trash-alt text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Products associated with inquiry -->
            <div class="p-6 md:p-8 bg-black/40">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                    <?php
                    $stmtItems = $conn->prepare("SELECT p.title, p.main_image FROM inquiry_items ii JOIN products p ON ii.product_id = p.id WHERE ii.inquiry_id = ?");
                    $stmtItems->execute([$inq['id']]);
                    $items = $stmtItems->fetchAll();
                    foreach($items as $item): ?>
                    <div class="bg-zinc-950 border border-zinc-900 p-3 rounded-2xl flex items-center gap-3.5 hover:border-zinc-800 transition">
                        <img src="../assets/images/products/<?php echo $item['main_image']; ?>" class="h-11 w-11 rounded-xl object-cover border border-zinc-800 shrink-0" onerror="this.src='https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?q=80&w=200&auto=format&fit=crop';">
                        <span class="block text-xs font-black text-zinc-300 leading-tight truncate"><?php echo htmlspecialchars($item['title']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if(!empty($inq['order_note'])): ?>
                <div class="mt-5 p-5 bg-zinc-950/80 rounded-2xl border border-zinc-900">
                    <p class="text-[9px] font-black text-red-500 uppercase tracking-widest mb-1.5">Production Requirements / Custom Notes:</p>
                    <p class="text-xs text-zinc-300 font-medium italic leading-relaxed">"<?php echo htmlspecialchars($inq['order_note']); ?>"</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if(empty($inquiries)): ?>
        <div class="text-center py-24 bg-zinc-950 rounded-[32px] border border-zinc-900">
            <i class="fas fa-inbox text-4xl text-zinc-700 mb-4"></i>
            <h3 class="text-xl font-black text-white uppercase">No records match criteria</h3>
            <p class="text-zinc-500 font-medium text-xs mt-2">Adjust your date range, urgency, or processing status.</p>
        </div>
        <?php endif; ?>
    </div>
</div>