<?php
session_start();

// Redirect to Dashboard if already authenticated
if (isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

require_once(__DIR__ . '/../db/db.php');

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $user = trim(htmlspecialchars($_POST['username']));
    $pass = $_POST['password'];

    if (!empty($user) && !empty($pass)) {
        $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
        $stmt->execute([$user]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($pass, $admin['password'])) {
            session_regenerate_id(true); 
            
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'];
            $_SESSION['last_regeneration'] = time(); 
            
            header("Location: index.php");
            exit();
        } else {
            sleep(1); 
            $error = "Invalid identity credentials. Access denied.";
        }
    } else {
        $error = "Please fill in all security fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Secure Access | Red Runner Admin Desk</title>
    
    <link rel="icon" type="image/png" href="/assets/images/logo.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800;900&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            -webkit-tap-highlight-color: transparent;
            overscroll-behavior: none;
        }

        @media (max-width: 640px) {
            h1 { font-size: 1.5rem !important; }
            .login-card { padding: 1.75rem !important; border-radius: 28px !important; }
            input { font-size: 16px !important; }
        }

        .animate-shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
    </style>
</head>
<body class="bg-black text-white h-full flex flex-col justify-center items-center p-4 relative overflow-x-hidden select-none">

    <!-- Ambient Red Glow Highlights -->
    <div class="absolute top-0 right-0 w-64 h-64 md:w-[450px] md:h-[450px] bg-red-600/10 blur-[120px] md:blur-[160px] rounded-full -mr-28 -mt-28 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 md:w-[450px] md:h-[450px] bg-red-950/20 blur-[120px] md:blur-[160px] rounded-full -ml-28 -mb-28 pointer-events-none"></div>

    <div class="w-full max-w-[420px] relative z-10 flex flex-col">
        
        <!-- Brand Header Section -->
        <div class="text-center mb-8 flex flex-col items-center">
            <div class="w-16 h-16 rounded-2xl bg-zinc-950 border border-zinc-800 flex items-center justify-center p-2 mb-4 shadow-[0_0_25px_rgba(220,38,38,0.25)]">
                <img src="../assets/images/logo.png" 
                     alt="Red Runner Logo" 
                     class="w-full h-full object-cover rounded-xl"
                     onerror="this.onerror=null; this.src='../assets/images/readrunnerlogo.jpg';">
            </div>
            <h1 class="text-2xl md:text-3xl font-black text-white tracking-tighter uppercase leading-none">
                RED <span class="text-red-600">RUNNER</span>
            </h1>
            <p class="text-[9px] uppercase tracking-[3px] text-zinc-500 font-bold mt-2">Authorized Operations Only</p>
        </div>

        <!-- Login Card -->
        <div class="login-card bg-zinc-950 p-8 rounded-[36px] shadow-2xl border border-zinc-900 relative mx-auto w-full">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-zinc-900">
                <h2 class="text-base font-black text-white tracking-tight uppercase">Admin Desk</h2>
                <span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span>
            </div>

            <?php if($error): ?>
                <div class="bg-red-600/10 border border-red-600/30 text-red-400 p-3.5 rounded-2xl mb-6 text-xs font-bold flex items-center gap-2.5 animate-shake">
                    <i class="fas fa-triangle-exclamation shrink-0 text-red-500"></i> 
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="space-y-4">
                
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-zinc-400 uppercase tracking-widest ml-1">Username</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500">
                            <i class="fas fa-user-shield text-xs"></i>
                        </span>
                        <input type="text" name="username" required 
                               class="w-full bg-black border border-zinc-800 p-3.5 pl-11 rounded-2xl text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all font-semibold placeholder:text-zinc-700 text-sm" 
                               placeholder="Enter username"
                               autocomplete="username">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-zinc-400 uppercase tracking-widest ml-1">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500">
                            <i class="fas fa-lock text-xs"></i>
                        </span>
                        <input type="password" name="password" required 
                               class="w-full bg-black border border-zinc-800 p-3.5 pl-11 rounded-2xl text-white outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all font-semibold placeholder:text-zinc-700 text-sm" 
                               placeholder="••••••••"
                               autocomplete="current-password">
                    </div>
                </div>

                <button name="login" class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all shadow-xl shadow-red-600/25 active:scale-[0.98] mt-3 flex items-center justify-center gap-2.5 cursor-pointer">
                    <span>Verify & Enter</span>
                    <i class="fas fa-arrow-right text-[11px]"></i>
                </button>
                
            </form>

            <div class="mt-6 pt-5 border-t border-zinc-900 text-center">
                <a href="/" class="text-[9px] font-bold text-zinc-500 hover:text-white uppercase tracking-widest transition inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left text-[10px]"></i> Return to Public Site
                </a>
            </div>
        </div>

        <p class="text-center text-zinc-600 text-[9px] font-bold uppercase tracking-widest mt-8">
            &copy; <?php echo date('Y'); ?> Red Runner &bull; Developed by Loopz Global
        </p>
    </div>

</body>
</html>