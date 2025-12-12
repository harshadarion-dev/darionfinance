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
<body class="bg-darion-bg text-darion-text font-inter">

<!-- NAVBAR + HERO SECTION (Merged) -->
<section class="darion-bg-effect relative overflow-hidden min-h-[85vh]">
    <!-- Star Wave Effect Canvas -->
    <canvas id="starWaveCanvas" class="absolute inset-0 z-0"></canvas>
    
    <!-- Background Overlay (to ensure text readability) -->
    <div class="absolute inset-0 bg-gradient-to-br from-darion-primary/20 via-darion-primary/10 to-darion-slate/5 backdrop-blur-[1px] z-1"></div>
    
    <!-- Decorative Elements -->
    <div class="absolute top-20 left-10 w-64 h-64 bg-darion-primary/10 rounded-full blur-3xl z-2"></div>
    <div class="absolute bottom-20 right-10 w-80 h-80 bg-darion-slate/10 rounded-full blur-3xl z-2"></div>

    <!-- NAVBAR -->
    <nav class="flex items-center justify-between px-6 py-6 relative z-30">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=home" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>

    <!-- Desktop Navigation -->
    <div class="hidden md:flex gap-4 font-medium">
        <!-- Loans Dropdown -->
        <div class="relative group">
            <button class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm flex items-center gap-1">
                Loans
                <svg class="w-4 h-4 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="absolute top-full left-0 mt-2 w-56 bg-darion-panel/90 backdrop-blur-lg border border-darion-border rounded-darion-lg shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top -translate-y-2 group-hover:translate-y-0 z-50">
                <div class="py-2">
                    <a href="index.php?page=personal_loan" class="flex items-center gap-3 px-4 py-3 hover:bg-darion-glass transition-colors group/item">
                        <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium">Personal Loan</div>
                            <div class="text-xs text-darion-text-muted mt-0.5">For individuals, salaried & self-employed</div>
                        </div>
                    </a>
                    
                    <a href="index.php?page=business_loan" class="flex items-center gap-3 px-4 py-3 hover:bg-darion-glass transition-colors group/item">
                        <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium">Business Loan</div>
                            <div class="text-xs text-darion-text-muted mt-0.5">For businesses, startups & MSMEs</div>
                        </div>
                    </a>
                    
                    <a href="index.php?page=loan_assistant" class="flex items-center gap-3 px-4 py-3 hover:bg-darion-glass transition-colors group/item">
                        <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium">Loan Assistant</div>
                            <div class="text-xs text-darion-text-muted mt-0.5">Udyam & document assistance</div>
                        </div>
                    </a>
                    
                    <a href="index.php?page=two_wheeler_loan" class="flex items-center gap-3 px-4 py-3 hover:bg-darion-glass transition-colors group/item">
                        <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-white font-medium">Two Wheeler Loan</div>
                            <div class="text-xs text-darion-text-muted mt-0.5">For bike & scooter financing</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Other Navigation Links -->
        <a href="index.php?page=register" class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
            Register
        </a>
        <a href="index.php?page=login" class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
            Login
        </a>
        <a href="index.php?page=about" class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
            About Us
        </a>
    </div>

    <!-- Mobile Menu Button -->
    <button id="menu-btn" class="md:hidden text-2xl text-white/80 hover:text-white transition-colors">&#9776;</button>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 bg-darion-panel/95 backdrop-blur-lg border-b border-darion-border px-6 py-4 z-40">
        <!-- Mobile Loans Accordion -->
        <div class="mb-4">
            <button id="mobile-loans-btn" class="flex items-center justify-between w-full py-3 text-left text-white/90 border-b border-darion-border/30">
                <span class="font-medium">Loans</span>
                <svg id="mobile-loans-arrow" class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            
            <div id="mobile-loans-menu" class="hidden pl-4 pt-2 space-y-3">
                <a href="index.php?page=personal_loan" class="flex items-center gap-3 py-2 text-white/80 hover:text-darion-primary-light transition-colors">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span>Personal Loan</span>
                </a>
                
                <a href="index.php?page=business_loan" class="flex items-center gap-3 py-2 text-white/80 hover:text-darion-primary-light transition-colors">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span>Business Loan</span>
                </a>
                
                <a href="index.php?page=loan_assistant" class="flex items-center gap-3 py-2 text-white/80 hover:text-darion-primary-light transition-colors">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span>Loan Assistant</span>
                </a>
                
                <a href="index.php?page=two_wheeler_loan" class="flex items-center gap-3 py-2 text-white/80 hover:text-darion-primary-light transition-colors">
                    <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                    <span>Two Wheeler Loan</span>
                </a>
            </div>
    </div>
        <!-- Other Mobile Links -->
        <a href="index.php?page=register" class="block py-3 border-b border-darion-border/30 text-white/90 hover:text-darion-primary-light transition-colors">
            Register
        </a>
        <a href="index.php?page=login" class="block py-3 border-b border-darion-border/30 text-white/90 hover:text-darion-primary-light transition-colors">
            Login
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
        mobileLoansBtn.addEventListener('click', function() {
            mobileLoansMenu.classList.toggle('hidden');
            mobileLoansArrow.classList.toggle('rotate-180');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                mobileLoansMenu.classList.add('hidden');
                mobileLoansArrow.classList.remove('rotate-180');
            }
        });
        
        // Close menu when clicking on a link
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                mobileLoansMenu.classList.add('hidden');
                mobileLoansArrow.classList.remove('rotate-180');
            });
        });
    });
</script>

    <div id="mobile-menu" class="hidden md:hidden flex flex-col bg-darion-panel/80 backdrop-blur-sm border-b border-white/20 px-6 py-4 relative z-40">
        <a href="index.php?page=home" class="py-3 border-b border-white/20 hover:text-darion-primary-light transition-colors text-white">Home</a>
        <a href="index.php?page=register" class="py-3 border-b border-white/20 hover:text-darion-primary-light transition-colors text-white">Register</a>
        <a href="index.php?page=login" class="py-3 hover:text-darion-primary-light transition-colors text-white">Login</a>
    </div>

    <!-- HERO CONTENT -->
    <div class="relative z-20 px-6 pt-16 pb-32 md:pt-32 md:pb-40 text-center fade-section opacity-0 translate-y-10 transition-all duration-700">
        <div class="max-w-4xl mx-auto">
            <!-- Animated Floating Elements -->
            <div class="absolute -top-10 left-1/4 w-12 h-12 bg-darion-primary/20 rounded-full blur-lg animate-pulse z-10"></div>
            <div class="absolute top-1/3 right-1/4 w-8 h-8 bg-darion-slate/20 rounded-full blur-lg animate-pulse delay-1000 z-10"></div>
            
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-light mb-6 leading-tight">
                <span class="bg-gradient-to-r from-white via-white to-darion-primary-light bg-clip-text text-transparent">
                    Finance Made Simple
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto text-white/90 leading-relaxed">
                Fast Udyam loans, re-loans, and quick financial support with transparent 
                <span class="text-darion-primary-light font-medium">5% commission</span>.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-12">
                <a href="index.php?page=register"
                   class="group bg-white text-darion-bg font-medium px-10 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 hover:bg-darion-primary-light hover:text-white flex items-center gap-3 min-w-[220px] justify-center relative z-20">
                    <span>Get Started</span>
                    <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Star Wave Effect Script -->
    <script>
        // Initialize star wave effect
        const starWaveCanvas = document.getElementById('starWaveCanvas');
        const starCtx = starWaveCanvas.getContext('2d');

        let starWidth, starHeight;
        let mouse = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
        
        // Configuration - adjusted for hero section
        const gap = 20; // Distance between dots
        const lineLength = 15; // Length of the lines
        const thickness = 0.5; // Thickness of lines
        const lineColor = 'rgba(255, 255, 255, 0.29)'; // White lines with transparency

        // Resize canvas to fill hero section
        function resizeStarCanvas() {
            starWidth = starWaveCanvas.width = window.innerWidth;
            starHeight = starWaveCanvas.height = window.innerHeight;
        }
        
        window.addEventListener('resize', resizeStarCanvas);
        resizeStarCanvas();

        // Track mouse movement
        window.addEventListener('mousemove', (e) => {
            mouse.x = e.clientX;
            mouse.y = e.clientY;
        });

        function drawStarWave() {
            // Clear with dark overlay for subtle trail effect
            starCtx.fillStyle = 'rgba(10, 15, 30, 0.1)'; 
            starCtx.fillRect(0, 0, starWidth, starHeight);

            starCtx.strokeStyle = lineColor;
            starCtx.lineWidth = thickness;
            starCtx.lineCap = 'round';

            // Create the grid
            for (let x = 0; x < starWidth; x += gap) {
                for (let y = 0; y < starHeight; y += gap) {
                    
                    // Calculate the center of the current cell
                    const centerX = x + gap / 2;
                    const centerY = y + gap / 2;

                    // Calculate distance and angle to mouse
                    const dx = mouse.x - centerX;
                    const dy = mouse.y - centerY;
                    
                    // Math.atan2 gives us the angle in radians between the point and the mouse
                    const angle = Math.atan2(dy, dx); 
                    
                    // Calculate distance for dynamic line length
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    const dynamicLength = Math.max(5, lineLength * (200 / Math.max(dist, 200)));
                    
                    // Save context state before transforming
                    starCtx.save();
                    
                    // Move "pen" to the grid point
                    starCtx.translate(centerX, centerY);
                    
                    // Rotate the canvas context to point at mouse
                    starCtx.rotate(angle);

                    // Draw the line with dynamic length
                    starCtx.beginPath();
                    starCtx.moveTo(-dynamicLength / 2, 0); 
                    starCtx.lineTo(dynamicLength / 2, 0);
                    starCtx.stroke();
                    
                    // Restore context to original state
                    starCtx.restore();
                }
            }

            requestAnimationFrame(drawStarWave);
        }

        // Start animation loop
        drawStarWave();

        // Mobile menu toggle
        document.getElementById('menu-btn').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</section>

            <!-- Stats Preview -->
<div class="mt-20 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl mx-auto">
    <div class="backdrop-blur-sm bg-darion-text/5 border border-darion-text/10 rounded-darion-lg p-6 hover:border-darion-primary-light/30 transition-all duration-300">
        <div class="text-3xl font-light text-darion-primary-light mb-2">₹25 Cr</div>
        <div class="text-sm text-darion-text/70">Maximum Loan Value</div>
    </div>
    <div class="backdrop-blur-sm bg-darion-text/5 border border-darion-text/10 rounded-darion-lg p-6 hover:border-darion-primary-light/30 transition-all duration-300">
        <div class="text-3xl font-light text-darion-primary-light mb-2">98%</div>
        <div class="text-sm text-darion-text/70">High Approval Rate</div>
    </div>
    <div class="backdrop-blur-sm bg-darion-text/5 border border-darion-text/10 rounded-darion-lg p-6 hover:border-darion-primary-light/30 transition-all duration-300">
        <div class="text-3xl font-light text-darion-primary-light mb-2">24-48h</div>
        <div class="text-sm text-darion-text/70">Fast Processing Time</div>
    </div>
</div>
</div>
</div>

<!-- Scroll Indicator -->
<div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
    <div class="animate-bounce">
        <svg class="w-6 h-6 text-darion-text/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</div>
</section>

<!-- ABOUT DARION FINANCE -->
<section class="py-20 px-6 fade-section opacity-0 translate-y-10 transition-all duration-700 bg-gradient-to-b from-darion-bg to-darion-panel">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-light text-darion-text mb-4">Capital that Builds Futures</h2>
            <p class="text-xl text-darion-text-muted max-w-4xl mx-auto">
                Darion Finance is a premier financial consultancy firm dedicated to empowering Indian businesses and individuals with the capital they need to grow. We are your strategic financial partners.
            </p>
        </div>
        
        <div class="glass-card rounded-darion-lg p-10 mb-12 border border-darion-border">
            <p class="text-lg text-darion-text/90 leading-relaxed mb-6">
                In an economy where opportunity waits for no one, access to timely capital is the difference between stagnation and success. At Darion Finance, we bridge the gap between ambition and liquidity.
            </p>
            <p class="text-lg text-darion-text/90 leading-relaxed">
                With a deep network of partnerships across India's leading Banks, NBFCs, and Private Financial Institutions, we ensure that when you apply with us, you get the best rates, the highest eligibility, and the fastest disbursement.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-10">
            <div class="glass-card rounded-darion-lg p-8 border border-darion-border">
                <h3 class="text-2xl font-light text-darion-primary-light mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Our Mission
                </h3>
                <p class="text-darion-text/90">
                    To democratize access to credit for every deserving Indian enterprise and individual. We strive to simplify the complex world of finance, replacing red tape with red carpets for our clients.
                </p>
            </div>
            
            <div class="glass-card rounded-darion-lg p-8 border border-darion-border">
                <h3 class="text-2xl font-light text-darion-primary-light mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    The Darion Advantage
                </h3>
                <ul class="space-y-3 text-darion-text/90">
                    <li class="flex items-start gap-2">• High Approval Rate</li>
                    <li class="flex items-start gap-2">• Unmatched Speed</li>
                    <li class="flex items-start gap-2">• Transparent Processing</li>
                    <li class="flex items-start gap-2">• Pan-India Network</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CORE SERVICES -->
<section class="py-20 px-6 fade-section opacity-0 translate-y-10 transition-all duration-700">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-light text-center text-darion-text mb-16">Our Core Services</h2>
        <p class="text-xl text-center text-darion-text-muted mb-12 max-w-4xl mx-auto">
            We specialize in high-value, structured financial solutions tailored to your specific needs.
        </p>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- SME & Business Loans -->
            <div class="glass-card p-8 rounded-darion-lg hover:shadow-xl transition-all duration-300 hover:border-darion-primary/30 border border-darion-border">
                <div class="w-14 h-14 bg-darion-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium mb-3 text-center">SME & Business Loans</h3>
                <p class="text-darion-text-muted text-center text-sm mb-4">Growth capital without collateral stress</p>
                <div class="text-center">
                    <span class="text-darion-primary-light text-sm font-medium">Up to ₹5 Crores</span>
                </div>
                <ul class="mt-4 space-y-2 text-sm text-darion-text/80">
                    <li class="flex items-start gap-2">• Collateral-free working capital</li>
                    <li class="flex items-start gap-2">• Business expansion funding</li>
                    <li class="flex items-start gap-2">• Stock purchase & cash flow</li>
                </ul>
            </div>

            <!-- Loan Against Property -->
            <div class="glass-card p-8 rounded-darion-lg hover:shadow-xl transition-all duration-300 hover:border-darion-primary/30 border border-darion-border">
                <div class="w-14 h-14 bg-darion-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium mb-3 text-center">Loan Against Property</h3>
                <p class="text-darion-text-muted text-center text-sm mb-4">Unlock the value of your real estate</p>
                <div class="text-center">
                    <span class="text-darion-primary-light text-sm font-medium">Up to ₹25 Crores</span>
                </div>
                <ul class="mt-4 space-y-2 text-sm text-darion-text/80">
                    <li class="flex items-start gap-2">• Residential & commercial property</li>
                    <li class="flex items-start gap-2">• Maximum Loan-to-Value ratio</li>
                    <li class="flex items-start gap-2">• Flexible repayment tenures</li>
                </ul>
            </div>

            <!-- Project Finance -->
            <div class="glass-card p-8 rounded-darion-lg hover:shadow-xl transition-all duration-300 hover:border-darion-primary/30 border border-darion-border">
                <div class="w-14 h-14 bg-darion-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium mb-3 text-center">Project Finance</h3>
                <p class="text-darion-text-muted text-center text-sm mb-4">Building India's infrastructure</p>
                <div class="text-center">
                    <span class="text-darion-primary-light text-sm font-medium">Custom Solutions</span>
                </div>
                <ul class="mt-4 space-y-2 text-sm text-darion-text/80">
                    <li class="flex items-start gap-2">• End-to-end project financing</li>
                    <li class="flex items-start gap-2">• Land acquisition to construction</li>
                    <li class="flex items-start gap-2">• Real estate & infrastructure</li>
                </ul>
            </div>

            <!-- Home Loans -->
            <div class="glass-card p-8 rounded-darion-lg hover:shadow-xl transition-all duration-300 hover:border-darion-primary/30 border border-darion-border">
                <div class="w-14 h-14 bg-darion-primary/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium mb-3 text-center">Home Loans</h3>
                <p class="text-darion-text-muted text-center text-sm mb-4">Your dream home, financed smartly</p>
                <div class="text-center">
                    <span class="text-darion-primary-light text-sm font-medium">Best Market Rates</span>
                </div>
                <ul class="mt-4 space-y-2 text-sm text-darion-text/80">
                    <li class="flex items-start gap-2">• New home purchases</li>
                    <li class="flex items-start gap-2">• Home loan balance transfer</li>
                    <li class="flex items-start gap-2">• Lowest interest rates</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- THE DARION PROCESS -->
<section class="py-20 px-6 fade-section opacity-0 translate-y-10 transition-all duration-700 bg-gradient-to-b from-darion-panel to-darion-bg">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-light text-center text-darion-text mb-16">4 Steps to Funding</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="glass-card rounded-darion-lg p-8 border border-darion-border relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-darion-primary rounded-full flex items-center justify-center text-darion-text font-medium">
                    1
                </div>
                <h3 class="text-xl font-medium mb-4 text-darion-primary-light">Consultation</h3>
                <p class="text-darion-text/90">
                    We analyze your financial profile and funding requirements to understand your specific needs.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="glass-card rounded-darion-lg p-8 border border-darion-border relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-darion-primary rounded-full flex items-center justify-center text-darion-text font-medium">
                    2
                </div>
                <h3 class="text-xl font-medium mb-4 text-darion-primary-light">Matching</h3>
                <p class="text-darion-text/90">
                    We identify the right lender (Bank/NBFC) that best matches your profile and requirements.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="glass-card rounded-darion-lg p-8 border border-darion-border relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-darion-primary rounded-full flex items-center justify-center text-darion-text font-medium">
                    3
                </div>
                <h3 class="text-xl font-medium mb-4 text-darion-primary-light">Documentation</h3>
                <p class="text-darion-text/90">
                    Our team assists you in preparing the perfect application file to minimize queries and delays.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="glasscard rounded-darion-lg p-8 border border-darion-border relative">
                <div class="absolute -top-4 -left-4 w-10 h-10 bg-darion-primary rounded-full flex items-center justify-center text-darion-text font-medium">
                    4
                </div>
                <h3 class="text-xl font-medium mb-4 text-darion-primary-light">Disbursement</h3>
                <p class="text-darion-text/90">
                    Approval is secured and funds are credited directly to your account for immediate use.
                </p>
            </div>
        </div>

        <div class="glass-card rounded-darion-lg p-8 mt-12 border border-darion-border max-w-3xl mx-auto">
            <p class="text-center text-darion-text/90 italic">
                "Don't Let Funding Stop Your Growth. Join hundreds of satisfied clients who trust Darion Finance with their capital needs."
            </p>
            <div class="text-center mt-6">
                <a href="index.php?page=register"
                   class="inline-flex items-center gap-3 bg-darion-primary text-white font-medium px-10 py-4 rounded-darion-lg hover:bg-darion-primary-light transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Check Your Eligibility Now
                </a>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <p class="text-sm text-darion-text-muted">
                Darion Finance acts as a strategic channel partner for Banks and NBFCs. All loans are at the sole discretion of the lending institutions.
            </p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="glass-card text-center py-12 px-6 text-darion-text-muted mt-20 border-t border-darion-border">

    <!-- Branding -->
    <div class="flex items-center justify-center gap-3 mb-8">
        <div class="logo-stipple w-8 h-8"></div>
        <div>
            <h3 class="text-3xl font-light text-darion-text tracking-tight">Darion Finance</h3>
            <p class="text-darion-text-muted text-sm mt-1">Empowering Financial Freedom Since 2025</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <!-- Footer Grid - Wider Layout -->
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-8 text-left mt-12">

            <!-- Quick Links -->
            <div class="md:col-span-2 lg:col-span-1">
                <h4 class="text-darion-text font-semibold mb-4 text-lg border-b border-darion-primary/30 pb-2">Quick Links</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="index.php?page=home" class="hover:text-darion-primary-light transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a></li>
                    <li><a href="index.php?page=register" class="hover:text-darion-primary-light transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Register
                    </a></li>
                    <li><a href="index.php?page=login" class="hover:text-darion-primary-light transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login
                    </a></li>
                    <li><a href="index.php?page=admin_login" class="hover:text-darion-primary-light transition-colors flex items-center gap-2 font-medium text-darion-primary-light/90">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Staff
                    </a></li>
                </ul>
            </div>

            <!-- Services - Column 1 -->
            <div>
                <h4 class="text-darion-text font-semibold mb-4 text-lg border-b border-darion-primary/30 pb-2">Personal Loans</h4>
                <ul class="space-y-2.5 text-sm">
                    <li class="hover:text-darion-primary-light transition-colors">Personal Loan</li>
                    <li class="hover:text-darion-primary-light transition-colors">Flexi Personal Loan</li>
                    <li class="hover:text-darion-primary-light transition-colors">Personal Loan for Self-Employed</li>
                    <li class="hover:text-darion-primary-light transition-colors">Personal Loan for Salaried</li>
                </ul>
            </div>

            <!-- Services - Column 2 -->
            <div>
                <h4 class="text-darion-text font-semibold mb-4 text-lg border-b border-darion-primary/30 pb-2">Business & Property</h4>
                <ul class="space-y-2.5 text-sm">
                    <li class="hover:text-darion-primary-light transition-colors">Loan Against Property</li>
                    <li class="hover:text-darion-primary-light transition-colors">Business Loan</li>
                    <li class="hover:text-darion-primary-light transition-colors">Udyam Loan Assistance</li>
                    <li class="hover:text-darion-primary-light transition-colors">Re-Loans (Top-up Loans)</li>
                </ul>
            </div>

            <!-- Services - Column 3 -->
            <div>
                <h4 class="text-darion-text font-semibold mb-4 text-lg border-b border-darion-primary/30 pb-2">Vehicle & Other</h4>
                <ul class="space-y-2.5 text-sm">
                    <li class="hover:text-darion-primary-light transition-colors">Two Wheeler Loan</li>
                    <li class="hover:text-darion-primary-light transition-colors">Document Verification</li>
                    <li class="hover:text-darion-primary-light transition-colors">Application Processing</li>
                    <li class="hover:text-darion-primary-light transition-colors">Financial Advisory</li>
                </ul>
            </div>

            <!-- Contact & Info -->
            <div>
                <h4 class="text-darion-text font-semibold mb-4 text-lg border-b border-darion-primary/30 pb-2">Contact & Support</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Pan India Service Network</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>24/7 Customer Support</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Fast Approval in 24-48 Hours</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>100% Secure & Confidential</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12 pt-8 border-t border-darion-border/30">
            <div class="text-center">
                <div class="text-2xl font-light text-darion-primary-light">24-48H</div>
                <div class="text-xs text-darion-text-muted mt-1">Fast Approval</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-light text-darion-primary-light">5%</div>
                <div class="text-xs text-darion-text-muted mt-1">Transparent Commission</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-light text-darion-primary-light">1000+</div>
                <div class="text-xs text-darion-text-muted mt-1">Happy Customers</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-light text-darion-primary-light">₹5Cr+</div>
                <div class="text-xs text-darion-text-muted mt-1">Loan Disbursed</div>
            </div>
        </div>
    </div>

    <!-- Social Media & Copyright -->
    <div class="mt-12 pt-8 border-t border-darion-border/30">
        <!-- Social Media Icons - Modern Style -->
        <div class="flex items-center justify-center gap-6 mb-8">
            <a href="#" class="p-2 bg-darion-panel/50 rounded-darion-sm hover:bg-darion-primary/20 transition-all hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            <a href="#" class="p-2 bg-darion-panel/50 rounded-darion-sm hover:bg-darion-primary/20 transition-all hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
            <a href="#" class="p-2 bg-darion-panel/50 rounded-darion-sm hover:bg-darion-primary/20 transition-all hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
            </a>
            <a href="#" class="p-2 bg-darion-panel/50 rounded-darion-sm hover:bg-darion-primary/20 transition-all hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.213c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
            </a>
            <a href="#" class="p-2 bg-darion-panel/50 rounded-darion-sm hover:bg-darion-primary/20 transition-all hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
            </a>
        </div>

        <!-- Copyright & Legal -->
        <div class="text-center">
            <p class="text-xs text-darion-text-muted/50">
                © <?= date("Y"); ?> Darion Finance — All Rights Reserved. | 
                <a href="#" class="hover:text-darion-primary-light transition-colors">Terms & Conditions</a> • 
                <a href="#" class="hover:text-darion-primary-light transition-colors">Privacy Policy</a> • 
                <a href="#" class="hover:text-darion-primary-light transition-colors">Refund Policy</a>
            </p>
            <p class="text-xs text-darion-text-muted/40 mt-2">
                Darion Finance is a registered financial services provider. All loans are subject to approval.
            </p>
        </div>
    </div>

</footer>
</body>
</html>