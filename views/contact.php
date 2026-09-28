<?php
/**
 * Red Runner - Modern Dark Theme Contact & Bulk Inquiries Page
 * Path: views/contact.php
 */

$status = '';
$debug_info = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_contact'])) {
    
    // 1. Form Data Sanitization
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // 2. Email Recipient Configuration
    $to = "info@redrunner.lk"; 
    $email_subject = "Red Runner Web Inquiry: $subject";
    
    // 3. HTML Email Template
    $email_html = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #27272a; border-radius: 16px; overflow: hidden; background-color: #09090b; color: #ffffff;'>
            <div style='background-color: #dc2626; color: white; padding: 24px; text-align: center;'>
                <h2 style='margin: 0; font-size: 22px; text-transform: uppercase; letter-spacing: 2px;'>Red Runner Inquiry</h2>
            </div>
            <div style='padding: 30px; line-height: 1.6; color: #d4d4d8;'>
                <p><strong style='color: #ffffff;'>Client Name:</strong> $name</p>
                <p><strong style='color: #ffffff;'>Email Address:</strong> $email</p>
                <p><strong style='color: #ffffff;'>Contact Number:</strong> $phone</p>
                <p><strong style='color: #ffffff;'>Inquiry Type:</strong> $subject</p>
                <hr style='border: 0; border-top: 1px solid #27272a; margin: 20px 0;'>
                <p><strong style='color: #ffffff;'>Order Specifications / Message:</strong></p>
                <p style='background: #18181b; padding: 16px; border-radius: 12px; border: 1px solid #27272a; color: #f4f4f5;'>$message</p>
            </div>
            <div style='background-color: #000000; color: #71717a; padding: 16px; text-align: center; font-size: 12px; border-top: 1px solid #27272a;'>
                Dispatched from www.redrunner.lk
            </div>
        </div>
    ";

    // 4. Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Red Runner Inquiry <noreply@redrunner.lk>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // 5. Send Email
    if(mail($to, $email_subject, $email_html, $headers)) {
        $status = 'success';
    } else {
        $status = 'error';
        $debug_info = "PHP mail() execution failed. Verify server mail transfer agent.";
    }
}
?>

<section class="pt-32 pb-24 bg-black min-h-screen text-white select-none">
    <div class="container mx-auto px-4 md:px-6 max-w-7xl">
        
        <?php if ($status === 'error'): ?>
            <div class="bg-red-950/40 border border-red-800 text-red-400 p-4 rounded-2xl mb-8">
                <p class="font-bold">Transmission Notice:</p>
                <p class="text-sm mt-1"><?php echo $debug_info; ?></p>
            </div>
        <?php endif; ?>

        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-16 md:mb-24">
            <div class="inline-flex items-center gap-2 bg-red-600/10 border border-red-600/20 px-4 py-2 rounded-full mb-4">
                <span class="text-red-500 text-[10px] font-black uppercase tracking-[3px]">Direct Factory Access</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-black text-white tracking-tighter uppercase leading-tight">Let's Connect</h2>
            <p class="text-zinc-400 mt-4 text-sm md:text-base font-medium">Discuss custom school monograms, wholesale gents orders, or international export shipments directly with our production desk.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Contact Info Cards -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                
                <a href="https://wa.me/94771179866" target="_blank" class="group flex items-center gap-5 p-6 bg-zinc-950 rounded-[28px] border border-zinc-900 shadow-sm hover:border-red-600/40 hover:shadow-xl hover:shadow-red-600/10 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-zinc-900 border border-zinc-800 text-red-500 rounded-2xl flex items-center justify-center text-xl group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-1">Direct WhatsApp</p>
                        <h4 class="text-lg font-bold text-white">+94 77 117 9866</h4>
                    </div>
                </a>

                <a href="tel:+94771179866" class="group flex items-center gap-5 p-6 bg-zinc-950 rounded-[28px] border border-zinc-900 shadow-sm hover:border-red-600/40 hover:shadow-xl hover:shadow-red-600/10 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-zinc-900 border border-zinc-800 text-red-500 rounded-2xl flex items-center justify-center text-xl group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-1">Factory Hotline</p>
                        <h4 class="text-lg font-bold text-white">+94 77 117 9866</h4>
                    </div>
                </a>

                <a href="mailto:info@redrunner.lk" class="group flex items-center gap-5 p-6 bg-zinc-950 rounded-[28px] border border-zinc-900 shadow-sm hover:border-red-600/40 hover:shadow-xl hover:shadow-red-600/10 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-zinc-900 border border-zinc-800 text-red-500 rounded-2xl flex items-center justify-center text-xl group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-1">Wholesale & Export</p>
                        <h4 class="text-lg font-bold text-white text-sm md:text-base">info@redrunner.lk</h4>
                    </div>
                </a>

                <!-- Factory Highlights Box -->
                <div class="mt-4 bg-zinc-950 border border-zinc-900 p-8 rounded-[32px] relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-600/10 blur-[50px] rounded-full pointer-events-none"></div>
                    <h4 class="text-xs font-black uppercase tracking-[3px] text-red-500 mb-4">Production Capabilities</h4>
                    <ul class="space-y-3 text-sm text-zinc-300 font-medium relative z-10">
                        <li class="flex items-center gap-3"><i class="fas fa-check text-red-600 text-xs"></i> School Monograms & Institutional Customization</li>
                        <li class="flex items-center gap-3"><i class="fas fa-check text-red-600 text-xs"></i> 20+ High-Gauge Gents Formal Knit Designs</li>
                        <li class="flex items-center gap-3"><i class="fas fa-check text-red-600 text-xs"></i> Non-Elastic Comfort Diabetic Therapeutic Socks</li>
                        <li class="flex items-center gap-3"><i class="fas fa-check text-red-600 text-xs"></i> Private Label OEM Tagging & Export Standard Packs</li>
                    </ul>
                </div>
            </div>

            <!-- Form Area -->
            <div class="lg:col-span-7">
                <div class="bg-zinc-950 p-8 md:p-12 rounded-[32px] md:rounded-[40px] border border-zinc-900 shadow-2xl">
                    <form action="" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest px-2">Your Name</label>
                                <input type="text" name="name" required placeholder="Nimal Perera" class="w-full bg-black border border-zinc-800 text-white text-sm font-medium px-5 py-4 rounded-[18px] outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all placeholder:text-zinc-600">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest px-2">Email Address</label>
                                <input type="email" name="email" required placeholder="nimal@company.lk" class="w-full bg-black border border-zinc-800 text-white text-sm font-medium px-5 py-4 rounded-[18px] outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all placeholder:text-zinc-600">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest px-2">Contact Number</label>
                                <input type="text" name="phone" placeholder="07x xxx xxxx" class="w-full bg-black border border-zinc-800 text-white text-sm font-medium px-5 py-4 rounded-[18px] outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all placeholder:text-zinc-600">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest px-2">Inquiry Category</label>
                                <select name="subject" class="w-full bg-black border border-zinc-800 text-white text-sm font-medium px-5 py-4 rounded-[18px] outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all appearance-none cursor-pointer">
                                    <option class="bg-zinc-900 text-white">Custom School Uniform Socks</option>
                                    <option class="bg-zinc-900 text-white">Gents Collection Wholesale</option>
                                    <option class="bg-zinc-900 text-white">Diabetic & Health Care Lines</option>
                                    <option class="bg-zinc-900 text-white">Private Label / OEM Contract</option>
                                    <option class="bg-zinc-900 text-white">Export Inquiries</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest px-2">Inquiry Specifications</label>
                            <textarea name="message" required rows="5" placeholder="Specify order volume, size requirements, pattern details, or target delivery dates..." class="w-full bg-black border border-zinc-800 text-white text-sm font-medium px-5 py-4 rounded-[20px] outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all resize-none placeholder:text-zinc-600"></textarea>
                        </div>

                        <button type="submit" name="submit_contact" class="group relative w-full bg-red-600 text-white py-5 rounded-[20px] font-black uppercase tracking-[3px] text-xs transition-all duration-300 shadow-xl shadow-red-600/30 hover:bg-red-700 active:scale-[0.98] overflow-hidden mt-4">
                            <span class="relative flex items-center justify-center gap-3">
                                Submit Factory Inquiry <i class="fas fa-paper-plane text-sm"></i>
                            </span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($status === 'success'): ?>
<script>
    Swal.fire({ 
        icon: 'success', 
        title: 'Inquiry Submitted', 
        text: 'Thank you for contacting Red Runner. Our production team will review your specs shortly.', 
        confirmButtonColor: '#dc2626',
        background: '#09090b',
        color: '#ffffff'
    });
</script>
<?php elseif ($status === 'error'): ?>
<script>
    Swal.fire({ 
        icon: 'error', 
        title: 'Submission Issue', 
        text: 'Unable to route message. Please connect directly via WhatsApp or Phone.', 
        confirmButtonColor: '#dc2626',
        background: '#09090b',
        color: '#ffffff'
    });
</script>
<?php endif; ?>