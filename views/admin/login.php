<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Darion Finance</title>

    <!-- TailwindCSS -->
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
            min-height: 100vh;
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

        /* Input field styling */
        .darion-input {
            background: rgba(22, 27, 34, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .darion-input:focus {
            outline: none;
            border-color: rgba(74, 158, 134, 0.5);
            box-shadow: 0 0 0 2px rgba(74, 158, 134, 0.2);
        }

        /* Custom placeholder color */
        .darion-input::placeholder {
            color: rgba(139, 148, 158, 0.5);
        }
    </style>
</head>

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAV BAR -->
<nav class="flex justify-between items-center bg-darion-panel/70 backdrop-blur-darion px-6 py-4 fixed top-0 left-0 right-0 z-50 border-b border-darion-border">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=home" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>
</nav>

<div class="h-20"></div>

<!-- LOGIN FORM BOX -->
<div class="flex justify-center items-center min-h-[70vh] px-4">

    <div class="glass-card w-full max-w-md shadow-xl p-8 rounded-darion-lg border border-darion-border">
        
        <!-- Header with Logo -->
        <div class="flex flex-col items-center mb-8">
            <div class="logo-stipple mb-4"></div>
            <h1 class="text-3xl font-light text-center">Admin Login</h1>
            <p class="text-darion-text-muted text-center mt-2">Secure access to administration panel</p>
        </div>

        <!-- Error Message -->
        <?php if (!empty($_SESSION["error"])): ?>
            <div class="bg-red-900/30 border-l-4 border-darion-red text-red-200 p-4 rounded-darion-sm mb-6">
                <?= $_SESSION["error"]; unset($_SESSION["error"]); ?>
            </div>
        <?php endif; ?>

        <!-- ADMIN LOGIN FORM -->
        <form method="POST" action="index.php" class="space-y-6">
            <input type="hidden" name="action" value="admin_login">

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Admin Email
                </label>
                <input type="email" name="email" required
                       class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                       placeholder="admin@darionfinance.com">
            </div>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Admin Password
                </label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                       placeholder="Enter admin password">
            </div>

            <button
                class="w-full bg-darion-primary text-white py-3 rounded-darion-sm font-medium hover:bg-darion-primary-light transition-all duration-300 mt-4 flex items-center justify-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login as Admin
            </button>
        </form>

        <!-- Security Notice -->
        <div class="mt-8 pt-6 border-t border-darion-border">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-darion-gold flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <div>
                    <p class="text-sm text-darion-text-muted">
                        This is a restricted access area. Unauthorized access is prohibited and may be subject to legal action.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="text-center py-6 text-darion-text-muted text-sm mt-10 border-t border-darion-border/30">
    <div class="flex items-center justify-center gap-3 mb-3">
        <div class="logo-stipple w-5 h-5"></div>
        <span class="font-light">Darion Finance</span>
    </div>
    © <?= date("Y") ?> Darion Finance — Admin Panel
</footer>

</body>
</html>