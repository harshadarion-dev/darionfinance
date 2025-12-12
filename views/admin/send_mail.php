<?php
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    echo "Access Denied";
    exit;
}

require_once __DIR__ . "/../../models/User.php";
$userModel = new User();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Mail - Admin | Darion Finance</title>

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

        /* User search results styling */
        .user-result-item {
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .user-result-item:hover {
            background: rgba(44, 116, 70, 0.15);
            border-left: 3px solid rgba(74, 158, 134, 0.5);
        }
    </style>

    <script>
        // LIVE SEARCH USING AJAX
        function searchUsers() {
            let keyword = document.getElementById("searchBox").value;

            if (keyword.length < 2) {
                document.getElementById("results").innerHTML = '<p class="text-darion-text-muted p-4 text-center">Type at least 2 characters to search</p>';
                return;
            }

            fetch("xhr/search_users.php?q=" + keyword)
                .then(res => res.text())
                .then(html => {
                    document.getElementById("results").innerHTML = html;
                });
        }

        function chooseUser(email) {
            document.getElementById("emailTo").value = email;
            document.getElementById("searchBox").value = email;
            document.getElementById("results").innerHTML = '<p class="text-darion-text-muted p-4 text-center">Email selected: ' + email + '</p>';
        }
    </script>

</head>

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAV -->
<nav class="bg-darion-panel/70 backdrop-blur-darion px-6 py-4 flex justify-between items-center border-b border-darion-border">
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-3">
            <div class="logo-stipple"></div>
            <div>
                <a href="index.php?page=admin_dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
            </div>
        </div>
    </div>
</nav>

<div class="max-w-5xl mx-auto mt-10 glass-card p-8 shadow-xl rounded-darion-lg border border-darion-border">

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-darion-primary/20 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-light">Send Email to User</h2>
                <p class="text-darion-text-muted text-sm">Search for users and send personalized emails</p>
            </div>
        </div>
    </div>

    <!-- SEARCH BAR -->
    <div class="mb-8">
        <label class="font-medium text-darion-text-muted flex items-center gap-2 mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Search User (Name / Email / Phone)
        </label>
        <input type="text" id="searchBox" onkeyup="searchUsers()"
               placeholder="Start typing name, email, or phone number..."
               class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors">

        <div id="results" class="glass-card mt-4 rounded-darion-sm border border-darion-border p-3 max-h-56 overflow-y-auto">
            <p class="text-darion-text-muted p-4 text-center">Search results will appear here</p>
        </div>
    </div>

    <!-- MAIL FORM -->
    <form method="POST" action="index.php?page=send_mail_action" class="space-y-6">

        <input type="hidden" name="action" value="send_manual_mail">

        <div class="space-y-3">
            <label class="font-medium text-darion-text-muted flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                To (Email)
            </label>
            <input type="email" id="emailTo" name="email"
                   class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                   placeholder="user@example.com"
                   required>
        </div>

        <div class="space-y-3">
            <label class="font-medium text-darion-text-muted flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Subject
            </label>
            <input type="text" name="subject"
                   class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                   placeholder="Email subject line"
                   required>
        </div>

        <div class="space-y-3">
            <label class="font-medium text-darion-text-muted flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Message
            </label>
            <textarea name="message" rows="6"
                      class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors resize-none"
                      placeholder="Write your email message here..."
                      required></textarea>
        </div>

        <button
            class="w-full bg-darion-primary text-white py-3 rounded-darion-sm font-medium hover:bg-darion-primary-light transition-all duration-300 mt-4 flex items-center justify-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            Send Email
        </button>
    </form>

    <!-- Tips Section -->
    <div class="glass-card rounded-darion-sm p-4 mt-8 border border-darion-border">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-darion-gold flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="text-sm font-medium mb-1">Email Tips</p>
                <ul class="text-xs text-darion-text-muted space-y-1">
                    <li>• Search for users by name, email, or phone number</li>
                    <li>• Click on a user to auto-fill their email</li>
                    <li>• Keep subject lines clear and concise</li>
                    <li>• Personalize messages for better engagement</li>
                </ul>
            </div>
        </div>
    </div>

</div>

</body>
</html>