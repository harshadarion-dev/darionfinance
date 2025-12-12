<?php
if (!isset($_SESSION["user_id"])) { 
    header("Location: index.php?page=login"); 
    exit; 
}

require_once __DIR__ . "/../../models/Loan.php";
$loan = new Loan();
$applications = $loan->getByUser($_SESSION["user_id"]);
$activeCount = count(array_filter($applications, fn($app) => !in_array($app["status"], ["sanctioned", "rejected"])));
$sanctionedCount = count(array_filter($applications, fn($app) => $app["status"] === "sanctioned"));
$rejectedCount = count(array_filter($applications, fn($app) => $app["status"] === "rejected"));
$totalAmount = array_sum(array_column($applications, "requested_amount"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Darion Finance - Dashboard</title>

    <!-- Tailwind CSS -->
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

        /* Dashboard specific styling */
        .dashboard-card {
            background: rgba(22, 27, 34, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .dashboard-card:hover {
            border-color: rgba(74, 158, 134, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Active navigation style */
        .nav-active {
            background: linear-gradient(90deg, rgba(44, 116, 70, 0.2) 0%, transparent 100%);
            color: #4a9e86;
            border-left: 2px solid #2C7446;
        }

        /* Stats card animation */
        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--darion-primary), var(--darion-primary-light));
        }

        /* Progress bar styling */
        .progress-bar {
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--darion-primary), var(--darion-primary-light));
            border-radius: 4px;
            transition: width 1s ease-in-out;
        }
    </style>
</head>

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-darion-panel/70 backdrop-blur-darion fixed top-0 left-0 right-0 z-50 border-b border-darion-border">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>

    <div class="hidden md:flex gap-6 font-medium">
        <a href="index.php?page=apply" class="px-4 py-2 rounded-darion-sm bg-darion-glass text-darion-primary-light border-l-2 border-darion-primary">
            Apply Loan
        </a>
        <a href="index.php?page=status" class="px-4 py-2 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
            Loan Status
        </a>
        
        <form action="index.php?page=logout" method="POST" class="flex items-center">
            <input type="hidden" name="action" value="logout">
            <button class="px-4 py-2 rounded-darion-sm hover:bg-red-900/20 hover:text-red-300 text-darion-text-muted transition-colors">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="h-20"></div>

<!-- DASHBOARD -->
<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- Welcome Header -->
    <div class="mb-10">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-light mb-2">Welcome Back, 
                    <span class="text-darion-primary-light font-medium">
                        <?= htmlspecialchars($_SESSION["user_name"] ?? "User"); ?>
                    </span>
                </h1>
                <p class="text-darion-text-muted">Your financial dashboard for loan management</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="glass-card px-4 py-2 rounded-darion-sm">
                    <span class="text-darion-text-muted text-sm">Member Since:</span>
                    <span class="ml-2 font-medium">
                        <?= date('M Y', strtotime($_SESSION["created_at"] ?? date('Y-m-d'))) ?>
                    </span>
                </div>
            </div>
        </div>
        
        <?php if (!empty($_SESSION["success"])): ?>
            <div class="bg-darion-primary/20 border-l-4 border-darion-primary-light text-darion-primary-light p-4 rounded-darion-sm mb-6 mt-4 max-w-2xl">
                <?= $_SESSION["success"]; unset($_SESSION["success"]); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Financial Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="glass-card stat-card rounded-darion-lg p-6 border border-darion-border">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Total Applications</p>
                    <p class="text-2xl font-medium"><?= count($applications) ?></p>
                </div>
                <div class="w-12 h-12 bg-darion-primary/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= count($applications) > 0 ? '100%' : '0%' ?>"></div>
            </div>
        </div>

        <div class="glass-card stat-card rounded-darion-lg p-6 border border-darion-border">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Active Applications</p>
                    <p class="text-2xl font-medium"><?= $activeCount ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= count($applications) > 0 ? ($activeCount / count($applications) * 100) . '%' : '0%' ?>"></div>
            </div>
        </div>

        <div class="glass-card stat-card rounded-darion-lg p-6 border border-darion-border">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Sanctioned Loans</p>
                    <p class="text-2xl font-medium text-darion-primary-light"><?= $sanctionedCount ?></p>
                </div>
                <div class="w-12 h-12 bg-darion-primary/30 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= count($applications) > 0 ? ($sanctionedCount / count($applications) * 100) . '%' : '0%' ?>"></div>
            </div>
        </div>

        <div class="glass-card stat-card rounded-darion-lg p-6 border border-darion-border">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Total Requested</p>
                    <p class="text-2xl font-medium">₹<?= number_format($totalAmount) ?></p>
                </div>
                <div class="w-12 h-12 bg-darion-gold/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-darion-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: <?= $totalAmount > 0 ? '100%' : '0%' ?>"></div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid lg:grid-cols-3 gap-8 mb-10">
        <!-- Main Actions -->
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-light mb-6">Quick Actions</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Apply for Loan Card -->
                <a href="index.php?page=apply" 
                    class="dashboard-card p-8 rounded-darion-lg group cursor-pointer">
                    <div class="w-14 h-14 bg-gradient-to-br from-darion-primary to-darion-primary-light rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-darion-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-medium mb-3 group-hover:text-darion-primary-light transition-colors">
                        Apply for Loan
                    </h3>
                    <p class="text-darion-text-muted">Start a new loan application with our streamlined process</p>
                    <div class="mt-6 text-darion-primary-light flex items-center gap-2 text-sm font-medium">
                        Start Application
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </div>
                </a>

                <!-- Check Loan Status Card -->
                <a href="index.php?page=status" 
                    class="dashboard-card p-8 rounded-darion-lg group cursor-pointer">
                    <div class="w-14 h-14 bg-gradient-to-br from-darion-primary to-darion-primary-light rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-darion-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-medium mb-3 group-hover:text-darion-primary-light transition-colors">
                        Loan Status
                    </h3>
                    <p class="text-darion-text-muted">Track all your applications and view detailed status</p>
                    <div class="mt-6 text-darion-primary-light flex items-center gap-2 text-sm font-medium">
                        View Status
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="glass-card rounded-darion-lg p-8 border border-darion-border">
            <h2 class="text-2xl font-light mb-6">Recent Activity</h2>
            <?php if (empty($applications)): ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-darion-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <p class="text-darion-text-muted">No recent activity</p>
                    <p class="text-sm text-darion-text-muted/70 mt-1">Apply for your first loan to get started</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php 
                    $recentApps = array_slice($applications, 0, 3);
                    foreach ($recentApps as $app): 
                        $statusColor = [
                            "submitted" => "text-gray-300",
                            "documents_verified" => "text-blue-300",
                            "processing" => "text-yellow-300",
                            "sanctioned" => "text-darion-primary-light",
                            "rejected" => "text-red-300"
                        ][$app["status"]] ?? "text-gray-300";
                    ?>
                    <div class="flex items-center justify-between p-4 rounded-darion-sm hover:bg-darion-glass/30 transition-colors">
                        <div>
                            <p class="font-medium">Application #<?= $app["id"] ?></p>
                            <p class="text-sm text-darion-text-muted"><?= $app["loan_type"] ?></p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium <?= $statusColor ?>">
                                <?= ucfirst(str_replace("_", " ", $app["status"])) ?>
                            </p>
                            <p class="text-sm text-darion-text-muted">₹<?= number_format($app["requested_amount"]) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-6 text-center">
                    <a href="index.php?page=status" class="text-darion-primary-light hover:text-darion-primary transition-colors text-sm font-medium">
                        View all applications →
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

        <!-- Support & Resources -->
        <div class="glass-card rounded-darion-lg p-8 border border-darion-border">
                <h2 class="text-2xl font-light mb-6 flex items-center gap-3">
                    <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Support & Resources
                </h2>

                <div class="space-y-4">

                    <!-- REQUIRED DOCUMENTS -->
                    <a href="index.php?page=required_documents" class="flex items-center gap-4 p-4 rounded-darion-sm hover:bg-darion-glass/30 transition-colors">
                        <div class="w-10 h-10 bg-darion-primary/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Required Documents</p>
                            <p class="text-sm text-darion-text-muted">Checklist for loan application</p>
                        </div>
                    </a>

                    <!-- FAQ & HELP CENTER -->
                    <a href="index.php?page=help_center" class="flex items-center gap-4 p-4 rounded-darion-sm hover:bg-darion-glass/30 transition-colors">
                        <div class="w-10 h-10 bg-darion-primary/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">FAQ & Help Center</p>
                            <p class="text-sm text-darion-text-muted">Answers to common questions</p>
                        </div>
                    </a>

                    <!-- CONTACT SUPPORT -->
                    <a href="index.php?page=contact_support" class="flex items-center gap-4 p-4 rounded-darion-sm hover:bg-darion-glass/30 transition-colors">
                        <div class="w-10 h-10 bg-darion-primary/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Contact Support</p>
                            <p class="text-sm text-darion-text-muted">Get help from our experts</p>
                        </div>
                    </a>

                </div>
            </div>
    </div>

</div>

<!-- FOOTER -->
<?php include "footer.php"; ?>
</body>
</html>