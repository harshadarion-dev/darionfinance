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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="text-sm font-medium">Required Documents Checklist</span>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-light mb-6 text-white">
            Required Documents
        </h1>
        
        <p class="text-darion-text-muted text-lg max-w-3xl mx-auto">
            List of mandatory documents needed for your loan application. 
            Ensure you have these ready for faster processing.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-8 mb-20 animate-slide-up">

        <!-- Identity Proof -->
        <div class="glass-card p-8 rounded-darion-lg border border-darion-border hover:border-darion-primary/50 transition-all duration-300">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-3">Identity Proof</h3>
                    <p class="text-sm text-darion-text-muted mb-4">Government-issued identification documents</p>
                </div>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Aadhaar Card</span>
                        <p class="text-xs text-darion-text-muted mt-1">Front and back scan (PDF/Image)</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">PAN Card</span>
                        <p class="text-xs text-darion-text-muted mt-1">Mandatory for all loan types</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Passport (Optional)</span>
                        <p class="text-xs text-darion-text-muted mt-1">If available, helps expedite process</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Income Proof -->
        <div class="glass-card p-8 rounded-darion-lg border border-darion-border hover:border-darion-primary/50 transition-all duration-300">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-3">Income Proof</h3>
                    <p class="text-sm text-darion-text-muted mb-4">Proof of regular income and financial stability</p>
                </div>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Salary Slip (Last 3 months)</span>
                        <p class="text-xs text-darion-text-muted mt-1">For salaried individuals</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Bank Statement (Last 6 months)</span>
                        <p class="text-xs text-darion-text-muted mt-1">PDF format from any bank</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Income Tax Returns (Optional)</span>
                        <p class="text-xs text-darion-text-muted mt-1">Last 2 years for higher loan amounts</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Address Proof -->
        <div class="glass-card p-8 rounded-darion-lg border border-darion-border hover:border-darion-primary/50 transition-all duration-300">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-3">Address Proof</h3>
                    <p class="text-sm text-darion-text-muted mb-4">Proof of current residential address</p>
                </div>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Aadhaar Card</span>
                        <p class="text-xs text-darion-text-muted mt-1">Address proof section</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Utility Bill (Electricity/Water)</span>
                        <p class="text-xs text-darion-text-muted mt-1">Latest bill within last 3 months</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Rental Agreement (if applicable)</span>
                        <p class="text-xs text-darion-text-muted mt-1">Notarized rental agreement</p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Business Documents -->
        <div class="glass-card p-8 rounded-darion-lg border border-darion-border hover:border-darion-primary/50 transition-all duration-300">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-white mb-3">Business Documents</h3>
                    <p class="text-sm text-darion-text-muted mb-4">For Business Loans & MSME Applications</p>
                </div>
            </div>
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Udyam Registration</span>
                        <p class="text-xs text-darion-text-muted mt-1">MSME registration certificate</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">GST Certificate</span>
                        <p class="text-xs text-darion-text-muted mt-1">If business is GST registered</p>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <div class="w-5 h-5 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-white">Business Bank Statement</span>
                        <p class="text-xs text-darion-text-muted mt-1">Last 12 months statement</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Document Upload Guidelines -->
    <div class="glass-card p-8 rounded-darion-lg border border-darion-border animate-slide-up" style="animation-delay: 0.1s;">
        <h3 class="text-2xl font-light mb-6 text-white">Document Upload Guidelines</h3>
        
        <div class="space-y-4">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-white mb-1">File Formats</h4>
                    <p class="text-darion-text-muted">Acceptable formats: PDF, JPEG, PNG (Max size: 5MB per file)</p>
                </div>
            </div>
            
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-white mb-1">Scan Quality</h4>
                    <p class="text-darion-text-muted">Ensure documents are clear, legible, and all four corners are visible</p>
                </div>
            </div>
            
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-white mb-1">Security & Privacy</h4>
                    <p class="text-darion-text-muted">Your documents are encrypted and stored securely. We never share your data with third parties without consent.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center mt-16 animate-slide-up" style="animation-delay: 0.2s;">
        <div class="glass-card p-12 rounded-darion-lg border border-darion-border">
            <h2 class="text-3xl font-light mb-4 text-white">Ready to Upload Your Documents?</h2>
            <p class="text-darion-text-muted text-lg mb-8 max-w-2xl mx-auto">
                Once you have all the required documents ready, proceed to the application form.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="index.php?page=apply"
                   class="group bg-gradient-to-r from-darion-primary to-darion-primary-light text-white font-semibold px-12 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 flex items-center gap-3">
                    <span>Start Application</span>
                    <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
            
            <div class="mt-8 text-sm text-darion-text-muted flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>100% Secure Upload • Bank-Level Encryption • Confidential Processing</span>
            </div>
        </div>
    </div>

</section>

<?php include "footer.php"; ?>
</body>
</html>
