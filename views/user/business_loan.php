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

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAVBAR -->
<?php include "navbar.php"; ?>

<div class="h-20"></div>

<!-- HERO SECTION -->
<section class="darion-gradient-bg py-20 px-6 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-6xl mx-auto relative z-10 text-center animate-fade-in">
        <div class="inline-flex items-center gap-2 mb-4 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-darion-lg">
            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <span class="text-sm font-medium">Trusted Business Loan Services</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-light mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-white to-darion-primary-light bg-clip-text text-transparent">
                Business Loans
            </span>
        </h1>
        
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto mb-8 leading-relaxed">
            Empower your business growth with flexible funding options crafted for startups, 
            MSMEs, traders, and enterprise owners. Get approved within 24-48 hours.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10">
            <a href="index.php?page=apply"
               class="group bg-white text-darion-bg font-semibold px-10 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 hover:bg-darion-primary-light hover:text-white flex items-center gap-3">
                <span>Apply Now</span>
                <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
            
            <a href="#features"
               class="px-10 py-4 glass-card border border-white/20 font-medium rounded-darion-lg hover:bg-white/10 transition-all duration-300">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="max-w-6xl mx-auto px-6 py-20">

    <!-- Features Grid -->
    <div id="features" class="grid md:grid-cols-3 gap-8 mb-20 animate-slide-up">
        <div class="feature-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-3">Working Capital Support</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Get financial support for daily operations, staff payments, inventory, and cash flow management.
            </p>
        </div>

        <div class="feature-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-3">Expansion & Growth</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Fuel your business expansion, purchase machinery, open new branches, or invest in technology.
            </p>
        </div>

        <div class="feature-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold mb-3">Minimal Documentation</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Quick processing with simple and secure document uploads. Only 5% commission after sanction.
            </p>
        </div>
    </div>

    <!-- Overview -->
    <div class="glass-card p-10 rounded-darion-lg border border-darion-border mb-16 animate-slide-up">
        <h2 class="text-3xl font-light mb-6 text-white">Business Loan Overview</h2>
        <p class="text-darion-text-muted text-lg leading-relaxed mb-6">
            Darion Finance offers fast and reliable Business Loan solutions designed to help entrepreneurs,
            small businesses, and MSMEs scale operations efficiently. With transparent fees, minimal documentation,
            and expert guidance — we ensure your business receives the financial boost it needs to grow.
        </p>
        
        <!-- Loan Details -->
        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="bg-darion-panel/50 p-6 rounded-darion-sm border border-darion-border">
                <div class="text-2xl font-light text-darion-primary-light mb-2">₹1 Lakh - ₹50 Lakhs</div>
                <div class="text-sm text-darion-text-muted">Loan Amount Range</div>
            </div>
            <div class="bg-darion-panel/50 p-6 rounded-darion-sm border border-darion-border">
                <div class="text-2xl font-light text-darion-primary-light mb-2">1-7 Years</div>
                <div class="text-sm text-darion-text-muted">Repayment Tenure</div>
            </div>
            <div class="bg-darion-panel/50 p-6 rounded-darion-sm border border-darion-border">
                <div class="text-2xl font-light text-darion-primary-light mb-2">24-48 Hours</div>
                <div class="text-sm text-darion-text-muted">Approval Time</div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid md:grid-cols-2 gap-12 mb-20">
        <!-- Eligibility -->
        <div class="animate-slide-up">
            <h2 class="text-3xl font-light mb-8 text-white flex items-center gap-3">
                <div class="step-number">1</div>
                Eligibility Criteria
            </h2>
            
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Business operational for 1+ year</div>
                        <div class="text-sm text-darion-text-muted mt-1">Minimum business vintage requirement</div>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Udyam Registration</div>
                        <div class="text-sm text-darion-text-muted mt-1">Optional but highly recommended</div>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Aadhaar & PAN mandatory</div>
                        <div class="text-sm text-darion-text-muted mt-1">For all business owners/partners</div>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Bank Statement (6-12 months)</div>
                        <div class="text-sm text-darion-text-muted mt-1">Regular business transactions proof</div>
                    </div>
                </div>
                
                <div class="flex items-start gap-3">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Latest ITR (if applicable)</div>
                        <div class="text-sm text-darion-text-muted mt-1">Income tax returns for business</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents -->
        <div class="animate-slide-up">
            <h2 class="text-3xl font-light mb-8 text-white flex items-center gap-3">
                <div class="step-number">2</div>
                Required Documents
            </h2>
            
            <div class="space-y-4">
                <div class="flex items-center gap-3 p-4 bg-darion-panel/30 rounded-darion-sm border border-darion-border">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Aadhaar Card</div>
                        <div class="text-sm text-darion-text-muted">All partners/directors</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 p-4 bg-darion-panel/30 rounded-darion-sm border border-darion-border">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">PAN Card</div>
                        <div class="text-sm text-darion-text-muted">Business & personal PAN</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 p-4 bg-darion-panel/30 rounded-darion-sm border border-darion-border">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Udyam Certificate</div>
                        <div class="text-sm text-darion-text-muted">Registration certificate</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 p-4 bg-darion-panel/30 rounded-darion-sm border border-darion-border">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Bank Statement</div>
                        <div class="text-sm text-darion-text-muted">6-12 months business statement</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 p-4 bg-darion-panel/30 rounded-darion-sm border border-darion-border">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">GST Certificate</div>
                        <div class="text-sm text-darion-text-muted">If business is GST registered</div>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 p-4 bg-darion-panel/30 rounded-darion-sm border border-darion-border">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-white">Income Proof / ITR</div>
                        <div class="text-sm text-darion-text-muted">Latest financial year returns</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center animate-slide-up">
        <div class="glass-card p-12 rounded-darion-lg border border-darion-border">
            <h2 class="text-3xl font-light mb-4 text-white">Grow Your Business Today</h2>
            <p class="text-darion-text-muted text-lg mb-8 max-w-2xl mx-auto">
                Take your business to the next level with our flexible business loan options. 
                Quick approval, transparent process, and dedicated support.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="index.php?page=apply"
                   class="group bg-gradient-to-r from-darion-primary to-darion-primary-light text-white font-semibold px-12 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 flex items-center gap-3">
                    <span>Apply for Business Loan</span>
                    <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                
                <a href="index.php?page=contact"
                   class="px-12 py-4 glass-card border border-darion-border font-medium rounded-darion-lg hover:bg-white/10 transition-all duration-300">
                    Contact Business Advisor
                </a>
            </div>
            
            <div class="mt-8 text-sm text-darion-text-muted flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>100% Secure Application • MSME Priority Processing</span>
            </div>
        </div>
    </div>

</section>

<!-- FOOTER -->
<?php include "footer.php"; ?>

</body>
</html>