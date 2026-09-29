<?php
/**
 * Dasanayaka International - Modern Light Theme Contact & Inquiries Page
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
    $to = "info@dasanayaka.lk"; 
    $email_subject = "Dasanayaka International Web Inquiry: $subject";
    
    // 3. HTML Email Template
    $email_html = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; background-color: #ffffff; color: #0f172a;'>
            <div style='background-color: #047857; color: white; padding: 24px; text-align: center;'>
                <h2 style='margin: 0; font-size: 22px; text-transform: uppercase; letter-spacing: 2px;'>Dasanayaka International Inquiry</h2>
            </div>
            <div style='padding: 30px; line-height: 1.6; color: #334155;'>
                <p><strong style='color: #0f172a;'>Client Name:</strong> $name</p>
                <p><strong style='color: #0f172a;'>Email Address:</strong> $email</p>
                <p><strong style='color: #0f172a;'>Contact Number:</strong> $phone</p>
                <p><strong style='color: #0f172a;'>Inquiry Type:</strong> $subject</p>
                <hr style='border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;'>
                <p><strong style='color: #0f172a;'>Order Specifications / Message:</strong></p>
                <p style='background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; color: #1e293b;'>$message</p>
            </div>
            <div style='background-color: #f1f5f9; color: #64748b; padding: 16px; text-align: center; font-size: 12px; border-top: 1px solid #e2e8f0;'>
                Dispatched from Dasanayaka International Web Portal
            </div>
        </div>
    ";

    // 4. Headers
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Dasanayaka Inquiry <noreply@dasanayaka.lk>\r\n";
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

<section class="py-16 md:py-24 bg-slate-50 min-h-screen text-slate-800 select-none">
    <div class="container mx-auto px-4 md:px-6 max-w-7xl">
        
        <?php if ($status === 'success'): ?>
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 p-5 rounded-2xl mb-8 flex items-center gap-4 shadow-sm">
                <i class="fa-solid fa-circle-check text-2xl text-emerald-600"></i>
                <div>
                    <h4 class="font-extrabold text-sm uppercase tracking-wider">Inquiry Sent Successfully!</h4>
                    <p class="text-xs mt-0.5 font-medium">Thank you for connecting with Dasanayaka International. Our factory desk will respond shortly.</p>
                </div>
            </div>
        <?php elseif ($status === 'error'): ?>
            <div class="bg-amber-50 border border-amber-300 text-amber-900 p-5 rounded-2xl mb-8 flex items-center gap-4 shadow-sm">
                <i class="fa-solid fa-triangle-exclamation text-2xl text-amber-600"></i>
                <div>
                    <h4 class="font-extrabold text-sm uppercase tracking-wider">Notice</h4>
                    <p class="text-xs mt-0.5 font-medium"><?php echo $debug_info; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-16 md:mb-20">
            <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200/80 px-4 py-1.5 rounded-full mb-4">
                <span class="text-emerald-700 text-[10px] font-black uppercase tracking-[2.5px]">Factory Direct Access</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight uppercase leading-tight">Contact Us</h2>
            <p class="text-slate-600 mt-4 text-sm md:text-base font-medium">Discuss custom OEM orders, wholesale rates, or export shipments directly with our production desk.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Contact Info Cards -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                
                <a href="https://wa.me/94771179866" target="_blank" class="group flex items-center gap-5 p-6 bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:border-emerald-400 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center text-xl group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Direct WhatsApp Desk</p>
                        <h4 class="text-lg font-extrabold text-slate-900">+94 77 117 9866</h4>
                    </div>
                </a>

                <a href="tel:+94771179866" class="group flex items-center gap-5 p-6 bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:border-emerald-400 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center text-xl group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Factory Hotline</p>
                        <h4 class="text-lg font-extrabold text-slate-900">+94 77 117 9866</h4>
                    </div>
                </a>

                <a href="mailto:info@dasanayaka.lk" class="group flex items-center gap-5 p-6 bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:border-emerald-400 hover:shadow-xl hover:shadow-emerald-950/5 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center text-xl group-hover:bg-emerald-700 group-hover:text-white transition-colors">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Wholesale & Export Email</p>
                        <h4 class="text-lg font-extrabold text-slate-900 text-sm md:text-base">info@dasanayaka.lk</h4>
                    </div>
                </a>

                <!-- Factory Highlights Box -->
                <div class="mt-2 bg-gradient-to-br from-emerald-900 to-slate-900 text-white p-8 rounded-3xl relative overflow-hidden shadow-md">
                    <h4 class="text-xs font-black uppercase tracking-[2.5px] text-amber-300 mb-4">Production Capabilities</h4>
                    <ul class="space-y-3 text-sm text-slate-200 font-medium relative z-10">
                        <li class="flex items-center gap-3"><i class="fas fa-check text-amber-400 text-xs"></i> Institutional Customization & Monograms</li>
                        <li class="flex items-center gap-3"><i class="fas fa-check text-amber-400 text-xs"></i> High-Gauge Automated Knitting</li>
                        <li class="flex items-center gap-3"><i class="fas fa-check text-amber-400 text-xs"></i> OEM Private Labeling & Export Packaging</li>
                    </ul>
                </div>
            </div>

            <!-- Form Area -->
            <div class="lg:col-span-7">
                <div class="bg-white p-8 md:p-12 rounded-3xl border border-slate-200/80 shadow-sm">
                    <form action="" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider px-1">Your Name</label>
                                <input type="text" name="name" required placeholder="Full Name" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium px-5 py-4 rounded-2xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-400">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider px-1">Email Address</label>
                                <input type="email" name="email" required placeholder="email@company.com" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium px-5 py-4 rounded-2xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-400">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider px-1">Contact Number</label>
                                <input type="text" name="phone" placeholder="+94 xx xxx xxxx" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium px-5 py-4 rounded-2xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-400">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider px-1">Inquiry Category</label>
                                <select name="subject" class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium px-5 py-4 rounded-2xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all cursor-pointer">
                                    <option>Wholesale Order</option>
                                    <option>OEM Private Label Supply</option>
                                    <option>Institutional Customization</option>
                                    <option>International Export Shipment</option>
                                    <option>General Inquiry</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-wider px-1">Order Details / Requirements</label>
                            <textarea name="message" rows="5" required placeholder="Specify product quantities, target delivery dates, custom requirements..." class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm font-medium p-5 rounded-2xl outline-none focus:border-emerald-600 focus:ring-4 focus:ring-emerald-500/10 transition-all placeholder:text-slate-400 resize-none"></textarea>
                        </div>

                        <button type="submit" name="submit_contact" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-black text-xs uppercase tracking-widest py-4 rounded-2xl transition-all shadow-md shadow-emerald-700/20 active:scale-95 cursor-pointer flex items-center justify-center gap-2">
                            Submit Inquiry <i class="fas fa-paper-plane text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>