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
        <div class="absolute top-10 left-1/4 w-48 h-48 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-1/4 w-64 h-64 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-6xl mx-auto relative z-10 text-center animate-fade-in">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-darion-lg">
            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-sm font-medium">Professional Loan Guidance</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-light mb-6 leading-tight">
            <span class="bg-gradient-to-r from-white via-white to-darion-primary-light bg-clip-text text-transparent">
                Loan Assistant
            </span>
        </h1>
        
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto mb-8 leading-relaxed">
            Professional assistance for Udyam Registration, Bank Document Preparation,
            Loan Filing & Real-time Support — all in one place.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10">
            <a href="index.php?page=apply"
               class="group bg-white text-darion-bg font-semibold px-10 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 hover:bg-darion-primary-light hover:text-white flex items-center gap-3">
                <span>Apply for Loan</span>
                <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
            
            <a href="#services"
               class="px-10 py-4 glass-card border border-white/20 font-medium rounded-darion-lg hover:bg-white/10 transition-all duration-300">
                Explore Services
            </a>
        </div>
    </div>
</section>

<!-- MAIN CONTENT -->
<section class="max-w-6xl mx-auto px-6 py-20">

    <!-- Service Sections -->
    <div id="services" class="grid md:grid-cols-3 gap-8 mb-20 animate-slide-up">
        <!-- Udyam Assistance -->
        <div class="assistant-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2s-3 1.343-3 3 1.343 3 3 3zM12 14a5 5 0 015 5v3H7v-3a5 5 0 015-5z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">Udyam Registration</h3>
            <p class="text-darion-text-muted leading-relaxed">
                We help you register, update, and download your Udyam certificate required for MSME loan approval.
                Complete end-to-end assistance with government portal navigation.
            </p>
        </div>

        <!-- Document Assistance -->
        <div class="assistant-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9M3 20h9m-6-8h12v12H6V12zm3-8h6m-3-4v4"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">Document Preparation</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Aadhaar, PAN, bank statements, GST, ITR — we guide you to prepare correct documents 
                and ensure they meet bank requirements for faster approval.
            </p>
        </div>

        <!-- Loan Guidance -->
        <div class="assistant-card glass-card p-8 border border-darion-border rounded-darion-lg hover:border-darion-primary/50 transition-all duration-300">
            <div class="w-14 h-14 rounded-full bg-darion-primary/20 flex items-center justify-center mb-6">
                <svg class="w-7 h-7 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3 3v-6m10 1a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-white mb-3">Loan Guidance & Support</h3>
            <p class="text-darion-text-muted leading-relaxed">
                Get guidance on bank loan eligibility, loan limits, sanctions, and step-by-step processing.
                Our experts help you choose the right loan product for your needs.
            </p>
        </div>
    </div>

    <!-- FAQ -->
    <div class="mb-20 animate-slide-up">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-light mb-4 text-white">Frequently Asked Questions</h2>
            <p class="text-darion-text-muted max-w-2xl mx-auto">
                Quick answers to common questions about our loan assistance services
            </p>
        </div>

        <div class="space-y-4 max-w-3xl mx-auto">
            <details class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
                <summary class="cursor-pointer p-6 text-lg font-medium text-white hover:text-darion-primary-light transition-colors">
                    Is Udyam registration mandatory for getting a loan?
                </summary>
                <div class="px-6 pb-6 pt-2 border-t border-darion-border">
                    <p class="text-darion-text-muted leading-relaxed">
                        Not always mandatory, but highly recommended for business & MSME loans. 
                        Udyam registration provides credibility, enables access to government schemes, 
                        and often results in better loan terms and faster approvals from banks.
                    </p>
                </div>
            </details>

            <details class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
                <summary class="cursor-pointer p-6 text-lg font-medium text-white hover:text-darion-primary-light transition-colors">
                    How long does the loan approval process take?
                </summary>
                <div class="px-6 pb-6 pt-2 border-t border-darion-border">
                    <p class="text-darion-text-muted leading-relaxed">
                        With our assistance, loan approval typically takes 2-5 working days depending on 
                        the bank and completeness of documentation. We expedite the process by ensuring 
                        all documents are correctly prepared and submitted as per bank requirements.
                    </p>
                </div>
            </details>

            <details class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
                <summary class="cursor-pointer p-6 text-lg font-medium text-white hover:text-darion-primary-light transition-colors">
                    Do you help with bank submission and follow-up?
                </summary>
                <div class="px-6 pb-6 pt-2 border-t border-darion-border">
                    <p class="text-darion-text-muted leading-relaxed">
                        Yes, we provide complete end-to-end assistance. We prepare documents, 
                        coordinate with bank officials, handle submission, and follow up regularly 
                        until your loan is sanctioned. We also provide real-time updates on your 
                        application status.
                    </p>
                </div>
            </details>

            <details class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
                <summary class="cursor-pointer p-6 text-lg font-medium text-white hover:text-darion-primary-light transition-colors">
                    What documents do I need to prepare?
                </summary>
                <div class="px-6 pb-6 pt-2 border-t border-darion-border">
                    <p class="text-darion-text-muted leading-relaxed">
                        Basic documents include Aadhaar Card, PAN Card, Bank Statements (6-12 months), 
                        and Address Proof. For business loans, additional documents like Udyam Certificate, 
                        GST Registration, ITR, and Business Proof may be required. We provide a 
                        customized checklist based on your loan type.
                    </p>
                </div>
            </details>

            <details class="glass-card border border-darion-border rounded-darion-lg overflow-hidden group">
                <summary class="cursor-pointer p-6 text-lg font-medium text-white hover:text-darion-primary-light transition-colors">
                    Is there any charge for loan assistance consultation?
                </summary>
                <div class="px-6 pb-6 pt-2 border-t border-darion-border">
                    <p class="text-darion-text-muted leading-relaxed">
                        Initial consultation is completely free. Our 5% commission is only applicable 
                        and payable after your loan is successfully sanctioned. We believe in 
                        transparent pricing with no hidden charges or upfront fees.
                    </p>
                </div>
            </details>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center animate-slide-up">
        <div class="glass-card p-12 rounded-darion-lg border border-darion-border">
            <h2 class="text-3xl font-light mb-4 text-white">Need Professional Loan Assistance?</h2>
            <p class="text-darion-text-muted text-lg mb-8 max-w-2xl mx-auto">
                Let our experts guide you through the entire loan process. From document preparation 
                to bank submission, we ensure a smooth and hassle-free experience.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="index.php?page=apply"
                   class="group bg-gradient-to-r from-darion-primary to-darion-primary-light text-white font-semibold px-12 py-4 rounded-darion-lg shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 flex items-center gap-3">
                    <span>Get Started Now</span>
                    <svg class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
            
            <div class="mt-8 text-sm text-darion-text-muted flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>100% Confidential • Expert Guidance • No Upfront Fees</span>
            </div>
        </div>
    </div>

</section>

<!-- FOOTER -->
<?php include "footer.php"; ?>

</body>
</html>