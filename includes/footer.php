<footer class="bg-black text-zinc-300 pt-20 pb-10 border-t border-zinc-900 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-red-600/5 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-red-950/15 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            
            <!-- Brand Column with 1:1 Modern Logo -->
            <div class="space-y-6">
                <a href="/" class="flex items-center gap-3.5 group">
                    <div class="w-14 h-14 aspect-square rounded-2xl bg-zinc-950 border border-zinc-800 group-hover:border-red-600 flex items-center justify-center p-2 transition-all duration-300 shadow-[0_0_20px_rgba(220,38,38,0.2)] overflow-hidden">
                        <img src="/assets/images/logo.png" 
                             alt="Red Runner Logo" 
                             class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105"
                             onerror="this.onerror=null; this.src='/assets/images/readrunnerlogo.jpg';">
                    </div>
                    <div class="flex flex-col">
                        <h2 class="text-2xl font-black tracking-tighter text-white leading-none font-sans">
                            RED <span class="text-red-600">RUNNER</span>
                        </h2>
                        <p class="text-[10px] uppercase tracking-[3px] text-zinc-500 font-bold mt-1">Premier Knitwear</p>
                    </div>
                </a>
                <p class="text-sm text-zinc-400 leading-relaxed">
                    Sri Lanka's premier knitwear manufacturer and wholesaler. Specializing in durable school socks, executive gents lines, and health-care non-elastic hosiery for local and global export markets.
                </p>
                <div class="flex items-center gap-3 text-xs text-zinc-500 uppercase tracking-widest font-semibold">
                    <span>Est. 2015</span>
                    <span class="text-red-600">&bull;</span>
                    <span>Bulk Production</span>
                </div>
            </div>

            <!-- Quick Links (Clean URLs) -->
            <div>
                <h4 class="text-white font-black uppercase tracking-[3px] text-xs mb-6">Navigation</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="/" class="hover:text-red-500 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-red-600 text-[8px]"></i> Home</a></li>
                    <li><a href="/about" class="hover:text-red-500 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-red-600 text-[8px]"></i> About Us</a></li>
                    <li><a href="/shop" class="hover:text-red-500 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-red-600 text-[8px]"></i> Products Catalog</a></li>
                    <li><a href="/categories" class="hover:text-red-500 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-red-600 text-[8px]"></i> Production Categories</a></li>
                    <li><a href="/contact" class="hover:text-red-500 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-red-600 text-[8px]"></i> Contact & Inquiries</a></li>
                </ul>
            </div>

            <!-- Manufacturing Categories -->
            <div>
                <h4 class="text-white font-black uppercase tracking-[3px] text-xs mb-6">Categories</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li class="text-zinc-400 flex items-center gap-2"><i class="fa-solid fa-check text-red-600 text-xs"></i> Custom School Socks</li>
                    <li class="text-zinc-400 flex items-center gap-2"><i class="fa-solid fa-check text-red-600 text-xs"></i> Executive Gents Collection</li>
                    <li class="text-zinc-400 flex items-center gap-2"><i class="fa-solid fa-check text-red-600 text-xs"></i> Diabetic & Edema Care Socks</li>
                    <li class="text-zinc-400 flex items-center gap-2"><i class="fa-solid fa-check text-red-600 text-xs"></i> OEM Private Label</li>
                    <li class="text-zinc-400 flex items-center gap-2"><i class="fa-solid fa-check text-red-600 text-xs"></i> Bulk Wholesaling</li>
                </ul>
            </div>

            <!-- Contact Touchpoints -->
            <div>
                <h4 class="text-white font-black uppercase tracking-[3px] text-xs mb-6">Factory Inquiries</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li>
                        <a href="tel:+94771179866" class="flex items-center gap-3 hover:text-white transition-colors">
                            <div class="w-8 h-8 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-red-500"><i class="fas fa-phone-alt text-xs"></i></div>
                            +94 77 117 9866
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@redrunner.lk" class="flex items-center gap-3 hover:text-white transition-colors">
                            <div class="w-8 h-8 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-red-500"><i class="fas fa-envelope text-xs"></i></div>
                            info@redrunner.lk
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center gap-3 text-zinc-400">
                            <div class="w-8 h-8 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-red-500"><i class="fas fa-location-dot text-xs"></i></div>
                            Colombo &bull; Kalutara &bull; Gampaha
                        </div>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Sub-footer Bar -->
        <div class="pt-8 border-t border-zinc-900 flex flex-col items-center md:items-start gap-6">
            
            <div class="w-full flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
                <p class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-zinc-500">
                    &copy; <?php echo date('Y'); ?> Red Runner. All Rights Reserved.
                </p>
                
                <div class="flex items-center gap-3">
                    <a href="https://facebook.com" target="_blank" class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/94771179866" target="_blank" class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                    <a href="mailto:info@redrunner.lk" class="w-10 h-10 rounded-xl bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-red-600 hover:border-red-600 hover:text-white transition-all"><i class="far fa-envelope"></i></a>
                </div>
            </div>

            <div class="text-[9px] md:text-[10px] text-zinc-600 font-semibold tracking-widest uppercase text-center w-full mt-2">
                Developed By <a href="https://loopzglobal.com" target="_blank" class="text-red-500 font-black hover:text-red-400 transition-colors">Loopz Global (Pvt) Ltd</a>
            </div>
            
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Quick Button -->
<a href="https://wa.me/94771179866" target="_blank" aria-label="Chat on WhatsApp" class="fixed bottom-6 right-6 md:bottom-8 md:right-8 z-50 group">
    <div class="absolute inset-0 bg-emerald-500 rounded-full animate-ping opacity-60"></div>
    <div class="relative bg-[#25D366] text-white w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center text-3xl md:text-4xl shadow-[0_10px_25px_rgba(37,211,102,0.4)] transform group-hover:-translate-y-2 transition-all duration-300">
        <i class="fab fa-whatsapp"></i>
    </div>
</a>

<!-- Red Themed Cursor Tracking -->
<div id="cursor-dot" class="fixed top-0 left-0 w-1.5 h-1.5 bg-red-600 rounded-full pointer-events-none z-[10000] mix-blend-difference opacity-0 transition-opacity duration-300"></div>
<div id="cursor-ring" class="fixed top-0 left-0 w-8 h-8 border border-red-600/40 rounded-full pointer-events-none z-[9999] opacity-0 transition-opacity duration-300"></div>

<style>
    html.lenis { height: auto; }
    .lenis.lenis-smooth { scroll-behavior: auto !important; }
    .lenis.lenis-smooth [data-lenis-prevent] { overscroll-behavior: contain; }
    .lenis.lenis-stopped { overflow: hidden; }
    .lenis.lenis-scrolling iframe { pointer-events: none; }

    .cursor-dot-active { width: 30px !important; height: 30px !important; background-color: rgba(220, 38, 38, 0.2) !important; mix-blend-mode: normal !important; }
    .cursor-ring-active { transform: scale(1.5); border-color: rgba(220, 38, 38, 0.6) !important; opacity: 0 !important; }

    @media (max-width: 1023px) {
        #cursor-dot, #cursor-ring { display: none !important; }
    }
</style>

<script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>

<script>
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true,
        smoothTouch: false
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    const dot = document.getElementById('cursor-dot');
    const ring = document.getElementById('cursor-ring');

    let mouseX = 0, mouseY = 0;
    let dotX = 0, dotY = 0;
    let ringX = 0, ringY = 0;
    let isVisible = false;

    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        if (!isVisible) {
            dot.style.opacity = '1';
            ring.style.opacity = '1';
            dotX = ringX = mouseX;
            dotY = ringY = mouseY;
            isVisible = true;
        }
    });

    function renderCursor() {
        const dotLerp = 0.25; 
        const ringLerp = 0.15;

        dotX += (mouseX - dotX) * dotLerp;
        dotY += (mouseY - dotY) * dotLerp;

        ringX += (mouseX - ringX) * ringLerp;
        ringY += (mouseY - ringY) * ringLerp;

        dot.style.transform = `translate3d(${dotX - 3}px, ${dotY - 3}px, 0)`;
        ring.style.transform = `translate3d(${ringX - 16}px, ${ringY - 16}px, 0)`;

        requestAnimationFrame(renderCursor);
    }
    renderCursor();

    const handleHover = () => {
        const targets = document.querySelectorAll('a, button, input, select, textarea, .group, [onclick]');
        
        targets.forEach(target => {
            target.addEventListener('mouseenter', () => {
                dot.classList.add('cursor-dot-active');
                ring.classList.add('cursor-ring-active');
            });
            target.addEventListener('mouseleave', () => {
                dot.classList.remove('cursor-dot-active');
                ring.classList.remove('cursor-ring-active');
            });
        });
    };

    handleHover();

    document.addEventListener('mouseleave', () => {
        dot.style.opacity = '0';
        ring.style.opacity = '0';
        isVisible = false;
    });
</script>

</body>
</html>