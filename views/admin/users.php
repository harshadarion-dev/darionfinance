<?php
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    echo "Access Denied";
    exit;
}

require_once __DIR__ . "/../../controllers/AdminController.php";
$admin = new AdminController();
$applications = $admin->dashboard();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Darion Finance</title>

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
    </style>
</head>

<body class="darion-bg-effect text-darion-text font-inter flex">

<!-- Sidebar -->
<div class="w-64 bg-darion-panel/90 backdrop-blur-darion h-screen fixed top-0 left-0 border-r border-darion-border">
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
            <a href="index.php?page=support_messages" 
               class="flex items-center gap-3 px-4 py-3 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Support
            </a>
        </nav>
    </div>
</div>

<!-- Main Content -->
<div class="ml-64 w-full p-10">

    <!-- Page Header -->
    <div class="mb-10">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-light mb-2">Loan Applications</h1>
                <p class="text-darion-text-muted">Manage and monitor all loan applications in one place.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="glass-card px-4 py-2 rounded-darion-sm">
                    <span class="text-darion-text-muted text-sm">Total Applications:</span>
                    <span class="font-medium ml-2"><?= count($applications) ?></span>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        <?php if (!empty($_SESSION["success"])): ?>
            <div class="bg-darion-primary/20 border-l-4 border-darion-primary-light text-darion-primary-light p-4 rounded-darion-sm mb-6 mt-6">
                <?= $_SESSION["success"]; unset($_SESSION["success"]); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Applications Table -->
    <div class="glass-card shadow-xl rounded-darion-lg overflow-hidden border border-darion-border">
        <?php if (empty($applications)): ?>
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-darion-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium mb-2">No Applications Found</h3>
                <p class="text-darion-text-muted">There are no loan applications to display.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-darion-primary to-darion-primary-light">
                            <th class="py-4 px-6 text-left font-medium">ID</th>
                            <th class="py-4 px-6 text-left font-medium">User</th>
                            <th class="py-4 px-6 text-left font-medium">Phone</th>
                            <th class="py-4 px-6 text-left font-medium">Loan Type</th>
                            <th class="py-4 px-6 text-left font-medium">Amount</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                            <th class="py-4 px-6 text-left font-medium">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-darion-border/30">
                        <?php foreach ($applications as $app): ?>
                        <tr class="table-row-hover transition-colors">
                            <td class="py-4 px-6 font-mono text-sm">#<?= $app["id"] ?></td>
                            <td class="py-4 px-6">
                                <div class="font-medium"><?= htmlspecialchars($app["user_name"]) ?></div>
                                <div class="text-xs text-darion-text-muted">User ID: <?= $app["user_id"] ?></div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <?= htmlspecialchars($app["phone"]) ?>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-darion-primary/10 text-darion-primary-light rounded-full text-sm">
                                    <?= $app["loan_type"] ?>
                                </span>
                            </td>
                            <td class="py-4 px-6 font-medium">₹<?= number_format($app["requested_amount"]) ?></td>

                            <!-- Status Badge -->
                            <td class="py-4 px-6">
                                <?php
                                $status = $app["status"];
                                $statusConfig = [
                                    "submitted" => ["color" => "bg-gray-700 text-gray-300", "icon" => "M9 12h6m-6 4h6"],
                                    "documents_verified" => ["color" => "bg-blue-900/30 text-blue-300", "icon" => "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"],
                                    "missing_documents" => ["color" => "bg-red-900/30 text-red-300", "icon" => "M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"],
                                    "processing" => ["color" => "bg-yellow-900/30 text-yellow-300", "icon" => "M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"],
                                    "sent_to_ruloans" => ["color" => "bg-indigo-900/30 text-indigo-300", "icon" => "M13 10V3L4 14h7v7l9-11h-7z"],
                                    "sent_to_bank" => ["color" => "bg-purple-900/30 text-purple-300", "icon" => "M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"],
                                    "sanctioned" => ["color" => "bg-darion-primary/30 text-darion-primary-light", "icon" => "M5 13l4 4L19 7"],
                                    "rejected" => ["color" => "bg-red-900/50 text-red-300", "icon" => "M6 18L18 6M6 6l12 12"]
                                ][$status] ?? ["color" => "bg-gray-700 text-gray-300", "icon" => "M9 12h6m-6 4h6"];
                                ?>

                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm <?= $statusConfig["color"] ?>">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="<?= $statusConfig["icon"] ?>"></path>
                                    </svg>
                                    <?= ucfirst(str_replace("_", " ", $status)) ?>
                                </div>
                            </td>

                            <!-- Action -->
                            <td class="py-4 px-6">
                                <a href="index.php?page=view_app&app_id=<?= $app["id"] ?>"
                                   class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-10">
        <div class="glass-card p-6 rounded-darion-lg border border-darion-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Total Applications</p>
                    <p class="text-2xl font-medium"><?= count($applications) ?></p>
                </div>
                <div class="w-10 h-10 bg-blue-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="glass-card p-6 rounded-darion-lg border border-darion-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Processing</p>
                    <p class="text-2xl font-medium">
                        <?= count(array_filter($applications, fn($app) => in_array($app["status"], ["processing", "documents_verified"]))) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-yellow-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="glass-card p-6 rounded-darion-lg border border-darion-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Sanctioned</p>
                    <p class="text-2xl font-medium">
                        <?= count(array_filter($applications, fn($app) => $app["status"] === "sanctioned")) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-darion-primary/30 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="glass-card p-6 rounded-darion-lg border border-darion-border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-darion-text-muted text-sm mb-1">Pending Review</p>
                    <p class="text-2xl font-medium">
                        <?= count(array_filter($applications, fn($app) => $app["status"] === "submitted")) ?>
                    </p>
                </div>
                <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>