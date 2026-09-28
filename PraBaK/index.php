<?php
ob_start();
session_start();

// Authentication Check
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

require_once(__DIR__ . '/../db/db.php');

// Sanitize Page Variable
$page = isset($_GET['page']) ? preg_replace('/[^a-z_-]/', '', $_GET['page']) : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red Runner Admin Panel</title>
    
    <link rel="icon" type="image/png" href="/assets/images/logo.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800;900&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Mobile Sidebar Transition */
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Dark Theme Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #dc2626; }
    </style>
</head>
<body class="bg-black text-zinc-200 antialiased overflow-hidden flex h-screen select-none">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"></div>

    <!-- Admin Sidebar -->
    <aside id="sidebar" class="bg-zinc-950 text-white w-64 flex-shrink-0 flex flex-col fixed lg:static inset-y-0 left-0 z-50 transform -translate-x-full lg:translate-x-0 border-r border-zinc-900 shadow-2xl lg:shadow-none">
        
        <!-- Sidebar Brand / Logo Header -->
        <div class="h-20 flex items-center justify-between px-6 border-b border-zinc-900">
            <a href="index.php" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-black border border-zinc-800 group-hover:border-red-600 flex items-center justify-center p-1.5 transition-all duration-300 shadow-[0_0_15px_rgba(220,38,38,0.2)] overflow-hidden">
                    <img src="/assets/images/logo.png" 
                         alt="Red Runner Logo" 
                         class="w-full h-full object-contain"
                         onerror="this.onerror=null; this.src='/assets/images/logo.jpg';">
                </div>
                <div class="flex flex-col">
                    <h1 class="text-base font-black tracking-tight text-white leading-none font-sans">
                        RED <span class="text-red-600">RUNNER</span>
                    </h1>
                    <p class="text-[8px] uppercase tracking-[2.5px] text-zinc-500 font-bold mt-1">Admin Desk</p>
                </div>
            </a>
            <button onclick="toggleSidebar()" class="lg:hidden text-zinc-400 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
            <p class="px-3 text-[10px] font-black uppercase tracking-[3px] text-zinc-500 mb-3">Core Operations</p>
            
            <a href="?page=dashboard" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 <?php echo $page == 'dashboard' ? 'bg-red-600 text-white shadow-lg shadow-red-600/30 font-black' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white'; ?>">
                <i class="fas fa-chart-pie w-4 text-sm"></i> Dashboard
            </a>
            
            <a href="?page=inquiries" class="flex items-center justify-between px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 <?php echo $page == 'inquiries' ? 'bg-red-600 text-white shadow-lg shadow-red-600/30 font-black' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white'; ?>">
                <div class="flex items-center gap-3">
                    <i class="fas fa-envelope-open-text w-4 text-sm"></i> Inquiries
                </div>
                <?php 
                try {
                    $pending = $conn->query("SELECT COUNT(id) FROM inquiries WHERE status = 'Pending'")->fetchColumn();
                    if($pending > 0): 
                ?>
                    <span class="bg-red-500 text-white text-[9px] font-black px-2 py-0.5 rounded-md shadow-sm"><?php echo $pending; ?> New</span>
                <?php 
                    endif;
                } catch(Exception $e) {} 
                ?>
            </a>

            <p class="px-3 text-[10px] font-black uppercase tracking-[3px] text-zinc-500 mb-3 mt-8">Catalog Management</p>

            <a href="?page=categories" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 <?php echo $page == 'categories' ? 'bg-red-600 text-white shadow-lg shadow-red-600/30 font-black' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white'; ?>">
                <i class="fas fa-layer-group w-4 text-sm"></i> Categories
            </a>

            <a href="?page=brands" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 <?php echo $page == 'brands' ? 'bg-red-600 text-white shadow-lg shadow-red-600/30 font-black' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white'; ?>">
                <i class="fas fa-tag w-4 text-sm"></i> Brands
            </a>

            <a href="?page=products" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 <?php echo $page == 'products' ? 'bg-red-600 text-white shadow-lg shadow-red-600/30 font-black' : 'text-zinc-400 hover:bg-zinc-900 hover:text-white'; ?>">
                <i class="fa-solid fa-socks w-4 text-sm"></i> Products
            </a>
        </nav>

        <!-- Sidebar Footer Action Links -->
        <div class="p-4 border-t border-zinc-900 space-y-2">
            <a href="/" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white text-xs font-black uppercase tracking-wider transition-all border border-zinc-800">
                <i class="fas fa-external-link-alt text-xs"></i> Visit Site
            </a>
            <a href="logout.php" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white text-xs font-black uppercase tracking-wider transition-all border border-red-600/20">
                <i class="fas fa-power-off text-xs"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden min-w-0 bg-black">
        
        <!-- Top Navigation Header Bar -->
        <header class="h-20 bg-zinc-950 border-b border-zinc-900 flex items-center justify-between px-4 md:px-8 flex-shrink-0 z-10">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-zinc-900 text-zinc-300 hover:bg-red-600 hover:text-white transition border border-zinc-800">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-base md:text-lg font-black text-white tracking-tight uppercase">
                    <?php echo str_replace('-', ' ', $page); ?>
                </h1>
            </div>

            <!-- Profile Overview -->
            <div class="flex items-center gap-3">
                <div class="hidden md:block text-right">
                    <p class="text-xs font-black text-white leading-none"><?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></p>
                    <p class="text-[9px] font-bold uppercase tracking-widest text-zinc-500 mt-1">Super Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-red-500 font-black text-sm shadow-md">
                    <?php echo strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)); ?>
                </div>
            </div>
        </header>

        <!-- Inner Content View -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            <?php
            $file = $page . ".php";

            if (file_exists($file)) {
                include($file);
            } else {
                echo "
                <div class='bg-zinc-950 p-10 rounded-3xl text-center border border-zinc-900 max-w-lg mx-auto mt-10 shadow-2xl'>
                    <div class='w-20 h-20 bg-red-600/10 border border-red-600/30 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-5 text-3xl shadow-[0_0_20px_rgba(220,38,38,0.2)]'>
                        <i class='fas fa-exclamation-triangle'></i>
                    </div>
                    <h3 class='text-2xl font-black text-white uppercase tracking-tight mb-2'>Module Not Found</h3>
                    <p class='text-zinc-500 text-sm font-medium'>The administrative module you requested does not exist or has been relocated.</p>
                    <a href='?page=dashboard' class='inline-block mt-6 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-wider text-xs rounded-xl transition-all shadow-lg shadow-red-600/25'>Return to Dashboard</a>
                </div>";
            }
            ?>
        </main>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if(sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
<?php ob_end_flush(); ?>