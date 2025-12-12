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
        
        <!-- Register Link -->
        <a href="index.php?page=register" class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
            Register
        </a>
        
        <!-- Login Link -->
        <a href="index.php?page=login" class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
            Login
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
        <a href="index.php?page=home" class="block py-3 border-b border-darion-border/30 text-white/90 hover:text-darion-primary-light transition-colors">
            Home
        </a>
        
        <!-- Mobile Loans Accordion -->
        <div class="border-b border-darion-border/30">
            <button id="mobile-loans-btn" class="flex items-center justify-between w-full py-3 text-left text-white/90">
                <span class="font-medium">Loans</span>
                <svg id="mobile-loans-arrow" class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            
            <div id="mobile-loans-menu" class="hidden pl-4 pt-2 space-y-3 pb-3">
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