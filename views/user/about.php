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

    <!-- Custom JS Animations -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const faders = document.querySelectorAll(".fade-section");

            const appearOptions = {
                threshold: 0.2,
                rootMargin: "0px 0px -50px 0px"
            };

            const appearOnScroll = new IntersectionObserver(function(
                entries,
                observer
            ) {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add("opacity-100", "translate-y-0");
                    observer.unobserve(entry.target);
                });
            }, appearOptions);

            faders.forEach(fader => {
                appearOnScroll.observe(fader);
            });

            const menuBtn = document.getElementById("menu-btn");
            const mobileMenu = document.getElementById("mobile-menu");

            menuBtn.addEventListener("click", () => {
                mobileMenu.classList.toggle("hidden");
            });

        });
    </script>

</head>

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAVBAR -->
<?php include "navbar.php"; ?>

<div class="h-20"></div>

<!-- HERO SECTION -->
<section class="darion-gradient-bg py-24 px-6 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-1/4 left-1/4 w-48 h-48 bg-white rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-white rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="max-w-6xl mx-auto relative z-10 text-center animate-fade-in">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-darion-lg">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <span class="text-sm font-medium">Empowering Financial Freedom Since 2025</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-light mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-white to-darion-primary-light bg-clip-text text-transparent">
                About Darion Finance
            </span>
        </h1>
        
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto mb-8 leading-relaxed">
            Empowering small businesses with fast, secure, and transparent loan processing.
            We bridge the gap between MSMEs and financial institutions through technology.
        </p>
        
        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto mt-12">
            <div class="stat-card glass-card p-6 border border-darion-border rounded-darion-lg text-center">
                <div class="text-3xl font-light text-darion-primary-light mb-2">1000+</div>
                <div class="text-sm text-darion-text-muted">Loans Processed</div>
            </div>
            <div class="stat-card glass-card p-6 border border-darion-border rounded-darion-lg text-center">
                <div class="text-3xl font-light text-darion-primary-light mb-2">₹5Cr+</div>
                <div class="text-sm text-darion-text-muted">Amount Disbursed</div>
            </div>
            <div class="stat-card glass-card p-6 border border-darion-border rounded-darion-lg text-center">
                <div class="text-3xl font-light text-darion-primary-light mb-2">24-48H</div>
                <div class="text-sm text-darion-text-muted">Average Processing</div>
            </div>
            <div class="stat-card glass-card p-6 border border-darion-border rounded-darion-lg text-center">
                <div class="text-3xl font-light text-darion-primary-light mb-2">98%</div>
                <div class="text-sm text-darion-text-muted">Client Satisfaction</div>
            </div>
        </div>
    </div>
</section>

<!-- WHO WE ARE -->
<section class="py-20 px-6 max-w-6xl mx-auto animate-slide-up">
    <div class="glass-card p-12 rounded-darion-lg border border-darion-border">
        <h2 class="text-3xl font-light mb-8 text-white">Who We Are</h2>
        
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-lg text-darion-text-muted leading-relaxed mb-6">
                    Darion Finance is a trusted financial service provider specializing in 
                    Udyam Loans, Re-Loans, and MSME growth support. Since 2025, we have 
                    assisted hundreds of businesses in securing funding with a completely 
                    transparent 5% commission model.
                </p>
                
                <p class="text-lg text-darion-text-muted leading-relaxed">
                    Our goal is simple — <span class="text-darion-primary-light font-medium">make loan processing fast, reliable, and stress-free</span>. 
                    We combine technology with personalized service to ensure every client 
                    receives the financial support they need to grow their business.
                </p>
            </div>
            
            <div class="relative">
                <div class="aspect-square rounded-darion-lg overflow-hidden border border-darion-border">
                    <div class="w-full h-full bg-gradient-to-br from-darion-primary/20 to-darion-slate/10 flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="text-6xl font-light text-darion-primary-light mb-4">DF</div>
                            <div class="text-darion-text-muted">Darion Finance - Your Financial Partner</div>
                        </div>
                    </div>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute -top-4 -left-4 w-8 h-8 bg-darion-primary/30 rounded-full blur-lg"></div>
                <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-darion-slate/30 rounded-full blur-lg"></div>
            </div>
        </div>
    </div>
</section>

<!-- MISSION + VISION -->
<section class="py-16 px-6 max-w-6xl mx-auto">
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Mission -->
        <div class="mission-card glass-card p-10 rounded-darion-lg border border-darion-border animate-slide-up">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-light mb-4 text-white">Our Mission</h3>
            <p class="text-darion-text-muted leading-relaxed">
                To empower entrepreneurs and small businesses by providing seamless 
                loan application support, reducing manual work, and enabling faster 
                approval through verified documentation and technology-driven solutions.
            </p>
        </div>

        <!-- Vision -->
        <div class="mission-card glass-card p-10 rounded-darion-lg border border-darion-border animate-slide-up" style="animation-delay: 0.2s;">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-light mb-4 text-white">Our Vision</h3>
            <p class="text-darion-text-muted leading-relaxed">
                To become India's most trusted digital finance partner, connecting 
                MSMEs with financial institutions using secure, simplified, and 
                innovative technology-driven solutions that transform business financing.
            </p>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US -->
<section class="py-20 px-6 max-w-6xl mx-auto">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-light mb-4 text-white">Why Choose Darion Finance?</h2>
        <p class="text-darion-text-muted max-w-2xl mx-auto">
            We stand out from traditional loan services with our modern approach and customer-first philosophy.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="feature-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300 animate-slide-up">
            <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <h4 class="text-xl font-semibold mb-3 text-white">Fast Approvals</h4>
            <p class="text-darion-text-muted leading-relaxed">
                24-48 hour processing with real-time application tracking and status updates.
            </p>
        </div>

        <div class="feature-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300 animate-slide-up" style="animation-delay: 0.1s;">
            <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h4 class="text-xl font-semibold mb-3 text-white">Transparent Pricing</h4>
            <p class="text-darion-text-muted leading-relaxed">
                Only 5% commission payable after loan sanction. No hidden charges or upfront fees.
            </p>
        </div>

        <div class="feature-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300 animate-slide-up" style="animation-delay: 0.2s;">
            <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h4 class="text-xl font-semibold mb-3 text-white">Secure Document Handling</h4>
            <p class="text-darion-text-muted leading-relaxed">
                Bank-level encryption for all documents. Your Aadhaar, PAN, and financial data are 100% secure.
            </p>
        </div>
    </div>
</section>

<!-- TIMELINE -->
<section class="py-20 px-6 max-w-4xl mx-auto">
    <div class="text-center mb-16">
        <h2 class="text-3xl font-light mb-4 text-white">Our Journey</h2>
        <p class="text-darion-text-muted max-w-2xl mx-auto">
            From a startup to a trusted financial partner, here's our story of growth and innovation.
        </p>
    </div>

    <div class="relative">
        <!-- Timeline Line -->
        <div class="absolute left-6 md:left-1/2 transform md:-translate-x-1/2 w-1 h-full bg-gradient-to-b from-darion-primary to-darion-primary-light"></div>
        
        <!-- Timeline Items -->
        <div class="space-y-12">
            <!-- 2025 -->
            <div class="relative flex md:flex-row flex-col items-center gap-8">
                <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 z-10">
                    <div class="text-darion-primary-light font-bold">2025</div>
                </div>
                
                <div class="glass-card p-8 rounded-darion-lg border border-darion-border md:w-1/2 md:ml-auto md:text-right">
                    <h4 class="text-xl font-semibold mb-2 text-white">Foundation Year</h4>
                    <p class="text-darion-text-muted">
                        Darion Finance was founded with a vision to help MSME borrowers 
                        access financial support easily through digital solutions.
                    </p>
                </div>
            </div>

            <!-- 2026 -->
            <div class="relative flex md:flex-row flex-col items-center gap-8">
                <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 z-10 order-2 md:order-1">
                    <div class="text-darion-primary-light font-bold">2026</div>
                </div>
                
                <div class="glass-card p-8 rounded-darion-lg border border-darion-border md:w-1/2 md:mr-auto order-1 md:order-2">
                    <h4 class="text-xl font-semibold mb-2 text-white">Partnership Expansion</h4>
                    <p class="text-darion-text-muted">
                        Expanded our network by partnering with multiple lenders, 
                        significantly improving loan processing speed and options.
                    </p>
                </div>
            </div>

            <!-- 2027 -->
            <div class="relative flex md:flex-row flex-col items-center gap-8">
                <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 z-10">
                    <div class="text-darion-primary-light font-bold">2027</div>
                </div>
                
                <div class="glass-card p-8 rounded-darion-lg border border-darion-border md:w-1/2 md:ml-auto md:text-right">
                    <h4 class="text-xl font-semibold mb-2 text-white">Technology Integration</h4>
                    <p class="text-darion-text-muted">
                        Introduced advanced automation, document verification, 
                        and real-time tracking systems for enhanced customer experience.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-20 px-6 max-w-6xl mx-auto">
    <div class="glass-card p-12 rounded-darion-lg border border-darion-border text-center relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-32 h-32 bg-darion-primary rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-32 h-32 bg-darion-primary-light rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative z-10">
            <h2 class="text-3xl font-light mb-4 text-white">Ready to Begin Your Financial Journey?</h2>
            <p class="text-darion-text-muted text-lg mb-8 max-w-2xl mx-auto">
                Join thousands of satisfied customers who trust Darion Finance for their financial needs.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="index.php?page=apply"
                   class="group bg-gradient-to-r from-darion-primary to-darion-primary-light text-white font-semibold px-12 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 flex items-center gap-3">
                    <span>Apply for Loan</span>
                    <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                
                <a href="index.php?page=register"
                   class="px-12 py-4 glass-card border border-darion-border font-medium rounded-darion-lg hover:bg-white/10 transition-all duration-300">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php include "footer.php"; ?>

</body>
</html>