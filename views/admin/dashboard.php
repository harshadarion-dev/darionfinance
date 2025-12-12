<?php
// admin_dashboard.php
require_once __DIR__ . "/../../controllers/AdminController.php";

$controller = new AdminController();

// Get dashboard stats
$stats = $controller->dashboardStats();

// Get latest applications
$applications = $controller->dashboard();

// Calculate daily stats
$db = DB::connect();
$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 day'));

// Today's stats
$todayStats = $db->query("
    SELECT 
        (SELECT COUNT(*) FROM users WHERE DATE(created_at) = '$today') as users_today,
        (SELECT COUNT(*) FROM loan_applications WHERE DATE(created_at) = '$today') as apps_today,
        (SELECT COUNT(*) FROM support_messages WHERE DATE(created_at) = '$today') as support_today,
        (SELECT COUNT(*) FROM loan_applications WHERE DATE(created_at) = '$today' AND status = 'sanctioned') as sanctioned_today
")->fetch();

// Yesterday's stats for comparison
$yesterdayStats = $db->query("
    SELECT 
        (SELECT COUNT(*) FROM users WHERE DATE(created_at) = '$yesterday') as users_yesterday,
        (SELECT COUNT(*) FROM loan_applications WHERE DATE(created_at) = '$yesterday') as apps_yesterday,
        (SELECT COUNT(*) FROM support_messages WHERE DATE(created_at) = '$yesterday') as support_yesterday
")->fetch();

// Calculate percentage changes
function calculateChange($today, $yesterday) {
    if ($yesterday == 0) return 100;
    return round((($today - $yesterday) / $yesterday) * 100, 1);
}

$usersChange = calculateChange($todayStats['users_today'], $yesterdayStats['users_yesterday']);
$appsChange = calculateChange($todayStats['apps_today'], $yesterdayStats['apps_yesterday']);
$supportChange = calculateChange($todayStats['support_today'], $yesterdayStats['support_yesterday']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Darion Finance</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CHART.JS FOR GRAPHS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* Sidebar active state */
        .sidebar-active {
            background: linear-gradient(90deg, rgba(44, 116, 70, 0.2) 0%, transparent 100%);
            color: #4a9e86;
            border-left: 2px solid #2C7446;
        }

        /* Table styling */
        .table-row-hover:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(22, 27, 34, 0.5);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(74, 158, 134, 0.5);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(74, 158, 134, 0.7);
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>
</head>

<body class="darion-bg-effect text-darion-text font-inter flex">
    <!-- Sidebar -->
    <div class="w-64 bg-darion-panel/90 backdrop-blur-darion h-screen sticky top-0 border-r border-darion-border">
        <!-- Sidebar Header -->
        <div class="p-6 border-b border-darion-border">
            <div class="flex items-center gap-3">
                <div class="logo-stipple"></div>
                <div>
                    <a href="index.php?page=admin_dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="mt-6 px-4">
            <nav class="space-y-1">

                <a href="index.php?page=admin_users"
                   class="flex items-center gap-3 px-4 py-3 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-10A2.5 2.5 0 1121 6.5a2.5 2.5 0 01-2.5 2.5z"></path>
                    </svg>
                    Users
                </a>

                <a href="index.php?page=admin_mail" 
                   class="flex items-center gap-3 px-4 py-3 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Send Mail
                </a>

                <a href="index.php?page=support_messages" 
                   class="flex items-center gap-3 px-4 py-3 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    Support
                </a>

                <form action="index.php?page=logout" method="POST" class="mt-8 pt-8 border-t border-darion-border">
                    <input type="hidden" name="action" value="logout">
                    <button class="flex items-center gap-3 w-full px-4 py-3 rounded-darion-sm hover:bg-red-900/20 hover:text-red-300 text-darion-text-muted transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <div class="container mx-auto px-6 py-8">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-semibold">Finance Dashboard</h1>
                    <p class="text-darion-text-muted">Welcome back! Here's what's happening today.</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-darion-text-muted"><?= date('l, F j, Y') ?></p>
                    <p class="text-lg font-medium" id="currentTime"><?= date('h:i:s A') ?></p>
                </div>
            </div>

            <!-- Today's Overview -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Today's Overview</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Users Today -->
                    <div class="glass-card rounded-darion-lg p-6 border border-darion-border/30">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-darion-text-muted text-sm mb-1">New Users</p>
                                <div class="flex items-end gap-2">
                                    <p class="text-2xl font-semibold"><?= $todayStats['users_today'] ?></p>
                                    <p class="text-sm <?= $usersChange >= 0 ? 'text-green-400' : 'text-darion-red' ?>">
                                        <?= $usersChange >= 0 ? '↑' : '↓' ?> <?= abs($usersChange) ?>%
                                    </p>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-blue-900/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-10A2.5 2.5 0 1121 6.5a2.5 2.5 0 01-2.5 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-darion-text-muted mt-3">vs <?= $yesterdayStats['users_yesterday'] ?> yesterday</p>
                    </div>

                    <!-- Applications Today -->
                    <div class="glass-card rounded-darion-lg p-6 border border-darion-border/30">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-darion-text-muted text-sm mb-1">New Applications</p>
                                <div class="flex items-end gap-2">
                                    <p class="text-2xl font-semibold"><?= $todayStats['apps_today'] ?></p>
                                    <p class="text-sm <?= $appsChange >= 0 ? 'text-green-400' : 'text-darion-red' ?>">
                                        <?= $appsChange >= 0 ? '↑' : '↓' ?> <?= abs($appsChange) ?>%
                                    </p>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-darion-text-muted mt-3">vs <?= $yesterdayStats['apps_yesterday'] ?> yesterday</p>
                    </div>

                    <!-- Support Tickets -->
                    <div class="glass-card rounded-darion-lg p-6 border border-darion-border/30">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-darion-text-muted text-sm mb-1">Support Tickets</p>
                                <div class="flex items-end gap-2">
                                    <p class="text-2xl font-semibold"><?= $todayStats['support_today'] ?></p>
                                    <p class="text-sm <?= $supportChange >= 0 ? 'text-green-400' : 'text-darion-red' ?>">
                                        <?= $supportChange >= 0 ? '↑' : '↓' ?> <?= abs($supportChange) ?>%
                                    </p>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-purple-900/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-darion-text-muted mt-3">vs <?= $yesterdayStats['support_yesterday'] ?> yesterday</p>
                    </div>

                    <!-- Sanctioned Today -->
                    <div class="glass-card rounded-darion-lg p-6 border border-darion-primary/30 bg-darion-primary/5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-darion-text-muted text-sm mb-1">Sanctioned Today</p>
                                <p class="text-2xl font-semibold text-darion-primary-light"><?= $todayStats['sanctioned_today'] ?></p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-darion-primary/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs text-darion-text-muted mt-3">Applications sanctioned today</p>
                    </div>
                </div>
            </div>

            <!-- Analytics Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
               <!-- Applications Over Time -->
                    <div class="glass-card rounded-darion-lg p-6 border border-darion-border/50">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold">Loan Applications Trend</h3>
                            <div class="flex items-center space-x-2">
                                <div class="text-sm text-darion-text-muted mr-2">View:</div>
                                <div class="flex space-x-1">
                                    <button onclick="updateChart('daily')" 
                                            class="px-3 py-1 text-xs rounded-darion-sm border border-darion-border hover:bg-darion-glass transition-colors duration-200 data-view-button">
                                        Daily
                                    </button>
                                    <button onclick="updateChart('weekly')" 
                                            class="px-3 py-1 text-xs rounded-darion-sm border border-darion-border hover:bg-darion-glass transition-colors duration-200 data-view-button">
                                        Weekly
                                    </button>
                                    <button onclick="updateChart('monthly')" 
                                            class="px-3 py-1 text-xs rounded-darion-sm border border-darion-border bg-darion-primary/20 text-darion-primary-light border-darion-primary/30 hover:bg-darion-primary/30 transition-colors duration-200 data-view-button active">
                                        Monthly
                                    </button>
                                    <button onclick="updateChart('yearly')" 
                                            class="px-3 py-1 text-xs rounded-darion-sm border border-darion-border hover:bg-darion-glass transition-colors duration-200 data-view-button">
                                        Yearly
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="applicationsChart"></canvas>
                        </div>
                    </div>

                <!-- Loan Type Distribution -->
                <div class="glass-card rounded-darion-lg p-6 border border-darion-border/50">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Loan Type Distribution</h3>
                        <div class="text-sm text-darion-text-muted">Total: <?= $stats['total_apps'] ?></div>
                    </div>
                    <div class="chart-container">
                        <canvas id="loanTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Application Status & Recent Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Application Status -->
                <div class="glass-card rounded-darion-lg p-6 border border-darion-border/50">
                    <h3 class="text-lg font-semibold mb-6">Application Status</h3>
                    <div class="space-y-4">
                        <?php foreach ($stats['status'] as $status): 
                            $percentage = round(($status['count'] / $stats['total_apps']) * 100, 1);
                            $color = match($status['status']) {
                                'submitted' => 'bg-blue-500',
                                'under_review' => 'bg-yellow-500',
                                'sent_to_bank' => 'bg-purple-500',
                                'sanctioned' => 'bg-green-500',
                                'rejected' => 'bg-red-500',
                                default => 'bg-gray-500'
                            };
                        ?>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="capitalize"><?= str_replace('_', ' ', $status['status']) ?></span>
                                <span><?= $status['count'] ?> (<?= $percentage ?>%)</span>
                            </div>
                            <div class="w-full bg-darion-glass rounded-full h-2">
                                <div class="<?= $color ?> h-2 rounded-full" style="width: <?= $percentage ?>%"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Recent Applications -->
                <div class="lg:col-span-2 glass-card rounded-darion-lg p-6 border border-darion-border/50">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Recent Applications</h3>
                        <a href="index.php?page=admin_users" class="text-sm text-darion-primary-light hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-sm text-darion-text-muted border-b border-darion-border/30">
                                    <th class="pb-3">User</th>
                                    <th class="pb-3">Loan Type</th>
                                    <th class="pb-3">Amount</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Date</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <?php foreach (array_slice($applications, 0, 5) as $app): 
                                    $statusColor = match($app['status']) {
                                        'submitted' => 'bg-blue-900/20 text-blue-400',
                                        'under_review' => 'bg-yellow-900/20 text-yellow-400',
                                        'sent_to_bank' => 'bg-purple-900/20 text-purple-400',
                                        'sanctioned' => 'bg-green-900/20 text-green-400',
                                        'rejected' => 'bg-red-900/20 text-red-400',
                                        default => 'bg-gray-900/20 text-gray-400'
                                    };
                                ?>
                                <tr class="border-b border-darion-border/10 table-row-hover">
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-darion-primary/20 flex items-center justify-center">
                                                <span class="text-xs font-medium text-darion-primary-light">
                                                    <?= strtoupper(substr($app['user_name'], 0, 2)) ?>
                                                </span>
                                            </div>
                                            <div>
                                                <p class="font-medium"><?= htmlspecialchars($app['user_name']) ?></p>
                                                <p class="text-xs text-darion-text-muted"><?= htmlspecialchars($app['email']) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4"><?= htmlspecialchars($app['loan_type']) ?></td>
                                    <td class="py-4">₹<?= number_format($app['requested_amount']) ?></td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium <?= $statusColor ?>">
                                            <?= ucfirst(str_replace('_', ' ', $app['status'])) ?>
                                        </span>
                                    </td>
                                    <td class="py-4 text-darion-text-muted"><?= date('M d, Y', strtotime($app['created_at'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="glass-card rounded-darion-lg p-6 border border-darion-border/50">
                <h3 class="text-lg font-semibold mb-6">Quick Stats</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="text-center p-4">
                        <p class="text-2xl font-semibold text-darion-primary-light"><?= $stats['total_apps'] ?></p>
                        <p class="text-sm text-darion-text-muted">Total Applications</p>
                    </div>
                    <div class="text-center p-4">
                        <p class="text-2xl font-semibold text-green-400"><?= $stats['sanctioned'] ?? 0 ?></p>
                        <p class="text-sm text-darion-text-muted">Sanctioned</p>
                    </div>
                    <div class="text-center p-4">
                        <p class="text-2xl font-semibold text-yellow-400"><?= $stats['pending'] ?? 0 ?></p>
                        <p class="text-sm text-darion-text-muted">Pending Review</p>
                    </div>
                    <div class="text-center p-4">
                        <p class="text-2xl font-semibold text-blue-400"><?= $stats['total_users'] ?? 0 ?></p>
                        <p class="text-sm text-darion-text-muted">Total Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       // Update time every second
function updateTime() {
    const now = new Date();
    document.getElementById('currentTime').textContent = 
        now.toLocaleTimeString('en-US', { hour12: true });
}
setInterval(updateTime, 1000);

// Chart data
const monthlyData = <?= json_encode($stats['monthly']) ?>;
const loanTypeData = <?= json_encode($stats['loan_types']) ?>;

// Applications Chart
const applicationsCtx = document.getElementById('applicationsChart').getContext('2d');
let applicationsChart;

// Sample data for different time periods (you would fetch this from your backend)
const sampleData = {
    daily: {
        labels: ['9 AM', '10 AM', '11 AM', '12 PM', '1 PM', '2 PM', '3 PM', '4 PM', '5 PM', '6 PM'],
        data: [5, 8, 12, 15, 10, 14, 18, 22, 15, 8]
    },
    weekly: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        data: [45, 52, 38, 67, 72, 48, 35]
    },
    monthly: {
        labels: monthlyData.map(m => m.month),
        data: monthlyData.map(m => m.count)
    },
    yearly: {
        labels: ['2020', '2021', '2022', '2023', '2024'],
        data: [850, 1200, 1850, 2200, 2800]
    }
};

// Initialize chart with monthly data
function initChart() {
    applicationsChart = new Chart(applicationsCtx, {
        type: 'line',
        data: {
            labels: sampleData.monthly.labels,
            datasets: [{
                label: 'Loan Applications',
                data: sampleData.monthly.data,
                borderColor: '#4a9e86',
                backgroundColor: 'rgba(74, 158, 134, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2C7446',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(22, 27, 34, 0.9)',
                    titleColor: '#ffffff',
                    bodyColor: '#8b949e',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#8b949e',
                        font: {
                            size: 11
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.05)',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#8b949e',
                        font: {
                            size: 11
                        },
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            elements: {
                line: {
                    tension: 0.4
                }
            }
        }
    });
}

// Update chart based on selected time period
function updateChart(period) {
    if (!sampleData[period]) return;
    
    // Update active button
    document.querySelectorAll('.data-view-button').forEach(btn => {
        btn.classList.remove('active', 'bg-darion-primary/20', 'text-darion-primary-light', 'border-darion-primary/30');
        btn.classList.add('border-darion-border', 'hover:bg-darion-glass');
    });
    
    event.target.classList.add('active', 'bg-darion-primary/20', 'text-darion-primary-light', 'border-darion-primary/30');
    event.target.classList.remove('border-darion-border', 'hover:bg-darion-glass');
    
    // Update chart data
    applicationsChart.data.labels = sampleData[period].labels;
    applicationsChart.data.datasets[0].data = sampleData[period].data;
    
    // Update y-axis label formatting for different periods
    if (period === 'daily' || period === 'weekly') {
        applicationsChart.options.scales.y.ticks.callback = function(value) {
            return value;
        };
    } else {
        applicationsChart.options.scales.y.ticks.callback = function(value) {
            return value.toLocaleString();
        };
    }
    
    // Update chart label based on period
    let label = 'Loan Applications';
    switch(period) {
        case 'daily':
            label = 'Applications Today';
            break;
        case 'weekly':
            label = 'Applications This Week';
            break;
        case 'monthly':
            label = 'Loan Applications (Monthly)';
            break;
        case 'yearly':
            label = 'Annual Applications';
            break;
    }
    applicationsChart.data.datasets[0].label = label;
    
    applicationsChart.update();
    
    // You can also fetch real data here:
    // fetchDataForPeriod(period).then(data => {
    //     applicationsChart.data.labels = data.labels;
    //     applicationsChart.data.datasets[0].data = data.values;
    //     applicationsChart.update();
    // });
}

        // Loan Type Chart
        const loanTypeCtx = document.getElementById('loanTypeChart').getContext('2d');
        const loanTypeChart = new Chart(loanTypeCtx, {
            type: 'doughnut',
            data: {
                labels: loanTypeData.map(t => t.loan_type),
                datasets: [{
                    data: loanTypeData.map(t => t.count),
                    backgroundColor: [
                        '#2C7446',
                        '#4a9e86',
                        '#5e7a7d',
                        '#d4a94e',
                        '#4a7b9e',
                        '#7d4a9e'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            color: '#8b949e',
                            padding: 20
                        }
                    }
                }
            }
        });
        // Function to fetch data from backend (example)
async function fetchDataForPeriod(period) {
    try {
        const response = await fetch(`index.php?page=admin_chart_data&period=${period}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching chart data:', error);
        return sampleData[period];
    }
}

// Add some CSS for the active state
const style = document.createElement('style');
style.textContent = `
    .data-view-button.active {
        background: rgba(44, 116, 70, 0.2) !important;
        color: #4a9e86 !important;
        border-color: rgba(44, 116, 70, 0.3) !important;
    }
`;
document.head.appendChild(style);

// Initialize chart on page load
document.addEventListener('DOMContentLoaded', initChart);
    </script>
</body>
</html>