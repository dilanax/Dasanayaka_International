<?php
/**
 * Red Runner Admin - Brands Management (SweetAlert2 Modal Add & Edit, Full-Width Dark Theme)
 * Path: PraBaK/brands.php
 */

$msg = "";
$error = "";

// --- DELETE LOGIC ---
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    $stmt = $conn->prepare("SELECT image FROM brands WHERE id = ?");
    $stmt->execute([$id]);
    $brand = $stmt->fetch();
    
    if ($brand) {
        if (!empty($brand['image']) && file_exists("../assets/images/brands/" . $brand['image'])) {
            unlink("../assets/images/brands/" . $brand['image']);
        }
        
        $del = $conn->prepare("DELETE FROM brands WHERE id = ?");
        if ($del->execute([$id])) {
            header("Location: ?page=brands&msg=Brand deleted successfully");
            exit();
        }
    }
}

// --- UPDATE BRAND (From SweetAlert2 Modal) ---
if (isset($_POST['update_brand'])) {
    $id = intval($_POST['brand_id']);
    $name = trim(htmlspecialchars($_POST['brand_name']));
    $old_image = $_POST['old_image'];
    $image = $old_image;

    if (!empty($_FILES['brand_image']['name'])) {
        $clean_name = preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['brand_image']['name']);
        $new_image = time() . "_" . $clean_name;
        
        if (!file_exists('../assets/images/brands/')) {
            mkdir('../assets/images/brands/', 0777, true);
        }

        if (move_uploaded_file($_FILES['brand_image']['tmp_name'], "../assets/images/brands/" . $new_image)) {
            if (!empty($old_image) && file_exists("../assets/images/brands/" . $old_image)) {
                unlink("../assets/images/brands/" . $old_image);
            }
            $image = $new_image;
        }
    }

    $sql = "UPDATE brands SET name = ?, image = ? WHERE id = ?";
    if ($conn->prepare($sql)->execute([$name, $image, $id])) {
        header("Location: ?page=brands&msg=Brand updated successfully");
        exit();
    }
}

// --- ADD NEW BRAND (From SweetAlert2 Modal) ---
if (isset($_POST['add_brand'])) {
    $name = trim(htmlspecialchars($_POST['brand_name']));
    $image = "";

    if (!empty($_FILES['brand_image']['name'])) {
        $clean_name = preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['brand_image']['name']);
        $image = time() . "_" . $clean_name;

        if (!file_exists('../assets/images/brands/')) {
            mkdir('../assets/images/brands/', 0777, true);
        }

        move_uploaded_file($_FILES['brand_image']['tmp_name'], "../assets/images/brands/" . $image);
    }

    if (!empty($name)) {
        $sql = "INSERT INTO brands (name, image) VALUES (?, ?)";
        if ($conn->prepare($sql)->execute([$name, $image])) {
            header("Location: ?page=brands&msg=Brand added successfully");
            exit();
        }
    }
}

$brands = $conn->query("SELECT * FROM brands ORDER BY id DESC")->fetchAll();
?>

<!-- Backup CDN Fallback -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="w-full space-y-6 select-none pb-12">
    
    <!-- Top Action Header -->
    <div class="bg-zinc-950 p-6 md:p-8 rounded-[32px] border border-zinc-900 shadow-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight uppercase flex items-center gap-3">
                <div class="w-10 h-10 bg-red-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-red-600/30">
                    <i class="fas fa-tag text-xs"></i>
                </div>
                Partner Brands & Labels
            </h2>
            <p class="text-[10px] text-zinc-500 font-bold uppercase tracking-[2px] mt-1.5 ml-1">Private Labels, OEMs & Brand Identifiers</p>
        </div>

        <button type="button" onclick="openAddBrandModal()" class="bg-red-600 hover:bg-red-700 text-white h-11 px-6 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-red-600/25 flex items-center gap-2.5 active:scale-95 cursor-pointer">
            <i class="fas fa-plus text-xs"></i> Add Brand
        </button>
    </div>

    <!-- Feedback Message Bar -->
    <?php if(isset($_GET['msg']) || $msg): ?>
        <div class="bg-zinc-950 border-l-4 border-red-600 p-4 rounded-r-2xl border border-zinc-900 shadow-md flex items-center gap-3">
            <i class="fas fa-check-circle text-red-500"></i>
            <p class="text-zinc-200 font-bold text-xs uppercase tracking-widest"><?php echo htmlspecialchars($_GET['msg'] ?? $msg); ?></p>
        </div>
    <?php endif; ?>

    <!-- Full-Width Brands Table -->
    <div class="bg-zinc-950 rounded-[32px] border border-zinc-900 shadow-2xl overflow-hidden">
        <div class="p-6 md:p-8 border-b border-zinc-900 flex items-center justify-between">
            <h3 class="font-black text-white uppercase tracking-wider text-sm">Active Brand Labels</h3>
            <span class="bg-black border border-zinc-800 text-zinc-400 text-[10px] font-black px-4 py-1.5 rounded-xl uppercase tracking-widest">
                <?php echo count($brands); ?> Total
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-black/40 text-zinc-500 text-[10px] uppercase tracking-[2px] font-black border-b border-zinc-900">
                    <tr>
                        <th class="px-8 py-5">Logo / Icon</th>
                        <th class="px-8 py-5">Brand Name</th>
                        <th class="px-8 py-5">Products Attached</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900">
                    <?php foreach($brands as $brand): 
                        $itemCount = $conn->query("SELECT COUNT(id) FROM products WHERE brand_id = " . intval($brand['id']))->fetchColumn();
                    ?>
                    <tr class="hover:bg-zinc-900/40 transition duration-150 group">
                        <td class="px-8 py-5">
                            <div class="w-16 h-16 bg-black border border-zinc-800 p-1.5 rounded-2xl overflow-hidden flex items-center justify-center transition-transform group-hover:scale-105">
                                <?php if (!empty($brand['image']) && file_exists('../assets/images/brands/' . $brand['image'])): ?>
                                    <img src="../assets/images/brands/<?php echo $brand['image']; ?>" class="w-full h-full object-contain rounded-xl">
                                <?php else: ?>
                                    <i class="fa-solid fa-tag text-2xl text-zinc-700"></i>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <h4 class="font-bold text-white text-base group-hover:text-red-500 transition-colors"><?php echo htmlspecialchars($brand['name']); ?></h4>
                            <span class="text-[9px] text-zinc-500 font-bold uppercase tracking-widest">ID #<?php echo $brand['id']; ?></span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="inline-flex items-center gap-2 bg-black border border-zinc-800 text-zinc-400 text-[10px] font-black px-3.5 py-1.5 rounded-xl uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo $itemCount > 0 ? 'bg-red-600 animate-pulse' : 'bg-zinc-700'; ?>"></span>
                                <?php echo $itemCount; ?> Products
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2.5">
                                <button type="button" 
                                        onclick="openEditBrandModal(<?php echo $brand['id']; ?>, '<?php echo addslashes(htmlspecialchars($brand['name'])); ?>', '<?php echo addslashes($brand['image']); ?>')" 
                                        class="w-10 h-10 bg-black border border-zinc-800 text-zinc-300 hover:text-white hover:bg-zinc-800 hover:border-zinc-700 rounded-xl flex items-center justify-center transition shadow-sm cursor-pointer"
                                        title="Edit Brand">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>
                                
                                <button type="button" 
                                        onclick="confirmBrandDelete(<?php echo $brand['id']; ?>, '<?php echo addslashes(htmlspecialchars($brand['name'])); ?>')" 
                                        class="w-10 h-10 bg-black border border-zinc-800 text-zinc-500 hover:text-white hover:bg-red-600 hover:border-red-600 rounded-xl flex items-center justify-center transition shadow-sm cursor-pointer"
                                        title="Delete Brand">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if(empty($brands)): ?>
                    <tr>
                        <td colspan="4" class="p-20 text-center">
                            <div class="w-16 h-16 bg-black border border-zinc-800 rounded-2xl flex items-center justify-center mx-auto mb-4 text-zinc-700">
                                <i class="fas fa-folder-open text-2xl"></i>
                            </div>
                            <p class="text-zinc-500 font-bold uppercase tracking-widest text-xs">No brands found</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SweetAlert2 Modal Scripts -->
<script>
function openAddBrandModal() {
    Swal.fire({
        title: '<span class="text-white text-xl font-black uppercase tracking-wider">Add New Brand</span>',
        html: `
            <form id="add-brand-form" action="?page=brands" method="POST" enctype="multipart/form-data" class="text-left space-y-4 pt-2">
                <input type="hidden" name="add_brand" value="1">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2">Brand Name</label>
                    <input type="text" name="brand_name" id="swal-brand-name" required placeholder="e.g. Red Runner Gold, SchoolPro" class="w-full bg-black border border-zinc-800 text-white rounded-xl px-4 py-3 text-xs font-semibold outline-none focus:border-red-600 transition placeholder:text-zinc-700">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2">Brand Logo (1:1 Ratio Recommended)</label>
                    <input type="file" name="brand_image" id="swal-brand-image" accept="image/*" class="w-full bg-black border border-zinc-800 text-zinc-400 rounded-xl p-2 text-xs file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-900 file:text-white hover:file:bg-red-600 file:transition cursor-pointer">
                </div>
            </form>
        `,
        background: '#09090b',
        color: '#ffffff',
        showCancelButton: true,
        confirmButtonText: 'Save Brand',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#27272a',
        customClass: {
            popup: 'rounded-3xl border border-zinc-800 shadow-2xl',
            confirmButton: 'rounded-xl font-black uppercase tracking-wider text-xs px-6 py-3',
            cancelButton: 'rounded-xl font-black uppercase tracking-wider text-xs px-6 py-3'
        },
        preConfirm: () => {
            const form = document.getElementById('add-brand-form');
            const nameInput = document.getElementById('swal-brand-name');
            if (!nameInput || !nameInput.value.trim()) {
                Swal.showValidationMessage('Brand name is required');
                return false;
            }
            form.submit();
        }
    });
}

function openEditBrandModal(id, name, oldImage) {
    const currentImgHtml = oldImage ? `
        <div class="flex items-center gap-3 p-3 bg-black border border-zinc-800 rounded-xl mb-3">
            <img src="../assets/images/brands/${oldImage}" class="w-12 h-12 rounded-lg object-contain border border-zinc-700 p-1" onerror="this.style.display='none'">
            <div>
                <p class="text-[9px] font-black uppercase tracking-widest text-zinc-500">Current Logo</p>
                <p class="text-xs text-zinc-300 font-bold truncate max-w-[200px]">${oldImage}</p>
            </div>
        </div>
    ` : '';

    Swal.fire({
        title: '<span class="text-white text-xl font-black uppercase tracking-wider">Edit Brand</span>',
        html: `
            <form id="edit-brand-form" action="?page=brands" method="POST" enctype="multipart/form-data" class="text-left space-y-4 pt-2">
                <input type="hidden" name="update_brand" value="1">
                <input type="hidden" name="brand_id" value="${id}">
                <input type="hidden" name="old_image" value="${oldImage}">

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2">Brand Name</label>
                    <input type="text" name="brand_name" id="swal-edit-brand-name" value="${name}" required class="w-full bg-black border border-zinc-800 text-white rounded-xl px-4 py-3 text-xs font-semibold outline-none focus:border-red-600 transition">
                </div>

                ${currentImgHtml}

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-400 mb-2">Change Logo (Optional)</label>
                    <input type="file" name="brand_image" accept="image/*" class="w-full bg-black border border-zinc-800 text-zinc-400 rounded-xl p-2 text-xs file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-zinc-900 file:text-white hover:file:bg-red-600 file:transition cursor-pointer">
                </div>
            </form>
        `,
        background: '#09090b',
        color: '#ffffff',
        showCancelButton: true,
        confirmButtonText: 'Update Brand',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#27272a',
        customClass: {
            popup: 'rounded-3xl border border-zinc-800 shadow-2xl',
            confirmButton: 'rounded-xl font-black uppercase tracking-wider text-xs px-6 py-3',
            cancelButton: 'rounded-xl font-black uppercase tracking-wider text-xs px-6 py-3'
        },
        preConfirm: () => {
            const form = document.getElementById('edit-brand-form');
            const nameInput = document.getElementById('swal-edit-brand-name');
            if (!nameInput || !nameInput.value.trim()) {
                Swal.showValidationMessage('Brand name is required');
                return false;
            }
            form.submit();
        }
    });
}

function confirmBrandDelete(id, name) {
    Swal.fire({
        title: '<span class="text-white text-lg font-black uppercase tracking-wider">Delete Brand?</span>',
        text: `Are you sure you want to remove "${name}"? Linked products may need their brand reference reassigned.`,
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
            window.location.href = `?page=brands&delete=${id}`;
        }
    });
}
</script>