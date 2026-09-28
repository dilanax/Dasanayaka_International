<?php
/**
 * Red Runner Admin - Internal 404 Error View
 * Path: PraBaK/404.php
 */
?>

<div class="w-full flex items-center justify-center min-h-[60vh] select-none">
    <div class="bg-zinc-950 p-10 md:p-14 rounded-[36px] text-center border border-zinc-900 max-w-lg mx-auto shadow-2xl relative overflow-hidden">
        
        <!-- Ambient Red Accent -->
        <div class="absolute -top-12 -right-12 w-44 h-44 bg-red-600/10 blur-[70px] rounded-full pointer-events-none"></div>

        <div class="w-20 h-20 bg-red-600/10 border border-red-600/30 text-red-500 rounded-3xl flex items-center justify-center mx-auto mb-6 text-3xl shadow-[0_0_30px_rgba(220,38,38,0.2)]">
            <i class="fas fa-triangle-exclamation animate-pulse"></i>
        </div>

        <span class="inline-block text-[10px] font-black uppercase tracking-[3px] text-red-500 bg-red-600/10 border border-red-600/20 px-3.5 py-1.5 rounded-full mb-4">
            Error 404
        </span>

        <h3 class="text-2xl md:text-3xl font-black text-white tracking-tight uppercase mb-3">
            Module Not Found
        </h3>

        <p class="text-zinc-400 text-xs md:text-sm font-medium leading-relaxed mb-8">
            The administrative section <span class="text-red-500 font-bold">'<?php echo htmlspecialchars($page ?? 'unknown'); ?>'</span> could not be located or has been relocated.
        </p>

        <div class="flex items-center justify-center gap-3">
            <a href="?page=dashboard" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3.5 rounded-2xl font-black uppercase tracking-wider text-xs transition-all shadow-xl shadow-red-600/25 flex items-center gap-2 active:scale-95">
                <i class="fas fa-chart-pie text-xs"></i> Return to Dashboard
            </a>
            <a href="?page=inquiries" class="bg-zinc-900 hover:bg-zinc-800 text-zinc-300 hover:text-white px-6 py-3.5 rounded-2xl font-black uppercase tracking-wider text-xs transition-all border border-zinc-800 flex items-center gap-2">
                <i class="fas fa-inbox text-xs"></i> Inquiries
            </a>
        </div>
    </div>
</div>