<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Darion Finance - Home</title>

    <!-- TAILWIND CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DARION DASHBOARD FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom Tailwind Config with Darion Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'darion-bg': '#090c10',
                        'darion-panel': '#161b22',
                        'darion-primary': '#2C7446',
                        'darion-primary-light': '#4a9e86',
                        'darion-slate': '#5e7a7d',
                        'darion-text': '#ffffff',
                        'darion-text-muted': '#8b949e',
                        'darion-gold': '#d4a94e',
                        'darion-red': '#c94646',
                        'darion-glass': 'rgba(22, 27, 34, 0.7)',
                        'darion-border': 'rgba(255, 255, 255, 0.1)',
                    },
                    borderRadius: {
                        'darion-lg': '16px',
                        'darion-sm': '8px',
                    },
                    backdropBlur: {
                        'darion': '10px',
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS for Darion Effects -->
    <style>
        /* Darion Background Effects */
        .darion-bg-effect {
            background-color: #090c10;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(44, 116, 70, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(94, 122, 125, 0.1) 0%, transparent 40%);
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(22, 27, 34, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Logo Stipple Effect */
        .logo-stipple {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff 20%, transparent 21%), #161b22;
            background-size: 3px 3px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Active Navigation Style */
        .nav-active {
            background: linear-gradient(90deg, rgba(44, 116, 70, 0.2) 0%, transparent 100%);
            color: #4a9e86;
            border-left: 2px solid #2C7446;
        }
    </style>
</head>

<body class="bg-[#0b0b0b] text-white">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-6 relative z-30">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>

    <!-- Desktop Navigation -->
    <div class="hidden md:flex gap-4 font-medium">
        <a href="index.php?page=apply" class="px-4 py-2 rounded-darion-sm bg-darion-glass text-darion-primary-light border-l-2 border-darion-primary">
            Apply Loan
        </a>
        <!-- About Us Link -->
        <a href="index.php?page=about" class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
            About Us
        </a>
    </div>

    <!-- Mobile Menu Button -->
    <button id="menu-btn" class="md:hidden text-2xl text-white/80 hover:text-white transition-colors">&#9776;</button>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 bg-darion-panel/95 backdrop-blur-lg border-b border-darion-border px-6 py-4 z-40">
        <!-- Home Link -->
        <a href="index.php?page=dashboard" class="block py-3 border-b border-darion-border/30 text-white/90 hover:text-darion-primary-light transition-colors">
            Home
        </a>
        
        <!-- Mobile Loans Accordion -->
        <a href="index.php?page=apply" class="block py-3 text-white/90 hover:text-darion-primary-light transition-colors">
            Apply Loan
        </a>
        <a href="index.php?page=about" class="block py-3 text-white/90 hover:text-darion-primary-light transition-colors">
            About Us
        </a>
    </div>
</nav>

<!-- Mobile Menu JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileLoansBtn = document.getElementById('mobile-loans-btn');
        const mobileLoansMenu = document.getElementById('mobile-loans-menu');
        const mobileLoansArrow = document.getElementById('mobile-loans-arrow');
        
        // Toggle main mobile menu
        menuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Toggle loans submenu on mobile
        if (mobileLoansBtn) {
            mobileLoansBtn.addEventListener('click', function() {
                mobileLoansMenu.classList.toggle('hidden');
                mobileLoansArrow.classList.toggle('rotate-180');
            });
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (menuBtn && !menuBtn.contains(event.target) && 
                mobileMenu && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                if (mobileLoansMenu) {
                    mobileLoansMenu.classList.add('hidden');
                }
                if (mobileLoansArrow) {
                    mobileLoansArrow.classList.remove('rotate-180');
                }
            }
        });
        
        // Close menu when clicking on a link
        if (mobileMenu) {
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                    if (mobileLoansMenu) {
                        mobileLoansMenu.classList.add('hidden');
                    }
                    if (mobileLoansArrow) {
                        mobileLoansArrow.classList.remove('rotate-180');
                    }
                });
            });
        }
    });
</script>
<div class="h-20"></div>

<section class="max-w-6xl mx-auto px-6 py-16">
    <div class="text-center mb-16 animate-fade-in">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-darion-primary/10 backdrop-blur-sm rounded-darion-lg">
            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-medium">Frequently Asked Questions</span>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-light mb-6 text-white">
            FAQ & Help Center
        </h1>
        
        <p class="text-darion-text-muted text-lg max-w-3xl mx-auto">
            Answers to frequently asked questions about our loan services, 
            application process, documents, and support.
        </p>
    </div>

    <div class="space-y-6 max-w-4xl mx-auto animate-slide-up">

        <!-- FAQ 1 -->
        <div class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
            <button class="faq-question w-full flex items-center justify-between p-6 text-left hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-darion-primary-light font-medium">1</span>
                    </div>
                    <h2 class="text-xl font-semibold text-white">How long does loan approval take?</h2>
                </div>
                <svg class="w-6 h-6 text-darion-primary-light transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="faq-answer px-6 pb-6 hidden">
                <div class="pl-12">
                    <p class="text-darion-text-muted leading-relaxed">
                        Loan approval typically takes 24–48 hours for personal loans and 2–5 working days 
                        for business loans, depending on document verification and bank processing time. 
                        We expedite the process by pre-verifying your documents and ensuring they meet 
                        all requirements before submission.
                    </p>
                    <div class="mt-4 text-sm text-darion-primary-light flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Typical processing time: 24-48 hours</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
            <button class="faq-question w-full flex items-center justify-between p-6 text-left hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-darion-primary-light font-medium">2</span>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Can I apply without a CIBIL score?</h2>
                </div>
                <svg class="w-6 h-6 text-darion-primary-light transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="faq-answer px-6 pb-6 hidden">
                <div class="pl-12">
                    <p class="text-darion-text-muted leading-relaxed">
                        Yes, applicants with low or no CIBIL score may still be eligible for loans. 
                        We consider alternative factors such as:
                    </p>
                    <ul class="mt-3 space-y-2 text-darion-text-muted">
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span>Regular income proof (bank statements, salary slips)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span>Business stability and Udyam registration</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span>Asset ownership and collateral (for secured loans)</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
            <button class="faq-question w-full flex items-center justify-between p-6 text-left hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-darion-primary-light font-medium">3</span>
                    </div>
                    <h2 class="text-xl font-semibold text-white">What is the commission fee structure?</h2>
                </div>
                <svg class="w-6 h-6 text-darion-primary-light transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="faq-answer px-6 pb-6 hidden">
                <div class="pl-12">
                    <p class="text-darion-text-muted leading-relaxed">
                        Darion Finance maintains complete transparency with our fee structure:
                    </p>
                    <ul class="mt-3 space-y-2 text-darion-text-muted">
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>5% Commission</strong> – Only applicable after loan sanction</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>No Hidden Charges</strong> – No processing fees or upfront payments</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Free Consultation</strong> – Initial guidance and support is completely free</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Commission Calculation</strong> – Based on sanctioned loan amount only</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- FAQ 4 -->
        <div class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
            <button class="faq-question w-full flex items-center justify-between p-6 text-left hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-darion-primary-light font-medium">4</span>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Where can I upload documents?</h2>
                </div>
                <svg class="w-6 h-6 text-darion-primary-light transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="faq-answer px-6 pb-6 hidden">
                <div class="pl-12">
                    <p class="text-darion-text-muted leading-relaxed">
                        Document upload is available through multiple channels for your convenience:
                    </p>
                    <ul class="mt-3 space-y-2 text-darion-text-muted">
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Dashboard Upload</strong> – Inside the Apply Loan page in your user dashboard</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Email Submission</strong> – Send documents to docs@darionfinance.com</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>WhatsApp Support</strong> – Share documents on +91 98765 43210</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Physical Submission</strong> – Visit our Hyderabad office (by appointment)</span>
                        </li>
                    </ul>
                    <div class="mt-4 text-sm text-darion-primary-light flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>All uploads are encrypted and 100% secure</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ 5 -->
        <div class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
            <button class="faq-question w-full flex items-center justify-between p-6 text-left hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-darion-primary-light font-medium">5</span>
                    </div>
                    <h2 class="text-xl font-semibold text-white">How can I track my loan application status?</h2>
                </div>
                <svg class="w-6 h-6 text-darion-primary-light transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="faq-answer px-6 pb-6 hidden">
                <div class="pl-12">
                    <p class="text-darion-text-muted leading-relaxed">
                        You can track your loan application through multiple channels:
                    </p>
                    <ul class="mt-3 space-y-2 text-darion-text-muted">
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Real-time Dashboard</strong> – Log into your account for live updates</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>SMS Notifications</strong> – Receive updates on registered mobile number</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Email Updates</strong> – Detailed status reports sent to your email</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Support Team</strong> – Call +91 98765 43210 for personalized updates</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- FAQ 6 -->
        <div class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
            <button class="faq-question w-full flex items-center justify-between p-6 text-left hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <span class="text-darion-primary-light font-medium">6</span>
                    </div>
                    <h2 class="text-xl font-semibold text-white">Is Udyam registration mandatory for business loans?</h2>
                </div>
                <svg class="w-6 h-6 text-darion-primary-light transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div class="faq-answer px-6 pb-6 hidden">
                <div class="pl-12">
                    <p class="text-darion-text-muted leading-relaxed">
                        While not always mandatory, Udyam registration is highly recommended for several reasons:
                    </p>
                    <ul class="mt-3 space-y-2 text-darion-text-muted">
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Faster Approvals</strong> – Banks prioritize registered MSMEs</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Better Interest Rates</strong> – Access to government-subsidized rates</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>Higher Loan Amounts</strong> – Increased eligibility limits</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-darion-primary-light mt-1.5 flex-shrink-0"></div>
                            <span><strong>We Can Help</strong> – Our team assists with Udyam registration if needed</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Additional Help Section -->
    <div class="mt-20 text-center animate-slide-up" style="animation-delay: 0.1s;">
        <div class="glass-card p-12 rounded-darion-lg border border-darion-border">
            <h2 class="text-3xl font-light mb-4 text-white">Still Have Questions?</h2>
            <p class="text-darion-text-muted text-lg mb-8 max-w-2xl mx-auto">
                Our support team is ready to help you with any questions about loans, 
                documents, eligibility, or the application process.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">  
                <a href="index.php?page=required_documents"
                   class="px-12 py-4 glass-card border border-darion-border font-medium rounded-darion-lg hover:bg-white/10 transition-all duration-300">
                    View Required Documents
                </a>
            </div>
            
            <div class="mt-8 text-sm text-darion-text-muted flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Quick Response • Expert Guidance • 7 Days Support</span>
            </div>
        </div>
    </div>

</section>

<!-- JavaScript for FAQ Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const arrow = this.querySelector('svg');
                
                // Toggle current FAQ
                answer.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
                
                // Close other FAQs
                faqQuestions.forEach(otherQuestion => {
                    if (otherQuestion !== this) {
                        const otherAnswer = otherQuestion.nextElementSibling;
                        const otherArrow = otherQuestion.querySelector('svg');
                        otherAnswer.classList.add('hidden');
                        otherArrow.classList.remove('rotate-180');
                    }
                });
            });
        });
    });
</script>

<?php include "footer.php"; ?>
</body>
</html>
