<section class="py-32 bg-black text-center flex items-center min-h-[75vh] select-none relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-red-600/10 blur-[140px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="w-24 h-24 bg-zinc-950 border border-red-600/30 text-red-600 rounded-3xl flex items-center justify-center mx-auto mb-8 text-4xl shadow-[0_0_30px_rgba(220,38,38,0.2)]">
            <i class="fas fa-exclamation-triangle animate-pulse"></i>
        </div>

        <span class="inline-block text-[10px] font-black uppercase tracking-[4px] text-red-500 bg-red-600/10 border border-red-600/20 px-3.5 py-1.5 rounded-full mb-4">
            Error 404
        </span>

        <h2 class="text-5xl md:text-7xl font-black text-white tracking-tighter uppercase mb-4 leading-none">
            Page Not Found
        </h2>

        <p class="text-zinc-400 text-sm md:text-base font-medium max-w-md mx-auto leading-relaxed">
            The requested page <span class="text-red-500 font-bold">'<?php echo htmlspecialchars($page); ?>'</span> could not be found in our catalog or manufacturing index.
        </p>

        <div class="mt-10 flex flex-wrap justify-center items-center gap-4">
            <a href="index.php?page=home" class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all duration-300 shadow-xl shadow-red-600/30 active:scale-95">
                Return Home
            </a>
            <a href="index.php?page=shop" class="bg-zinc-950 border border-zinc-800 hover:border-zinc-700 text-zinc-300 hover:text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all duration-300">
                Explore Catalog
            </a>
        </div>
    </div>
</section>