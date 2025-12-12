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
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-darion-lg">
            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 0l9-4.5M9 7v10m9-4.5V7m0 4.5l-9 4.5"/>
            </svg>
            <span class="text-sm font-medium">Fast Two Wheeler Financing</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-light mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-white to-darion-primary-light bg-clip-text text-transparent">
                Two Wheeler Loan
            </span>
        </h1>
        
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto mb-8 leading-relaxed">
            Get fast, affordable loans for Motorcycles, Scooters, and Electric Vehicles with easy EMIs.
            Hassle-free processing & transparent charges. Ride your dream vehicle today!
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10">
            <a href="index.php?page=apply"
               class="group bg-white text-darion-bg font-semibold px-10 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 hover:bg-darion-primary-light hover:text-white flex items-center gap-3">
                <span>Apply Now</span>
                <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
            
            <a href="#benefits"
               class="px-10 py-4 glass-card border border-white/20 font-medium rounded-darion-lg hover:bg-white/10 transition-all duration-300">
                View Benefits
            </a>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="max-w-6xl mx-auto px-6 py-20">

    <!-- Loan Overview -->
    <div class="glass-card p-10 rounded-darion-lg border border-darion-border mb-16 animate-slide-up">
        <div class="flex items-start gap-6 mb-8">
            <div class="w-16 h-16 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 bike-icon">
                <svg class="w-8 h-8 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 0l9-4.5M9 7v10m9-4.5V7m0 4.5l-9 4.5"/>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-light mb-4 text-white">What is a Two Wheeler Loan?</h2>
                <p class="text-darion-text-muted text-lg leading-relaxed">
                    A Two Wheeler Loan helps you purchase a new or used bike, scooter, or electric vehicle
                    with easy EMI plans, low documentation, and quick approvals. Perfect for students, 
                    working professionals, delivery executives, and business use. Choose from various 
                    financing options tailored to your needs.
                </p>
            </div>
        </div>
        
        <!-- Loan Details -->
        <div class="grid md:grid-cols-4 gap-6 mt-8">
            <div class="bg-darion-panel/50 p-6 rounded-darion-sm border border-darion-border text-center">
                <div class="text-2xl font-light text-darion-primary-light mb-2">₹30,000 - ₹5 Lakhs</div>
                <div class="text-sm text-darion-text-muted">Loan Amount</div>
            </div>
            <div class="bg-darion-panel/50 p-6 rounded-darion-sm border border-darion-border text-center">
                <div class="text-2xl font-light text-darion-primary-light mb-2">1-5 Years</div>
                <div class="text-sm text-darion-text-muted">Repayment Tenure</div>
            </div>
            <div class="bg-darion-panel/50 p-6 rounded-darion-sm border border-darion-border text-center">
                <div class="text-2xl font-light text-darion-primary-light mb-2">2-24 Hours</div>
                <div class="text-sm text-darion-text-muted">Approval Time</div>
            </div>
            <div class="bg-darion-panel/50 p-6 rounded-darion-sm border border-darion-border text-center">
                <div class="text-2xl font-light text-darion-primary-light mb-2">5% Commission</div>
                <div class="text-sm text-darion-text-muted">Transparent Fee</div>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <div id="benefits" class="grid md:grid-cols-3 gap-8 mb-20 animate-slide-up">
        <div class="vehicle-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">Easy Approval</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Minimal documents required for salaried & self-employed individuals. 
                Quick verification process with high approval rates.
            </p>
        </div>

        <div class="vehicle-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.791 3-4S13.657 0 12 0s-3 1.791-3 4 1.343 4 3 4zm0 3c-3.314 0-6 3.582-6 8v3h12v-3c0-4.418-2.686-8-6-8z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">Low EMI Options</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Flexible EMI plans starting from ₹500 per month. Customized repayment 
                schedules based on your income and requirements.
            </p>
        </div>

        <div class="vehicle-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8V4m0 4l3.5 3.5M12 8l-3.5 3.5M4 12h16M4 16h16M4 20h16"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">Fast Processing</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Get loan approval within 2–24 hours with instant document verification. 
                Quick disbursement after approval.
            </p>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid md:grid-cols-2 gap-12 mb-20">
        <!-- Eligibility -->
        <div class="animate-slide-up">
            <div class="glass-card p-8 rounded-darion-lg border border-darion-border h-full">
                <h2 class="text-2xl font-light mb-6 text-white flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
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
                            <div class="font-medium text-white">Age: 18–60 years</div>
                            <div class="text-sm text-darion-text-muted mt-1">For Indian citizens</div>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-white">Income proof required</div>
                            <div class="text-sm text-darion-text-muted mt-1">Salary slip or bank statement</div>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-white">Valid Aadhaar & PAN</div>
                            <div class="text-sm text-darion-text-muted mt-1">Mandatory KYC documents</div>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-white">CIBIL score above 600</div>
                            <div class="text-sm text-darion-text-muted mt-1">Preferred but not mandatory</div>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-3 h-3 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-white">Business owner friendly</div>
                            <div class="text-sm text-darion-text-muted mt-1">Udyam certificate accepted</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents -->
        <div class="animate-slide-up" style="animation-delay: 0.1s;">
            <div class="glass-card p-8 rounded-darion-lg border border-darion-border h-full">
                <h2 class="text-2xl font-light mb-6 text-white flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
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
                            <div class="text-sm text-darion-text-muted">Front & Back Scan</div>
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
                            <div class="text-sm text-darion-text-muted">Mandatory for all applicants</div>
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
                            <div class="text-sm text-darion-text-muted">Last 3-6 months PDF</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 p-4 bg-darion-panel/30 rounded-darion-sm border border-darion-border">
                        <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-white">Salary Slip</div>
                            <div class="text-sm text-darion-text-muted">For salaried individuals</div>
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
                            <div class="text-sm text-darion-text-muted">For business owners</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center animate-slide-up" style="animation-delay: 0.2s;">
        <div class="glass-card p-12 rounded-darion-lg border border-darion-border">
            <h2 class="text-3xl font-light mb-4 text-white">Ready to Ride Your Dream Vehicle?</h2>
            <p class="text-darion-text-muted text-lg mb-8 max-w-2xl mx-auto">
                Apply for a Two Wheeler Loan today and get on the road faster with our quick processing 
                and minimal documentation requirements.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="index.php?page=apply"
                   class="group bg-gradient-to-r from-darion-primary to-darion-primary-light text-white font-semibold px-12 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 flex items-center gap-3">
                    <span>Apply for Two Wheeler Loan</span>
                    <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
            
            <div class="mt-8 text-sm text-darion-text-muted flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>100% Secure Application • Quick Disbursement • Affordable EMIs</span>
            </div>
        </div>
    </div>

</section>

<!-- FOOTER -->
<?php include "footer.php"; ?>

</body>
</html>