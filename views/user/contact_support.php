<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Support - Darion Finance</title>

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
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
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

        /* Form Input Styling */
        .darion-input {
            background: rgba(22, 27, 34, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .darion-input:focus {
            border-color: rgba(74, 158, 134, 0.5);
            box-shadow: 0 0 0 3px rgba(74, 158, 134, 0.1);
            outline: none;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #2C7446 0%, #4a9e86 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Pulse Animation for Important Elements */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(74, 158, 134, 0.3); }
            50% { box-shadow: 0 0 30px rgba(74, 158, 134, 0.5); }
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="darion-bg-effect font-inter min-h-screen">
    <!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-6 relative z-30">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>
        <a href="index.php?page=dashboard" class="px-4 py-2 rounded-darion-sm text-white/90 hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
            Back
        </a>
    </div>
</nav>

<div class="h-20"></div>

    <div class="relative container mx-auto px-4 py-12 max-w-4xl">
        <!-- Header Section with Animation -->
        <div class="text-center mb-12 animate-fade-in">
            <div class="inline-block mb-4 animate-float">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-darion-primary/20 to-darion-primary-light/20 flex items-center justify-center mx-auto">
                    <svg class="w-10 h-10 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            
            <h1 class="text-4xl font-bold gradient-text mb-3">Contact Support</h1>
            <p class="text-darion-text-muted text-lg max-w-2xl mx-auto">
                Our support team is here to help you with any questions about your loans, account, or our services.
                We typically respond within 24 hours.
            </p>
        </div>

        <!-- Success/Error Messages -->
        <div class="mb-8 space-y-4">
            <?php if (!empty($_SESSION["error"])): ?>
                <div class="glass-card border border-darion-red/30 p-4 rounded-darion-lg flex items-start gap-3 animate-fade-in">
                    <div class="w-8 h-8 rounded-full bg-darion-red/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-darion-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-darion-text"><?= htmlspecialchars($_SESSION["error"]) ?></p>
                        <?php unset($_SESSION["error"]); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION["success"])): ?>
                <div class="glass-card border border-darion-primary/30 p-4 rounded-darion-lg flex items-start gap-3 animate-fade-in">
                    <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-darion-text"><?= htmlspecialchars($_SESSION["success"]) ?></p>
                        <?php unset($_SESSION["success"]); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Contact Form Card -->
        <div class="glass-card rounded-darion-lg p-8 shadow-2xl border border-darion-border/50 mb-8 animate-fade-in">
            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-darion-border/30">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-darion-primary/20 to-darion-primary-light/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold text-darion-text">Send us a Message</h2>
                    <p class="text-darion-text-muted">Fill out the form below and we'll get back to you as soon as possible</p>
                </div>
            </div>

            <form method="POST" action="index.php" class="space-y-6">
                <input type="hidden" name="action" value="send_support">

                <!-- Name Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-darion-text-muted">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Your Name
                        </span>
                    </label>
                    <input type="text" name="name" required
                           value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>"
                           class="w-full px-4 py-3 darion-input rounded-darion-sm text-darion-text placeholder-darion-text-muted/50">
                </div>

                <!-- Email Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-darion-text-muted">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email Address
                        </span>
                    </label>
                    <input type="email" name="email" required
                           value="<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>"
                           class="w-full px-4 py-3 darion-input rounded-darion-sm text-darion-text placeholder-darion-text-muted/50">
                </div>

                <!-- Category Selection -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-darion-text-muted">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Category
                        </span>
                    </label>
                    <select name="category" class="w-full px-4 py-3 darion-input rounded-darion-sm text-darion-text">
                        <option value="" class="bg-darion-panel">Select a category</option>
                        <option value="loan_inquiry" class="bg-darion-panel">Loan Inquiry</option>
                        <option value="technical_issue" class="bg-darion-panel">Technical Issue</option>
                        <option value="billing" class="bg-darion-panel">Billing Question</option>
                        <option value="account_issue" class="bg-darion-panel">Account Issue</option>
                        <option value="general" class="bg-darion-panel">General Inquiry</option>
                        <option value="feedback" class="bg-darion-panel">Feedback/Suggestion</option>
                    </select>
                </div>

                <!-- Message Field -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-darion-text-muted">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Your Message
                        </span>
                    </label>
                    <textarea name="message" required rows="6"
                              class="w-full px-4 py-3 darion-input rounded-darion-sm text-darion-text placeholder-darion-text-muted/50 resize-none"
                              placeholder="Please describe your issue or question in detail..."></textarea>
                    <p class="text-xs text-darion-text-muted/70 mt-1">
                        Please provide as much detail as possible to help us assist you better.
                    </p>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-gradient-to-r from-darion-primary to-darion-primary-light text-white font-semibold py-3 rounded-darion-sm hover:shadow-lg transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 group pulse-glow">
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Send Message to Support
                </button>
            </form>
        </div>

        <!-- Additional Information Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="glass-card rounded-darion-lg p-6 border border-darion-border/30 hover:border-darion-primary/30 transition-colors">
                <div class="w-10 h-10 rounded-full bg-darion-primary/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-darion-text mb-2">Response Time</h3>
                <p class="text-sm text-darion-text-muted">We typically respond within 24 hours during business days.</p>
            </div>

            <div class="glass-card rounded-darion-lg p-6 border border-darion-border/30 hover:border-darion-primary/30 transition-colors">
                <div class="w-10 h-10 rounded-full bg-darion-primary/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-darion-text mb-2">Expert Support</h3>
                <p class="text-sm text-darion-text-muted">Our team specializes in loan processing and financial services.</p>
            </div>

            <div class="glass-card rounded-darion-lg p-6 border border-darion-border/30 hover:border-darion-primary/30 transition-colors">
                <div class="w-10 h-10 rounded-full bg-darion-primary/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-darion-text mb-2">Secure Communication</h3>
                <p class="text-sm text-darion-text-muted">All messages are encrypted and handled with confidentiality.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center pt-8 border-t border-darion-border/30">
            <p class="text-darion-text-muted text-sm">
                © <?= date("Y") ?> Darion Finance • 
                <span class="text-darion-primary-light">support@darionfinance.com</span> • 
                <span>Mon-Fri 9AM-6PM</span>
            </p>
            <p class="text-darion-text-muted text-xs mt-2">
                Need urgent assistance? Call our emergency line: <span class="text-darion-primary-light">+1 (800) 123-4567</span>
            </p>
        </div>
    </div>

    <script>
        // Add animation to form on load
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.classList.add('animate-fade-in');
            
            // Auto-focus on message textarea
            document.querySelector('textarea[name="message"]').focus();
            
            // Add character counter for message
            const textarea = document.querySelector('textarea[name="message"]');
            const counter = document.createElement('p');
            counter.className = 'text-xs text-darion-text-muted/50 text-right mt-1';
            counter.textContent = '0/1000 characters';
            textarea.parentNode.appendChild(counter);
            
            textarea.addEventListener('input', function() {
                counter.textContent = `${this.value.length}/1000 characters`;
                if (this.value.length > 1000) {
                    counter.classList.add('text-darion-red');
                } else {
                    counter.classList.remove('text-darion-red');
                }
            });
        });

        // Form submission animation
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Sending Message...
            `;
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>